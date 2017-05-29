using Antlr.Runtime;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows;

namespace Importer
{
    public class ScriptParser
    {
        private readonly TextReader input;
        private readonly List<IEntity> result;
        private IEntityParser parser;

        public ScriptParser(TextReader input)
        {
            result = new List<IEntity>();
            this.input = input;
        }

        public List<IEntity> Run()
        {
            string line;
            while ((line = input.ReadLine()) != null)
            {
                line = AppendContinuingLine(line);
                ParseLine(line);
            }
            return result;
        }

        private string AppendContinuingLine(string line)
        {
            if (IsContinuingLine(line))
            {
                var first = Regex.Replace(line, @"\+\s*$", "");
                var next = input.ReadLine();
                if (next == null)
                {
                    MessageBox.Show("Une erreur s'est produite avec la continuation de l'instruction" + line);
                    Application.Current.Shutdown();
                }
                    
                return String.Format("{0} {1}", first.Trim(), AppendContinuingLine(next));
            }
            else
                return line.Trim();
        }

        private bool IsContinuingLine(string line)
        {
            return Regex.IsMatch(line, @"\+\s*$");
        }

        private void ParseLine(string line)
        {
            line = RemoveComment(line);
            line = Regex.Replace(line, @"\s+", "");
            if (IsEmpty(line))
                return;
            if (IsEntityDefinition(line))
                ChangeParser(line);
            else if (IsFieldDefinition(line))
                ChangeFieldDefinition(line);
            else
                result.Add(parser.Parse(line));
        }

        private string RemoveComment(string line)
        {
            return Regex.Replace(line, @"--.*", "");
        }

        private bool IsEmpty(string line)
        {
            return Regex.IsMatch(line, @"^\s*$") || Regex.IsMatch(line, @"^,*$");
        }

        private bool IsEntityDefinition(string line)
        {
            return Regex.IsMatch(line, @"^:.+");
        }

        private void ChangeParser(string line)
        {
            line = Regex.Replace(line, @"^:", "");
            switch (line)
            {
                case "Joueur":
                    parser = new JoueurParser();
                    break;
                case "Entraineur":
                    parser = new EntraineurParser();
                    break;
                default:
                    MessageBox.Show("Les insertions de " + line + " ne sont pas supportées");
                    Application.Current.Shutdown();
                    break;
            }
        }

        private bool IsFieldDefinition(string line)
        {
            return Regex.IsMatch(line, @"^>.*");
        }

        private void ChangeFieldDefinition(string line)
        {
            parser.FieldDefinition = line.Split(',');
        }
    }
}

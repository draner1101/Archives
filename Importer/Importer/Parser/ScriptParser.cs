using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace Importer
{
    public class ScriptParser
    {
        private readonly TextReader input;
        //private readonly List<Offer> result;

        //public OfferScriptParser(TextReader input)
        //{
        //    result = new List<Offer>();
        //    this.input = input;
        //}

        //public List<Offer> Run()
        //{
        //    string line;
        //    while ((line = input.ReadLine()) != null)
        //    {
        //        line = AppendContinuingLine(line);
        //        ParseLine(line);
        //    }
        //    return result;
        //}

        //private string AppendContinuingLine(string line)
        //{
        //    if (IsContinuingLine(line))
        //    {
        //        var first = Regex.Replace(line, @"&\s*$", "");
        //        var next = input.ReadLine();
        //        if (next == null)
        //            throw new RecognitionException(line);
        //        return String.Format("{0} {1}", first.Trim(), AppendContinuingLine(line));
        //    }
        //    else
        //        return line.Trim();
        //}

        //private bool IsContinuingLine(string line)
        //{
        //    return Regex.IsMatch(line, @"&\s*$");
        //}

        //private void ParseLine(string line)
        //{
        //    line = RemoveComment(line);
        //    if (IsEmpty(line))
        //        return;
        //    result.Add(new OfferLineParser().Parse(line.Trim()));

        //}

        //private string RemoveComment(string line)
        //{
        //    return Regex.Replace(line, @"#.*", "");
        //}

        //private bool IsEmpty(string line)
        //{
        //    return Regex.IsMatch(line, @"^\s*$");
        //}
    }
}

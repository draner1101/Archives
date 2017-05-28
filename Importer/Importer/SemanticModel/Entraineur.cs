using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class Entraineur : IEntity
    {
        public Personne Personne { get; set; }
        public string NoEmbauche { get; set; }
        public string Type { get; set; }
        public string Note { get; set; }
        
        public static Entraineur FromArray(string[] fieldDefinition, string[] values)
        {
            return new Entraineur(fieldDefinition, values);
        }

        private Entraineur(string[] fieldDefinition, string[] values)
        {
            Personne = Personne.FromArray(fieldDefinition, values);
            NoEmbauche = Array.Exists(fieldDefinition, field => field.Equals("NoEmbauche"))
                ? values[Array.IndexOf(fieldDefinition, "NoEmbauche")]
                : "";
            Type = Array.Exists(fieldDefinition, field => field.Equals("Type"))
                ? values[Array.IndexOf(fieldDefinition, "Type")]
                : "";
            Note = Array.Exists(fieldDefinition, field => field.Equals("Note"))
                ? values[Array.IndexOf(fieldDefinition, "Note")]
                : "";
        }

        public void Write(TextWriter output)
        {
            Personne.Write(output);

            string instruction = "INSERT INTO entraineurs(`id_personne`, `no_embauche`, `note`, `type`, `statut`)" +
                "VALUES(LAST_INSERT_ID(), '" + NoEmbauche.ToSafeString() + "', '" + Note.ToSafeString() + "', '" +
                Type.ToSafeString() + "', 'actif');";
            output.WriteLine(instruction);

        }
    }
}

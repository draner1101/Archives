using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class Personne : IEntity
    {
        public string Nom { get; set; }
        public string Prenom { get; set; }
        public string Sexe { get; set; }
        public DateTime? DateNaissance { get; set; }
        public string Telephone { get; set; }
        public string Poste { get; set; }
        public string Courriel { get; set; }
        public string Adresse { get; set; }
        public string Ville { get; set; }
        public string Province { get; set; }

        public static Personne FromArray(string[] fieldDefinition, string[] values)
        {
            return new Personne(fieldDefinition, values);
        }

        private Personne(string[] fieldDefinition, string[] values)
        {
            Nom = Array.Exists(fieldDefinition, field => field.Equals("Nom"))
                ? values[Array.IndexOf(fieldDefinition, "Nom")]
                : "";
            Prenom = Array.Exists(fieldDefinition, field => field.Equals("Prenom"))
                ? values[Array.IndexOf(fieldDefinition, "Prenom")]
                : "";
            Adresse = Array.Exists(fieldDefinition, field => field.Equals("Adresse"))
                ? values[Array.IndexOf(fieldDefinition, "Adresse")]
                : "";
            Courriel = Array.Exists(fieldDefinition, field => field.Equals("Courriel"))
                ? values[Array.IndexOf(fieldDefinition, "Courriel")]
                : "";
            DateNaissance = Array.Exists(fieldDefinition, field => field.Equals("DateNaissance"))
                ? (DateTime?)Convert.ToDateTime(values[Array.IndexOf(fieldDefinition, "DateNaissance")])
                : null;
            Province = Array.Exists(fieldDefinition, field => field.Equals("Province"))
                ? values[Array.IndexOf(fieldDefinition, "Province")]
                : "";
            Sexe = Array.Exists(fieldDefinition, field => field.Equals("Sexe"))
                ? values[Array.IndexOf(fieldDefinition, "Sexe")]
                : "";
            Ville = Array.Exists(fieldDefinition, field => field.Equals("Ville"))
                ? values[Array.IndexOf(fieldDefinition, "Ville")]
                : "";
            Telephone = Array.Exists(fieldDefinition, field => field.Equals("Telephone"))
                ? values[Array.IndexOf(fieldDefinition, "Telephone")]
                : "";
            Poste = Array.Exists(fieldDefinition, field => field.Equals("Poste"))
                ? values[Array.IndexOf(fieldDefinition, "Poste")]
                : "";
        }

        public string Write()
        {
            throw new NotImplementedException();
        }
    }
}

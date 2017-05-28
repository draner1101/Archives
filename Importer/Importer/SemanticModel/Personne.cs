using System;
using System.Collections.Generic;
using System.IO;
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
        public string CodePostal { get; set; }
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
            Courriel = Array.Exists(fieldDefinition, field => field.Equals("CodePostal"))
                ? values[Array.IndexOf(fieldDefinition, "CodePostal")]
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

        public void Write(TextWriter output)
        {
            DateTime dateNaissance = new DateTime();
            if (DateNaissance != null)
                dateNaissance = (DateTime)DateNaissance;

            string instruction = "INSERT INTO personnes(`nom`, `prenom`, `sexe`, `date_naissance`, `no_tel` " +
                ", `posteTelephonique`, `courriel`, `rue`, `ville`, `province`, `code_postal`, `statut`)" +
                "VALUES('" + Nom.ToSafeString() + "', '" + Prenom.ToSafeString() + "', '" + Sexe.ToSafeString() + 
                "', '" + dateNaissance.ToShortDateString() +  "', '" + Telephone.ToSafeString() + "', '" + Poste +
                "', '" + Courriel + "', '" + Adresse.ToSafeString() + "', '" + Ville.ToSafeString() +
                "', '" + Province.ToSafeString() + "', '" + CodePostal + "', 'actif');";
      
            output.WriteLine(instruction);
        }
    }
}

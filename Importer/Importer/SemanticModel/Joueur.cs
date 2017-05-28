using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class Joueur : IEntity
    {
        public Personne Personne { get; set; }
        public double? Taille { get; set; }
        public double? Poids { get; set; }
        public string EcoleSecondaire { get; set; }
        public string VilleNatale { get; set; }
        public string DomaineEtude { get; set; }
        public string Note { get; set; }

        public static Joueur FromArray(string[] fieldDefinition, string[] values)
        {
            return new Joueur(fieldDefinition, values);
        }

        private Joueur(string[] fieldDefinition, string[] values)
        {
            Personne = Personne.FromArray(fieldDefinition, values);
            Taille = Array.Exists(fieldDefinition, field => field.Equals("Taille")) 
                ? (double?)Convert.ToDouble(values[Array.IndexOf(fieldDefinition, "Taille")])
                : null;
            Poids = Array.Exists(fieldDefinition, field => field.Equals("Poids"))
                ? (double?)Convert.ToDouble(values[Array.IndexOf(fieldDefinition, "Poids")])
                : null;
            DomaineEtude = Array.Exists(fieldDefinition, field => field.Equals("DomaineEtude"))
                ? values[Array.IndexOf(fieldDefinition, "DomaineEtude")]
                : "";
            EcoleSecondaire = Array.Exists(fieldDefinition, field => field.Equals("EcoleSecondaire"))
                ? values[Array.IndexOf(fieldDefinition, "EcoleSecondaire")]
                : "";
            VilleNatale = Array.Exists(fieldDefinition, field => field.Equals("VilleNatale"))
                ? values[Array.IndexOf(fieldDefinition, "VilleNatale")]
                : "";
            Note = Array.Exists(fieldDefinition, field => field.Equals("Note"))
                ? values[Array.IndexOf(fieldDefinition, "Note")]
                : "";
        }

        public string Write()
        {
            throw new NotImplementedException();
        }
    }
}

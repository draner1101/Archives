﻿using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class Joueur : IEntity
    {
        public Personne Personne { get; set; }
        public string Taille { get; set; }
        public string Poids { get; set; }
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
                ? values[Array.IndexOf(fieldDefinition, "Taille")]
                : "";
            Poids = Array.Exists(fieldDefinition, field => field.Equals("Poids"))
                ? values[Array.IndexOf(fieldDefinition, "Poids")]
                : "";
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

        public void Write(TextWriter output)
        {
            string taille = String.IsNullOrEmpty(Taille) ? "NULL" : Taille;
            string poids = String.IsNullOrEmpty(Poids) ? "NULL" : Poids;
          
            Personne.Write(output);
       
            string instruction = "INSERT INTO joueurs(`id_personne`, `taille`, `poids`, `note`, `ecole_prec`, " +
                "`ville_natal`, `domaine_etude`, `statut`) VALUES(LAST_INSERT_ID(), " + taille + ", " + poids +
                ", '" + Note.ToSafeString() + "', '" + EcoleSecondaire.ToSafeString() + "', '" + 
                VilleNatale.ToSafeString() + "', '" + DomaineEtude.ToSafeString() + "' , 'actif');";
            output.WriteLine(instruction);
        }
    }
}

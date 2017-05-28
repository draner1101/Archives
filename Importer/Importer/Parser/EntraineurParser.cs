using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class EntraineurParser : IEntityParser
    {
        public string[] FieldDefinition { get; set; }

        public IEntity Parse(string line)
        {
            string[] values = line.Split(',');
            return Entraineur.FromArray(FieldDefinition, values);
        }
    }
}

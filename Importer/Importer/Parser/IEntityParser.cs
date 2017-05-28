using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public interface IEntityParser
    {
        string[] FieldDefinition { get; set; }
        IEntity Parse(string line);
    }
}

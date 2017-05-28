using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public interface IEntity
    {
        void Write(TextWriter output);
    }
}

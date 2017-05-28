using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public class ScriptWriter
    {
        List<IEntity> input;
        TextWriter output;

        public ScriptWriter(List<IEntity> input, TextWriter output)
        {
            this.input = input;
            this.output = output;
        }

        public void Run()
        {
            foreach (var entity in input)
                entity.Write(output);
            output.Close();
        }
    }
}

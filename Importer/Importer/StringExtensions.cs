using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Importer
{
    public static class StringExtensions
    {
        public static string ToSafeString(this string input)
        {
            return input.Replace("'", "\'");
        }
    }
}

using Microsoft.Win32;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace Importer
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        string pathFrom, pathTo;
        public MainWindow()
        {
            InitializeComponent();
        }

        private void BtnOpenFile_Click(object sender, RoutedEventArgs e)
        {
            BtnSaveFile.IsEnabled = false;
            LblPathFrom.Content = "";
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Filter = "Fichier text (*.txt)|*.txt";
            if (openFileDialog.ShowDialog() == true)
            {
                pathFrom = openFileDialog.SafeFileName;
                LblPathFrom.Content = pathFrom;
                BtnSaveFile.IsEnabled = true;
            }
        }

        private void BtnSaveFile_Click(object sender, RoutedEventArgs e)
        {
            SaveFileDialog saveFileDialog = new SaveFileDialog();
            saveFileDialog.Filter = "Fichier SQL (*.sql)|*.sql";
            if (saveFileDialog.ShowDialog() == true)
            {
                pathTo = saveFileDialog.FileName;
                using (var input = new StreamReader(pathFrom))
                using (var output = new StreamWriter(pathTo))
                {
                    ScriptParser parser = new ScriptParser(input);
                    ScriptWriter writer = new ScriptWriter(parser.Run(), output);
                    writer.Run();
                }
                MessageBox.Show("Fichier généré");
            }
        }
    }
}

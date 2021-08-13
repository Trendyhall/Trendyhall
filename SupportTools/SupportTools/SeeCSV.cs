using System;
using System.IO;
using System.Windows.Forms;

namespace SupportTools
{
    public partial class SeeCSV : Form
    {
        public SeeCSV()
        {
            InitializeComponent();
        }

        private void textBox1_Click(object sender, EventArgs e)
        {
            if (openFileDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox1.Text = openFileDialog1.FileName;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (File.Exists(textBox1.Text))
            {
                try
                {
                    string[] dt1 = File.ReadAllLines(textBox1.Text);
                    string[][] data = new string[dt1.Length][];
                    ListViewItem[] lvi = new ListViewItem[dt1.Length];
                    for (int i = 0; i < dt1.Length; i++)
                    {
                        data[i] = dt1[i].Split(';');
                        lvi[i] = new ListViewItem(data[i]);
                    }

                    listView1.Items.AddRange(lvi);

                    MessageBox.Show("Process has ended", "All done", MessageBoxButtons.OK);
                }
                catch (Exception err)
                {
                    MessageBox.Show("Process has interupted with error:\n" + err.Message, "ERROR", MessageBoxButtons.OK);
                }
            }
            else
            {
                MessageBox.Show("One of files does not exsist", "You are stupid", MessageBoxButtons.OK);
            }
        }
    }
}

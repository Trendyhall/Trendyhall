using System;
using System.IO;
using System.Windows.Forms;
using System.Collections.Generic;

namespace SupportTools
{
    public partial class Rename_image : Form
    {
        public Rename_image()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (File.Exists(textBox3.Text) && File.Exists(textBox3.Text) && File.Exists(textBox3.Text))
            {
                try
                {
                    Process();
                    MessageBox.Show( "Process has ended", "All done",MessageBoxButtons.OK);
                }
                catch (Exception err)
                {
                    MessageBox.Show("Process has interupted with error:\n"+err.Message, "ERROR", MessageBoxButtons.OK);
                }
            }
            else
            {
                MessageBox.Show("One of files does not exsist", "You are stupid", MessageBoxButtons.OK);
            }

        }

        private void textBox1_Click(object sender, EventArgs e)
        {
            if (folderBrowserDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox1.Text = folderBrowserDialog1.SelectedPath;
            }
        }

        private void textBox2_Click(object sender, EventArgs e)
        {
            if (folderBrowserDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox2.Text = folderBrowserDialog1.SelectedPath;
            }
        }

        private void textBox3_Click(object sender, EventArgs e)
        {
            if (openFileDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox3.Text = openFileDialog1.FileName;
            }
        }

        private void Process()
        {
            // id;modelcode;imagecount;colourcode
            foreach (var line in File.ReadAllLines(textBox3.Text))
            {
                string[] row = line.Split(';');

                string fileName = Path.Combine(textBox1.Text, $"id{row[0]}.webp");

                if (File.Exists(fileName))
                {
                    File.Move(fileName, Path.Combine(textBox1.Text, $"{row[1]}_{row[3]}.webp"));
                }

                for (int i = 1; i <= int.Parse(row[2]); i++)
                {
                    fileName = Path.Combine(textBox2.Text, $"id{row[0]}_{i}.webp");

                    if (File.Exists(fileName))
                    {
                        File.Move(fileName, Path.Combine(textBox2.Text, $"{row[1]}_{row[3]}_{i}.webp"));
                    }
                }
            }
        }
    }
}


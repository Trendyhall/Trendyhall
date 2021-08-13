using System;
using System.IO;
using System.Windows.Forms;
using System.Collections.Generic;

namespace SupportTools
{
    public partial class SetFirstSize : Form
    {
        public SetFirstSize()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (File.Exists(textBox1.Text) && textBox2.Text.Length > 0)
            {
                try
                {
                    new FirstSizeSetter().Start(textBox1.Text, textBox2.Text);
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

        private void textBox1_Click(object sender, EventArgs e)
        {
            if (openFileDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox1.Text = openFileDialog1.FileName;
            }
        }

        private void textBox2_Click(object sender, EventArgs e)
        {
            if (saveFileDialog1.ShowDialog() == DialogResult.OK)
            {
                textBox2.Text = saveFileDialog1.FileName;
            }
        }
    }

    class FirstSizeSetter
    {
        //id;articule;modelcode;colour;size;firstsize;gender;brand;itemgroup;name;consist;provider;manufacturer;country;imagecount;price;sale;count;season;description

        // [0] -> id
        // [2] -> modelcode
        // [3] -> colour
        // [4] -> size
        // [5] -> firstsize


        string[][] data;

        public void Start(string inputFile, string outputFile)
        {
            string[] predata = File.ReadAllLines(inputFile);

            data = new string[predata.Length][];
            for (int i = 0; i < predata.Length; i++)
            {
                data[i] = predata[i].Split(';');
            }


            for (int i = 0; i < data.Length; i++)
            {
                if (data[i][5] == "") SetSomthing(i);
            }



            for (int i = 0; i < predata.Length; i++)
            {
                predata[i] = data[i][0];
                for (int j = 1; j < data[i].Length; j++)
                {
                    predata[i] += ";"+data[i][j];
                }
            }
            File.WriteAllLines(outputFile, predata);
        }

        void SetSomthing(int f)
        {
            string pattern = data[f][2]+data[f][3];
            data[f][5] = "0";
            List<int> a = new List<int>();
            for (int i = 0; i < data.Length; i++)
            {
                if (data[i][2] + data[i][3] == pattern) a.Add(i);
            }

            for (int i = 0; i < a.Count; i++)
            {
                if (a[i] != f) data[a[i]][5] = data[f][0];
            }

        }
    }

}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace SupportTools
{
    public partial class SteelImages : Form
    {
        public SteelImages()
        {
            InitializeComponent();
            //DownloadImage();
        }

        public void DownloadImage()
        {
            using (WebClient client = new WebClient())
            {
                client.DownloadFile(new Uri("https://tommy-europe.scene7.com/is/image/TommyEurope/KB0KB06291_1BC_main?$main$"), @"c:\temp\image35.png");
                // OR 
                //client.DownloadFileAsync(new Uri(url), @"c:\temp\image35.png");
            }
        }
    }
}

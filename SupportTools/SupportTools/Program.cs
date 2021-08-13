using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace SupportTools
{
    static class Program
    {
        /// <summary>
        /// Главная точка входа для приложения.
        /// </summary>
        [STAThread]
        static void Main()
        {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            Application.Run(new StartPage());
            while (IsRunNewForm)
            {
                IsRunNewForm = false;
                Application.Run(NewForm);
            }
        }

        static bool IsRunNewForm = false;
        static Form NewForm;
        public static void StartForm(Form form)
        {
            IsRunNewForm = true;
            NewForm = form;
        }
    }
}

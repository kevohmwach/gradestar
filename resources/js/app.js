import './bootstrap';

import 'bootstrap/dist/js/bootstrap.bundle.min';

import 'bootstrap/dist/css/bootstrap.min.css';

import '@fortawesome/fontawesome-free/css/all.min.css';

/* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function update_patient() {
          document.getElementById("form_Dropdown").classList.toggle("show");
          //alert( document.getElementById("myDropdown").classList);
        }
        function account() {
          document.getElementById("acc_Dropdown").classList.toggle("show");
        }

        function view_records() {
          document.getElementById("record_Dropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(e) {
          if (!e.target.matches('.form_dropbtn')) {
          var form_Dropdown = document.getElementById("form_Dropdown");
            if (form_Dropdown.classList.contains('show')) {
                form_Dropdown.classList.remove('show');
            }
          }

          if (!e.target.matches('.acc_dropbtn')) {
          var acc_Dropdown = document.getElementById("acc_Dropdown");
            if (acc_Dropdown.classList.contains('show')) {
                acc_Dropdown.classList.remove('show');
            }
          }

          if (!e.target.matches('.record_dropbtn')) {
          var record_Dropdown = document.getElementById("record_Dropdown");
            if (record_Dropdown.classList.contains('show')) {
                record_Dropdown.classList.remove('show');
            }
          }

        }
   

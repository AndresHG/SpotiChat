
//CheckBox enable other gender
// document.getElementById('yourBox').onchange = function() {
//     document.getElementById('yourText').disabled = !this.checked;
// };


//'otro? option in Select ComboBox' enable other gender
function myFunction()
{
 var ddl = document.getElementById("drop");
 var selectedValue = ddl.options[ddl.selectedIndex].value;
    if (selectedValue == "otro")
   {
    document.getElementById('yourText').disabled = false;
   }
   else {
     document.getElementById('yourText').disabled = true;
   }
}

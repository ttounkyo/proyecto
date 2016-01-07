// Oculta o muestra un contenido 
function showmenu(id) {
  if(document.getElementById(id).style.display == "block") {
	document.getElementById(id).style.display ="none !important";
  }
  else {
    document.getElementById(id).style.display = "block !important";
  }
}
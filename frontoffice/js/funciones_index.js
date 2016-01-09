// Oculta o muestra un contenido 
function showmenu(){
  if(document.getElementById('menulog').style.display == "block") {
	document.getElementById('menulog').style.display ="none";
  }
  else {
    document.getElementById('menulog').style.display = "block";
  }
}

function showmenu2(){
  if(document.getElementById('nav').style.display == "inline-block") {
	document.getElementById('nav').style.display ="none";
  }
  // else if(document.getElementById('nav').style.display == "none"){
  // 	document.getElementById('nav').style.display ="block";
  // }
  else {
    document.getElementById('nav').style.display = "inline-block";
  }
}
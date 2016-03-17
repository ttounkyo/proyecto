// Oculta o muestra un contenido 
function showmenu(){
  if(document.getElementById('menulog').style.display == "block") {
	document.getElementById('menulog').style.display ="none";
  }
  else {
    document.getElementById('menulog').style.display = "block";
  }
}

// function showmenu(){
//   if(document.getElementById('menulog').style.display == "block") {
//   document.getElementById('menulog').style.display ="none";
//   }
//   else {
//     document.getElementById('menulog').style.display = "block";
//     // document.getElementById('menulog').style.float = "left";
//     document.getElementById('menulog').style.position = "absolute";
//     document.getElementById('menulog').style.background = "black";
//     document.getElementById('menulog').style.width = "250px";
//     document.getElementById('menulog').style.height = "250px";
//     document.getElementById('menulog').style.visibility = "visible";
//     document.getElementById('menulog').style.overflow = "hidden";
//   }
// }

function showmenu2(){
  if(document.getElementById('nav').style.display == "inline-block") {
	document.getElementById('nav').style.display ="none";
  }
  else {
    document.getElementById('nav').style.display = "inline-block";
  }
}
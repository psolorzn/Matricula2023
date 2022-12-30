function modificarClave() {
  document.getElementById("nuevaClave1").value = "";
  document.getElementById("nuevaClave2").value = "";
  document.getElementById("divClave").style.display = "";
  document.getElementById("msgError").innerHTML = "";
}
function cancelarClave() {
  document.getElementById("divClave").style.display = "none";
}
function guardarClave() {
  var xhttp;
  var clave1 = document.getElementById("nuevaClave1").value;
  var clave2 = document.getElementById("nuevaClave2").value;

  if (clave1 == "" || clave1 !== clave2) {

    document.getElementById("msgError").innerHTML = "Error en contraseña";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      respuesta =  this.responseText;
      if (respuesta.trim() == "sucess") {
        window.location.href = "index.php"
      }
      //document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarClave.php?clave="+clave1, true);
  xhttp.send();
//  document.getElementById("divClave").style.display = "none";
}
function modificarDatos() {
  document.getElementById("datosIE").style.display = "none";
  document.getElementById("divIE").style.display = "";
  recuperarDatos();
}
function cancelarDatos() {
  document.getElementById("divIE").style.display = "none";
  document.getElementById("datosIE").style.display = "";
}
function guardarDatos() {
  var xhttp;
  var apepat = document.getElementById("apepat").value;
  var apemat = document.getElementById("apemat").value;
  var nombres = document.getElementById("nombres").value;
  var celular = document.getElementById("celular").value;
  var correo = document.getElementById("correo").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarDatos.php?apepat="+apepat+"&apemat="+apemat+"&nombres="+nombres+"&celular="+celular+"&correo="+correo, true);
  xhttp.send();

  document.getElementById("apNom").innerHTML = apepat+" "+apemat+", "+nombres;
  document.getElementById("numCel").innerHTML = celular;
  document.getElementById("eMail").innerHTML = correo;

  document.getElementById("divIE").style.display = "none";
  document.getElementById("datosIE").style.display = "";
}
function recuperarDatos() {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		str01 = this.responseText;
		datos01  = str01.split(';');
		document.getElementById("apepat").value = datos01[0];
		document.getElementById("apemat").value = datos01[1];
		document.getElementById("nombres").value = datos01[2];
		document.getElementById("celular").value = datos01[3];
		document.getElementById("correo").value = datos01[4];
    }
  };
  xhttp.open("GET", "recuperarDatos.php", true);
  xhttp.send();
}
function anadirNee() {
  document.getElementById("divNee").style.display = "none";
  document.getElementById("divNee2").style.display = "";
}
function cancelarNee() {
  document.getElementById("divNee2").style.display = "none";
  document.getElementById("divNee").style.display = "";
}
function insertarNee() {
  var xhttp;
  var grado = document.getElementById("gradoNee").value;
  var seccion = document.getElementById("seccionNee").value;
  var vacantes = document.getElementById("vacantesNee").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblNee").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarNee.php?grado="+grado+"&seccion="+seccion+"&vacantes="+vacantes, true);
  xhttp.send();
  document.getElementById("divNee2").style.display = "none";
  document.getElementById("divNee").style.display = "";

  document.getElementById("seccionNee").value = "";
  document.getElementById("vacantesNee").value = "";
}
function cancelarNee2() {
  document.getElementById("divNee3").style.display = "none";
  document.getElementById("divNee").style.display = "";
}
function eliminarNee() {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divNee4").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "recuperarNee.php", true);
  xhttp.send();
  document.getElementById("divNee").style.display = "none";
  document.getElementById("divNee3").style.display = "";
}
function eliminarNee2() {
  var nodoDiv = document.getElementById("divNee4");
  for (var i = 0; i < nodoDiv.childNodes.length; i++) {
      if (nodoDiv.childNodes[i].type == "checkbox") {
        if (nodoDiv.childNodes[i].checked) {
          str01 = nodoDiv.childNodes[i].value;
          datos01  = str01.split(';');

          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("divNee4").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "borrarNee.php?grado="+datos01[0]+"&seccion="+datos01[1], true);
          xhttp.send();
        }
      }
  }

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblNee").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "mostrarNee.php", true);
  xhttp.send();
  document.getElementById("divNee3").style.display = "none";
  document.getElementById("divNee").style.display = "";
}

function anadirVac() {
  document.getElementById("divVac").style.display = "none";
  document.getElementById("divVac2").style.display = "";
}
function cancelarVac() {
  document.getElementById("divVac2").style.display = "none";
  document.getElementById("divVac").style.display = "";
}
function insertarVac() {
  var xhttp;
  var grado = document.getElementById("gradoVac").value;
  var seccion = document.getElementById("seccionVac").value;
  var vacantes = document.getElementById("vacantesVac").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblVac").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarVac.php?grado="+grado+"&seccion="+seccion+"&vacantes="+vacantes, true);
  xhttp.send();
  document.getElementById("divVac2").style.display = "none";
  document.getElementById("divVac").style.display = "";

  document.getElementById("seccionVac").value = "";
  document.getElementById("vacantesVac").value = "";
}
function cancelarVac2() {
  document.getElementById("divVac3").style.display = "none";
  document.getElementById("divVac").style.display = "";
}
function eliminarVac() {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divVac4").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "recuperarVac.php", true);
  xhttp.send();
  document.getElementById("divVac").style.display = "none";
  document.getElementById("divVac3").style.display = "";
}
function eliminarVac2() {
  var nodoDiv = document.getElementById("divVac4");
  for (var i = 0; i < nodoDiv.childNodes.length; i++) {
      if (nodoDiv.childNodes[i].type == "checkbox") {
        if (nodoDiv.childNodes[i].checked) {
          str01 = nodoDiv.childNodes[i].value;
          datos01  = str01.split(';');

          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("divVac4").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "borrarVac.php?grado="+datos01[0]+"&seccion="+datos01[1], true);
          xhttp.send();
        }
      }
  }

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblVac").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "mostrarVac.php", true);
  xhttp.send();
  document.getElementById("divVac3").style.display = "none";
  document.getElementById("divVac").style.display = "";
}
function anadirPri() {
  document.getElementById("divPri").style.display = "none";
  document.getElementById("divPri2").style.display = "";
}
function eliminarPri() {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divPri4").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "recuperarPri.php", true);
  xhttp.send();
  document.getElementById("divPri").style.display = "none";
  document.getElementById("divPri3").style.display = "";
}
function eliminarPri2() {
  var nodoDiv = document.getElementById("divPri4");
  for (var i = 0; i < nodoDiv.childNodes.length; i++) {
      if (nodoDiv.childNodes[i].type == "checkbox") {
        if (nodoDiv.childNodes[i].checked) {
          datos01 = nodoDiv.childNodes[i].value;

          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("divPri4").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "borrarPri.php?orden="+datos01, true);
          xhttp.send();
        }
      }
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblPri").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "mostrarPri.php", true);
  xhttp.send();
  document.getElementById("divPri3").style.display = "none";
  document.getElementById("divPri").style.display = "";
}
function cancelarPri2() {
  document.getElementById("divPri3").style.display = "none";
  document.getElementById("divPri").style.display = "";
}
function cancelarPri() {
  document.getElementById("divPri2").style.display = "none";
  document.getElementById("divPri").style.display = "";
}
function insertarPri() {
  var xhttp;

  var orden = document.getElementById("orden").value;
  var prioridad = document.getElementById("prioridad").value;
  var medio = document.getElementById("medio").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tblPri").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarPri.php?orden="+orden+"&prioridad="+prioridad+"&medio="+medio, true);
  xhttp.send();
  document.getElementById("divPri2").style.display = "none";
  document.getElementById("divPri").style.display = "";

  document.getElementById("orden").value = "";
  document.getElementById("prioridad").value = "";
  document.getElementById("medio").value = "";
}
function modificarAdi() {
  document.getElementById("divAdi").style.display = "none";
  document.getElementById("divAdi2").style.display = "";
  recuperarAdi();
}
function recuperarAdi() {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    str01 = this.responseText;
    datos01  = str01.split(';');
    document.getElementById("celular2").value = datos01[0];
    document.getElementById("correo2").value = datos01[1];
    document.getElementById("url").value = datos01[2];
    document.getElementById("direccion").value = datos01[3];
    document.getElementById("urb").value = datos01[4];
    document.getElementById("referencia").value = datos01[5];
    document.getElementById("horario").value = datos01[6];
    }
  };
  xhttp.open("GET", "recuperarAdi.php", true);
  xhttp.send();
}
function guardarAdi() {
  var xhttp;
  var celular = document.getElementById("celular2").value;
  var correo = document.getElementById("correo2").value;
  var url = document.getElementById("url").value;
  var direccion = document.getElementById("direccion").value;
  var urb = document.getElementById("urb").value;
  var referencia = document.getElementById("referencia").value;
  var horario = document.getElementById("horario").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("txtHint").innerHTML = this.responseText;
      document.getElementById("celular0").innerHTML = celular;
      document.getElementById("correo0").innerHTML = correo;
      document.getElementById("url0").innerHTML = url;
      document.getElementById("direccion0").innerHTML = direccion;
      document.getElementById("urb0").innerHTML = urb;
      document.getElementById("referencia0").innerHTML = referencia;
      document.getElementById("horario0").innerHTML = horario;

    }
  };
  xhttp.open("GET", "guardarAdi.php?celular="+celular+"&correo="+correo+"&url="+url+"&direccion="+direccion+"&urb="+urb+"&referencia="+referencia+"&horario="+horario, true);
  xhttp.send();
  document.getElementById("divAdi2").style.display = "none";
  document.getElementById("divAdi").style.display = "";
}
function cancelarAdi() {
  document.getElementById("divAdi2").style.display = "none";
  document.getElementById("divAdi").style.display = "";
}
function verDatos(nivel,tipo) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divDatos").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "verDatos.php?nivel="+nivel+"&tipo="+tipo, true);
  xhttp.send();
}
function verVacantes(nivel,tipo) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divDatos").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "verVacantes.php?nivel="+nivel+"&tipo="+tipo, true);
  xhttp.send();
}
function verPrioridades(nivel) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divDatos").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "verPrioridades.php?nivel="+nivel, true);
  xhttp.send();
}

function verRecepcion(nivel) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divDatos").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "verRecepcion.php?nivel="+nivel, true);
  xhttp.send();
}
function consultarVacantes(nivel,grado) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divDatos").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "ver2Vacantes.php?nivel="+nivel+"&grado="+grado, true);
  xhttp.send();
}
function limpiarSolicitud() {
  document.getElementById("dni1").value = "";
  document.getElementById("apellidos1").value = "";
  document.getElementById("nombres1").value = "";
  document.getElementById("dni2").value = "";
  document.getElementById("apellidos2").value = "";
  document.getElementById("nombres2").value = "";
  document.getElementById("ie").value = "";
  var gradoname = document.getElementsByName("grado");
  for (item of gradoname) {
    item.checked = false;
  }

}

function nuevaSolicitud() {
  limpiarSolicitud();

  document.getElementById("msgError").innerHTML = "";

  document.getElementById("divSolicitud").style.display = "";
  document.getElementById("divBuscar").style.display = "none";
  document.getElementById("divEliminar").style.display = "none";
//  document.getElementById("divSolicitudes").style.display = "none";
}
function cancelarSolicitud() {
  document.getElementById("divSolicitud").style.display = "none";
}
function guardarSolicitud() {
  var xhttp;
  var dni1 = document.getElementById("dni1").value;
  var apellidos1 = document.getElementById("apellidos1").value;
  var nombres1 = document.getElementById("nombres1").value;
  var dni2 = document.getElementById("dni2").value;
  var apellidos2 = document.getElementById("apellidos2").value;
  var nombres2 = document.getElementById("nombres2").value;
  var ie = document.getElementById("ie").value;
  //var grado = document.getElementById("grado").value;
  var grado = "";
  var gradoname = document.getElementsByName("grado");
  grado = 0;
  for (item of gradoname) {
    if (item.checked) grado = item.value;
  }

  if (dni2 == "" || nombres1 == "" || nombres2 == "" || ie == "" || grado == 0) {
    document.getElementById("msgError").innerHTML = "Faltan datos";
    document.getElementById("msgSolicitud").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
//      document.getElementById("msgError").innerHTML = this.responseText;
      str01 = this.responseText;
      if (str01.trim() == "error") {
        document.getElementById("msgError").innerHTML = "Existe solicitud con DNI del estudiante (verifique IE en la opción: Buscar solictud)";
        document.getElementById("msgSolicitud").innerHTML = "";
        //document.getElementById("divSolicitud").style.display = "";
      } else {
        document.getElementById("msgSolicitud").innerHTML = "Solicitud guardada - "+dni2;
        //document.getElementById("divSolicitud").style.display = "none";
        limpiarSolicitud();
      }
      //document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "guardarSolicitud.php?dni1="+dni1+"&apellidos1="+apellidos1+"&nombres1="+nombres1+"&dni2="+dni2+"&apellidos2="+apellidos2+"&nombres2="+nombres2+"&ie="+ie+"&grado="+grado, true);
  xhttp.send();
}

function buscarSolicitud() {
  document.getElementById("divSolicitud2").innerHTML = "";
  document.getElementById("dni20").value = "";
  
  document.getElementById("divSolicitud").style.display = "none";
  document.getElementById("divBuscar").style.display = "";
  document.getElementById("frmBuscar").style.display = "";
  document.getElementById("divEliminar").style.display = "none";
}
function buscarDni2() {
  var xhttp;
  var dni2 = document.getElementById("dni20").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divSolicitud2").innerHTML = this.responseText;
      document.getElementById("frmBuscar").style.display = "none";
    }
  };
  xhttp.open("GET", "buscarSolicitud.php?dni2="+dni2, true);
  xhttp.send();
  
  //document.getElementById("dni20").value = "";
}

function cancelarBuscar() {
  document.getElementById("divBuscar").style.display = "none";
}
function cancelarSolicitudes() {
  document.getElementById("divSolicitudes").style.display = "none";
}

function eliminarSolicitud() {
  document.getElementById("divSolicitud3").innerHTML = "";
  document.getElementById("dni21").value = "";
  
  document.getElementById("divSolicitud").style.display = "none";
  document.getElementById("divBuscar").style.display = "none";
  document.getElementById("divEliminar").style.display = "";
  document.getElementById("frmEliminar").style.display = "";
  document.getElementById("frmEliminar2").style.display = "none";
}
function buscarDni20() {
  var xhttp;
  var dni21 = document.getElementById("dni21").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      textoBuscar = this.responseText;
      document.getElementById("frmEliminar").style.display = "none";
      if (textoBuscar.trim() != "fallo") {

        document.getElementById("divSolicitud3").innerHTML = this.responseText;
        document.getElementById("frmEliminar2").style.display = "";
      } else {
        document.getElementById("divSolicitud3").innerHTML = "Solicitud no existe: "+document.getElementById("dni21").value;
        document.getElementById("frmEliminar2").style.display = "none";

      }
    }
  };
  xhttp.open("GET", "buscarSolicitud2.php?dni2="+dni21, true);
  xhttp.send();
  
  //document.getElementById("dni20").value = "";
}
function cancelarEliminar() {
  document.getElementById("divEliminar").style.display = "none";
}
function eliminarSolicitud2() {
  var xhttp;
  var dni21 = document.getElementById("dni21").value;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divSolicitud3").innerHTML = "Solicitud fue eliminado.";
      document.getElementById("frmEliminar").style.display = "none";
      document.getElementById("frmEliminar2").style.display = "none";
    }
  };
  xhttp.open("GET", "eliminarSolicitud.php?dni2="+dni21, true);
  xhttp.send();
  
  //document.getElementById("dni20").value = "";
}

function listarSolicitudes(grado) {
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("divLista").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "listarSolicitudes.php?grado="+grado, true);
  xhttp.send();
  
}

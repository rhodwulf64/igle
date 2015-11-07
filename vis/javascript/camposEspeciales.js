

var loF=document.fr_Bautismo;

function Notificalo(texto)
{
        notif({
		type: "error",
		msg: texto,
		position: "center",
		width: 500,
		height: 60,
		opacity: 0.8
		});
}

function NotificaS(texto)
{
        notif({
		type: "success",
		msg: texto,
		position: "center",
		width: 500,
		height: 60,
		opacity: 0.8
		});
}

function NotificaE(texto)
{
        notif({
		type: "error",
		msg: texto,
		position: "center",
		width: 500,
		height: 60,
		opacity: 0.8
		});
}

function NotificaI(texto)
{
        notif({
		type: "info",
		msg: texto,
		position: "center",
		width: 500,
		height: 60,
		opacity: 0.8
		});
}

function NotificaW(texto)
{
        notif({
		type: "warning",
		msg: texto,
		position: "center",
		width: 500,
		height: 60,
		opacity: 0.8
		});
}

function MaskCedulaNac(cid)
{		
		$.mask.definitions["~"] = "[VvEePp]";
		$.mask.definitions["+"] = "[0123456789 ]";
		$("#"+cid).mask("~-999999++");
		$("#ttip"+cid).css("display","block");
		$("#ttip"+cid).css("background-color","rgba( 0, 0, 0, .7)");
  		document.getElementById("ttip"+cid).textContent = "Formato: V-99999999 o E-99999999";

}
function QuitarMask(campoid)
{
	$("#"+campoid).unmask();
}

function MaskTelefono(tlfid)
{		
		$.mask.definitions["~"] = "[123456789]";
		$("#"+tlfid).mask("(~~~)9999999");
		$("#ttip"+tlfid).css("display","block");
		$("#ttip"+tlfid).css("background-color","rgba( 0, 0, 0, .7)");
  		document.getElementById("ttip"+tlfid).textContent = "Formato: (412)5279313";
}


function vSoloNumeros()
{

 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;

}

function vSoloLetras()
{
	
    tecla = (document.all) ? event.keyCode : event.which; 
		if (event.ctrlKey && tecla==86) {event.returnValue = true;} //Ctrl v
		if (event.ctrlKey && tecla==67) {event.returnValue = true;} //Ctrl c
		if (event.ctrlKey && tecla==88) {event.returnValue = true;} //Ctrl x
 
		patron = /^[a-z A-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/; //patron
 
		te = String.fromCharCode(tecla); 
		event.returnValue = patron.test(te); // prueba de patron
}
function vSoloTelefono()
{
	vSoloNumeros();
}


function vAlfaNum()
{
	
    tecla = (document.all) ? event.keyCode : event.which; 
		if (event.ctrlKey && tecla==86) {event.returnValue = true;} //Ctrl v
		if (event.ctrlKey && tecla==67) {event.returnValue = true;} //Ctrl c
		if (event.ctrlKey && tecla==88) {event.returnValue = true;} //Ctrl x
 
		patron = /[a-z A-Z0-9]/; //patron
 
		te = String.fromCharCode(tecla); 
		event.returnValue = patron.test(te); // prueba de patron
}

function vCampoVacio(campoid) {	//verifica si el campo esta vacio - adicionalmente completa con espacios la cedula
document.getElementById(campoid).value=document.getElementById(campoid).value.split('_').join(' '); //Justo aqui completa con espacios la cedula

var getValue=document.getElementById(campoid).value.trim();
 	if ((getValue=="")||(getValue=="0"))
	{
	
	  	document.getElementById("ha"+campoid).className = "form-group has-error";
	  	document.getElementById("ttip"+campoid).style.display = "block";
	  	document.getElementById("ttip"+campoid).textContent = "Este campo no puede quedar vacio";
	return true;
	}
	else
	{
	  	document.getElementById("ha"+campoid).className = "form-group has-default";
	  	document.getElementById("ttip"+campoid).style.display = "none";
  	return false;
  	}

}
function vCampoVacioDireccion(campoid) {	//verifica si el campo esta vacio - adicionalmente completa con espacios la cedula
document.getElementById(campoid).value=document.getElementById(campoid).value.split('_').join(' '); //Justo aqui completa con espacios la cedula

var getValue=document.getElementById(campoid).value.trim();
 	if ((getValue=="")||(getValue=="0"))
	{
	  	document.getElementById("ha"+campoid).className = "form-group has-error";
	  	document.getElementById("ttip"+campoid).style.display = "block";
	  	document.getElementById("ttip"+campoid).textContent = "Este campo no puede quedar vacio";
	return true;
	}
	else
	{
	  	document.getElementById("ha"+campoid).className = "form-group has-default";
	  	document.getElementById("ttip"+campoid).style.display = "none";
  	return false;
  	}

}

function CedulaVenezolanaDefault(ceduid)
{
	if((document.getElementById("txtOperacion").value=="buscar")&&(document.getElementById("txtHacer").value=="buscar"))
	{
		var ceduvalue=document.getElementById(ceduid).value;
		var ceduLimpia=document.getElementById(ceduid).value.split('_').join('');
		var cedCantidadChart=ceduvalue.length;
		var cedCantUnderScor=ceduLimpia.length;
		var cantCeduLimpia=cedCantidadChart-cedCantUnderScor;
		tecla = (document.all) ? event.keyCode : event.which; 
		//document.getElementById("EncontroNovia").value= new Date()+tecla;

				

			if ((tecla!=69)&&(event.keyCode >= 48)&&(event.keyCode <= 57)) 
			{
			 
				if (tecla!=69)
				{

					if (cantCeduLimpia==0)
					{

						document.getElementById(ceduid).value="V-";
					}
					
				}
			}
			else
			{
				event.returnValue = true;
			}
	}
	
}

function DameFechaFormato(fecha,formato) //formato US o LA
{
	if (formato=="US")
	{
		fecha=fecha.split("-");
		dia=fecha[0];
		mes=fecha[1];
		year=fecha[2];
		if (dia.length<2)
		{
			dia="0"+dia;
		}
		if (mes.length<2)
		{
			mes="0"+mes;
		}
		fecha=year+"-"+mes+"-"+dia;
	}
	else
	{
		fecha=fecha.split("-");
		dia=fecha[0];
		mes=fecha[1];
		year=fecha[2];
		if (dia.length<2)
		{
			dia="0"+dia;
		}
		if (mes.length<2)
		{
			mes="0"+mes;
		}
		fecha=dia+"-"+mes+"-"+year;
	}
	return fecha;
}
function vSoloFechaAnterior(fechaid) {	//verifica que la fecha de nacimiento sea anterior a la fecha actual
	var fechaCorrecta=false;

	if(vCampoVacio(fechaid)==false)
	{
		fechi=document.getElementById(fechaid).value.split('-').join('/');
		f1=new Date(fechi);
		f2=new Date();
	  	if ((f1>f2)||(document.getElementById(fechaid).value.substring(0,4)<1900))
	  	{
	 	 	document.getElementById("ha"+fechaid).className = "form-group has-error";
	 	 	document.getElementById("ttip"+fechaid).style.display = "block";
	 	 	document.getElementById("ttip"+fechaid).textContent = "Ingrese una fecha valida";
		}
		else
		{
	 	 	document.getElementById("ha"+fechaid).className = "form-group has-default";
		  	document.getElementById("ttip"+fechaid).style.display = "none";
		  	fechaCorrecta=true;
	 	}
	}
	return fechaCorrecta;
}

function vMayorDeEdad(fechaid) {	//verifica que sea mayor de edad
	var fechaCorrecta=false;

	if(vCampoVacio(fechaid)==false)
	{
		var fecha=document.getElementById(fechaid).value;
		var fechaActual = new Date()
		var diaActual = fechaActual.getDate();
		var mmActual = fechaActual.getMonth() + 1;
		var yyyyActual = fechaActual.getFullYear();
		FechaNac = fecha.split("-");
		var diaCumple = FechaNac[2];
		var mmCumple = FechaNac[1];
		var yyyyCumple = FechaNac[0];
		//retiramos el primer cero de la izquierda
		if (mmCumple.substr(0,1) == 0) {
		mmCumple= mmCumple.substring(1, 2);
		}
		//retiramos el primer cero de la izquierda
		if (diaCumple.substr(0, 1) == 0) {
		diaCumple = diaCumple.substring(1, 2);
		}
		var edad = yyyyActual - yyyyCumple;

		//validamos si el mes de cumpleaños es menor al actual
		//o si el mes de cumpleaños es igual al actual
		//y el dia actual es menor al del nacimiento
		//De ser asi, se resta un año
		if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
		edad--;
		}
		if (edad<18)
		{
			document.getElementById("ha"+fechaid).className = "form-group has-error";
	 	 	document.getElementById("ttip"+fechaid).style.display = "block";
	 	 	document.getElementById("ttip"+fechaid).textContent = "Debe ser Mayor de edad para proceder";
		}
		else if(edad>115)
		{
			document.getElementById("ha"+fechaid).className = "form-group has-error";
	 	 	document.getElementById("ttip"+fechaid).style.display = "block";
	 	 	document.getElementById("ttip"+fechaid).textContent = "Debe Ingresar una Fecha de nacimiento valida";
		}
		else
		{
			document.getElementById("ha"+fechaid).className = "form-group has-default";
		  	document.getElementById("ttip"+fechaid).style.display = "none";
			fechaCorrecta=true;
		}
	}
	return fechaCorrecta;
}

function vFechaEvento(fechaid) {	//verifica que la fecha del evento sea posterior a la fecha actual
	var respu=false;
	fechi=document.getElementById(fechaid).value.split('-').join('/');
	f1=new Date(fechi);
	f2=new Date();
	if (f1<f2)
  {
  	document.getElementById("ha"+fechaid).className = "form-group has-error";
  	document.getElementById("ttip"+fechaid).style.display = "block";
  	document.getElementById("ttip"+fechaid).textContent = "Ingrese una fecha que no haya transcurrido aun";
  }
  else
  {
  	document.getElementById("ha"+fechaid).className = "form-group has-default";
  	document.getElementById("ttip"+fechaid).style.display = "none";
  	respu=true;
  }
  return respu;
}

function vFechaMenor(fechaid,eventoid) {
var vValidado=false;
document.getElementById("haf_ProclamaUnoFecha").className = "form-group has-default";
document.getElementById("haf_ProclamaDosFecha").className = "form-group has-default";
document.getElementById("haf_ProclamaTresFecha").className = "form-group has-default";
document.getElementById("ttipf_ProclamaUnoFecha").style.display = "none";
document.getElementById("ttipf_ProclamaDosFecha").style.display = "none";
document.getElementById("ttipf_ProclamaTresFecha").style.display = "none";
var fechaE=document.getElementById(eventoid).value;
var fechi1=document.getElementById("f_ProclamaUnoFecha").value;
var fechi2=document.getElementById("f_ProclamaDosFecha").value;
var fechi3=document.getElementById("f_ProclamaTresFecha").value;
var vInvalido=0;
	if (vFechaEvento("f_ProclamaUnoFecha")==false)
	{
		document.getElementById("haf_ProclamaUnoFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaUnoFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaUnoFecha").textContent = "Ingrese una fecha que no haya transcurrido aun";
		vInvalido=1;
	}
	else if (vFechaEvento("f_ProclamaDosFecha")==false)
	{
		document.getElementById("haf_ProclamaDosFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaDosFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaDosFecha").textContent = "Ingrese una fecha que no haya transcurrido aun";
		vInvalido=1;
	}
	else if (vFechaEvento("f_ProclamaTresFecha")==false)
	{
		document.getElementById("haf_ProclamaTresFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaTresFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaTresFecha").textContent = "Ingrese una fecha que no haya transcurrido aun";
		vInvalido=1;
	}
	else if (fechi1>fechaE)
	{
	  	document.getElementById("haf_ProclamaUnoFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaUnoFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaUnoFecha").textContent = "La fecha no puede ser mayor que la del evento";
	  	vInvalido=1;

	}
	else if (fechi2<fechi1)
	{
	  	document.getElementById("haf_ProclamaDosFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaDosFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaDosFecha").textContent = "La fecha dos no puede ser menor que la uno";
	  	vInvalido=1;
	}
	else if (fechi2>fechaE)
	{
	  	document.getElementById("haf_ProclamaDosFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaDosFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaDosFecha").textContent = "La fecha no puede ser mayor que la del evento";
	  	vInvalido=1;
	}
	else if ((fechi3<fechi2)||(fechi3<fechi1))
	{
	  	document.getElementById("haf_ProclamaTresFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaTresFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaTresFecha").textContent = "La fecha no puede ser mayor que las demas";
	  	vInvalido=1;
	}
	else if ((fechi3>fechaE))
	{
	  	document.getElementById("haf_ProclamaTresFecha").className = "form-group has-error";
	  	document.getElementById("ttipf_ProclamaTresFecha").style.display = "block";
	  	document.getElementById("ttipf_ProclamaTresFecha").textContent = "La fecha no puede ser mayor que la del evento";
	  	vInvalido=1;
	}
	if (vInvalido==0)
	{
		vValidado=true;
	}
	return vValidado;
}


function fpCreaReferencia(proxCamp,campoid,param)
{

	
	if (param=="date")
	{
		vSoloFechaAnterior(campoid); 
	}
	else
	{
		vCampoVacio(campoid);
	}

	if (proxCamp==1)
	{
		
		var numRef=document.getElementById("f_PartiNumero").value+document.getElementById("f_PartiPresentado").value.substring(0,4);
		document.getElementById("f_refInfante").value=numRef;
		document.getElementById("RefInfanteBuscar").value=numRef;
		loF.f_PartiNumero.focus();
	}
	else
	{
		var numRef=document.getElementById("f_PartiNumero").value+document.getElementById("f_PartiPresentado").value.substring(0,4);
		document.getElementById("f_refInfante").value=numRef;
		document.getElementById("RefInfanteBuscar").value=numRef;
		if ((loF.f_PartiPresentado.value!="")&&(loF.f_PartiNumero.value!="")&&(vSoloFechaAnterior("f_PartiPresentado")))
		{
			
		}
		else
		{
			if ((vCampoVacio("f_PartiPresentado"))||(vSoloFechaAnterior("f_PartiPresentado")==false))
			{
				loF.f_PartiPresentado.focus();
			}
			else if (vCampoVacio("f_PartiNumero"))
			{
				loF.f_PartiNumero.focus();
			}
		}
	}
}

function fpAvisaSeleccionar(valor)
{
	if (valor=="")
	{
		NotificaW("Debe presionar el boton \"Seleccionar\" antes de editar un elemento.");
	}
	
}

function consulta_ajax(url,parametros){
	var http;

	if (window.XMLHttpRequest){
		  http=new XMLHttpRequest();
	}else{
	 	 http=new ActiveXObject("Microsoft.XMLHTTP");
	}

	http.onreadystatechange=function(){
	  if (http.readyState==4 && http.status==200){
	    document.getElementById("temporal").value=http.responseText;
	  }
	}
	http.open("GET",url+parametros,true);
	http.send();
}


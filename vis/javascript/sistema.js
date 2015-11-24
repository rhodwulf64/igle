
var loF=document.fr_Bautismo;

function fpInicial()
{

	loF.b_Nuevo.disabled=false;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=true;
	loF.b_Buscar.disabled=false;
	loF.b_Modificar.disabled=true;
	loF.b_Eliminar.disabled=true;

}

function fpCambioN()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=false;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
	loF.b_Modificar.disabled=true;
	loF.b_Eliminar.disabled=true;
}


function fpCambioNSegundo()
{
loF.b_Nuevo.disabled=true;
loF.b_Guardar.disabled=true;
loF.b_Cancelar.disabled=false;
loF.b_Buscar.disabled=true;
loF.b_Modificar.disabled=false;
loF.b_Eliminar.disabled=false;

}

function fpCambioB()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
	loF.b_Modificar.disabled=true;
	loF.b_Eliminar.disabled=true;
}


function fpCambioE()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
	loF.b_Modificar.disabled=false;
	loF.b_Eliminar.disabled=false;
}

function fpInicialnoElimMod()
{

	loF.b_Nuevo.disabled=false;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=true;
	loF.b_Buscar.disabled=false;

}

function fpCambioNnoElimMod()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=false;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
}
function fpCambioBnoElimMod()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
}


function fpCambioEnoElimMod()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
	loF.b_Buscar.disabled=true;
}

function fpIniciald()
{

	loF.b_Nuevo.disabled=false;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=true;

}

function fpCambioNd()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=false;
	loF.b_Cancelar.disabled=false;
}

function fpCambioBd()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
}

function fpCambioEd()
{
	loF.b_Nuevo.disabled=true;
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
}


function fpInicial2()
{

	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=true;

}

function fpCambioN2()
{
	loF.b_Guardar.disabled=false;
	loF.b_Cancelar.disabled=false;
}

function fpCambioB2()
{
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
}

function fpCambioE2()
{
	loF.b_Guardar.disabled=true;
	loF.b_Cancelar.disabled=false;
}


function fpCuestionamiento(praccion,prsujeto,prorigen)
{
	var respu=false;
	respu=confirm("Esta usted seguro que desea "+praccion+" a "+prsujeto+" del "+prorigen);
	return respu;
}


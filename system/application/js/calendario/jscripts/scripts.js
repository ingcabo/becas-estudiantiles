/*********************************************************************************
	MOSTRAR VENTANA BUSCAR usuario
 *********************************************************************************/
function buscarusuario(){
	var ventanadepartamento = ventanaNueva('usuario_listar.php','Usuario','toolbar=no,scrollbars=YES,width=500,height=300,status=yes');
}  

/*********************************************************************************
	MOSTRAR VENTANA BUSCAR equipo
 *********************************************************************************/
function buscarequipo(){
	var ventanaequipo = ventanaNueva('equipo_listar.php','Usuario','toolbar=no,scrollbars=YES,width=800,height=300,status=yes');
}  

/*********************************************************************************
	MOSTRAR VENTANA BUSCAR status
 *********************************************************************************/
function buscarstatus(){
	var ventanastatus = ventanaNueva('status_listar.php','Usuario','toolbar=no,scrollbars=YES,width=200,height=200,status=yes');
}  

/*********************************************************************************
	SELECCIONAR usuario
 *********************************************************************************/
function seleccionarusuario(id,nombre,apellido,cargo,departamento){
    window.opener.document.formulario.nombre.value      		= nombre;
	window.opener.document.formulario.apellido.value      		= apellido;
	window.opener.document.formulario.cargo.value        		= cargo;
	window.opener.document.formulario.departamento.value   		= departamento;		
	window.close();
}

/*********************************************************************************
	SELECCIONAR equipo
 *********************************************************************************/
function seleccionarequipo(id,tipo,marca,modelo,serial,fecha_compra,fecha_garantia,observaciones,ubicacion){
    window.opener.document.formulario.tipo.value         		= tipo;
	window.opener.document.formulario.marca.value      		    = marca;
	window.opener.document.formulario.modelo.value        		= modelo;
	window.opener.document.formulario.serial.value   		    = serial;		
	window.opener.document.formulario.fecha_compra.value      	= fecha_compra;
	window.opener.document.formulario.fecha_garantia.value      = fecha_garantia;
	window.opener.document.formulario.observaciones.value      	= observaciones;
	window.opener.document.formulario.ubicacion.value      		= ubicacion;
	window.close();
}

/*********************************************************************************
	SELECCIONAR status
 *********************************************************************************/
function seleccionarstatus(id,status){
    window.opener.document.formulario.status.value      		= status;
	window.close();
}
/*********************************************************************************
 * RESALTAR FILA EN UNA TABLA CUANDO EL APUNTADOR DEL MOUSE SE COLOCA SOBRE ELLA.
/*********************************************************************************/ 
function setPointer(theRow, theRowNum, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;
    if ((thePointerColor == '' && theMarkColor == '') || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
        return false;
    }
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;

    if (typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    else {
        currentColor = theCells[0].style.backgroundColor;
        domDetect    = false;
    } 
    if (theAction == 'over') {
            newColor              = thePointerColor;
    }
    if (theAction == 'out') {
            newColor              = theDefaultColor;
    }
    if (newColor) {
        var c = null;
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } 
    return true;
}

/*********************************************************************************/
/* Iniciar Funcion Calendario */
/*********************************************************************************/
function iniciarCalendario(Input,Button,Format,ShowTime){
Calendar.setup({
		inputField     :    Input,  		//id del campo de entrada													    
		ifFormat       :    Format,     // formato del campo de entrada
		showsTime      :    ShowTime,          // despliegue de un seleccionador de tiempo
		button         :    Button,  	// activa el calendario co el (botón ID)
		singleClick    :    false,          // doble-pulse el botón modo
		step           :    1  });          // muestre todos los años en gota-abajo las cajas (en lugar de cada dos años como valor por defecto)
}

/*********************************************************************************/
/* MOSTRAR FECHA Y HORA DEL SISTEMA **********************************************/
/*********************************************************************************/
function showtime()
{
	if (!document.layers&&!document.all&&!document.getElementById)
	return

	var Digital=new Date()
	myclock="Maracaibo,"+Digital.toLocaleString();
	if (document.layers)
	{
		document.layers.liveclock.document.write(myclock)
		document.layers.liveclock.document.close()
	}
	else
	if (document.all)
	liveclock.innerHTML=myclock
	else
	if (document.getElementById)
	document.getElementById("liveclock").innerHTML=myclock
	setTimeout("showtime()",60000)
}
// Abrir una nueva ventana.
function ventanaNueva(archivo,nombre,estilo){
	/* El método window.open realiza la apertura de una nueva ventana, y un "nuevo documento"
	SINTAXIS::		
			window.open('URL','nombre_ventana','características');
			Tabla de caracteristicas para una nueva ventana:
			Característica	Descripción
			dependent: 	
				(Javascript 1.2) Si es 'yes', crea una nueva ventana como un hijo de la ventana actual. 
				Una ventana dependiente se cierra cuando su ventana madre se cierra. En la plataforma Windows, 
				una ventana dependiente no se muestra en la barra de tareas.
				directories: 	
				Si es 'yes', crea los botones de directorio comunes.
			height: 	
				(Javascript 1.0 y 1.1) Especifica la altura de la ventana en pixeles.
			hotkeys: 	
				(Javascript 1.2) Si 'no' (o 0), desactiva la mayoría de las teclas rápidas en una ventana que no tiene barra de menú. 
				Las teclas rápidas de seguridad y de salir siguen activadas.
			location: 	
				Si es 'yes', crea un campo de entrada de dirección (URL).
			menubar: 	
				Si es 'yes', crea el menú en la parte de arriba de la ventana.
			personalbar: 	
				(Javascript 1.2) Si es 'yes', crea la barra personal, que despliega los botones desde la carpeta de la 
				barra personal de los marcadores.
			resizable: 	
				Si es 'yes', permite al usuario cambiar de tamaño la ventana.
			scrollbars: 	
				Si es 'yes', crea barras de desplazamiento horizontales y verticales cuando el documento crece más grande 
				que las dimensiones de la ventana.
			status: 	
				Si es 'yes', crea la barra de estado en la parte de abajo de la ventana.
			toolbar: 	
				Si es 'yes', crea la barra de navegación estándar, con botones como 'Atrás' y 'Adelante'.
			width: 	
				(Javascript 1.0 y 1.1) Especifica el ancho de la ventana en pixels.			
	*/
	
	return window.open(archivo,nombre,estilo);
	
}

// RETROCEDER LA VENTANA DE NAVEGACION.
function pasoAtras(){
	history.back();
}	

// Confirmación para eliminar un registro o ejecutar un paso 
// Argumento: msg = Mensaje que desea ser visulaizado en el browser
// return   : true = Si presiona ok
//          : false = Si presiona cancelar
//
// implementación: onclick="return frmMensajeRegistro('\u00bf Desea Anular este registro ?') "
//
function frmMensajeRegistro(msg)
{
	return(confirm(msg));	
}

/*********************************************************************************/
/* FINAL DEL ARCHIVO *************************************************************/
/*********************************************************************************/
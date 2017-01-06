// JavaScript Document

function confirmDelete()
{ 
  return confirm("¿Está seguro que desea eliminar el registro?");
}

function setFocus(nombreControl,selected)
{    
    var control;
    control=document.getElementById(nombreControl);    
    control.focus();
    if (selected)
    {
        control.select();
    }
}


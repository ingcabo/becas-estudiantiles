<?php

class sorteo extends Controller
{

  var $javaScriptText ='';

	function sorteo()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('xajax');
    $this->load->library('JELGeneral');
    $this->load->model('Model_consulta','',TRUE);
    $this->load->model('sorteoModel');
    $this->load->model('Mfrmclass');
    $this->load->library('Mylib_base');
   

    $this->load->model('procedenciaModel');
    $this->load->model('personaModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('tipoProcedenciaModel');
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->registerFunction(array('buildSelectParroquias', &$this, 'buildSelectParroquias'));
    $this->xajax->registerFunction(array('buscarProcedenciaPersona', &$this, 'buscarProcedenciaPersona'));
    $this->xajax->registerFunction(array('inserta_persona_sorteo', &$this, 'inserta_persona_sorteo'));
    $this->xajax->registerFunction(array('actualizar', &$this, 'actualizar'));
    $this->xajax->registerFunction(array('sorteo_persona_Delete', &$this, 'sorteo_persona_Delete'));


    //$this->xajax->setFlag('debug',true);
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());

	}

  function sorteo_persona_Delete($sorteo_id,$pp_id)
  {


    $respuesta             = new xajaxResponse();
    $propiedadInputDestino = "innerHTML";
    $inputDestino          = "div_grid";

    $atts = array(
              'width'      => '780',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );



    $data['result'] = $this->sorteoModel->sorteo_persona_delete($sorteo_id,$pp_id);

    $consulta = $this->Model_consulta->consulta_un_limit_parametro('ult_mod','desc','vis_sorteo_persona',$sorteo_id,'sorteo_id','10'); //consulta la vista sorteo persona

    $valorAAsignar  ='<table width="743" border="0" align="center" cellpadding="0" cellspacing="0">';
    foreach($consulta->result() as $row)
    {
      $valorAAsignar .= '<tr><td width="129" class="celdaContenido">'.$row->cedula_persona.'</td>';
      $valorAAsignar .= '<td width="175" class="celdaContenido">'.$row->nombre_persona.'</td>';
      $valorAAsignar .= '<td width="158" class="celdaContenido">'.$row->apellido_persona.'</td>';
      $valorAAsignar .= '<td width="218" class="celdaContenido">'.$row->nombre_parroquia_persona.'</td>';
      $valorAAsignar .= '<td width="34" class="celdaContenido">'. anchor_popup('sorteo/detallePersona/'.$row->persona_id,'<img alt="Ver Detalle" src="'.base_url().'system/application/views/imagenes/zoom+.png" border="0">', $atts).' </td>';
      $valorAAsignar .= '<td width="29" class="celdaContenido"> <a href="" onClick="xajax_sorteo_persona_Delete('.$row->sorteo_id.','.$row->procedencia_persona_id.');return false;"><img name="imagen1"src="'.base_url().'system/application/views/imagenes/eliminar.png"  border="0"></a>  </td></tr>';
    }
    $valorAAsignar .= '</table>';




    $respuesta->Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);

    return $respuesta;

  }

  function buscarProcedenciaPersona($ced,$sorteo)
  {

   $respuesta = new xajaxResponse();
   $propiedadInputDestino = "innerHTML";
   $inputDestino =  "div_persona";
  // $inputDestino2 = "div_carta";
  
   

  
   
   //para confirmar si la persona ya existe en ese sorteo
   $data['confirm_persona']   =$this->Model_consulta->consulta_dos_parametro('persona_id','asc','vis_sorteo_persona',$ced,'cedula_persona','1','activo');
  // $data['q_ubicacion_carta']   =$this->Model_consulta->consulta_combo('nombre_ubicacion_carta','asc','ubicacion_carta');                                                                                                                                      //$sorteo,'sorteo_id',
        if( $data['confirm_persona']->num_rows() > 0 ){

            $valorAAsignar= '<font color="#FF0000"><BLINK>La Persona Ya esta Registrada en un Sorteo. </BLINK></font>';

        }else{

            
                      

                          $data['consulta_persona']= $this->Model_consulta->consulta_un_parametro('persona_id','asc','vis_procedencia_persona',$ced,'cedula_persona');
                      if ($data['consulta_persona']->num_rows() > 0){

                              $fila           = $data['consulta_persona']->row();
                              $valorAAsignar  = '<table width="743" border="0" align="center" cellpadding="0" cellspacing="0">';
                              $valorAAsignar .= '<tr><td width="121" class="celdaContenido">'.$fila->nombre_persona.'</td>';
                              $valorAAsignar .= '<td width="160" class="celdaContenido">'.$fila->apellido_persona.'</td>';
                              $valorAAsignar .= '<td width="66" class="celdaContenido">'.$fila->sexo_persona.'</td>';
                              $valorAAsignar .= '<td width="335" class="celdaContenido">'.$fila->direccion01_persona.' ';
                              $valorAAsignar .= '<input type="hidden" name="pp_id" value=" '.$fila->procedencia_persona_id.' " >  </td>';

                              $valorAAsignar .= '<td width="51">  <input type="button" value="Agregar" name="Agregar"   onMouseDown="xajax_inserta_persona_sorteo('.$fila->procedencia_persona_id.',txtId.value,cmbu.value,codcarta.value,fechac.value,ref.value);"  onMouseUp ="actualizare('.$fila->procedencia_persona_id.',txtId.value,cmbu.value,codcarta.value,fechac.value,ref.value);"     /></td></tr>';
                              $valorAAsignar .= '</table>';
                    

                           

                       }else{

                              $valorAAsignar  ='<font color="#FF0000"><BLINK> Número de Cedula no existe en el sistema. </BLINK></font>';
                              
                            }
                  }
                 $respuesta->Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                 //$respuesta->Assign($inputDestino2, $propiedadInputDestino, $valorAAsignar2);
                 return $respuesta;
        
  }

function inserta_persona_sorteo($pp_id,$sorteo_id,$ubicart,$codcarta,$fechacarta,$refcart){

   $respuesta = new xajaxResponse();
   $propiedadInputDestino = "innerHTML";
   $inputDestino   = "div_no";
   $valorAAsignar  ="";

   
             
              $insrt         = $this->sorteoModel->insert_sorteo_per($pp_id,$sorteo_id); //inserto datos sorteo persona
              $insrt_post    = $this->sorteoModel->insert_postulacion($ubicart,$pp_id,$codcarta,$fechacarta,$refcart);//

               
                
                 $respuesta->Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                 
                
                 return $respuesta;

}


function actualizar($pp_id,$sorteo_id,$ubicart,$codcarta,$fechacarta,$refcart){

   $respuesta = new xajaxResponse();
   $propiedadInputDestino = "innerHTML";
   $inputDestino   = "div_grid";
   $inputDestino2  = "div_persona";
   
      $atts = array(
              'width'      => '780',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );


   
    if($ubicart <> '' or $codcarta <> '' or $fechacarta <> '' or  $refcart <> ''){
             $valorAAsignar2   ="se agrego a la Persona, y la información de su Carta de Postulación<br>";
             $valorAAsignar2  .="<IMG SRC=".base_url()."system/application/views/imagenes/listo.gif>";
    }else{
             $valorAAsignar2  ="se agrego a la Persona, Pero no su Carta<br>";
             $valorAAsignar2 .="<IMG SRC=".base_url()."system/application/views/imagenes/listo.gif>";
          }



 $consulta = $this->Model_consulta->consulta_un_limit_parametro('ult_mod','desc','vis_sorteo_persona',$sorteo_id,'sorteo_id','10'); //consulta la vista sorteo persona

$valorAAsignar  ='<table width="743" border="0" align="center" cellpadding="0" cellspacing="0">';
        foreach($consulta->result() as $row){

 $valorAAsignar .= '<tr><td width="129" class="celdaContenido">'.$row->cedula_persona.'</td>';
 $valorAAsignar .= '<td width="175" class="celdaContenido">'.$row->nombre_persona.'</td>';
 $valorAAsignar .= '<td width="158" class="celdaContenido">'.$row->apellido_persona.'</td>';
 $valorAAsignar .= '<td width="218" class="celdaContenido">'.$row->nombre_parroquia_persona.'</td>';
 $valorAAsignar .= '<td width="34" class="celdaContenido">'.anchor_popup('sorteo/detallePersona/'.$row->persona_id,'<img alt="Ver Detalle" src="'.base_url().'system/application/views/imagenes/zoom+.png" border="0">', $atts).' </td>';
 $valorAAsignar .= '<td width="29" class="celdaContenido"> <a href="" onClick="xajax_sorteo_persona_Delete('.$row->sorteo_id.','.$row->procedencia_persona_id.');return false;"><img name="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png"  border="0"></a>  </td></tr>';
       }
$valorAAsignar .= '</table>';




                 $respuesta->Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                 $respuesta->Assign($inputDestino2, $propiedadInputDestino, $valorAAsignar2);

                 return $respuesta;
 
}



  function buildSelectEstados($paisId)
  {

    $objResponse = new xajaxResponse();

    $estados = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $paisId, '', '');

    $result = '<select name="cmbEstado" id="cmbEstado" style="width:367px" onchange="xajax_buildSelectMunicipios(this.value)">';
    $result = $result .'<option></option>';
    if($estados->num_rows()!=0)
    {
      foreach($estados->result() as $row)
      {
        $result = $result . '<option value = "'.$row->estado_id.'">'.$row->nombre_estado.'</option>';
      }
    }
    $result = $result . '</select>';

    $objResponse->Assign('divCmbEstado', "innerHTML", $result);
    return $objResponse;
  }

  function buildSelectMunicipios($estadoId)
  {

   $objResponse = new xajaxResponse();

    $municipios = $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $estadoId, '', '');

    $result = '<select name="cmbMunicipio" id="cmbMunicipio" style="width:367px" onchange="xajax_buildSelectParroquias(this.value)">';
    $result = $result .'<option></option>';
    if($municipios->num_rows()!=0)
    {
      foreach($municipios->result() as $row)
      {
        $result = $result . '<option value = "'.$row->municipio_id.'">'.$row->nombre_municipio.'</option>';
      }
    }
    $result = $result . '</select>';
    $objResponse->Assign('divCmbMunicipio', "innerHTML", $result);
    return $objResponse;
  }

  function buildSelectParroquias($municipioId)
  {

   $objResponse = new xajaxResponse();

    $parroquias = $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $municipioId, '', '');

    $result = '<select name="cmbParroquia" id="cmbParroquia" style="width:367px">';
    $result = $result .'<option></option>';
    if($parroquias->num_rows()!=0)
    {
      foreach($parroquias->result() as $row)
      {
        $result = $result . '<option value = "'.$row->parroquia_id.'">'.$row->nombre_parroquia.'</option>';
      }
    }
    $result = $result . '</select>';
    $objResponse->Assign('divCmbParroquia', "innerHTML", $result);
    return $objResponse;
  }

  function sorteoControl()
  {
    
    $this->Mfrmclass->nombre_tabla = 'sorteo';
    $this->load->library('pagination');
    //$this->load->library('JELGeneral');
    $page =is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    if(isset($_POST['bandPost']))
    {
      $campo = isset($_POST['cmbCampo']) ? $_POST['cmbCampo'] : '';
      $criterio = isset($_POST['cmbCriterio']) ? $_POST['cmbCriterio'] : '';
      $valor = isset($_POST['txtValor']) ? $_POST['txtValor'] : '';
    }
    else
    {
      $campo ='';
      $criterio ='';
      $valor ='';
      $uri = current_url();

      $campo =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =   $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }
    }

    $config['base_url']    =   base_url().'/index.php/sorteo/sorteoControl/';
    $config['total_rows']  = $this->sorteoModel->getNumTotalsorteo($campo, $criterio, $valor);
    $config['per_page']    = 10;
    $config['uri_segment'] = 3;
    $config['first_link']  = 'Inicio';
    $config['last_link']   = 'Fin';

    $data['result']=$this->sorteoModel->getAllsorteo($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);

    $pages = $this->pagination->create_links();

    $data['pages']= $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
     //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


    $data['campo']=$campo;
    $data['criterio']=$criterio;
    $data['valor']=$valor;

    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar

    $this->load->view('operaciones/sorteoList', $data);
  }

  function sorteoForm()
  {

    

    $this->Mfrmclass->nombre_tabla = 'sorteo';

    $data['q_ubicacion_carta']   =$this->Model_consulta->consulta_combo('nombre_ubicacion_carta','asc','ubicacion_carta');
    
    $id =$this->uri->segment(3);
    $data['sorteo_persona'] = $this->Model_consulta->consulta_un_limit_parametro('ult_mod','desc','vis_sorteo_persona',$id,'sorteo_id','10');
    $data['id'] = $id;
    $data['paisId']= -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['contactoId'] = -1;
  
    
 
    $data['fecha'] = '';
    $data['nombreEstado'] = '';
    $data['nombreMunicipio'] = '';
    $data['nombreParroquia'] = '';
    $data['instruccionProcedencia'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    $data['lugar'] = '';
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


    if($id!=-1)
    {
      $reg=$this->sorteoModel->getsorteo($id);

     $data['parroquiaId'] = $reg->parroquia_id;
     $data['parroquias']= $this->parroquiaModel->getAllParroquia('parroquia_id', 'Sea Igual a', $reg->parroquia_id, '', '');
     $row_m = $data['parroquias']->row();
     $data['municipioId'] = $row_m->municipio_id;


      $data['paisId']= $row_m->pais_id;
      $data['estadoId'] = $row_m->estado_id;
      $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $row_m->pais_id, '', '');
     // $data['municipioId'] = $reg->municipio_id;
      $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $row_m->estado_id, '', '');
      $data['parroquiaId'] = $reg->parroquia_id;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('parroquia_id', 'Sea Igual a', $reg->parroquia_id, '', '');

      $data['fecha'] = $this->mylib_base->pg_to_human($reg->fecha_sorteo);
      $data['lugar'] = $reg->lugar_sorteo;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('operaciones/sorteoForm', $data);
  }

  function sorteoRecord()
  {
    $this->load->library('form_validation');
	$this->Mfrmclass->nombre_tabla = 'sorteo';
    $this->form_validation->set_rules('txtLugar', 'Lugar', 'required');

    $data['id'] = $_POST['txtId'];
  
  
     //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('operaciones/sorteoForm',$data);
		}
		else
		{
      if($data['id'] == -1)
			{
				$dataMsg['result'] =  $this->sorteoModel->insertsorteo();
                $row = $dataMsg['result'] -> row_array();


               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','sorteo/sorteoForm/'.$row['ins_sorteo'].'','black');
               
			}
			else
			{
				$dataMsg['result'] = $this->sorteoModel->updatesorteo($data['id']);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','sorteo/sorteoForm/'.$data['id'].'','black');
			}
    }
  }

  function sorteoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->sorteoModel->sorteoDelete($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','sorteo/sorteoControl','black');
  }


function detallePersona(){

$persona_id =$this->uri->segment(3);

$data['Query']           =$this->Model_consulta->consulta_un_parametro('persona_id','asc','vis_procedencia_persona',$persona_id,'persona_id');
$fila = $data['Query']->row();

$data['tipo_nacionalidad'] = $fila->tipo_cedula_persona;
$data['cedula']            = $fila->cedula_persona;
if($fila->sexo_persona == 'M'){$data['sexo']='Masculino';}else{$data['sexo']='Femenino';}

$dota['nacionalidad'] =$this->Model_consulta->consulta_un_parametro('pais_id','asc','vis_pais',$fila->pais_id,'pais_id');
$fola = $dota['nacionalidad']->row();

$data['nacionalidad']      = $fola->nacionalidad_pais;
$data['correo']            = $fila->email_persona;
$data['nombre']            = $fila->nombre_persona;
$data['apellido']          = $fila->apellido_persona;
$data['f_nacimiento']      = $fila->fecha_nacimiento_persona;


$dato['donde'] =$this->Model_consulta->consulta_un_parametro('parroquia_id','asc','vis_parroquia',$fila->parroquia_id,'parroquia_id');
$filo = $dato['donde']->row();

$data['pais']              = $filo->nombre_pais;
$data['estado']            = $filo->nombre_estado;
$data['municipio']         = $filo->nombre_municipio;
$data['parroquia']         = $filo->nombre_parroquia;
$data['direccion01']       = $fila->direccion01_persona;
$data['direccion02']       = $fila->direccion02_persona.'.';
$data['telefono01']        = $fila->telefono01_persona;
$data['telefono02']        = $fila->telefono02_persona;
$data['telefono03']        = $fila->telefono03_persona.'.';
$data['telefono04']        = $fila->telefono04_persona;
$data['representante']     = $fila->nombre_representante.' '.$fila->apellido_representante;
$data['cuenta']            = $fila->tipo_cuenta_persona;
$data['n_cuenta']          = $fila->numero_cuenta_persona;
$data['banco']             = $fila->nombre_banco;

$data['carta_persona']   =$this->Model_consulta->consulta_un_parametro('procedencia_persona_id','asc','vis_carta_postulacion',$fila->procedencia_persona_id,'procedencia_persona_id');
$fill = $data['carta_persona']->row();

if($data['carta_persona']->num_rows() < 1){
$data['codigoc']       =' ';
$data['ubicacionc']    =' ';
$data['fecha']         =' ';
$data['referencia']    =' ';
$data['carta_postulacion_id'] ='-1';
}else{
$data['codigoc']       =$fill->codigo_carta_postulacion;
$data['ubicacionc']    =$fill->nombre_ubicacion_carta;
$data['fecha']         =$fill->fecha_carta_postulacion;
$data['referencia']    =$fill->referencia_carta_postulacion;
$data['carta_postulacion_id'] =$fill->carta_postulacion_id;

}



$this->load->view('operaciones/DetallePersonaForm', $data);
}


function cartaForm(){


     $id                   = $this->uri->segment(3);
     $data['q_ubicacion_carta']   =$this->Model_consulta->consulta_combo('nombre_ubicacion_carta','asc','ubicacion_carta');
     $data['carta_postulacion_id']              = '-1';
     $data['ubicacion_carta_id']                = '';
     $data['codigo_carta_postulacion']          = '';
     $data['fecha_carta_postulacion']           = '';
     $data['referencia_carta_postulacion']      = '';
   



    //Armado de las opciones del menu segun el usuario
    //$centinela = new Centinela();
    //$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   // $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1){
      $reg                                     = $this->presupuestoModel->getcarta($pre_id);

      $data['carta_postulacion_id']            = $id;
      $data['ubicacion_carta_id']              = $reg->beca_persona_id;
      $data['codigo_carta_postulacion']        = $reg->codigo_carta_postulacion;
      $data['fecha_carta_postulacion']         = $this->mylib_base->pg_to_human($reg->fecha_carta_postulacion);
      $data['referencia_carta_postulacion']    = $reg->referencia_carta_postulacion;
      



    }
    $this->load->view('operaciones/cartaForm', $data);


}






function cartaRecord(){
$data['q_ubicacion_carta']   =$this->Model_consulta->consulta_combo('nombre_ubicacion_carta','asc','ubicacion_carta');


    $this->load->library('form_validation');

    $this->form_validation->set_rules('fecha_carta_postulacion', 'fecha carta', 'required');



      $data['carta_postulacion_id']         = $this->input->post('carta_postulacion_id');
      $data['ubicacion_carta_id']           = $this->input->post('ubicacion_carta_id');
      $data['codigo_carta_postulacion']     = $this->input->post('codigo_carta_postulacion');
      $data['fecha_carta_postulacion']      = $this->input->post('fecha_carta_postulacion');
      $data['referencia_carta_postulacion'] = $this->input->post('referencia_carta_postulacion');

     //Armado de las opciones del menu segun el usuario
   // $centinela = new Centinela();
    //$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    //$data['menu']               = $this->load->view('vis_menu',$menu_final,true);


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('operaciones/cartaForm',$data);
		}
		else
		{
      if($data['carta_postulacion_id'] == -1)
			{
				$dataMsg['result'] =  $this->sorteoModel->ins_carta($data);
                //$row = $dataMsg['result'] -> row_array();


               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','sorteo','black');

			}
			else
			{
				$dataMsg['result'] = $this->sorteoModel->upd_carta($data);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','sorteo','black');
			}
    }


}







  function personaControl()
  {
    $this->load->library('pagination');
    
     $this->personaModel->nombre_tabla = 'sorteo_persona';

    if(isset($_POST['sorteo_id']))
    {
      $data['sorteo_id'] = $_POST['sorteo_id'];
    }
    else
    {
      $data['sorteo_id']   = $this->uri->segment(3);
    }

    $sorteo_id = $data['sorteo_id'];

    $page =is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
  
    $this->personaModel->condicion_valor = ' and  sorteo_id = '.$sorteo_id;

    if(isset($_POST['bandPost']))
    {
      $campo = isset($_POST['cmbCampo']) ? $_POST['cmbCampo'] : '';
      $criterio = isset($_POST['cmbCriterio']) ? $_POST['cmbCriterio'] : '';
      $valor = isset($_POST['txtValor']) ? $_POST['txtValor'] : '';
    }
    else
    {
      $campo ='';
      $criterio ='';
      $valor ='';
      $uri = current_url();

      $campo = $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }
    }

    $config['base_url']    =   base_url().'/index.php/sorteo/personaControl/'.$sorteo_id.'/';
    $config['total_rows']  =   $this->personaModel->getNumTotalPersona($campo, $criterio, $valor);
    $config['per_page']    =   10;
    $config['uri_segment'] =    3;
    $config['first_link']  =   'Inicio';
    $config['last_link']   =   'Fin';
    $data['result']=$this->personaModel->getAllPersona($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);
    $pages = $this->pagination->create_links();
    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


    $data['campo']   =$campo;
    $data['criterio']=$criterio;
    $data['valor']   =$valor;

    $data['titulo'] = 'Control de Personas Sorteadas';
    $data['titulo_valor']  ='sorteo';

    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar

    $this->load->view('mantenimiento/personaList', $data);
  }


  function deletepersonasorteo(){

      $this->personaModel->nombre_tabla = 'sorteo_persona';
      $sorteo_id = $this->uri->segment(3);
      $pp_id     = $this->uri->segment(4);

      $data['borrar'] = $this->sorteoModel->sorteo_persona_delete($sorteo_id,$pp_id);
      $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','sorteo/personaControl/'.$sorteo_id,'black');

  }

}
?>

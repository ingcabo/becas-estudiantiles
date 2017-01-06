<?php
class pruebas extends Controller{
 


	function pruebas(){
		parent :: Controller();




        $this -> load -> helper('url');
        $this -> load -> helper('form');
        $this -> load -> model('sorteoModel');
        $this -> load -> model('Model_consulta');
		$this -> load -> database();
		$this -> load -> library('xajax');
		$this -> load -> helper(array('form', 'url'));
       

		//declarar en el controller las fuinciones xajas a llamara en el view
		$this -> xajax -> registerFunction(array('obtieneMunicipio', &$this, 'obtieneMunicipio'));
		$this -> xajax -> registerFunction(array('obtieneParroquia', &$this, 'obtieneParroquia'));
        $this -> xajax -> registerFunction(array('test', &$this, 'test'));
      


		$this -> xajax -> processRequest();
	}


	// Formulario 1:
	function index(){
		$data['xajax_js'] = $this -> xajax -> getJavascript(base_url());
        $data['query_estados']          = $this -> Model_consulta -> consulta_combo('nombre_estado','ASC','estado');

        $this -> load -> view('pruebas', $data);
    }



function obtieneMunicipio($idEstado){
		$respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "div_Municipio"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML


        $query_municipio = $this -> Model_consulta -> consulta_un_parametro('nombre_municipio','ASC','municipio',$idEstado,'municipio_id');

		$valorAAsignar .= "<select name='menu1' class='textbox' onChange='xajax_obtieneParroquia(this.value);'>";
		$valorAAsignar .= "<option value='0'>[Seleccione]</option>";

		foreach($query_municipio -> result() as $row)
			$valorAAsignar .= "<option value='" . $row -> municipio_id . "'>" . $row -> nombre_municipio . "</option>";

		$valorAAsignar .= "</select>";

		$respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);

		return $respuesta;
	}


	function obtieneParroquia($idMunicipio){
		$respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "divCiudad"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML

		$valorAAsignar .= "<select name='selCiudades' class='textbox'>";
		$valorAAsignar .= "<option value=''>[Seleccione uno]</option>";

		$query_ciudades = $this -> Model_insert -> consultar_municipio_ciudades($idMunicipio);

		foreach ($query_ciudades -> result() as $row)
			$valorAAsignar .= "<option value='" . $row -> ciu_ciudades_pk . "'>" . $row -> ciu_nombre . "</option>";

		$valorAAsignar .= "</select>";

		$respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);

		return $respuesta;
	}

    function test(){
		$respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		//$valorAAsignar = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML


		$valorAAsignar = "<span>Funciona esta cosa</span>";

		$respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);

		return $respuesta;
	}











}

?>

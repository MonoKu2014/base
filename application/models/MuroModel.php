<?php

class MuroModel extends CI_Model {


        public function __construct()
        {
                parent::__construct();
        }



        public function muro($id_usuario)
        {
            
        	$datos = [];

        	$this->db->limit(10);
        	$this->db->order_by('id_empresa', 'desc');
        	$nuevos_negocios = $this->db->get('empresas')->result();

        	$i = 0;

        	foreach ($nuevos_negocios as $negocio) {
        		$datos[$i]['tipo'] 				= 'negocio';
        		$datos[$i]['id']   				= $negocio->id_empresa;
        		$datos[$i]['titulo'] 			= $negocio->nombre_empresa;
        		$datos[$i]['fecha_creacion'] 	= $negocio->fecha_creacion_empresa;
        		$datos[$i]['ubicacion']			= $negocio->region_empresa.', '.$negocio->comuna_empresa.', '.$negocio->calle_empresa.' '.$negocio->numero_calle_empresa;
        		$datos[$i]['imagen']			= $negocio->imagen_empresa;

        		$i++;
        	}


        	return $datos;

        }


}
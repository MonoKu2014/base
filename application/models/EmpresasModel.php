<?php

class EmpresasModel extends CI_Model {




        public $table = 'empresas';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_empresa)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->join('categorias', $this->table.'.id_categoria = categorias.id_categoria');
            $this->db->where('id_empresa', $id_empresa);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete($this->table);
        }

        public function porCategoria($id, $array, $ordenar, $final, $inicio)
        {


            $this->db->limit($final, $inicio);

            if($ordenar == 1){
                $this->db->order_by('cantidad_recomendaciones', 'desc');
            }

            if($ordenar == 2){
                $this->db->order_by('cantidad_productos', 'desc');
            }

            if($ordenar == 3){
                $this->db->order_by('cantidad_servicios', 'desc');
            }

            if($ordenar == 4){
                $this->db->order_by('cantidad_promociones', 'desc');
            }

            $this->db->where('e.id_estado', 1);
            $this->db->where('e.id_categoria', $id);
            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
                $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');
            }
            if($array[1] != 0){
                $this->db->where('ess.id_sub_subcategoria', $array[1]);
                $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }
            $query = $this->db->get('empresas e');
            return $query->result();
        }



        public function totalPorCategoria($id, $array)
        {

            $this->db->where('e.id_estado', 1);
            $this->db->where('e.id_categoria', $id);
            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
                $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');
            }
            if($array[1] != 0){
                $this->db->where('ess.id_sub_subcategoria', $array[1]);
                $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }
            $query = $this->db->count_all_results('empresas e');
            return $query;
        }




        public function porSubCategoria($id, $array, $ordenar, $final, $inicio)
        {

            $this->db->limit($final, $inicio);

            if($ordenar == 1){
                $this->db->order_by('cantidad_recomendaciones', 'desc');
            }

            if($ordenar == 2){
                $this->db->order_by('cantidad_productos', 'desc');
            }

            if($ordenar == 3){
                $this->db->order_by('cantidad_servicios', 'desc');
            }

            if($ordenar == 4){
                $this->db->order_by('cantidad_promociones', 'desc');
            }

            $this->db->where('e.id_estado', 1);
            $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');

            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
            } else {
                $this->db->where('es.id_subcategoria', $id);
            }
            if($array[1] != 0){
                $this->db->where('ess.id_sub_subcategoria', $array[1]);
                $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }

            $query = $this->db->get('empresas e');
            return $query->result();
        }



        public function totalPorSubCategoria($id, $array)
        {

            $this->db->where('e.id_estado', 1);
            $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');

            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
            } else {
                $this->db->where('es.id_subcategoria', $id);
            }
            if($array[1] != 0){
                $this->db->where('ess.id_sub_subcategoria', $array[1]);
                $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }

            $query = $this->db->count_all_results('empresas e');
            return $query;
        }


        public function porSubSubCategoria($id, $array, $ordenar, $final, $inicio)
        {

            $this->db->limit($final, $inicio);

            if($ordenar == 1){
                $this->db->order_by('cantidad_recomendaciones', 'desc');
            }

            if($ordenar == 2){
                $this->db->order_by('cantidad_productos', 'desc');
            }

            if($ordenar == 3){
                $this->db->order_by('cantidad_servicios', 'desc');
            }

            if($ordenar == 4){
                $this->db->order_by('cantidad_promociones', 'desc');
            }

            $this->db->where('e.id_estado', 1);
            $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
                $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');
            }
            if($array[1] != 0){
                $this->db->or_where('ess.id_sub_subcategoria', $array[1]);
            } else {
                $this->db->where('ess.id_sub_subcategoria', $id);
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }
            $query = $this->db->get('empresas e');
            return $query->result();
        }



        public function totalPorSubSubCategoria($id, $array)
        {

            $this->db->where('e.id_estado', 1);
            $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            if($array[0] != 0){
                $this->db->where('es.id_subcategoria', $array[0]);
                $this->db->join('empresa_subcategorias es', 'e.id_empresa = es.id_empresa');
            }
            if($array[1] != 0){
                $this->db->or_where('ess.id_sub_subcategoria', $array[1]);
            } else {
                $this->db->where('ess.id_sub_subcategoria', $id);
            }
            if($array[2] != ''){
                $this->db->where('e.region_empresa', $array[2]);
            }
            if($array[3] != ''){
                $this->db->where('e.comuna_empresa', $array[3]);
            }
            if($array[4] != ''){
                $this->db->where('e.despacho_empresa', $array[4]);
            }
            $query = $this->db->count_all_results('empresas e');
            return $query;
        }




        public function obtenerLogin($email, $password)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where($this->table.'.id_estado', 1);
            $this->db->where($this->table.'.email_empresa', $email);
            $this->db->where($this->table.'.password_empresa', $password);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function insertarSubcategoriasEmpresa($data)
        {
            return $this->db->insert('empresa_subcategorias', $data);
        }

        public function insertarSub_subcategoriasEmpresa($data)
        {
            return $this->db->insert('empresa_sub_subcategorias', $data);
        }

        public function insertarHorario($data)
        {
            return $this->db->insert('empresa_horarios', $data);
        }

        public function insertarPagos($data)
        {
            return $this->db->insert('pagos_empresa', $data);
        }

        public function insertarImagenPerfil($data, $id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->update($this->table, $data);
        }


        public function listarMasRecomendados($data)
        {
            $query = 'select e.id_empresa, e.nombre_empresa, e.imagen_empresa, e.id_categoria, e.calle_empresa, e.numero_calle_empresa, e.comuna_empresa, e.region_empresa, COUNT(id_recomendacion) as cantidad from empresas e inner join recomendaciones r on e.id_empresa = r.id_empresa group by e.id_empresa';

            if($data['ordenar'] == 1){
                $query .= ' order by e.cantidad_recomendaciones desc';
            }

            if($data['ordenar'] == 2){
                $query .= ' order by e.cantidad_productos desc';
            }

            if($data['ordenar'] == 3){
                $query .= ' order by e.cantidad_servicios desc';
            }

            if($data['ordenar'] == 4){
                $query .= ' order by e.cantidad_promociones desc';
            }

            return $this->db->query($query)->result();
        }

        public function listarMasRecomendadosUno()
        {
            return $this->db->query('select e.id_empresa, e.nombre_empresa, e.imagen_empresa, e.id_categoria, COUNT(id_recomendacion) as cantidad from empresas e inner join recomendaciones r on e.id_empresa = r.id_empresa group by e.id_empresa limit 0,6')->result();
        }


        public function listarMasRecomendadosDos()
        {
            return $this->db->query('select e.id_empresa, e.nombre_empresa, e.imagen_empresa, e.id_categoria, COUNT(id_recomendacion) as cantidad from empresas e inner join recomendaciones r on e.id_empresa = r.id_empresa group by e.id_empresa limit 6,6')->result();
        }


        public function listarMasRecomendadosTres()
        {
            return $this->db->query('select e.id_empresa, e.nombre_empresa, e.imagen_empresa, e.id_categoria, COUNT(id_recomendacion) as cantidad from empresas e inner join recomendaciones r on e.id_empresa = r.id_empresa group by e.id_empresa limit 12,6')->result();
        }


        public function listarEmpresasPorSector($comuna, $id)
        {
            return $this->db->query('select e.id_empresa, e.nombre_empresa, e.imagen_empresa, c.nombre_categoria, e.id_categoria, e.region_empresa, e.comuna_empresa, e.numero_calle_empresa, e.calle_empresa from empresas e inner join categorias c on e.id_categoria = c.id_categoria where e.comuna_empresa = "'.$comuna.'" and e.id_empresa <> '.$id.' limit 0, 4')->result();
        }


        public function buscarEmpresas($term)
        {
            return $this->db->query('select nombre_sub_subcategoria, id_sub_subcategoria from sub_subcategorias where nombre_sub_subcategoria like "%'.$term.'%"')->result();
        }


        public function listarEmpresasPorSubSubcategorias($data)
        {
            $this->db->where('e.id_estado', 1);
            $this->db->where_in('ess.id_sub_subcategoria', $data);
            $this->db->join('empresa_sub_subcategorias ess', 'e.id_empresa = ess.id_empresa');
            $query = $this->db->get('empresas e');
            return $query->result();
        }


        //marcar leidas empresa
        public function marcar_leidas($data, $id)
        {
            $this->db->where('id_notificacion', $id);
            return $this->db->update('notificaciones', $data);
        }


        public function marcar_leidas_persona($data, $id)
        {
            $this->db->where('id_notificacion', $id);
            return $this->db->update('notificaciones_persona', $data);
        }

        public function marcar_leidas_convenio($data, $id)
        {
            $this->db->where('id_notificacion', $id);
            return $this->db->update('notificaciones_convenio', $data);
        }

        public function eliminarSubcategoriasEmpresa($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete('empresa_subcategorias');
        }

        public function eliminarSub_subcategoriasEmpresa($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete('empresa_sub_subcategorias');
        }

        public function eliminarPagos($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete('pagos_empresa');
        }

        public function eliminarHorario($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete('empresa_horarios');
        }


        public function listadoDeAyudaEmpresas($id_cliente, $ordenar = 0)
        {
            if($ordenar == 1){
                $this->db->order_by('cantidad_recomendaciones', 'desc');
            }

            if($ordenar == 2){
                $this->db->order_by('cantidad_productos', 'desc');
            }

            if($ordenar == 3){
                $this->db->order_by('cantidad_servicios', 'desc');
            }

            if($ordenar == 4){
                $this->db->order_by('cantidad_promociones', 'desc');
            }
            $this->db->where('id_estado', 1);
            $this->db->where('id_cliente', $id_cliente);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function empresasYaRegistradas($nombre)
        {
            return $this->db->query('select * from empresas where nombre_empresa like "%'.$nombre.'%"')->result();
        }

        public function buscar_empresas_requerimientos($ides)
        {
            $this->db->where('e.region_empresa', $this->session->region);
            $this->db->where_in('s.id_sub_subcategoria', $ides);
            $this->db->join('empresas e', 's.id_empresa = e.id_empresa');
            $this->db->join('sub_subcategorias sc', 'sc.id_sub_subcategoria = s.id_sub_subcategoria');
            $query = $this->db->get('empresa_sub_subcategorias s');
            return $query->result();
        }

        public function obtener_empresas_requerimientos($ides)
        {
            $this->db->where_in('e.id_empresa', $ides);
            $this->db->join('clientes c', 'c.id_cliente = e.id_cliente');
            $query = $this->db->get('empresas e');
            return $query->result();
        }


        public function insertar_requerimiento($data)
        {
            return $this->db->insert('requerimientos', $data);
        }

        public function insertar_sc($data)
        {
            return $this->db->insert('requerimientos_sc', $data);
        }

        public function mis_requerimientos()
        {
            $this->db->where('r.id_cliente', $this->session->id);
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function requerimientos()
        {
            $this->db->limit(5);
            $this->db->where('r.estado_requerimiento', 1);
            $this->db->join('clientes cl', 'cl.id_cliente = r.id_cliente');
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function ver_todos_requerimientos($data)
        {

            if($data != ''){
                if($data['categoria'] != ''){
                    $this->db->where('r.id_categoria', $data['categoria']);
                }

                if($data['subcategoria'] != ''){
                    $this->db->where('r.id_subcategoria', $data['subcategoria']);
                }

                if($data['region'] != ''){
                    $this->db->where('cl.region_cliente', $data['region']);
                }

                if($data['comuna'] != ''){
                    $this->db->where('cl.comuna_cliente', $data['comuna']);
                }

                if($data['fecha'] != '' && $data['fecha'] != 'todas'){

                    if($data['fecha'] == 'hoy'){
                        $fecha = date('Y-m-d');
                        $this->db->where('r.fecha_requerimiento', $fecha);
                    }

                    if($data['fecha'] == 'semana'){
                        $fecha = $this->functions->rango_semana_actual(date('Y-m-d'));
                        $this->db->where('r.fecha_requerimiento >=', $fecha['start']);
                        $this->db->where('r.fecha_requerimiento <=', $fecha['end']);
                    }

                    if($data['fecha'] == 'mes'){
                        $fecha = $this->functions->rango_mes_actual(date('Y-m-d'));
                        $this->db->where('r.fecha_requerimiento >=', $fecha['start']);
                        $this->db->where('r.fecha_requerimiento <=', $fecha['end']);
                    }

                }

                if($data['estado'] != '' && $data['estado'] != 2){
                    $this->db->where('r.estado_requerimiento', $data['estado']);
                }

            }

            $this->db->join('clientes cl', 'cl.id_cliente = r.id_cliente');
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function obtener_requerimiento($id)
        {
            $this->db->where('r.id_requerimiento', $id);
            $this->db->join('clientes cl', 'cl.id_cliente = r.id_cliente');
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function editar_requerimiento($data, $id)
        {
            $this->db->where('id_requerimiento', $id);
            return $this->db->update('requerimientos', $data);
        }

        public function insertar_oferta($data)
        {
            return $this->db->insert('ofertas', $data);
        }

        public function mis_ofertas()
        {
            $this->db->where('o.id_ofertador', $this->session->id);
            $this->db->join('requerimientos r', 'r.id_requerimiento = o.id_requerimiento');
            $this->db->join('clientes c', 'c.id_cliente = o.id_cliente');
            $query = $this->db->get('ofertas o');
            return $query->result();
        }

        public function ofertas_requerimientos($id_requerimiento)
        {
            $this->db->where('o.id_requerimiento', $id_requerimiento);
            $this->db->join('requerimientos r', 'r.id_requerimiento = o.id_requerimiento');
            $this->db->join('clientes c', 'c.id_cliente = o.id_ofertador');
            $query = $this->db->get('ofertas o');
            return $query->result();
        }

        public function editar_oferta($data, $id)
        {
            $this->db->where('id_oferta', $id);
            return $this->db->update('ofertas', $data);
        }


        public function insertar_req_empresa($data)
        {
            return $this->db->insert('requerimientos_empresas', $data);
        }


        public function solicitudes_para_mi($empresas)
        {
            $this->db->where_in('re.id_empresa', $empresas);
            $this->db->join('requerimientos_empresas re', 're.id_requerimiento = r.id_requerimiento');
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $this->db->join('clientes cl', 'cl.id_cliente = r.id_cliente');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function ofertas_para_mi()
        {
            $this->db->where('o.id_cliente', $this->session->id);
            $this->db->join('requerimientos r', 'r.id_requerimiento = o.id_requerimiento');
            $this->db->join('clientes c', 'c.id_cliente = o.id_ofertador');
            $query = $this->db->get('ofertas o');
            return $query->result();
        }


        public function mis_empresas($id_cliente)
        {
            if($id_cliente === null){
                return '';
            }

            $this->db->where_in('id_cliente', $id_cliente);
            $query = $this->db->get('empresas');
            return $query->result();
        }


}
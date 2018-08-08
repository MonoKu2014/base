<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = 'error/error_400';
$route['500_override'] = 'error/error_500';
$route['translate_uri_dashes'] = FALSE;


//PERFILES
$route['persona'] = 'welcome/persona';
$route['microempresario/(:num)'] = 'microempresarios/microempresario/$1';
$route['preguntas_frecuentes'] = 'preguntas';
$route['contactenos'] = 'welcome/contactenos';

//LISTADOS
$route['microempresarios/(:num)/(:num)'] = 'microempresarios/listado_microempresarios/$1/$2';
$route['microempresarios/detalle/(:num)/(:num)'] = 'microempresarios/detalle/$1/$2';


//MICROEMPRESARIOS
$route['publica'] = 'microempresarios/publica';
$route['publica_microempresario'] = 'microempresarios/publica_microempresario';
$route['publica_tercero'] = 'microempresarios/publica_tercero';

$route['agregar_producto/(:num)'] = 'microempresarios/agregar_producto/$1';
$route['agregar_servicio/(:num)'] = 'microempresarios/agregar_servicio/$1';
$route['crear_promocion/(:num)'] = 'microempresarios/crear_promocion/$1';


$route['eliminar_producto/(:num)'] = 'microempresarios/eliminar_producto/$1';
$route['eliminar_servicio/(:num)'] = 'microempresarios/eliminar_servicio/$1';
$route['eliminar_promocion/(:num)'] = 'microempresarios/eliminar_promocion/$1';


$route['editar_producto/(:num)'] = 'microempresarios/editar_producto/$1';
$route['eliminar_imagen_producto/(:num)'] = 'microempresarios/eliminar_imagen_producto/$1';

$route['editar_servicio/(:num)'] = 'microempresarios/editar_servicio/$1';


$route['listado_categorias'] = 'welcome/listado_categorias';


$route['perfil_persona/(:num)'] = 'welcome/perfil_persona/$1';
$route['perfil_rse/(:num)'] = 'rse/perfil_rse/$1';
$route['chat/(:num)'] = 'rse/chat/$1';


$route['editar_persona'] = 'welcome/editar_persona';
$route['guarda_edicion_persona'] = 'welcome/guarda_edicion_persona';

$route['invitar'] = 'welcome/invitar';

$route['publicar_microempresario'] = 'welcome/publicar_microempresario_ayuda';
$route['ayuda'] = 'welcome/ayuda';

$route['acerca_de'] = 'welcome/acerca_de';
$route['beneficios'] = 'welcome/beneficios';
$route['beneficios_inscritos'] = 'welcome/beneficios_inscritos';

$route['recomendar'] = 'welcome/recomendar';
$route['seguir_promociones'] = 'welcome/seguir_promociones';
$route['seguir_recomendaciones'] = 'welcome/seguir_recomendaciones';


$route['registrarse'] = 'welcome/registrarse';

$route['registro_paso_uno'] = 'welcome/registro_paso_uno';
$route['registro_paso_dos'] = 'welcome/registro_paso_dos';
$route['registro_paso_tres'] = 'welcome/registro_paso_tres';
$route['registro_paso_cuatro'] = 'welcome/registro_paso_cuatro';
$route['publicar_paso_uno'] = 'welcome/publicar_paso_uno';
$route['publicar_paso_dos'] = 'welcome/publicar_paso_dos';
$route['publicar_paso_tres'] = 'welcome/publicar_paso_tres';
$route['publicar_paso_cuatro'] = 'welcome/publicar_paso_cuatro';

$route['mis_notificaciones'] = 'welcome/mis_notificaciones';
$route['agregar_requerimiento'] = 'welcome/agregar_requerimiento';
$route['mis_requerimientos'] = 'welcome/mis_requerimientos';
$route['mis_ofertas'] = 'welcome/mis_ofertas';
$route['requerimientos'] = 'welcome/requerimientos';
$route['ofertas_requerimiento/(:num)'] = 'welcome/ofertas_requerimiento/$1';
$route['detalle_requerimiento/(:num)'] = 'welcome/detalle_requerimiento/$1';


$route['productos_mas_buscados'] = 'welcome/productos_mas_buscados';
$route['servicios_mas_buscados'] = 'welcome/servicios_mas_buscados';
$route['mas_recomendados'] = 'welcome/mas_recomendados';


$route['solicitudes'] = 'welcome/solicitudes';
$route['ofertas_recibidas'] = 'welcome/ofertas_recibidas';
<?php defined('BASEPATH') OR exit('No direct script access allowed');


//si no hay sesion, lo redirijo al inicio donde esta el login
function validate_session()
{
	$ci =& get_instance();
    if($ci->session->id == ''){
    	$message = 'Debe iniciar sesión para acceder a este contenido';
    	$ci->session->set_flashdata('message', alert_danger($message));
        redirect(base_url());
    }
}

//para imprimir la última consulta que se realiza a la base de datos y poder depurar bien una query
function query_logger()
{
	$ci =& get_instance();
	dd($ci->db->last_query());
}


//funciona igual que el dd de laravel
function dd($var)
{
	var_dump($var);
	die();
}


function alert_success($text)
{
	return '<div class="alert alert-success"><i class="fa fa-check"></i> '.$text.'</div>';
}

function alert_danger($text)
{
	return '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$text.'</div>';
}

function alert_info($text)
{
	return '<div class="alert alert-info"><i class="fa fa-info-circle"></i> '.$text.'</div>';
}


function active($controller)
{
	$ci =& get_instance();

	$nav = change_nav($ci->router->class);

	if($nav == $controller){
		return 'class="active"';
	}

	return '';
}


function change_nav($controller)
{
    return $controller;
}


//retorna la letra asociada a la columna de conteo del exportar a excel
function excel_final_letter($index)
{
	$letters = range('A', 'Z');
	return $letters[$index];
}


function header_correction($header)
{
	$find = strpos($header, '_');
	if($find){
		return str_replace('_', ' ', $header);
	}

	return $header;
}


function main_export($filename, $registers, $fields)
{

	$ci =& get_instance();

    $ci->load->library('Excel.php');

    $ci->excel->getProperties()->setCreator("ISO Quality")
                                 ->setTitle("Registros Exportados")
                                 ->setSubject("Registros Exportados");


    $ci->excel->setActiveSheetIndex(0);

    $col = 0;
    foreach ($fields as $field) {
        $ci->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, header_correction(strtoupper($field)));
        $col++;
    }

    $letters = 'A1:' . excel_final_letter($col - 1) . '1';


    $ci->excel->getActiveSheet()
        ->getStyle($letters)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('0066cb');

    $ci->excel->getActiveSheet()
        ->getStyle($letters)
        ->getFont()->setBold(false)
        ->setSize(12)
        ->getColor()->setRGB('FFFFFF');


    $ci->excel->setActiveSheetIndex(0);


    $row = 2;
    foreach($registers as $register)
    {
        $col = 0;
        foreach ($fields as $field)
        {
            $ci->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $register->$field);
            $col++;
        }

        $row++;
    }

    $ci->excel->getActiveSheet()->setTitle($filename);

    $ci->excel->setActiveSheetIndex(0);


    foreach ($ci->excel->getWorksheetIterator() as $worksheet) {
        $ci->excel->setActiveSheetIndex($ci->excel->getIndex($worksheet));
        $sheet = $ci->excel->getActiveSheet();
        $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);
        foreach ($cellIterator as $cell) {
            $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
        }
    }


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($ci->excel, 'Excel2007');
    $objWriter->save('php://output');

}



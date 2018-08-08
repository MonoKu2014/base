<?php

class PaisModel extends CI_Model {


    const ARGENTINA     = 'https://portalmicroempresa.com.ar';
    const BOLIVIA       = 'https://portalmicroempresarios.com.bo';
    const BRASIL        = 'https://portalmicroempresarios.com.br';
    const CHILE         = 'https://portalmicroempresarios.cl';
    const COLOMBIA      = 'https://portalmicroempresarios.com.co';
    const ECUADOR       = 'https://portalmicroempresarios.com.ec';
    const MEXICO        = 'https://portalmicroempresarios.mx';
    const PARAGUAY      = 'https://portalmicroempresarios.com.py';
    const PERU          = 'https://portalmicroempresarios.com.pe';
    const URUGUAY       = 'https://portalmicroempresarios.com.uy';
    const VENEZUELA     = 'https://portalmicroempresarios.com.ve';


    public function __construct()
    {

            parent::__construct();

    }



    public function pais_actual($pais_actual)
    {
        $pais = '<a href=""><img class="ps" src="'.IMAGES_PATH.'paises/'.strtolower($pais_actual).'.png"></a>';

        return $pais;
    }


    public function opciones_paises($pais_actual)
    {

        $paises = '';

        if($pais_actual == 'Argentina'){
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Bolivia'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Brasil'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Chile'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Colombia'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Ecuador'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Mexico'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }



        if($pais_actual == 'Paraguay'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Peru'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Uruguay'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::VENEZUELA.'"><img class="ps" src="'.IMAGES_PATH.'paises/venezuela.png">Venezuela</a></li>';
        }


        if($pais_actual == 'Venezuela'){
            $paises .= '<li><a href="'.self::ARGENTINA.'"><img class="ps" src="'.IMAGES_PATH.'paises/argentina.png">Argentina</a></li>';
            $paises .= '<li><a href="'.self::BOLIVIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/bolivia.png">Bolivia</a></li>';
            $paises .= '<li><a href="'.self::BRASIL.'"><img class="ps" src="'.IMAGES_PATH.'paises/brasil.png">Brasil</a></li>';
            $paises .= '<li><a href="'.self::CHILE.'"><img class="ps" src="'.IMAGES_PATH.'paises/chile.png">Chile</a></li>';
            $paises .= '<li><a href="'.self::COLOMBIA.'"><img class="ps" src="'.IMAGES_PATH.'paises/colombia.png">Colombia</a></li>';
            $paises .= '<li><a href="'.self::ECUADOR.'"><img class="ps" src="'.IMAGES_PATH.'paises/ecuador.png">Ecuador</a></li>';
            $paises .= '<li><a href="'.self::MEXICO.'"><img class="ps" src="'.IMAGES_PATH.'paises/mexico.png">Mexico</a></li>';
            $paises .= '<li><a href="'.self::PARAGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/paraguay.png">Paraguay</a></li>';
            $paises .= '<li><a href="'.self::PERU.'"><img class="ps" src="'.IMAGES_PATH.'paises/peru.png">Peru</a></li>';
            $paises .= '<li><a href="'.self::URUGUAY.'"><img class="ps" src="'.IMAGES_PATH.'paises/uruguay.png">Uruguay</a></li>';
        }

        return $paises;

    }




}
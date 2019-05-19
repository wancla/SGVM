<?php
namespace App\Controller;
/**
 * @author Wanclei Felipe <wanclei.santos@fatec.sp.gov.br>
 * @license http://URL name
 * 
 */
use App\Model\ClassFpdfMudas;

class ControllerRelatorioPorData extends ClassFpdfMudas {
    /**
     * metodo construtor da classe de controler do Usuario.
     */
    public function __construct() {
        
        if (isset($_POST["btn_relatorioData"])) {
            $data1 = $_POST["data1"];
            $data2 = $_POST["data2"];
            $this->GeneratePdfPorData($data1, $data2);
        }
    }

}

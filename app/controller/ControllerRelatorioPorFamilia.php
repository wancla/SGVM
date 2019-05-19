<?php
namespace App\Controller;
/**
 * @author Wanclei Felipe <wanclei.santos@fatec.sp.gov.br>
 * @license http://URL name
 * 
 */
use App\Model\ClassFpdfMudas;

class ControllerRelatorioPorFamilia extends ClassFpdfMudas {
    /**
     * metodo construtor da classe de controler do Usuario.
     */
    public function __construct() {
        
        if (isset($_POST["btn_relatorioFamilia"])) {
            $familia = $_POST["familia"];            
            $this->GeneratePdfPorFamilia($familia);
        }
    }

}

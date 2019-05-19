<?php
namespace App\Controller;
/**
 * @author Wanclei Felipe <wanclei.santos@fatec.sp.gov.br>
 * @license http://URL name
 * 
 */
use App\Model\ClassFpdfMudas;

class ControllerRelatorioPorEspecie extends ClassFpdfMudas {
    /**
     * metodo construtor da classe de controler do Usuario.
     */
    public function __construct() {
        
        if (isset($_POST["btn_relatorioEspecie"])) {
            $especie = $_POST["especie"];
            $this->GeneratePdfPorEspecie($especie);
        }
    }

}

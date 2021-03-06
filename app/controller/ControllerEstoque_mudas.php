<?php

namespace App\Controller;

session_start();

/**
 * @author John Doe <john.doe@example.com>
 * @license http://URL name
 * 
 */
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use Src\Classes\ClassSessions;
use App\Model\ClassFpdfMudas;

class ControllerEstoque_mudas extends ClassRender implements InterfaceView {

    use \Src\Traits\TraitUrlParser;

    /**
     * metodo construtor da classe de controler da home.
     */
    public function __construct() {
        if (count($this->parseUrl()) === 1) {
            $this->setTitle("Estoque de Mudas");
            $this->setDescription("");
            $this->setKeywords("");
            $this->setDir("estoque_mudas");
            $this->Main();
            $this->renderLayout();
            $session = new ClassSessions();
            $session->verifyInsideSession("padrao");
        }
    }

    private function Main() {

        if (isset($_REQUEST["relatorio"]) && $_REQUEST["relatorio"] == "geral") {
            $fpdf = new ClassFpdfMudas();
            $fpdf->GeneratePdf();
        }
    }

}

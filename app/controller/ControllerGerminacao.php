<?php
namespace App\Controller;
session_start();
/**
 * @author John Doe <john.doe@example.com>
 * @license http://URL name
 * 
 */

use Src\Classes\ClassRender;
use Src\Classes\ClassValidate as validate;
use App\Model\ClassGerminacao as germinacao;
use Src\Interfaces\InterfaceView;
use Src\Classes\ClassSessions;
use Src\Classes\ClassExport;

class ControllerGerminacao extends ClassRender implements InterfaceView{
    
    /**
     * metodo construtor da classe de controler da home.
     */
    public function __construct() {
        $this->setTitle("Germinação");
        $this->setDescription("");
        $this->setKeywords("");
        $this->setDir("germinacao");
        $this->renderLayout();
        $this->btn_excluir_event();
        $this->btn_export_event();
        $this->Main();
        $session= new ClassSessions();
        $session->verifyInsideSession("padrao");
    }
  #
    private function Main(){
        $arrVar = null;
        $germinacao = new germinacao();
        $validate = new validate();

        if(!empty($_POST)){                                
            $arrVar =[
                "especie"=>$germinacao::getEspecie(),
                "data"=>$germinacao::getData(),
                "qtde"=>$germinacao::getQtde(),
                "descricao"=>$germinacao::getDescricao()
            ];
            //$validate->validateFields($_POST);           
            
            if($validate->getErro()== ""){
                $germinacao->insertGerminacao($arrVar);
                echo '<div class="" style="color:red; font-weight:bold;">'.$validate->getErro().'</div>';
            }
        }           
    }
    # evento do botão excluir
    private function btn_excluir_event(){
        if(isset($_REQUEST["id"])){
            $id=$_REQUEST["id"];
            $germinacao = new germinacao();
            $germinacao->deleteDataGerminacao($id);
        }
    }
    /**
     * Função do evento do botão excluir
     */
    private function btn_export_event(){
        if(isset($_REQUEST["pagina"])&& $_REQUEST["pagina"]==0){
             $export=new ClassExport();
             $export->gerarExcelGerminacao("Tabela Germinacao");
        }
    }

    

}
<?php
namespace App\Controller;

/**
 * @author John Doe <john.doe@example.com>
 * @license http://URL name
 * 
 */


use Src\Classes\ClassHelperUser as help;
use App\Model\ClassEspecies;
use App\Model\ClassCliente as cliente;
use App\Model\ClassLogin;
use App\Model\ClassGeminacao;
use App\Model\ClassViveiros;
use App\Model\ClassSementes;
use App\Model\Json;
use App\Model\ClassExport;
use Src\database\ClassDatabase;
use App\Model\ClassInventario;


class ControllerJson extends ClassDatabase{
    /**
     * metodo construtor da classe de controler do Usuario.
     */
    public function __construct() {
        $invent = new ClassInventario();
       $invent->getInventario();
}
}
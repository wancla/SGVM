<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of ClassEspecies
 *
 * @author wsantos
 */
use App\Model\ClassCrud;
use Src\Traits\TraitGetIp;
use PDO;

class ClassSementes extends ClassCrud {

    /**
     *
     * @var type 
     */
    static $local;
    static $especie;
    static $data;
    static $cep;
    static $endereco;
    static $bairro;
    static $cidade;
    static $uf;
    static $descricao;
    private $trait;
    private $dateNow;

    public function __construct() {
        $this->dateNow = date("Y-m-d H:i:s");
        $this->trait = TraitGetIp::getUserIp();
    }

    #Realizará a inserção no banco de dados

    public function insertSementes($arrVar) {
        //
        $verify_exist = $this->getDataEspecie($arrVar["especie"]);
        
        //
        $verify = $this->getDataSementes($arrVar["especie"]);
        
        if($verify_exist["rows"] >0){
            if($verify["rows"] > 0 && $verify["data"]["local"]=== $arrVar["local"]){
                if($verify["data"]["dt"]===$arrVar["data"]){
                    echo "<script>alert('Quantidade somada');window.location.href='" . DIRPAGE . "/coleta_sementes?pagina=1'</script>";
                }else{
                    //se a data for igual, então faça um update na quantidade.
                    $sql = "update tb_sementes set dt = :data where especie= :especie and local= :local";
                    $pdo = $this->conexaoDB();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':especie' => $arrVar["especie"],
                        ':data' => $arrVar["data"],
                        ':local' => $arrVar["local"]
                    ));
                    if ($stmt->rowCount() > 0) {
                        echo "<script>alert('A data foi modificada!');window.location.href='" . DIRPAGE . "/coleta_sementes?pagina=1'</script>";
                    } else {
                        echo "<script>alert('Erro!Verifique os campos!');window.location.href='" . DIRPAGE . "/coleta_sementes?pagina=1'</script>";
                    }
                }
            }else{
                //se for diferente entao insira uma nova geminação.
                    $this->insertDB(
                            "tb_sementes", "?,?,?,?,?,?,?,?,?,?", array(
                        0,
                        $arrVar['local'],
                        $arrVar['especie'],
                        $arrVar['data'],
                        $arrVar['cep'],
                        $arrVar['endereco'],
                        $arrVar['bairro'],
                        $arrVar['cidade'],
                        $arrVar['uf'],
                        $arrVar['descricao']
                            )
                    );
                    echo "<script>alert('{$arrVar["especie"]} Cadastrada com sucesso!');window.location.href='" . DIRPAGE . "/coleta_sementes?pagina=1'</script>";
            }
        }else{
            echo "faça o cadastro da especie!";
        }
    }

    static function getLocal() {
        if (isset($_POST['local'])) {
            self::$local = filter_input(INPUT_POST, 'local', FILTER_DEFAULT);
            return ucwords(self::$local);
        }
    }

    static function getEspecie() {
        if (isset($_POST['especie'])) {
            self::$especie = filter_input(INPUT_POST, 'especie', FILTER_DEFAULT);
            return ucwords(self::$especie);
        }
    }

    static function getData() {
        if (isset($_POST['data'])) {
            self::$data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT);
            return self::$data;
        }
    }

    static function getEndereco() {
        if (isset($_POST['endereco'])) {
            self::$endereco = filter_input(INPUT_POST, 'endereco', FILTER_DEFAULT);
            return ucfirst(self::$endereco);
        }
    }
    static function getBairro() {
        if (isset($_POST['bairro'])) {
            self::$bairro = filter_input(INPUT_POST, 'bairro', FILTER_DEFAULT);
            return ucwords(self::$bairro);
        }
    }

    static function getCidade() {
        if (isset($_POST['cidade'])) {
            self::$cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT);
            return ucwords(self::$cidade);
        }
    }

    static function getUF() {
        if (isset($_POST['uf'])) {
            self::$uf = filter_input(INPUT_POST, 'uf', FILTER_DEFAULT);
            return ucwords(self::$uf);
        }
    }

    static function getCep() {
        if (isset($_POST['cep'])) {
            self::$cep = filter_input(INPUT_POST, 'cep', FILTER_DEFAULT);
            return self::$cep;
        }
    }

    static function getDescricao() {
        if (isset($_POST['descricao'])) {
            self::$descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
            return ucfirst(self::$descricao);
        }
    }

    /**
     * retorna os dados do usuario
     */
    public function getDataSementes($especie) {
        $select = $this->selectDB(
                "*", "tb_sementes", "where especie=?", array(
            $especie
                )
        );
        $fetch = $select->fetch(\PDO::FETCH_ASSOC);
        $row = $select->rowCount();
        return $arrData = [
            "data" => $fetch,
            "rows" => $row
        ];
    }

    /**
     * retorna os dados do usuario
     */
    public function getDataEspecie($especie) {
        $select = $this->selectDB(
                "*", "tb_especies", "where nPopular=?", array(
            $especie
                )
        );
        $fetch = $select->fetch(\PDO::FETCH_ASSOC);
        $row = $select->rowCount();
        return $arrData = [
            "data" => $fetch,
            "rows" => $row
        ];
    }

    /**
     * retorna os dados referente a data.
     */
    public function getDataLocal($local) {
        $select = $this->selectDB(
                "*", "tb_sementes", "where local=?", array(
            $local
                )
        );
        $fetch = $select->fetch(\PDO::FETCH_ASSOC);
        $row = $select->rowCount();
        return $arrData = [
            "data" => $fetch,
            "rows" => $row
        ];
    }

    /**
     * deleta a especie do database
     */
    public function deleteDataSementes($id) {
        $this->deleteDB(
                "tb_sementes", "id=?", array(
            $id
                )
        );
    }

}

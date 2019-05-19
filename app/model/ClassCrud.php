<?php

namespace App\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;

class ClassCrud extends ClassConexao {

    /**
     * 
     */
    private $crud;

    /**
     * 
     */
    private function prepareExecute($prep, $exec) {
        $this->crud = $this->conexaoDB()->prepare($prep);
        $this->crud->execute($exec);
    }

    /**
     * 
     * 
     */
    public function selectDB($fields, $table, $where, $exec) {
        $this->prepareExecute("select {$fields} from {$table} {$where}", $exec);
        return $this->crud;
    }

    /**
     * 
     * 
     */
    public function likeDB($fields, $table, $where, $like, $exec) {
        $this->prepareExecute("select {$fields} from {$table} {$where} like %{$like}%", $exec);
        return $this->crud;
    }

    /**
     * 
     * 
     */
    public function insertDB($table, $values, $exec) {
        $this->prepareExecute("insert into {$table} values ({$values})", $exec);
        return $this->crud;
    }

    /**
     * 
     * 
     */
    public function deleteDB($table, $values, $exec) {
        $this->prepareExecute("delete from {$table} where {$values}", $exec);
        return $this->crud;
    }

    /**
     * 
     * 
     */
    public function updateDB($table, $values, $where, $exec) {
        $this->prepareExecute("update {$table} set {$values} where {$where}", $exec);
        return $this->crud;
    }

    /**
     * busca pela entre datas
     */
    public function getAllEntreDatas($table, $dt1, $dt2) {
        $stmt = "SELECT especie,dt,qtde,material FROM {$table} WHERE dt BETWEEN :dt1 AND :dt2 ORDER BY especie";
        $data = $this->conexaoDB()->prepare($stmt);
        $data->bindValue(':dt1', $dt1);
        $data->bindValue(':dt2', $dt2);
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return $fetch;
    }

    /**
     * busca pela entre datas
     */
    public function getMaxQtdeporData($table, $dt1, $dt2) {
        try {
            $stmt = "SELECT especie,dt,MAX(qtde) FROM {$table} WHERE dt BETWEEN :dt1 AND :dt2";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->bindValue(':dt1', $dt1);
            $data->bindValue(':dt2', $dt2);
            $data->execute();
            $result = $data->fetchAll(\PDO::FETCH_ASSOC);
            $fetch = array();

            foreach ($result as $key => $value) {
                foreach ($value as $k => $v) {
                    $fetch[$key][$k] = utf8_decode($v);
                }
            }
            return $fetch["0"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * busca pela entre datas
     */
    public function getMinQtdeporData($table, $dt1, $dt2) {
        try {
            $stmt = "SELECT especie,dt,MIN(qtde) FROM {$table} WHERE dt BETWEEN :dt1 AND :dt2 GROUP BY qtde";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->bindValue(':dt1', $dt1);
            $data->bindValue(':dt2', $dt2);
            $data->execute();
            $result = $data->fetchAll(\PDO::FETCH_ASSOC);
            $fetch = array();

            foreach ($result as $key => $value) {
                foreach ($value as $k => $v) {
                    $fetch[$key][$k] = utf8_decode($v);
                }
            }
            return $fetch["0"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * pega todos os campos da tabela viveiro
     */
    public function getAllData($table) {
        $stmt = "SELECT * FROM {$table}";
        $data = $this->conexaoDB()->prepare($stmt);
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return $fetch;
    }

    /**
     * pega todos os campos da tabela viveiro
     */
    public function getDiasDeGerminacao($especie) {
        try {
            
            $stmt = "SELECT dt FROM tb_repicagem WHERE especie= :especie";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->bindValue(':especie', $especie);            
            $data->execute();
            $result = $data->fetchColumn();
            
            
            $stmt1 = "SELECT dt FROM tb_germinacao WHERE especie= :especie";
            $data1 = $this->conexaoDB()->prepare($stmt1);
            $data1->bindValue(':especie', $especie);            
            $data1->execute();
            $result1 = $data1->fetchColumn();
            
            
            
            $dataGer = strtotime($result1);
            $dataRep = strtotime($result);
                    
            $dataFinal = ($dataRep-$dataGer)/86400;
            
            
            return $dataFinal;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * pega todos os campos da tabela repicagem pela especie
     */
    public function getAllDataPorEspecie($table, $especie) {
        $stmt = "SELECT * FROM {$table} WHERE especie = :especie";
        $data = $this->conexaoDB()->prepare($stmt);
        $data->bindValue(':especie', $especie);
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return $fetch;
    }

    /**
     * busca a especie pela familia
     */
    public function getAllDataPorFamilia($table, $familia) {
        //faz um select pra buscar se a familia existe na tabela especie.
        $verifySTMT = "SELECT nPopular, familia, qtde ,dt FROM tb_especies CROSS JOIN {$table} ON tb_especies.nPopular = {$table}.especie WHERE familia= :familia ORDER BY nPopular";
        $data = $this->conexaoDB()->prepare($verifySTMT);
        $data->bindValue(':familia', ucfirst($familia));
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return $fetch;
    }

    /**
     * busca a especie pela familia
     */
    public function getSUMDataPorFamilia($table, $familia) {
        //faz um select pra buscar se a familia existe na tabela especie.
        $verifySTMT = "SELECT nPopular,SUM(qtde) FROM tb_especies CROSS JOIN {$table} ON tb_especies.nPopular = {$table}.especie WHERE familia= :familia ORDER BY nPopular";
        $data = $this->conexaoDB()->prepare($verifySTMT);
        $data->bindValue(':familia', ucfirst($familia));
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return $fetch;
    }

    /**
     * busca a especie pela familia
     */
    public function getMaxQtdePorFamilia($table, $familia) {
        //faz um select pra buscar se a familia existe na tabela especie.
        $verifySTMT = "SELECT especie, familia, MAX(qtde) ,dt FROM tb_especies CROSS JOIN {$table} ON tb_especies.nPopular = {$table}.especie WHERE familia= :familia";
        $data = $this->conexaoDB()->prepare($verifySTMT);
        $data->bindValue(':familia', ucfirst($familia));
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return max($fetch);
    }

    /**
     * busca a especie pela familia
     */
    public function getMinQtdePorFamilia($table, $familia) {
        //faz um select pra buscar se a familia existe na tabela especie.
        $verifySTMT = "SELECT especie, familia, MIN(qtde) ,dt FROM tb_especies CROSS JOIN {$table} ON tb_especies.nPopular = {$table}.especie WHERE familia= :familia";
        $data = $this->conexaoDB()->prepare($verifySTMT);
        $data->bindValue(':familia', ucfirst($familia));
        $data->execute();
        $result = $data->fetchAll(\PDO::FETCH_ASSOC);
        $fetch = array();

        foreach ($result as $key => $value) {
            foreach ($value as $k => $v) {
                $fetch[$key][$k] = utf8_decode($v);
            }
        }
        return min($fetch);
    }

    /**
     * tras a quantidade max
     */
    public function getMaxQtdePorEspecie($table, $especie) {
        try {
            $stmt = "SELECT especie,dt,MAX(qtde) FROM {$table} WHERE especie = :especie";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->bindValue(':especie', $especie);
            $data->execute();
            $result = $data->fetchAll(\PDO::FETCH_ASSOC);
            $fetch = array();

            foreach ($result as $key => $value) {
                foreach ($value as $k => $v) {
                    $fetch[$key][$k] = utf8_decode($v);
                }
            }
            return $fetch["0"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * tras a quantidade max
     */
    public function getMinQtdePorEspecie($table, $especie) {
        try {
            $stmt = "SELECT especie,dt,MIN(qtde) FROM {$table} WHERE especie = :especie GROUP BY qtde";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->bindValue(':especie', $especie);
            $data->execute();
            $result = $data->fetchAll(\PDO::FETCH_ASSOC);
            $fetch = array();

            foreach ($result as $key => $value) {
                foreach ($value as $k => $v) {
                    $fetch[$key][$k] = utf8_decode($v);
                }
            }
            return $fetch["0"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * pega todos os campos da tabela repicagem pela especie
     */
    public function getSUMDataPorEspecie($table, $especie) {
        $stmt = "SELECT SUM(qtde) FROM {$table} WHERE especie = :especie";
        $data = $this->conexaoDB()->prepare($stmt);
        $data->bindValue(':especie', $especie);
        $data->execute();
        $result = $data->fetchColumn();

        return $result;
    }

    /**
     * pega todos os campos da tabela repicagem pela especie
     */
    public function getSUMDataPorData($table, $dt1, $dt2) {
        $stmt = "SELECT SUM(qtde) FROM {$table} WHERE dt BETWEEN :dt1 AND :dt2";
        $data = $this->conexaoDB()->prepare($stmt);
        $data->bindValue(':dt1', $dt1);
        $data->bindValue(':dt2', $dt2);
        $data->execute();
        $result = $data->fetchColumn();

        return $result;
    }

    /**
     * soma a coluna desejada
     */
    public function getSomaColQtde($table) {
        try {
            $stmt = "SELECT SUM(qtde)FROM {$table}";
            $con = $this->conexaoDB();
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cont = $con->query($stmt)->fetchColumn();
            return $cont;
        } catch (\PDOExceptionException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * conta as rows de uma tabela
     */
    public function getRowsData($table) {
        try {
            $stmt = "SELECT * FROM {$table}";
            $data = $this->conexaoDB()->prepare($stmt);
            $data->execute();
            $count = $data->rowCount();
            return $count;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of ClassFpdf
 *
 * @author ModoHacker
 */
use App\Model\ClassInventario;

class ClassFpdfMudas extends ClassCrud {

    private function addFpdf() {
        if (file_exists(DIRREQ . "/src/fpdf/fpdf.php")) {
            require_once DIRREQ . "/src/fpdf/fpdf.php";
            $pdf = new \FPDF();
            return $pdf;
        } else {
            return false;
        }
    }

    public function GeneratePdf() {
        $pdf = $this->addFpdf();
        $invent = new ClassInventario();

        /**
         * Inicia e cria o pdf
         */
        $pdf->AddPage();

        /**
         * Nome do arquivo em pdf.
         */
        $filename = "EstoqueDeMudas.pdf";

        /**
         * Formatação
         */
        $family = "Arial";
        $estilo = "B";
        $border = "1";
        $alignC = "C";
        $alignL = "L";

        /**
         * tipo do pdf
         * I -> Envia o pdf pro navegador.
         * D -> Envia pro navegador e força o download.
         * F -> Salva o arquivo local com o nome definido
         * S -> Retorna o documento como uma string.
         */
        $tipo_pdf = "I";
        
        
        $pdf->Image(DIRIMG.'daeLogo.png');
        $pdf->Cell(190, 5, "", 0, 1, $alignL);
        
        $somatoria = $this->getSomaColQtde("tb_repicagem");
        $MaxEspecie = $invent->getMaxQtde("tb_repicagem")["especie"];
        $MaxQtde = $invent->getMaxQtde("tb_repicagem")["qtde"];
        $MaxData = $invent->getMaxQtde("tb_repicagem")["data"];

        $MinEspecie = $invent->getMinQtde("tb_repicagem")["especie"];
        $MinQtde = $invent->getMinQtde("tb_repicagem")["qtde"];
        $MinData = $invent->getMinQtde("tb_repicagem")["data"];


        $pdf->SetFont($family, $estilo, 15);
        $pdf->Cell(190, 10, utf8_decode("Relatório Geral - Estoque de Mudas - Viveiro"), 0, 1, $alignC);
        $pdf->Ln();
        $pdf->SetFont($family, '', 12);
        $pdf->Cell(190, 5, utf8_decode("Maior produção"), 1, 1, $alignL);
        $pdf->Cell(190, 10, utf8_decode("Espécie: {$MaxEspecie} | Qtde: {$MaxQtde} | Data: {$MaxData}"), 0, 1, $alignC);
        $pdf->Cell(190, 5, utf8_decode("Menor produção"), 1, 1, $alignL);
        $pdf->Cell(190, 10, utf8_decode("Espécie: {$MinEspecie} | Qtde: {$MinQtde} | Data: {$MinData}"), 0, 1, $alignC);
        $pdf->Cell(190, 5, utf8_decode("Mudas prontas para doação"), 1, 1, $alignL);
        $pdf->Cell(190, 10, "Total de: $somatoria", "B", 1, $alignL);
        $pdf->Ln();
        $pdf->Cell(47, 7, utf8_decode("Espécies"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Data"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Quantidade"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Material"), 1, 1, $alignC);
        foreach ($this->getAllData("tb_repicagem") as $values) {
            $pdf->SetFont($family, '', 11);
            $pdf->Cell(47, 7, utf8_decode($values["especie"]), 0, 0, $alignL);
            $pdf->Cell(47, 7, utf8_decode($values["dt"]), 0, 0, $alignC);
            $pdf->Cell(47, 7, utf8_decode($values["qtde"]), 0, 0, $alignC);
            $pdf->Cell(47, 7, utf8_decode($values["material"]), 0, 1, $alignC);
        }
        /**
         * Fecha o arquivo
         */
        return $pdf->Output($filename, $tipo_pdf);
    }
    /**
     * 
     * @return type
     */
    public function GeneratePdfPorEspecie($especie) {
        $pdf = $this->addFpdf();
        $invent = new ClassInventario();

        /**
         * Inicia e cria o pdf
         */
        $pdf->AddPage();

        /**
         * Nome do arquivo em pdf.
         */
        $filename = "EstoqueDeMudas.pdf";

        /**
         * Formatação
         */
        $family = "Arial";
        $estilo = "B";
        $border = "1";
        $alignC = "C";
        $alignL = "L";

        /**
         * tipo do pdf
         * I -> Envia o pdf pro navegador.
         * D -> Envia pro navegador e força o download.
         * F -> Salva o arquivo local com o nome definido
         * S -> Retorna o documento como uma string.
         */
        $tipo_pdf = "I";
        
        
        $pdf->Image(DIRIMG.'daeLogo.png');
        $pdf->Cell(190, 5, "", 0, 1, $alignL);
        
        $total=$this->getSUMDataPorEspecie("tb_repicagem", $especie);
        $Max=$invent->getMaxQtde("tb_repicagem");
        $Min=$invent->getMinQtde("tb_repicagem");


        $pdf->SetFont($family, $estilo, 15);
        $pdf->Cell(190, 10, utf8_decode("Relatório Geral - Estoque de Mudas - Viveiro"), 0, 1, $alignC);
        $pdf->Ln();
        $pdf->SetFont($family, '', 12);
        $pdf->Cell(190, 5, utf8_decode("Data com maior produção"), 1, 1, $alignL);
        $pdf->Cell(190, 10, utf8_decode("Data: {$Max["data"]} | Quantidade: {$Max["qtde"]}"), 0, 1, $alignC);
        $pdf->Cell(190, 5, utf8_decode("Data com menor produção"), 1, 1, $alignL);
        $pdf->Cell(190, 10, utf8_decode("Data: {$Min["data"]} | Quantidade: {$Min["qtde"]}"), 0, 1, $alignC);
        $pdf->Cell(190, 5, utf8_decode("Mudas prontas para doação"), 1, 1, $alignL);
        $pdf->Cell(190, 10, "Total de: {$total}", "B", 1, $alignL);
        $pdf->Ln();
        $pdf->Cell(47, 7, utf8_decode("Espécies"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Data"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Quantidade"), 1, 0, $alignC);
        $pdf->Cell(47, 7, utf8_decode("Material"), 1, 1, $alignC);
        foreach ($this->getAllDataPorEspecie("tb_repicagem",$especie) as $values) {
            $pdf->SetFont($family, '', 11);
            $pdf->Cell(47, 7, utf8_decode($values["especie"]), 0, 0, $alignL);
            $pdf->Cell(47, 7, utf8_decode($values["dt"]), 0, 0, $alignC);
            $pdf->Cell(47, 7, utf8_decode($values["qtde"]), 0, 0, $alignC);
            $pdf->Cell(47, 7, utf8_decode($values["material"]), 0, 1, $alignC);
        }
        /**
         * Fecha o arquivo
         */
        return $pdf->Output($filename, $tipo_pdf);
    }

}

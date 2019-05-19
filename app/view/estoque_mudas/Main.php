<div class="container">
    <h1 style="font-weight: bold;">Gere seu relatório</h1>
    <hr>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);">
        <h3>Relatório Geral</h3>
      <a href="" target="" id="876"><button class="btn btn-success" id="btn_relatorioGeral" onclick="btn_relatorioGeral()">Criar Relatório</button></a>
      <br><br>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relatório por Data</h3>
        <form action="relatorioPorData" method="POST" id="formData" target="_blank">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="data1">De:</label>
                    <input type="date" class="form-control" name="data1" name="data1" required>
                </div>
                <div class="form-group">
                    <label for="data2">Até:</label>
                    <input type="date" class="form-control" name="data2" name="data2" required>
                    <button type="submit" class="btn btn-warning" name="btn_relatorioData" onclick="btn_relatorioPorData();">Criar Relatório</button>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relatório por Espécie</h3>
        <form action="relatorioPorEspecie" method="POST" id="formEspecie" target="_blank">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="especie">Espécie:</label>
                    <input type="text" class="form-control" id="especie" name="especie" required>
                    <a href="" target="" id="877"><button type="submit" class="btn btn-warning" id="btn_relatorioEspecie" name="btn_relatorioEspecie" onclick="btn_relatorioPorEspecie();">Criar Relatório</button></a>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relatório por Familia</h3>
        <form action="relatorioPorFamilia" method="POST" id="formFamilia" target="_blank">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="familia">Familia:</label>
                    <input type="text" class="form-control" id="familia" name="familia" required>
                    <button type="submit" class="btn btn-warning" name="btn_relatorioFamilia" onclick="btn_relatorioPorFamilia();">Criar Relatório</button>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    
    <br><br>
    
</div>
<script>
    /**
     * 
     * @returns {undefined}
     */
    function btn_relatorioGeral() {
        var resposta = confirm("Deseja gerar o relatório?");

        if (resposta === true) {
            document.getElementById("876").target = "_blank";
            window.location.href = "?relatorio=geral";

        } else {
            document.getElementById("876").target = "";
            window.location.href = "?action=false";
        }


    }
    /**
     * 
     */
    function btn_relatorioPorEspecie(){
        var resposta = confirm("Deseja gerar o relatório por especie?");
        
        if(resposta === true){
            window.location.href = "?relatorio=especie";
        }else{
            window.location.href = "?action=false";
        }
    }
    /**
     * 
     */
    function btn_relatorioPorFamilia(){
        var resposta = confirm("Deseja gerar o relatório por familia?");
        
        if(resposta === true){
            window.location.href = "?relatorio=familia";
        }else{
            window.location.href = "?action=false";
        }
    }
    /**
     * 
     */
    function btn_relatorioPorData(){
        var resposta = confirm("Deseja gerar o relatório por Data?");
        
        if(resposta === true){
            window.location.href = "?relatorio=data";
        }else{
            window.location.href = "?action=false";
        }
    }
</script>
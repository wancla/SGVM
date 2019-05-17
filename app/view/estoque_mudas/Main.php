<div class="container">
    <h1 style="font-weight: bold;">Gere seu relátorio</h1>
    <hr>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);">
        <h3>Relátorio Geral</h3>
      <a href="" target="" id="876"><button class="btn btn-success" id="btn_relatorioGeral" onclick="btn_relatorioGeral()">Criar Relatório</button></a>
      <br><br>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relátorio por Data</h3>
        <form action="" method="POST" id="formDoa">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="data1">De:</label>
                    <input type="date" class="form-control" id="data1" name="data1">
                </div>
                <div class="form-group">
                    <label for="data2">Até:</label>
                    <input type="date" class="form-control" id="data2" name="data2">
                    <button type="submit" class="btn btn-warning" id="btn_relatorioData" onclick="">Criar Relatório</button>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relátorio por Espécie</h3>
        <form action="" method="POST" id="formDoa">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="especie">Espécie:</label>
                    <input type="text" class="form-control" id="especie" name="especie">
                    <button type="submit" class="btn btn-warning" id="btn_relatorioEspecie" onclick="">Criar Relatório</button>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px solid #A9A9A9; box-shadow: 0 8px 16px -8px rgba(0,0,0,0.8); background: linear-gradient(#f8f8f8, #fff);"> 
        <h3>Relátorio por Familia</h3>
        <form action="" method="POST" id="formDoa">
            <div class="form-inline"> 
                <br>
                <div class="form-group">
                    <label for="familia">Familia:</label>
                    <input type="text" class="form-control" id="familia" name="familia">
                    <button type="submit" class="btn btn-warning" id="btn_relatorioFamilia" onclick="">Criar Relatório</button>
                </div>
            </div> 
            <br>
            <br>
        </form>
    </div>
    
    <br><br>
    
</div>
<script>
    function btn_relatorioGeral() {
        var resposta = confirm("Deseja gerar o relatório?");

        if (resposta === true) {
            document.getElementById("876").target = "_blank";
            window.location.href = "?action=true";

        } else {
            document.getElementById("876").target = "";
            window.location.href = "?action=false";
        }


    }
</script>
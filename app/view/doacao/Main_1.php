<div class="container">
    <h1 style="font-weight: bold;">Doações</h1>
    <hr>
    <div class="container">
        <form action="" method="POST" name="add_name" id="add_name">
        <div class="form-inline">  
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <input type="text" class="form-control" id="cliente" name="cliente">
            </div>
            <div class="form-group">
                <label for="data"></label>
                <input type="date" class="form-control" id="data" name="data">
            </div>
        </div>   
        <br>
        <div class="form-inline">
            <div class="form-group">
                <label class="" for="especie">Especie:</label>
                <input type="text" name="especie" id="especie" class="form-control">            
            </div>
            <div class="form-group">
                <label class="" for="qtde">Qtde:</label>
                <input type="text" name="qtde" id="qtde" class="form-control" >            
            </div>
            <div class="form-group">
                <label class="" for="local">Local:</label>
                <input type="text" name="local" id="qtde" class="form-control">   
                <input class="btn btn-success" type='submit' name="btn_add" id='incluir' value='incluir' onclick=''/>    
            </div>
        </div>
       </form>
    </div>
</div>



<div class="container">
    <table id='tabela' class="table table-hover table-responsive">
        <tr>
            <td>Espécie</td>
            <td>Qtde</td>
            <td>Excluir</td>
        </tr>
        <?php 
           
        ?>
    </table>
</div>

<div class="container">
    <div class="form-group form-inline">
        <label class="control-label col-sm-12"></label>
        <div class="col-sm-3">
            <input class="btn btn-warning" type='button' id='salvar' value='Salvar' onclick="btn_save();"/>
        </div>
    </div>
</div>

<script LANGUAGE="JavaScript">
    /**
    geral = 0;
    function adiciona() {
        geral++;
        tabelinha = document.getElementById("tabela")
        var especie1 = document.getElementById("especie");
        var qtde1 = document.getElementById("qtde");
        var novaLinha = tabelinha.insertRow(-1);
        var novaCelula;
        if (geral % 2 == 0)
            cortabela = "FFF5EE";
        else
            cortabela = "FFFAF0";

        novaCelula = novaLinha.insertCell(0);
        novaCelula.style.backgroundColor = cortabela;
        novaCelula.innerHTML = especie1.value;

        novaCelula = novaLinha.insertCell(1);
        novaCelula.style.backgroundColor = cortabela;
        novaCelula.innerHTML = qtde1.value;

        novaCelula = novaLinha.insertCell(2);
        novaCelula.style.backgroundColor = cortabela;
        novaCelula.innerHTML = '<input type="button" class="btn btn-danger" value="X" onclick="deleteRow(this)"/>';
        
        const tabela = document.getElementById('tabela');
        const rows = [...tabela.querySelectorAll('tr')]
                .slice(1) // o slice é para remover a primeira linha com os labels
                .map(el => [...el.children].map(el => el.textContent));

        const data = rows.reduce((arr, [tipo, valor]) => arr.concat({
                tipo,
                valor
            }), []);

        console.log(JSON.stringify(data, null, 4));


    }
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        
    }
    function get() {
        var especie = document.getElementById("especie");
        var qtde = document.getElementById("qtde");

        return array = [especie, qtde];
    }

    function btn_save() {
        var resposta = confirm("Deseja excluir o registro?");

        if (resposta === true) {
            var data = get();
            window.location.href = "?pagina=1&&data=" + data;

        }

    }
**/
</script>
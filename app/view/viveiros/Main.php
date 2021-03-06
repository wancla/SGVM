<?php
#<!--VIEW @Viveiros -->
include DIRREQ . '/src/helpers/data.php';
include DIRREQ . '/src/helpers/paginationViveiros.php';
?>      
<div class="container" id="tableEspecie" style="display:block;">    
    <h1 style='font-weight:bold;'>Viveiros</h1>
    <hr>
    <div class="wrapper">
        <div class="form-group form-inline">
            <form method="post" action="<?= DIRPAGE . '/viveiros?pagina=1' ?>">
                <button class="btn btn-sm btn-primary" type="submit" id="btn_consulta" name="btn_consultar"><span class='glyphicon glyphicon-search'></span></button>
                <input id="consultar" name='consultar' placeholder='Consultar' type='text' class='form-control'>           
            </form>
        </div>
        <div class="table">    
            <div class="row header green">
                <div class="cell">
                    ID
                </div>
                <div class="cell">
                    Local
                </div>
                <div class="cell">
                    Nome
                </div>
                <div class="cell">
                    Data Oc
                </div>
                <div class="cell">
                    Data Man
                </div>
                <div class="cell">
                    Bairro
                </div>
                <div class="cell">
                    Ações
                </div>
            </div>
            <?php
            if ($limite->rowCount() > 0) {
                while ($data = $limite->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="row">
                        <div class="cell" data-title="ID">
                            <?= $data['id'] ?>
                        </div>
                        <div class="cell" data-title="Local">
                            <?= $data['local'] ?>
                        </div>
                        <div class="cell" data-title="Nome">
                            <?= $data['nome'] ?>
                        </div>
                        <div class="cell" data-title="Data Oc">
                            <?= $data['dt'] ?>
                        </div>
                        <div class="cell" data-title="Data Man">
                            <?= $data['manutencao'] ?>
                        </div>
                        <div class="cell" data-title="Endereco">
                            <?= $data['bairro'] ?>
                        </div>
                        <div class="cell" data-title="Ações">
                            <button class='btn btn-sm btn-warning' type='button'>Editar <span class='glyphicon glyphicon-pencil'></span></button>
                            <button class='btn btn-sm btn-danger' type='button' id='excluir' onclick='btn_excluir(<?= $data["id"] ?>);'>Excluir <span class='glyphicon glyphicon-trash'></span></button>
                            <button class='btn btn-sm btn-info' type='button' data-toggle='modal' data-target='#info<?= $data["id"] ?>'> <span class='glyphicon glyphicon-info-sign'></span></button>
                        </div>
                    </div>
                    <!-- JANELA MODAL DE INFORMAÇÕES-->
                    <div class="modal fade" id="info<?= $data["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel"><?= $data["nome"] ?></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">                    
                                        <form action="" method="post" id="formEspecie" class="form-horizontal">
                                 
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="local">Local:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["local"] ?>" name="local" id="local" class="form-control" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="nome">Nome:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["nome"] ?>" name="nome" id="nome" class="form-control" disabled="true">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="data">Data do ocorrido:</label>
                                                <div class="col-sm-3">
                                                    <input type="date" value="<?= $data["dt"] ?>" name="data" id="data" class="form-control" disabled="true">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="manutencao">Data da Manutenção:</label>
                                                <div class="col-sm-3">
                                                    <input type="date" value="<?= $data["manutencao"] ?>" name="manutencao" id="manutencao" class="form-control" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="cep">Cep:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["cep"] ?>" name="cep" id="cep" class="form-control" onblur="" disabled="true">
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="endereco">Endereço:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["endereco"] ?>" name="endereco" id="endereco" class="form-control" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="bairro">Bairro:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["bairro"] ?>" name="bairro" id="bairro" class="form-control" disabled="true">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="cidade">Cidade:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= utf8_decode($data["cidade"]); ?>" name="cidade" id="cidade" class="form-control" disabled="true">
                                                </div>
                                            </div>             
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="uf">UF:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?= $data["uf"] ?>" name="uf" id="uf" class="form-control" disabled="true">
                                                </div>
                                            </div>             

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="descricao">Descrição:</label>
                                                <div class="col-sm-3">
                                                    <textarea  name="descricao"  id="descricao" class="form-control" rows="5" disabled="true"><?= $data["descricao"] ?></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <?php if ($pc > 1) { ?>
                <a href="?pagina=<?= $anterior ?>"><button  class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-backward'></button></a>
            <?php } ?>

            <?php if ($pc < $tp) { ?>
                <a href="?pagina=<?= $proximo ?>"><button class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-forward'></button></a>
                <?php
            } else {
                
            }
            ?>
        </div>
        <a href="<?= DIRPAGE . '/viveiros?pagina=0' ?>" class="btn btn-info btn-lg" name="excel"><span class="glyphicon glyphicon-save"></span></a>
        <button class='btn btn-success btn-lg' type='button' onclick="showForm()" name="novo"><span class="glyphicon glyphicon-plus"></span></button>    
    </div>

</div>

<!--=========================================================================-->
<div class="container">                    
    <form action="<?= DIRPAGE . '/viveiros?pagina=1' ?>" method="post" id="formEspecie" class="form-horizontal" style="display:none;">
        <h1 style='font-weight:bold;'>Viveiros</h1>
        <hr>
        <div class="form-group">
            <label class="control-label col-sm-2" for="local">Local:</label>
            <div class="col-sm-5">
                <input type="text" name="local" id="local" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nome">Nome:</label>
            <div class="col-sm-5">
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="data">Data do ocorrido:</label>
            <div class="col-sm-5">
                <input type="date" name="data" id="data" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="manutencao">Data da Manutenção:</label>
            <div class="col-sm-5">
                <input type="date" name="manutencao" id="manutencao" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cep">Cep:</label>
            <div class="col-sm-5">
                <input type="text" name="cep" id="cep" class="form-control" onblur="pesquisacep(this.value);" required>
            </div>
        </div> 

        <div class="form-group">
            <label class="control-label col-sm-2" for="endereco">Endereço:</label>
            <div class="col-sm-5">
                <input type="text" name="endereco" id="endereco" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="bairro">Bairro:</label>
            <div class="col-sm-5">
                <input type="text" name="bairro" id="bairro" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="cidade">Cidade:</label>
            <div class="col-sm-5">
                <input type="text" name="cidade" id="cidade" class="form-control">
            </div>
        </div>             
        <div class="form-group">
            <label class="control-label col-sm-2" for="uf">UF:</label>
            <div class="col-sm-5">
                <input type="text" name="uf" id="uf" class="form-control">
            </div>
        </div>             

        <div class="form-group">
            <label class="control-label col-sm-2" for="descricao">Descrição:</label>
            <div class="col-sm-5">
                <textarea  name="descricao" id="descricao" class="form-control" rows="5"></textarea>
            </div>
        </div>

        <div class="form-group form-inline">
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-3">
                <input type="submit" name="btn_enviar" id="btn_enviar" value="Enviar" class="btn btn-success" >
                <input type="submit" name="btn_voltar" id="btn_voltar" value="Voltar" class="btn btn-primary" onclick="reload();">
            </div>
        </div>
    </form>
</div>

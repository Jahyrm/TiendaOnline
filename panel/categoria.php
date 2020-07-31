<div class="col-12 pb-3">

    <div style="display: flex;flex-direction: column; margin: auto auto;">
        <h2 style="display: block;">Administrar Categorías</h2><hr/>
    </div>

    <div id="accordionCuatro">
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseTen">
                    Crear
                </a>
            </div>
            <div id="collapseTen" class="collapse" data-parent="#accordionCuatro">
                <div class="card-body">
                    <form action="logic/category/create.php" method="POST">
                    <div class="form-group row">
                        <div class="col">
                            <label for="cname">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nombre de la nueva categoria" name="cname" id="cname">
                        </div>
                        <div class="col">
                            <label for="btnCCategoria">Crear</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Crear" id="btnCCategoria" name="btnCCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>










        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseEleven">
                    Editar
                </a>
            </div>
            <div id="collapseEleven" class="collapse" data-parent="#accordionCuatro">
                <div class="card-body">
                    <form action="logic/category/update.php" method="POST">
                    <div class="form-group row">
                    <div class="col">
                            <label for="catided">Categoría</label>
                            <select class="form-control" id="catided" name="catided">
<?php $categorias = json_decode( file_get_contents($env.'api/category/read.php'), true );
foreach ($categorias["records"] as $categoria) { ?>
                                                    <option value="<?php echo $categoria["id"]; ?>"><?php echo $categoria["name"] ?></option>
<?php } ?>
                                                </select>
                            </select>
                        </div>
                        <div class="col">
                            <label for="cnameed">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nuevo nombre de la categoría" name="cnameed" id="cnameed">
                        </div>
                        <div class="col">
                            <label for="btnEdCategoria">Editar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Editar" id="btnEdCategoria" name="btnEdCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>









        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseTwelve">
                    Eliminar
                </a>
            </div>
            <div id="collapseTwelve" class="collapse" data-parent="#accordionCuatro">
                <div class="card-body">
                    <form action="logic/category/delete.php" method="POST">
                    <div class="form-group row">
                        <div class="col">
                            <label for="catidel">Categoría</label>
                            <select class="form-control" id="catidel" name="catidel">
<?php
foreach ($categorias["records"] as $categoria) { ?>
                                                    <option value="<?php echo $categoria["id"]; ?>"><?php echo $categoria["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="btnElCategoria">Eliminar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Eliminar" id="btnElCategoria" name="btnElCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
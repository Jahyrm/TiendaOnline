<div class="col-12 pb-3">

    <div style="display: flex;flex-direction: column; margin: auto auto;">
        <h2 style="display: block;">Administrar Subcategorías</h2><hr/>
    </div>

    <div id="accordionCinco">
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseTrece">
                    Crear
                </a>
            </div>
            <div id="collapseTrece" class="collapse" data-parent="#accordionCinco">
                <div class="card-body">
                    <form action="logic/subcategory/create.php" method="POST">
                    <div class="form-group row">
                        <div class="col">
                            <label for="catidsub">Categoría</label>
                            <select class="form-control" id="catidsub" name="catidsub">
<?php
foreach ($categorias["records"] as $categoria) { ?>
                                                    <option value="<?php echo $categoria["id"]; ?>"><?php echo $categoria["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="scname">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nombre de la nueva subcategoria" name="scname" id="scname">
                        </div>
                        <div class="col">
                            <label for="btnCSCategoria">Crear</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Crear" id="btnCSCategoria" name="btnCSCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>










        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseCatorce">
                    Editar
                </a>
            </div>
            <div id="collapseCatorce" class="collapse" data-parent="#accordionCinco">
                <div class="card-body">
                    <form action="logic/subcategory/update.php" method="POST">
                    <div class="form-group row">
                    <div class="col">
                            <label for="scatided">Subcategoría</label>
                            <select class="form-control" id="scatided" name="scatided">
<?php
foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                    <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="scnewcatid">Nueva Categoria</label>
                            <select class="form-control" id="scnewcatid" name="scnewcatid">
<?php
foreach ($categorias["records"] as $categoria) { ?>
                                                    <option value="<?php echo $categoria["id"]; ?>"><?php echo $categoria["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="scnameed">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nuevo nombre de la subcategoría" name="scnameed" id="scnameed">
                        </div>
                        <div class="col">
                            <label for="btnEdSCategoria">Editar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Editar" id="btnEdSCategoria" name="btnEdSCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>









        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseQuince">
                    Eliminar
                </a>
            </div>
            <div id="collapseQuince" class="collapse" data-parent="#accordionCinco">
                <div class="card-body">
                    <form action="logic/subcategory/delete.php" method="POST">
                    <div class="form-group row">
                    <div class="col">
                            <label for="scatidel">Subcategoría</label>
                            <select class="form-control" id="scatidel" name="scatidel">
<?php
foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                    <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="btnElSCategoria">Eliminar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Eliminar" id="btnElSCategoria" name="btnElSCategoria">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 pb-3">

    <div style="display: flex;flex-direction: column; margin: auto auto;">
        <h2 style="display: block;">Administrar Marcas</h2><hr/>
    </div>

    <div id="accordionTres">
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseSeven">
                    Crear
                </a>
            </div>
            <div id="collapseSeven" class="collapse" data-parent="#accordionTres">
                <div class="card-body">
                    <form action="logic/marca/create.php" method="POST">
                    <div class="form-group row">
                        <div class="col">
                            <label for="mname">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nombre de la nueva marca" name="mname" id="mname">
                        </div>
                        <div class="col">
                            <label for="btnCMarca">Crear</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Crear" id="btnCMarca" name="btnCMarca">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>










        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseEight">
                    Editar
                </a>
            </div>
            <div id="collapseEight" class="collapse" data-parent="#accordionTres">
                <div class="card-body">
                    <form action="logic/marca/update.php" method="POST">
                    <div class="form-group row">
                    <div class="col">
                            <label for="marided">Marca</label>
                            <select class="form-control" id="marided" name="marided">
<?php
foreach ($marcas["records"] as $marca) { ?>
                                <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="mnameed">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nuevo nombre de la marca" name="mnameed" id="mnameed">
                        </div>
                        <div class="col">
                            <label for="btnEdMarca">Editar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Editar" id="btnEdMarca" name="btnEdMarca">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>









        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseNine">
                    Eliminar
                </a>
            </div>
            <div id="collapseNine" class="collapse" data-parent="#accordionTres">
                <div class="card-body">
                    <form action="logic/marca/delete.php" method="POST">
                    <div class="form-group row">
                    <div class="col">
                            <label for="maridel">Marca</label>
                            <select class="form-control" id="maridel" name="maridel">
<?php
foreach ($marcas["records"] as $marca) { ?>
                                <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
<?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="btnElMarca">Eliminar</label>
                            <input type="submit" class="btn btn-dark btn-block " value="Eliminar" id="btnElMarca" name="btnElMarca">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
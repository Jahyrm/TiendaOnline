            <div class="col-12 pb-3">


                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h2 style="display: block;">Administrar Productos</h2><hr/>
                </div>


                <div id="accordionDos">

                    <div class="card">


                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseFour">
                                Crear
                            </a>
                        </div>


                        <div id="collapseFour" class="collapse" data-parent="#accordionDos">
                            <div class="card-body">
                                <form action="logic/product/create.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-md-6">
                                            <label for="marcaid">Marca</label>
                                                <select class="form-control" id="marcaid" name="marcaid">
<?php
foreach ($marcas["records"] as $marca) { ?>
                                                    <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
<?php } ?>
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="subcatid">Subcategoría</label>
                                            <select class="form-control" id="subcatid" name="subcatid">
<?php $subcategorias = json_decode( file_get_contents($env.'api/subcategory/read.php'), true );
foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                    <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
<?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="nombrep">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingresa el nombre del producto" name="nombrep" id="nombrep">
                                        </div>
                                        <div class="col-12 col-md-6" lang="en-US">
                                            <label for="precio">Precio</label>
                                            <input class="form-control" type="number" name="precio" id="precio" step="0.01" min="0" placeholder="0,00"/>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="stock">Stock</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input class="form-control" type="number" step="1" min="0" id="stock" name="stock">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="descripcion">Descripción</label>
                                            <div class="input-group">
                                                <div class="custom-file" style="display: block;">
                                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="imagep">Foto del producto</label>
                                            <div class="input-group">
                                                <div class="custom-file" id="customFile" lang="es">
                                                    <input type="file" class="custom-file-input" id="imagep" name="imagep" accept=".jpg,.png,.jpeg,.gif" aria-describedby="fileHelp">
                                                    <label id="img1" class="custom-file-label" for="imagep">Escoger Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <input type="submit" class="btn btn-dark btn-block " value="Crear">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
























                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseFive">
                                Editar
                            </a>
                        </div>


                        <div id="collapseFive" class="collapse" data-parent="#accordionDos">
                            <div class="card-body">
                                <div class="container">
                                    <form>
                                    <div class="row">
                                        <div class="col">
                                            <label for="marid">Marca</label>
                                            <select class="form-control" id="marid" name="marid">
    <?php
    foreach ($marcas["records"] as $marca) { ?>
                                                <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="subid">SubCategoría</label>
                                            <select class="form-control" id="subid" name="subid">
    <?php
    foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="buttonF">Filtrar</label>
                                            <button type="button" class="btn btn-dark btn-block" id="buttonF" name="buttonF">Filtrar</button>
                                        </div>
                                    </div>
                                    </form>











                                    <div class="row">
                                        <div class="col">
                                            <hr/>
                                        </div>
                                    </div>









                                    <form>
                                    <div class="row">
                                        <div class="col-9">
                                            <label for="prodid">Producto</label>
                                            <select class="form-control" id="prodid" name="prodid">
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="buttonB">Buscar</label>
                                            <button type="button" class="btn btn-dark btn-block" id="buttonB" disabled>Rellenar</button>
                                        </div>
                                    </div>
                                    </form>




                                    <div class="row">
                                        <div class="col">
                                            <hr/>
                                        </div>
                                    </div>

                                    





                                    <div id="editprodoculto" style="display: none;">

                                    <div class="row">
                                        <div class="col">
                                            <h5>Imagen Acutual</h5>
                                            <img id="imageprod" src="" style="width: 250px; height: 250px;"/>
                                        </div>
                                    </div>

                                    <form action="logic/product/update.php" method="POST" enctype="multipart/form-data">
                                    <input id="pid" name="pid" type="hidden" value="0">
                                    <input id="oldimage" name="oldimage" type="hidden" value="cero">
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="emarcaid">Marca</label>
                                                <select class="form-control" id="emarcaid" name="emarcaid">
<?php
foreach ($marcas["records"] as $marca) { ?>
                                                    <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
<?php } ?>
                                                </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="esubcatid">Subcategoría</label>
                                            <select class="form-control" id="esubcatid" name="esubcatid">
<?php
foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                    <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
<?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="enombrep">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Ingresa el nombre del producto" name="enombrep" id="enombrep">
                                        </div>
                                        <div class="col-12 col-md-6" lang="en-US">
                                            <label for="eprecio">Precio</label>
                                            <input class="form-control" type="number" name="eprecio" id="eprecio" step="0.01" min="0" placeholder="0,00"/>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="estock">Stock</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input class="form-control" type="number" step="1" min="0" id="estock" name="estock">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="edescripcion">Descripción</label>
                                            <div class="input-group">
                                                <div class="custom-file" style="display: block;">
                                                    <textarea class="form-control" id="edescripcion" name="edescripcion" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="eimagep">Foto del producto</label>
                                            <div class="input-group">
                                                <div class="custom-file" id="customFile" lang="es">
                                                    <input type="file" class="custom-file-input" id="eimagep" name="eimagep" accept=".jpg,.png,.jpeg,.gif" aria-describedby="fileHelp">
                                                    <label id="img2" class="custom-file-label" for="imagep">Escoger Archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <input type="submit" disabled class="btn btn-dark btn-block " value="Editar" id="editprod" name="editprod">
                                    </div>
                                    </form>
                                    </div>











                                </div>
                            </div>
                        </div>
                    </div>




































                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseSix">
                                Eliminar
                            </a>
                        </div>


                        <div id="collapseSix" class="collapse" data-parent="#accordionDos">
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <label for="emarid">Marca</label>
                                            <select class="form-control" id="emarid" name="emarid">
    <?php
    foreach ($marcas["records"] as $marca) { ?>
                                                <option value="<?php echo $marca["id"]; ?>"><?php echo $marca["name"] ?></option>
    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="esubid">SubCategoría</label>
                                            <select class="form-control" id="esubid" name="esubid">
    <?php
    foreach ($subcategorias["records"] as $subcategoria) { ?>
                                                <option value="<?php echo $subcategoria["id"]; ?>"><?php echo $subcategoria["name"] ?></option>
    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="ebuttonF">Filtrar</label>
                                            <button type="button" class="btn btn-dark btn-block" id="ebuttonF" name="ebuttonF">Filtrar</button>
                                        </div>
                                    </div>
                                    </form>







                                    <div class="row">
                                        <div class="col">
                                            <hr/>
                                        </div>
                                    </div>









                                    <form action="logic/product/delete.php" method="POST">
                                    <div class="row">
                                        <div class="col-9">
                                            <label for="eprodid">Producto</label>
                                            <select class="form-control" id="eprodid" name="eprodid">
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="btnEliminarProducto">Eliminar</label>
                                            <button type="submit" class="btn btn-dark btn-block" id="btnEliminarProducto" disabled>Eliminar</button>
                                        </div>
                                    </div>
                                    </form>


                            </div>
                        </div>
                </div>  
            </div>
            

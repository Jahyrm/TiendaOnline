$("#buttonF").click(function(e) {
    e.preventDefault();

    $("#editprodoculto").hide();
    $("#editprod").prop( "disabled", true);
    var marcaId = $( "#marid" ).val();
    //var catId = $( "#catid" ).val();
    var subcatid = $( "#subid" ).val();

    //var string = "api/product/filter.php?catid="+catId+"&marcaid="+marcaId+"&subcatid="+subcatid;
    var string = "api/product/filter.php?marcaid="+marcaId+"&subcatid="+subcatid;

    $.ajax({
        dataType: "json",
        url: string,
        success: function(json) {
            // Do stuff with data

            var len = json.records.length;
            if(len!=null) {
                $("#prodid").prop( "disabled", false);
                $("#buttonB").prop( "disabled", false);
                $("#prodid").empty();
                for( var i = 0; i<len; i++){
                    var id = json.records[i].id;
                    var name = json.records[i].name;
                    
                    $("#prodid").append("<option value='"+id+"'>"+name+"</option>");
    
                }
            }

        },
        error: function(e) {
            $("#prodid").empty();
            $("#prodid").append("<option value=\"0\">No hay productos</option>");
            $("#prodid").prop( "disabled", true);
            $("#buttonB").prop( "disabled", true);
        }
    });
});


$("#buttonB").click(function(e) {
    e.preventDefault();

    $("#editprodoculto").show();
    $("#prodid").prop( "disabled", true)
    $("#buttonB").prop( "disabled", true);
    $("#editprod").prop( "disabled", false);

    var prodId = $( "#prodid" ).val();

    var string = "api/product/read_one.php?id="+prodId;

    if(prodId!=0) {
        $.ajax({
            dataType: "json",
            url: string,
            success: function(json) {
                // Do stuff with data
                var id_marca = json.id_marca;
                var id_cat = json.id_subcategoria;
                var nombre = json.name;
                var precio = json.price;
                var stock = json.stock;
                var descripcion = json.description;
                var imagen = json.image;

                $( "#pid" ).val(prodId);
                if(imagen!=null && imagen!="") {
                    $( "#oldimage" ).val(imagen);
                }
                $("#emarcaid").val(id_marca);
                $("#esubcatid").val(id_cat);
                $("#enombrep").val(nombre);
                $("#eprecio").val(precio);
                $("#estock").val(stock);
                $("#edescripcion").val(descripcion);
                if(imagen!=null && imagen!="") {
                    $("#imageprod").attr("src", imagen);
                } else {
                    $("#imageprod").attr("src","img/products/image.jpg");
                }
                
            },
            error: function(e) {

            }
        });
    }
});



$("#ebuttonF").click(function(e) {
    e.preventDefault();

    var marcaId = $( "#emarid" ).val();
    //var catId = $( "#catid" ).val();
    var subcatid = $( "#esubid" ).val();

    //var string = "api/product/filter.php?catid="+catId+"&marcaid="+marcaId+"&subcatid="+subcatid;
    var string = "api/product/filter.php?marcaid="+marcaId+"&subcatid="+subcatid;

    $.ajax({
        dataType: "json",
        url: string,
        success: function(json) {
            // Do stuff with data

            var len = json.records.length;
            if(len!=null) {
                $("#eprodid").prop( "disabled", false);
                $("#btnEliminarProducto").prop( "disabled", false);
                $("#eprodid").empty();
                for( var i = 0; i<len; i++){
                    var id = json.records[i].id;
                    var name = json.records[i].name;
                    
                    $("#eprodid").append("<option value='"+id+"'>"+name+"</option>");
    
                }
            }

        },
        error: function(e) {
            $("#eprodid").empty();
            $("#eprodid").append("<option value=\"0\">No hay productos</option>");
            $("#eprodid").prop( "disabled", true);
            $("#bbtnEliminarProducto").prop( "disabled", true);
        }
    });
});
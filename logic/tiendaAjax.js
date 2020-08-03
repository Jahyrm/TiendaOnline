$('#sbid').on('change', function() {

    if(this.value!=0) {
        var catId = $( "#catId" ).val();
        var string = "../api/product/filter.php?catid="+catId+"&subcatid="+this.value;
        $.ajax({
            dataType: "json",
            url: string,
            success: function(json) {

                var contador = 0;
                var html = '';
                var len = json.records.length;
                if(len!=null) {
                    $("#productsLoader").empty();
                    for( var i = 0; i<len; i++){
                        if (contador==0) {
                            html += '<div class="row">';
                            //$("#productsLoader").append('<div class="row">');
                        }
                        html += '<div class="col-4 mb-4">';
                        html += '<div class="card">';
                        html += '<img class="card-img-top" src="'+json.records[i].image+'" alt="" style="height: 250px;">';
                        html += '<div class="card-body">';
                        html += '<h5 class="card-title">'+json.records[i].name+'</h5>';
                        html += '<p class="card-text"><b>Precio:</b> '+json.records[i].price+'</p>';
                        html += '<p class="card-text">'+json.records[i].description+'</p>';

                        html += '<a href="../logic/cart/add.php?id='+json.records[i].id+'"><button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button></a>';
                        html += '<a href="../producto/?id='+json.records[i].id+'"><button class="btn btn-dark" style="width: 100%;">Detalles del producto</button></a>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';

                        contador = contador + 1;
                        if(contador==3 || i==(len-1)) {
                            html += '</div>';
                            contador = 0;
                        }
                    }
                    $("#productsLoader").append(html);
                }


    
            },
            error: function(e) {
                $("#productsLoader").html('<div class="row"><div class="col">No se encontraron productos.</div></div>');
            }
        });
    }
});
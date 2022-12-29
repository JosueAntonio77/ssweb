let tableCompras;
var divLoading = document.querySelector("#divLoading");
tableCompras = $('#tableCompras').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Compras/getCompras",
        "dataSrc":""
    },
    "columns":[
        {"data":"folio"},
        {"data":"monto"},
        {"data":"nombre"},
        {"data":"productoid"},
        {"data":"tipopago"},
        {"data":"unidades"},
        {"data":"datecreated"},
        {"data":"options"}
    ],
    "columnDefs": [
                { 'className': "textright", "targets": [ 3 ] },
                { 'className': "textcenter", "targets": [ 6 ] }
              ],  
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
            }
        },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Esportar a Excel",
            "className": "btn btn-success",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Esportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
            }
        },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Esportar a CSV",
            "className": "btn btn-info",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] 
            }
        }
    ],
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});

/*function fntProductoVenta(){
    if(document.querySelector('#listProductoid')){
        var ajaxUrl = base_url+'/Ventas/getSelectProducto';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listProductoid').innerHTML = request.responseText;
                $('#listGrupoid').selectpicker('render');
            }
        }
    }
}
function fntClienteVenta(){
    if(document.querySelector('#listProductoid')){
        var ajaxUrl = base_url+'/Ventas/getSelectProducto';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listProductoid').innerHTML = request.responseText;
                $('#listGrupoid').selectpicker('render');
            }
        }
    }
}*/
function fntTipoPago(){
    if(document.querySelector('#listTipoPagoid')){
        var ajaxUrl = base_url+'/Compras/getSelectTipoPago';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listProductoid').innerHTML = request.responseText;
                $('#listGrupoid').selectpicker('render');
            }
        }
    }
}
// FUNCION PARA EL OJITO DE LA TABLA
function fntViewCompra(idcompra){
   
    var idcompra = idcompra;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Compras/getCompras/'+idcompra;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               var estadoCompras = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
                
                document.querySelector("#celFolio").innerHTML = objData.data.folio;
                document.querySelector("#celMonto").innerHTML = objData.data.monto;
                document.querySelector("#celProducto").innerHTML = objData.data.producto;
                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celApellidos").innerHTML = objData.data.apellidos;
                document.querySelector("#celTipoPago").innerHTML = objData.data.tipopago;
                document.querySelector("#celFecha").innerHTML = objData.data.fecha;
                document.querySelector("#celEstado").innerHTML = estadoVentas;
                $('#modalViewVenta').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

/*function fntEditInfo(idventa){
    let request = (window.XMLHttpRequest) ?
                    new XMLHttpRequest():
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Ventas/getVenta/'+idventa;
  //  divLoading.style.display = "flex";
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#divModal").innerHTML = objData.html;
                $('#modalFormVenta').modal('show');
                $('select').selectpicker();
            }else{
                swal("Error",objData.msg, "error");
        }
      //  divLoading.style.display = "none";
        return false;  
        }       
    }
}*/

function fntDelInfo(idcompra){
    swal({
        title: "Eliminar Compra",
        text: "¿Realmente quiere eliminar la compra?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Compras/delCompra';
            let strData = "idCompra="+idcompra;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableCompras.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}
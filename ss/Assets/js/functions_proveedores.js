var tableProveedores;
document.addEventListener('DOMContentLoaded', function(){

    tableProveedores = $('#tableProveedores').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proveedores/getProveedores",
            "dataSrc":""
        },
        "columns":[
            {"data":"idproveedor"},
            {"data":"nombre"},
            {"data":"email"},
            {"data":"telefono"},
            {"data":"direccion"},
            {"data":"status"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    var formProveedor = document.querySelector("#formProveedor");
    formProveedor.onsubmit = function(e){
        e.preventDefault();
        var strNombre = document.querySelector('#txtNombre').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var strDireccion = document.querySelector('#txtDireccion').value;

        if(strNombre == '' || strEmail == '' || intTelefono == '' || strDireccion == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Proveedores/setProveedor'; 
        var formData = new FormData(formProveedor);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormProveedor').modal("hide");
                        formProveedor.reset();
                        swal("Usuarios", objData.msg ,"success");
                        tableProveedores.api().ajax.reload();
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
        }

    }
}, false);

function openModal()
{
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Proveedor";
    document.querySelector("#formProveedor").reset();
    $('#modalFormProveedor').modal('show');
}
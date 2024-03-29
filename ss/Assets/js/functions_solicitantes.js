let tableSolicitantes; 
//let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableSolicitantes = $('#tableSolicitantes').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Solicitantes/getSolicitantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

	if(document.querySelector("#formSolicitante")){
        let formSolicitante = document.querySelector("#formSolicitante");
        formSolicitante.onsubmit = function(e) {
            e.preventDefault();

            let strIdentificacion   = document.querySelector('#txtIdentificacion').value;
            let strNombre           = document.querySelector('#txtNombre').value;
            let strApellido         = document.querySelector('#txtApellido').value;
            var intDireccion        = document.querySelector('#listDireccionid').value;
            let strEmail            = document.querySelector('#txtEmail').value;
            let intTelefono         = document.querySelector('#txtTelefono').value;
            let strCargo            = document.querySelector('#txtCargo').value;
            let strArea             = document.querySelector('#txtArea').value;
            let strPassword         = document.querySelector('#txtPassword').value;

            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || intDireccion == '' || strEmail == '' || intTelefono == '' || strArea == '' || strCargo=='')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Solicitantes/setSolicitante'; 
            let formData = new FormData(formSolicitante);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormSolicitante').modal("hide");
                        formSolicitante.reset();
                        swal("Solicitantes", objData.msg ,"success");
                        tableSolicitantes.api().ajax.reload();
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

window.addEventListener('load', function() {
    ftnDirecciones();    
}, false);

function ftnDirecciones() {
    if(document.querySelector('#listDireccionid')){
        let ajaxUrl = base_url+'/Usuarios/getSelectDirecciones';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listDireccionid').innerHTML = request.responseText;
                $('#listDireccionid').selectpicker('render');
            }
        }
    }
}

function fntViewInfo(idpersona){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Solicitantes/getSolicitante/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#celIdentificacion").innerHTML  = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML          = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML        = objData.data.apellidos;
                document.querySelector("#celDireccion").innerHTML       = objData.data.direccion;
                document.querySelector("#celTelefono").innerHTML        = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML           = objData.data.email_user;
                document.querySelector("#celCargo").innerHTML           = objData.data.cargo;
                document.querySelector("#celArea").innerHTML            = objData.data.area;
                document.querySelector("#celFechaRegistro").innerHTML   = objData.data.fechaRegistro; 
                $('#modalViewSolicitante').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

// Actualizar datos del solicitante.
function fntEditInfo(idpersona){
    //rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar datos del Solicitante";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Solicitantes/getSolicitante/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idUsuario").value          = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value  = objData.data.identificacion;
                document.querySelector("#txtNombre").value          = objData.data.nombres;
                document.querySelector("#txtApellido").value        = objData.data.apellidos;
                document.querySelector("#txtTelefono").value        = objData.data.telefono;
                document.querySelector("#txtEmail").value           = objData.data.email_user;
                document.querySelector("#listDireccionid").value    = objData.data.iddireccion;
                document.querySelector("#txtCargo").value           = objData.data.cargo;
                document.querySelector("#txtArea").value            = objData.data.area;

                $('#listDireccionid').selectpicker('render');
            }
        }
        $('#modalFormSolicitante').modal('show');
    }
}

function fntDelInfo(idpersona){
    swal({
        title: "Eliminar Solicitante",
        text: "¿Realmente quiere eliminar al solicitante?",
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
            let ajaxUrl = base_url+'/Solicitantes/delSolicitante';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableSolicitantes.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal()
{
    //rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Solicitante";
    document.querySelector("#formSolicitante").reset();
    $('#modalFormSolicitante').modal('show');
}
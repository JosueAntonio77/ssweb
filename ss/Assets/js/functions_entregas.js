let tableEntregas;


tableEntregas = $('#tableEntregas').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Entregas/getEntregas",
        "dataSrc":""
    },
    "columns":[
        {"data":"idmantenimiento"},
        {"data":"persona"},
        {"data":"equipo"},
        {"data":"direcciones"},
        {"data":"diagnostico"},
        {"data":"personatecnico"},
        {"data":"datefinish"},
        {"data":"status"},
        {"data":"options"}
    ],
    "columnDefs": [
                { 'className': "textright", "targets": [ 3 ] },
                { 'className': "textcenter", "targets": [ 7 ] }
              ],  
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6] 
            }
        },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-success",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6] 
            }
        },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar a CSV",
            "className": "btn btn-info",
            "exportOptions": { 
            "columns": [ 0, 1, 2, 3, 4, 5, 6] 
            }
        }
    ],
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});

    if(document.querySelector("#formEntregas")){
        let formEntregas = document.querySelector("#formEntregas");
        formEntregas.onsubmit = function(e) {
            e.preventDefault();

            let strNombre       = document.querySelector('#txtNombre').value;
            let strDescripcion  = document.querySelector('#txtDescripcion').value;
            let intCategoriaid  = document.querySelector('#listCategoria').value;
            let intPersonaid    = document.querySelector('#listPersona').value;
            let strEquipo       = document.querySelector('#txtEquipo').value;
            let intStatus       = document.querySelector('#listStatus').value;

            if(strNombre == '' || strEquipo == '' )
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
            tinyMCE.triggerSave();
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Entregas/setRecepcion'; 
            let formData = new FormData(formEntregas);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormEntregas').modal("hide");
                        formEntregas.reset();
                        swal("Entregas", objData.msg ,"success");
                        tableEntregas.api().ajax.reload();
                        
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }


function fntDelInfo(idMantenimiento){
    swal({
        title: "Eliminar Entrega",
        text: "¿Realmente quiere eliminar la entrega?",
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
            let ajaxUrl = base_url+'/Entregas/delMantenimiento';
            let strData = "idMantenimiento="+idMantenimiento;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableEntregas.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

tinymce.init({
    selector: '#txtDescripcion', 
    width: "100%",
    height: 250,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});
function openModal()
{
    //rowTable = "";
    document.querySelector('#idMantenimiento').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Entrega";
    document.querySelector("#formEntregas").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormEntregas').modal('show');
}

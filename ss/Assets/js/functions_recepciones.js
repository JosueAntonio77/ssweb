let tableRecepciones;
let rowTable;
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

window.addEventListener('load', function(e){
     
    tableRecepciones = $('#tableRecepciones').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Recepciones/getRecepciones",
            "dataSrc":""
        },
        "columns":[
            {"data":"idmantenimiento"},
            {"data":"nombre"},
            {"data":"persona"},
            {"data":"direcciones"},
            {"data":"categoria"},
            {"data":"descripcion"},
            {"data":"equipo"},
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
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success",
                "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5, 6] 
                }
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger",
                "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5, 6] 
                }
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
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

    if(document.querySelector("#formRecepciones")){
        let formRecepciones = document.querySelector("#formRecepciones");
        formRecepciones.onsubmit = function(e) {
            e.preventDefault();

            let strNombre       = document.querySelector('#txtNombre').value;
            let strDescripcion  = document.querySelector('#txtDescripcion').value;
            let strDiagnostico  = document.querySelector('#txtDiagnostico').value;
            let intCategoriaid  = document.querySelector('#listCategoria').value;
            let intPersonaid    = document.querySelector('#listPersona').value;
            let strEquipo       = document.querySelector('#txtEquipo').value;
            let intStatus       = document.querySelector('#listStatus').value;

            if(strNombre == '' || intCategoriaid == '' || intPersonaid == '' )
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            
            divLoading.style.display = "flex";
            tinyMCE.triggerSave();
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Recepciones/setMantenimiento'; 
            let formData = new FormData(formRecepciones);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg ,"success");
                        document.querySelector("#idMantenimiento").value = objData.idmantenimiento;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        //tableRecepciones.api().ajax.reload();
                        if(rowTable == ""){
                            tableRecepciones.api().ajax.reload();
                        }else{
                           htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-danger">Pendiente</span>' :
                            '<span class="badge badge-success">Entregado</span>';
                            
                            rowTable.cells[1].textContent = strNombre;
                            rowTable.cells[2].textContent = intPersonaid;
                            rowTable.cells[3].textContent = strDireccion;
                            rowTable.cells[4].textContent = intCategoriaid;
                            rowTable.cells[5].textContent = strDescripcion;
                            rowTable.cells[6].textContent = strEquipo;
                            rowTable.cells[7].innerHTML =  htmlStatus;
                            rowTable = ""; 
                        }
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    if(document.querySelector(".btnAddImage")){
        let btnAddImage = document.querySelector(".btnAddImage");
        btnAddImage.onclick = function(e){
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id= "div"+key;
            newElement.innerHTML = `
                <div class="prevImage"></div>
                <input type="file" name="foto" id="img${key}" class="inputUploadfile">
                <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div"+key+" .btnUploadfile").click();
        fntInputFile();
        }
    }

    ftnCategorias();
    ftnPersonas();
}, false);

function ftnCategorias() {
    if(document.querySelector('#listCategoria')){
        let ajaxUrl = base_url+'/Categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria').selectpicker('render');
            }
        }
    }
}

function ftnPersonas() {
    if(document.querySelector('#listPersona')){
        let ajaxUrl = base_url+'/Recepciones/getSelectPersonas';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listPersona').innerHTML = request.responseText;
                $('#listPersona').selectpicker('render');
            }
        }
    }
}

function fntViewInfo(idMantenimiento){

    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Recepciones/getMantenimiento/'+idMantenimiento;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objMantenimiento = objData.data;
                let estadoMantenimiento = objMantenimiento.status == 1 ?
                '<span class="badge badge-danger">Pendiente</span>'  :
                '<span class="badge badge-success">Entregado</span>';

                document.querySelector("#celNombre").innerHTML      = objMantenimiento.nombre;
                document.querySelector("#celPersona").innerHTML     = objMantenimiento.persona;
                document.querySelector("#celDirecciones").innerHTML = objMantenimiento.direcciones;
                document.querySelector("#celCategoria").innerHTML   = objMantenimiento.categoria;
                document.querySelector("#celEquipo").innerHTML      = objMantenimiento.equipo;
                document.querySelector("#celStatus").innerHTML      = estadoMantenimiento;
                document.querySelector("#celDescripcion").innerHTML = objMantenimiento.descripcion;
                document.querySelector("#celDiagnostico").innerHTML = objMantenimiento.diagnostico;

                if(objMantenimiento.images.length > 0){
                    let objMantenimientos = objMantenimiento.images;
                    for (let p = 0; p < objMantenimientos.length; p++) {
                        htmlImage +=`<img src="${objMantenimientos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewMantenimiento').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditInfo(element,idMantenimiento){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Recepción";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Recepciones/getMantenimiento/'+idMantenimiento;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objMantenimiento = objData.data;

                document.querySelector("#idMantenimiento").value    = objMantenimiento.idMantenimiento;
                document.querySelector("#txtNombre").value          = objMantenimiento.nombre;
                document.querySelector("#txtDescripcion").value     = objMantenimiento.descripcion;
                document.querySelector("#txtDiagnostico").value     = objMantenimiento.diagnostico;
                document.querySelector("#listCategoria").value      = objMantenimiento.categoria;
                document.querySelector("#listPersona").value        = objMantenimiento.persona;
                document.querySelector("#txtEquipo").value          = objMantenimiento.equipo;
                document.querySelector("#listStatus").value         = objMantenimiento.status;

                tinymce.activeEditor.setContent(objMantenimiento.descripcion);
                tinymce.activeEditor.setContent(objMantenimiento.diagnostico);
                $('#listCategoria').selectpicker('render');
                $('#listPersona').selectpicker('render');

                if(objData.data.status == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');

                if(objMantenimiento.images.length > 0){
                    let objMantenimientos = objMantenimiento.images;
                    for (let p = 0; p < objMantenimientos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objMantenimientos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objMantenimientos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#containerGallery").classList.remove("notblock");
                $('#modalFormRecepciones').modal('show');
                
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
    
}

function fntDelInfo(idMantenimiento){
    swal({
        title: "Eliminar Recepción",
        text: "¿Realmente quiere eliminar la recepción?",
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
            let ajaxUrl = base_url+'/Recepciones/delMantenimiento';
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
                        tableRecepciones.api().ajax.reload();
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

tinymce.init({
    selector: '#txtDiagnostico',
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

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idMantenimiento = document.querySelector("#idMantenimiento").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Recepciones/setImage'; 
                    let formData = new FormData();
                    formData.append('idMantenimiento',idMantenimiento);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}   

function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idMantenimiento = document.querySelector("#idMantenimiento").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Recepciones/delFile'; 

    let formData = new FormData();
    formData.append('idMantenimiento',idMantenimiento);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}

function openModal()
{
    rowTable = "";
    document.querySelector('#idMantenimiento').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Recepción";
    document.querySelector("#formRecepciones").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormRecepciones').modal('show');
}
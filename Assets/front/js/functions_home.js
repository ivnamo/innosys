let tableSolicitudes;
let url;
if (window.location.href.includes('Home') || window.location.href.includes('home')) {
    url = window.location.href; //OJO no accede a la variable global BASE_URL
} else {
    url = window.location.href + 'Home'; //OJO no accede a la variable global BASE_URL
}

document.addEventListener('DOMContentLoaded', function() {
    tableSolicitudes = $('#tableSolicitudes').DataTable({
        "drawCallback": function() {
            fntToggleEvento();
            fntUpdateEstado();
            fntAlertCopy();
        },
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "ajax": {
            "url": "" + url + "/getSolicitudes",
            "dataSrc": ""

        },
        "columns": [
            { "data": "idsolicitud" },
            { "data": "nombreSolicitante" },
            { "data": "fechaSolicitud" },
            { "data": "seccion" },
            { "data": "categoria" },
            { "data": "descripcion" },
            { "data": "prioridad" },
            { "data": "statusNombre" },
            { "data": "options" }
        ],
        "dom": 'lBfrtip',
        "buttons": [{
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary"

        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Exportar a Excel",
            "className": "btn btn-success"
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Exportar a PDF",
            "className": "btn btn-danger"
        }],
        "responsive": true,
        "autoWidth": false,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });

    //Crear Solicitud
    if (document.querySelector("#formSolicitud")) {

        let formSolicitud = document.querySelector("#formSolicitud");

        formSolicitud.onsubmit = function(e) {
            e.preventDefault();
            let srtSeccion = document.querySelector('#listSeccion').value;
            let srtCategoria = document.querySelector('#listCategoria').value;
            let srtObjetivo = document.querySelector('#txtObjetivo').value;
            let srtPrioridad = document.querySelector('#listPrioridad').value;

            if (srtSeccion == '' || srtCategoria == '' || srtObjetivo == '' || srtPrioridad == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }



            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = url + '/setSolicitud'; //OJO no accede a la variable global BASE_URL
            let formData = new FormData(formSolicitud);
            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        $('#modalFormSolicitud').modal("hide");
                        formSolicitud.reset();
                        swal("Solicitud", objData.msg, "success");
                        tableSolicitudes.ajax.reload();

                        srtSeccion == 1;
                        srtCategoria == 1;
                        srtPrioridad == 1;
                        $("#listSeccion").selectpicker("render");
                        $("#listCategoria").selectpicker("render");
                        $("#listPrioridad").selectpicker("render");


                    } else {
                        swal("Error", objData.msg, "error");
                    }

                }

                return false;
            }

        }
    }


    //Actualizar Solicitud
    if (document.querySelector("#formSolicitudEdit")) {

        let formSolicitudEdit = document.querySelector("#formSolicitudEdit");

        formSolicitudEdit.onsubmit = function(e) {
            e.preventDefault();

            let intIdSolicitud = document.querySelector("#idSolicitudEdit").value;
            let intSeccionEdit = document.querySelector("#listSeccionEdit").value;
            let intCategoriaEdit = document.querySelector("#listCategoriaEdit").value;
            let strObjetivoEdit = document.querySelector("#txtObjetivoEdit").value;
            let intPrioridadEdit = document.querySelector("#listPrioridadEdit").value;
            let strSolucionEdit = document.querySelector("#txtSolucionEdit").value;

            if (document.querySelector("#listResponsableEdit")) {
                let intResponsableEdit = document.querySelector("#listResponsableEdit").value;
            }


            if (intIdSolicitud == '' || intSeccionEdit == '' || intCategoriaEdit == '' || strObjetivoEdit == '' || intPrioridadEdit == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = url + '/editSolicitud'; //OJO no accede a la variable global BASE_URL
            let formData = new FormData(formSolicitudEdit);
            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        $('#modalEditSolicitud').modal("hide");
                        formSolicitudEdit.reset();

                        if (strSolucionEdit.length == 0) {
                            swal("Actualización", objData.msg, "success");
                        } else {
                            swal("Solucionado", "Añadiste una solución a la solicitud.", "success");
                        }


                        tableSolicitudes.ajax.reload();



                    } else {
                        swal("Error", objData.msg, "error");
                    }

                }

                return false;
            }

        }
    }






}, false); //fin domcontentloaded



function fntViewSolicitud(idsolicitud) {

    $(".meGustaSol").show();
    $(".noMeGustaSol").show();

    let ajaxUrl = url + '/getSolicitud/' + idsolicitud;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();


    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {


                //VALORACION
                document.querySelector(".meGustaSol").innerHTML = '<span><i class="far fa-thumbs-up"></i></span>';
                document.querySelector(".noMeGustaSol").innerHTML = '<span><i class="far fa-thumbs-down"></i></span>';

                if (objData.data.valuser == 1) {
                    document.querySelector(".noMeGustaSol").classList.remove("valoracionActiva")
                    document.querySelector(".meGustaSol").classList.add("valoracionActiva")
                    document.querySelector(".meGustaSol").innerHTML = objData.data.valuserIcon;
                } else if (objData.data.valuser == 2) {
                    document.querySelector(".meGustaSol").classList.remove("valoracionActiva")
                    document.querySelector(".noMeGustaSol").classList.add("valoracionActiva")
                    document.querySelector(".noMeGustaSol").innerHTML = objData.data.valuserIcon;
                } else {
                    document.querySelector(".noMeGustaSol").classList.remove("valoracionActiva")
                    document.querySelector(".meGustaSol").classList.remove("valoracionActiva")
                }

                let estado = objData.data.status;

                //quitar mano arriba o abajo
                if (estado > 5) {
                    if (objData.data.valuser == 1) {
                        //quitar mano abajo
                        $(".noMeGustaSol").hide();
                    } else {
                        //quitar mano arriba
                        $(".meGustaSol").hide();
                    }

                }



                //RELLENAR FORMULARIO
                document.querySelector("#idSolicitudView").value = objData.data.idsolicitud;
                document.querySelector("#celObjetivo").innerHTML = objData.data.descripcion;
                document.querySelector("#celSolucion").innerHTML = objData.data.solucion;

                if (document.querySelector("#celSolucion").value.length > 0) {
                    document.querySelector(".valorarSol").style.display = "inline";






                } else {
                    document.querySelector(".valorarSol").style.display = "none";
                }

                $('#modalViewSolicitud').modal('show');
                tableSolicitudes.ajax.reload();

            } else {
                swal("Error", objData.msg, "error");
            }

        }
    }
}


function fntEditSolicitud(idsolicitud) {

    idUser = document.querySelector("#idUser").value;

    let ajaxUrl = url + '/getSolicitud/' + idsolicitud;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idSolicitudEdit").value = objData.data.idsolicitud;
                document.querySelector("#listSeccionEdit").value = objData.data.seccion;
                document.querySelector("#listCategoriaEdit").value = objData.data.categoria;
                document.querySelector("#txtObjetivoEdit").value = objData.data.descripcion;
                document.querySelector("#listPrioridadEdit").value = objData.data.prioridad;
                comentarios = document.querySelector("#txtComentariosEdit").innerHTML = objData.data.comentarios;
                comentarios.replace(/\n/g, "<br />");
                document.querySelector("#txtSolucionEdit").value = objData.data.solucion;

                //No actualizar solicitudes resueltas o valoradas
                let estado = objData.data.status;

                if (estado > 4) {
                    $(".btn-solicitudEdit").hide();
                } else {
                    $(".btn-solicitudEdit").show();
                }



                if (document.querySelector('#listResponsableEdit')) {
                    document.querySelector('#listResponsableEdit').value = objData.data.responsableid;
                    if (objData.data.responsableid == "") {
                        document.querySelector('#listResponsableEdit').value = "0";

                    } else if (objData.data.responsableid == idUser) {
                        document.querySelector('#listResponsableEdit').value = "0";

                    } else {
                        document.querySelector("#listResponsableEdit").value = objData.data.responsableid;
                    }
                }

                $("#listSeccionEdit").selectpicker("render");
                $("#listCategoriaEdit").selectpicker("render");
                $("#listPrioridadEdit").selectpicker("render");
                $("#listResponsableEdit").selectpicker("render");

                if (document.querySelector("#txtSolucionEdit")) {

                    if (document.querySelector("#txtSolucionEdit").value.length > 0) {
                        document.querySelector('.textEdit').innerHTML = "Resolver";




                    } else {
                        document.querySelector('.textEdit').innerHTML = "Actualizar";
                    }
                }


                document.querySelector("#txtSolucionEdit").addEventListener("keyup", function() {
                    if (document.querySelector("#txtSolucionEdit").value.length > 0) {

                        document.querySelector('.textEdit').innerHTML = "Resolver";
                        if (document.querySelector('#listResponsableEdit')) {
                            document.querySelector('#listResponsableEdit').value = "0";
                            $("#listResponsableEdit").selectpicker("render");
                            $(".dropdown-toggle").prop("disabled", true);
                        }



                    } else {
                        document.querySelector('.textEdit').innerHTML = "Actualizar";
                        $(".dropdown-toggle").prop("disabled", false);

                    }
                });
                tableSolicitudes.ajax.reload();
                $(".dropdown-toggle").prop("disabled", false);
            }
        }
        $('#modalEditSolicitud').modal('show');


    }

}


window.addEventListener("load", function() {
    fntColUsuario();

}, false);

//Actualizar estilos estado 
function fntUpdateEstado() {
    $(".estadoPendiente").parents('td').css({ "background": "#4c7c03", "color": "#deefba" });
    $(".estadoRevision").parents('td').css({ "background": "#deefba", "color": "#2c3a0d" });
    $(".estadoSolucionado").parents('td').css({ "background": "#fbfff5", "color": "#5e7c1d" });
    //FALTAN ESTADOS!!!!
    $(".estadoPendiente").parents('td').css({ "background": "#4c7c03", "color": "#deefba" });
    $(".estadoRevision").parents('td').css({ "background": "#deefba", "color": "#2c3a0d" });
    $(".estadoSolucionado").parents('td').css({ "background": "#fbfff5", "color": "#5e7c1d" });
}

function fntToggleEvento() {
    var elemento = $("table tbody tr").find("td:eq(5)");
    for (var i = 0; i < elemento.length; i++) {
        if (!elemento[i].classList.contains('elipsis'))
            elemento[i].className += "elipsis";
    }

    //$(elemento).click(function() {
    //  $(this).toggleClass('elipsis');
    // });
}

//alert copy
function fntAlertCopy() {
    let botonCopiar = document.querySelector(".buttons-copy");
    botonCopiar.addEventListener("click", function() {

        document.querySelector(".copiado").innerHTML = `<div class="alert alert-dismissible alert-success col-sm-3">
                                                            <button class="close" type="button" data-dismiss="alert">×</button><strong>Copiado</strong>
                                                    </div>`
    });

}




// LLENAR SELECT PICKER RESPONSABLES
function fntColUsuario() {
    if (document.querySelector("#listResponsableEdit")) {
        let ajaxUrl = url + '/getSelectCols/';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector("#listResponsableEdit").innerHTML = request.responseText;
                //document.querySelector("#listRolid").value = 1;
                $('#listResponsableEdit').selectpicker('refresh');


            }
        }

    }

}

//Borrar solicitud
function fntDelSolicitud(idsolicitud) {

    swal({
        title: "Eliminar Solicitud",
        text: "¿Realmente quiere eliminar la solicitud?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar!",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = url + '/delSolicitud/' + idsolicitud;
            let strData = "idSolicitud=" + idsolicitud;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {

                        swal({
                            title: "Eliminar",
                            text: objData.msg,
                            type: "success",
                            timer: 1000,
                            showConfirmButton: false
                        });



                        tableSolicitudes.ajax.reload(function() {


                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }

        }
    });

}

//Usuario valorar solucion
function fntValorarSol(intValoracion) {

    let idSolicitudView = document.querySelector('#idSolicitudView').value;

    if (intValoracion == 1) {
        document.querySelector(".noMeGustaSol").classList.remove("valoracionActiva");
        document.querySelector(".noMeGustaSol").innerHTML = '<span><i class="far fa-thumbs-down"></i></span>';
        document.querySelector(".meGustaSol").classList.add("valoracionActiva");
        document.querySelector(".meGustaSol").innerHTML = '<span><i class="fas fa-thumbs-up"></i></span>';


    } else if (intValoracion == 2) {
        document.querySelector(".meGustaSol").classList.remove("valoracionActiva");
        document.querySelector(".meGustaSol").innerHTML = '<span><i class="far fa-thumbs-up"></i></span>';
        document.querySelector(".noMeGustaSol").classList.add("valoracionActiva");
        document.querySelector(".noMeGustaSol").innerHTML = '<span><i class="fas fa-thumbs-down"></i></span>';

    }


    let ajaxUrl = url + '/valorarSolucion/';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let formData = new FormData();
    formData.append('idSolicitudView', idSolicitudView);
    formData.append('intValoracion', intValoracion);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {


                tableSolicitudes.ajax.reload();


            }
        }



    }

}


function openModal() {

    $('#modalFormSolicitud').modal('show');

}
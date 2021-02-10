<!-- Modal Nueva Solicitud -->
<div class="modal fade" id="modalFormSolicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header headerSolicitud">
        <h5 class="modal-title" id="titleModal">Nueva Solicitud I+D+i</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="tile">
              <div class="tile-body">
                <form id="formSolicitud" name="formSolicitud" class="form-horizontal">
                <input type="hidden" id="idSolicitud" name="idSolicitud" value="">
                  <p class="text-primary">Todos los campos (<span class="required">*</span>) son obligatorios</p>
                  
                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listSeccion">Sección</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listSeccion" name="listSeccion" required="">
                              <option value="1">Bioestimulante</option>
                              <option value="2">Biocontrol</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listCategoria">Categoría</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listCategoria" name="listCategoria" required="">
                              <option value="1">Nuevo Producto</option>
                              <option value="2">Modificación Producto</option>
                              <option value="3">Ensayo</option>
                              <option value="4">Idea/Problema</option>
                              <option value="5">Muestra I+D</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtObjetivo">Objetivo</label><span class="required">*</span>
                          <textarea class="form-control" id="txtObjetivo" name="txtObjetivo" placeholder="Objetivo detallado" required=""></textarea>
                      </div>
                  </div>
          
                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listPrioridad">Prioridad</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listPrioridad" name="listPrioridad" required="">
                              <option value="1">Baja</option>
                              <option value="2">Media</option>
                              <option value="3">Alta</option>
                              </select>
                          </div>
                  </div>


                  <div class="tile-footer">
                      <button id="btnActionForm" class="btn btn-solicitud" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> <span id="btnText">Solicitar</span> </button>&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-danger" type="button" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</a>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal VIEW Solicitud -->

<div class="modal fade" id="modalViewSolicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header headerSolicitud">
        <h5 class="modal-title view" id="titleModal">Objetivo Detallado I+D+i</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      
            <div class="form-row">
                <div class="form-group col-lg-12">
                    <label for="celObjetivo">Objetivo</label>
                    <textarea  class="form-control" id="celObjetivo" name="celObjetivo" rows="5" cols="50" disabled></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-lg-12">
                    <label for="celSolucion">Solución</label>
                    <textarea class="form-control" id="celSolucion" name="celSolucion" rows="5" cols="50" disabled></textarea>
                </div>
            </div>

            <div class="tile-footer">
            <div class="form-row">
                <div class="form-group col-lg-12 valorarSol" disabled>
                    <label>Valoración</label>
               

                    <input type="hidden" id="idSolicitudView" name="idSolicitudview" class="" value="">
                    <button class="btn btn-sm meGustaSol shadow-none" onClick="fntValorarSol(1)"   title="Me gusta"><i class="far fa-thumbs-up"></i></button>
                    <button class="btn btn-sm noMeGustaSol shadow-none" onClick="fntValorarSol(2)" title="No me gusta"><i class="far fa-thumbs-down"></i></button>

              
                </div>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal EDIT solicitud -->
<div class="modal fade" id="modalEditSolicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header headerEditSolicitud">
        <h5 class="modal-title" id="titleModal">Resolver Solicitud I+D+i</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="tile">
              <div class="tile-body">
                <form id="formSolicitudEdit" name="formSolicitudEdit" class="form-horizontal">
                <input type="hidden" id="idSolicitudEdit" name="idSolicitudEdit" value="">
                <input type="hidden" id="idUser" value="<?php echo $_SESSION['idUser']?>">
                  <p class="text-primary">Todos los campos (<span class="required">*</span>) son obligatorios</p>
                  
                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listSeccionEdit">Sección</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listSeccionEdit" name="listSeccionEdit" required="">
                              <option value="1">Bioestimulante</option>
                              <option value="2">Biocontrol</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listCategoriaEdit">Categoría</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listCategoriaEdit" name="listCategoriaEdit" required="">
                              <option value="1">Nuevo Producto</option>
                              <option value="2">Modificación Producto</option>
                              <option value="3">Ensayo</option>
                              <option value="4">Idea/Problema</option>
                              <option value="5">Muestra I+D</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtObjetivoEdit">Objetivo</label><span class="required">*</span>
                          <textarea class="form-control" id="txtObjetivoEdit" name="txtObjetivoEdit" placeholder="Objetivo detallado" required=""></textarea>
                      </div>
                  </div>
          
                  <div class="form-row">
                          <div class="form-group col-md-12">
                              <label for="listPrioridadEdit">Prioridad</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listPrioridadEdit" name="listPrioridadEdit" required="">
                              <option value="1">Baja</option>
                              <option value="2">Media</option>
                              <option value="3">Alta</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtComentariosEdit">Comentarios Internos</label>
                          <textarea class="form-control" id="txtComentariosEdit" name="txtComentariosEdit" placeholder="Comentarios Internos I+D+i"></textarea>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtSolucionEdit">Solución</label>
                          <textarea class="form-control" id="txtSolucionEdit" name="txtSolucionEdit" placeholder="Solución detallada"></textarea>
                      </div>
                  </div>

          <?php if($_SESSION['userData']['idrol']<4){ ?>
                  <div class="form-row">
                          <div class="form-group col-md-12 contenedorListResponsableEdit">
                              <label for="listResponsableEdit">Asignado a</label>
                              <select class="form-control selectpicker show-tick" id="listResponsableEdit" name="listResponsableEdit">
                              </select>
                          </div>
                  </div>
          <?php } ?>


                  <div class="tile-footer">
                      <button id="btnActionFormEdit" class="btn btn-solicitudEdit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> <span id="btnText" class="textEdit">Actualizar</span> </button>&nbsp;&nbsp;&nbsp;
                      <a class="btn btn-danger" type="button" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</a>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

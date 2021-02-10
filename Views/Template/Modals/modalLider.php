<!-- Modal -->
<div class="modal fade" id="modalFormLider" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="tile">
              <div class="tile-body">
                <form id="formLider" name="formLider" class="form-horizontal">
                  <p class="text-primary">Todos los campos (<span class="required">*</span>) son obligatorios</p>
                  <input type="hidden" id="idLibreta" name="idLibreta" value="">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                          <label for="listColaboradorid">Colaborador</label>
                          <select class="form-control show-tick" data-live-search="true" id="listColaboradorid" name="listColaboradorid" required=""></select>
                    </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtFecha">Fecha</label><span class="required">*</span>
                          <input class="form-control" id="txtFecha" name="txtFecha" type="date" required="">
                      </div>
                  </div>
       
                  
                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="txtEvento">Evento</label><span class="required">*</span>
                          <textarea class="form-control" id="txtEvento" name="txtEvento" placeholder="Descripción del evento" required=""></textarea>
                      </div>
                  </div>
          
                  <div class="form-row">
        
                          <div class="form-group col-md-12">
                              <label for="listStatusLider">Evaluación</label><span class="required">*</span>
                              <select class="form-control selectpicker show-tick" id="listStatusLider" name="listStatusLider" required="">
                              <option value="1">Positivo</option>
                              <option value="2">Negativo</option>
                              </select>
                          </div>
                  </div>


                  <div class="tile-footer">
                      <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> <span id="btnText">Guardar</span> </button>&nbsp;&nbsp;&nbsp;
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

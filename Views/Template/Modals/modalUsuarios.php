<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="tile">
              <div class="tile-body">
                <form id="formUsuario" name="formUsuario" class="form-horizontal" autocomplete="off">
                  <input type="hidden" id="idUsuario" name="idUsuario" value="">
                  <p class="text-primary">Todos los campos son obligatorios</p>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtUser">Usuario</label>
                          <input class="form-control" id="txtUser" name="txtUser" type="text" required="">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtEmail">Email</label>
                          <input autocomplete="nope" class="form-control" id="txtEmail" name="txtEmail" type="email" required="">
                      </div>
                  </div>
                  <input name = "DummyUsername" type="text" style="display:none;"><!-- quitar autocompletado-->
                  <input name = "DummyPassword" type="password" style="display:none;"><!-- quitar autocompletado-->
                  
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtNombre">Nombre</label>
                          <input class="form-control" id="txtNombre" name="txtNombre" type="text" required="">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtApellido">Apellido</label>
                          <input autocomplete="off" class="form-control" id="txtApellido" name="txtApellido" type="text" required="">
                      </div>
                  </div>
          
                  <div class="form-row">
                          <div class="form-group col-md-6">
                              <label for="listRolid">Tipo</label>
                              <select class="form-control show-tick" data-live-search="true" id="listRolid" name="listRolid" required="">
                              </select>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="listStatus">Estado</label>
                              <select class="form-control selectpicker show-tick" id="listStatus" name="listStatus" required="">
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                              </select>
                          </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtPassword">Password</label>
                          <input autocomplete="new-password" class="form-control" id="txtPassword" name="txtPassword" type="password">
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


<!-- Modal VIEW USER -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <table class="table table-bordered">
            <tbody>
            <tr>
                <td>Usuario</td>
                <td id="celUser"></td>
              </tr>
              <tr>
                <td>Email</td>
                <td id="celEmail"></td>
              </tr>
              <tr>
                <td>Nombre</td>
                <td id="celNombre"></td>
              </tr>
              <tr>
                <td>Apellido</td>
                <td id="celApellido"></td>
              </tr>
              <tr>
                <td>Rol</td>
                <td id="celRol"></td>
              </tr>
              <tr>
                <td>Estatus</td>
                <td id="celEstatus">Activo</td>
              </tr>
              <tr>
                <td>Fecha registro</td>
                <td id="celFechaReg"></td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


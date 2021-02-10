<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="tile">
              <div class="tile-body">
                <form id="formPerfil" name="formPerfil" class="form-horizontal" autocomplete="off">
                  
                  <p class="text-primary">Todos los campos (<span class="required">*</span>) son obligatorios</p>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtUser">Usuario<span class="required">*</span></label>
                          <input class="form-control" id="txtUser" name="txtUser" type="text" value="<?=$_SESSION['userData']['user']?>" required="">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtEmail">Email</label>
                          <input autocomplete="nope" class="form-control" id="txtEmail" name="txtEmail" type="email" value="<?=$_SESSION['userData']['email']?>" required="" readonly disabled>
                      </div>
                  </div>                  
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtNombre">Nombre<span class="required">*</span></label>
                          <input class="form-control" id="txtNombre" name="txtNombre" type="text" value="<?=$_SESSION['userData']['nombre']?>"required="">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtApellido">Apellido<span class="required">*</span></label>
                          <input autocomplete="off" class="form-control" id="txtApellido" name="txtApellido" type="text" value="<?=$_SESSION['userData']['apellidos']?>"required="">
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtDepartamento">Departamento</label>
                          <input class="form-control" id="txtDepartamento" name="txtDepartamento" type="text" value="<?=$_SESSION['userData']['departamento']?>" required="" readonly disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtFechaReg">Fecha de Registro</label>
                          <input autocomplete="off" class="form-control" id="txtFechaReg" name="txtFechaReg" type="text" value="<?=$_SESSION['userData']['fechaRegistro']?>" required="" readonly disabled>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Sube tu avatar:</label>
                    <div id="containerImages">
                      <div id="divAvatar">
                        <div class="prevImage">
                          <img src="<?= base_url();?>Assets/images/uploads/avatar/<?=$_SESSION['userData']['avatar']?>" alt="">
                          
                        </div>
                        <input type="file" accept="image/*" name="foto" id="img1" class="inputUploadfile">
                        <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                        
                      </div>
                    </div>

                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="txtPassword">Password</label>
                          <input class="form-control" id="txtPassword" name="txtPassword" type="password">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="txtPasswordConfirm">Repetir Password</label>
                          <input autocomplete="off" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" type="password">
                      </div>
                  </div>

                  <div class="tile-footer">
                      <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> <span id="btnText">Actualizar</span> </button>&nbsp;&nbsp;&nbsp;
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



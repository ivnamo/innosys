<?php 

    headerAdmin($data);
    getModal('modalLider',$data);
?>
    
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="far fa-clipboard"></i> <?php echo  $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
          <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa fa-plus-circle"></i>Nuevo</button>
          <?php } ?>
        </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>libretaLider"><?php echo  $data['page_title'] ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableLider">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Colaborador</th>
                      <th>Fecha</th>
                      <th>Evento</th>
                      <th>Tipo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <th>CARGANDO...</th>
                      <th>CARGANDO...</th>
                      <th>CARGANDO...</th>
                      <th>CARGANDO...</th>
                      <th>CARGANDO...</th>
                      <th>CARGANDO...</th>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
<?php footerAdmin($data);?>
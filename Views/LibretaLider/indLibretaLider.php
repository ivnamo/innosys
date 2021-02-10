<?php 

    headerAdmin($data);
    
?>
    
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="far fa-clipboard"></i> <?php echo  $data['page_title'] ?>
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
                <table class="table table-hover table-bordered" id="tableIndicadoresLider">
                <div class="daterangeContainer">
                  <label class=daterangelb for="daterange">Fechas:</label>
                <input type="text" class="daterange form-control col-md-3" name="daterange"  aria-controls="tableIndicadoresLider">
                </div>
                
                  <thead>
                    <tr>
                      <th>Colaborador</th>
                      <th>Nº Eventos</th>
                      <th>% Positivos</th>
                      <th>% Negativos</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
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
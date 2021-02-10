<?php 
headerFront($data);
getModal('modalSolicitud',$data);
//dep($_SESSION);
?>
    <!-- Services -->
        <div id="services" class="container">
          <main class="">
              <div class="text-container flex-container">
                              <h2 class="tit-solicitudes"><span class="turquoise">Solicitudes</span></h2>
                              <?php  if($_SESSION['permisosMod']['w']==1){ ?>
                              <button class="btn-solid-lg page-scroll" type="button" onclick="openModal();">AÑADIR</button>
                              <?php } ?>
              </div> <!-- end of text-container --> 
              <div class="row">
                <div class="col-md-12">
                      <div class="table-responsive">
                      <div class="copiado"></div>
                        <table class="table table-hover table-bordered" id="tableSolicitudes">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Solicitante</th>
                              <th>Fecha</th>
                              <th>Sección</th>
                              <th>Categoría</th>
                              <th>Objetivo</th>
                              <th>Prioridad</th>
                              <th>Estado</th>
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
                              <th>CARGANDO...</th>
                              <th>CARGANDO...</th>
                              <th>CARGANDO...</th>
                          
                            </tr>
                      
                          </tbody>
                        </table>
                </div>
              </div>
          </main>
        </div> <!-- end of container -->
    <!-- end of services-->
<?php footerFront($data) ?>
   

    
  
 


    
    


 
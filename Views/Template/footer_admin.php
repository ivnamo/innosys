 <script>
   const base_url = "<?= base_url();?>";
 </script>
 
 <!-- Essential javascripts for application to work-->
    <script src="<?=base_url();?>Assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url();?>Assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>Assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>Assets/js/main.js"></script>
    <script src="<?=base_url();?>Assets/js/fontawesome.js"></script>
    
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url();?>Assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?=base_url();?>Assets/js/plugins/sweetalert.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?=base_url();?>Assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>Assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>Assets/js/plugins/bootstrap-select.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="<?=base_url();?>Assets/js/plugins/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="<?=base_url();?>Assets/js/plugins/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?=base_url();?>Assets/js/<?= $data['page_functions_js'] ?>"></script>

    
    
    

    
   
  </body>
</html>
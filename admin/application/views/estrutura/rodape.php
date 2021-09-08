</div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

     <!-- Bootstrap core JavaScript-->
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/script.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/popper.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/bootstrap.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.easing.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/mascaras.js'); ?>"></script>
      <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/fancybox.js'); ?>"></script>



    <!-- Page level plugin JavaScript 
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/sb-admin.js'); ?>"></script>
    <!-- Custom scripts for this page- 
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>-->

    <script>
    $(document).ready( function(){

      $(".fancybox").fancybox();

      $(".fancybox_ajax").fancybox({type: 'ajax'});

      /* ===== Mascaras ===== */
      $('.mascara-data').mask('00/00/0000');
      $('.mascara-hora').mask('00:00:00');
      $('.mascara-data-hora').mask('00/00/0000 00:00:00');
      $('.mascara-cep').mask('00000-000');
      $('.mascara-telefone-simples').mask('0000-0000');
      $('.mascara-telefone').mask('(00) 0000-0000');
      $('.mascara-celular').mask('(00) 0000-00000');
      $('.mascara-cpf').mask('000.000.000-00', {reverse: true});
      $('.mascara-cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.mascara-dinheiro').mask('000.000.000.000.000,00', {reverse: true});
      //$('.money2').mask("#.##0,00", {reverse: true, maxlength: false});
      $('.mascara-ip').mask('099.099.099.099');
      $('.mascara-percentual').mask('##0,00%', {reverse: true});
      $('.mascara-peso').mask('##0.000', {reverse: true});

    });
    </script>
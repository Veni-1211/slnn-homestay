 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery-ui/jquery-ui.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/popper.js/popper.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/modernizr/modernizr.js"></script>
 <script src="<?php echo base_url(); ?>utilities/backend/assets/pages/widget/amchart/amcharts.min.js"></script>
 <script src="<?php echo base_url(); ?>utilities/backend/assets/pages/widget/amchart/serial.min.js"></script>
 <script type="text/javascript " src="<?php echo base_url(); ?>utilities/backend/assets/pages/todo/todo.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/pages/dashboard/custom-dashboard.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>utilities/backend/assets/js/script.js"></script>
 <script type="text/javascript " src="<?php echo base_url(); ?>utilities/backend/assets/js/SmoothScroll.js"></script>
 <script src="<?php echo base_url(); ?>utilities/backend/assets/js/pcoded.min.js"></script>
 <script src="<?php echo base_url(); ?>utilities/backend/assets/js/demo-12.js"></script>
 <script src="<?php echo base_url(); ?>utilities/backend/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
 <script>
     var $window = $(window);
     var nav = $('.fixed-button');
     $window.scroll(function() {
         if ($window.scrollTop() >= 200) {
             nav.addClass('active');
         } else {
             nav.removeClass('active');
         }
     });
 </script>
 </body>

 </html>
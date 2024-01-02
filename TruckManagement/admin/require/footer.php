<!--<footer class="footer text-right">
    &copy; <?php echo date('Y'); ?> . All rights reserved.
</footer>-->

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<!--<script type="text/javascript" -->
<!--src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>-->

<script type="text/javascript">
// $(document).ready(function(){
//     if ($(window).width() <=600 ) {
// 	$('#wrapper').addClass('enlarged');
//     }
// });
</script>

<script>
    var resizefunc = [];</script>



<script src="<?php echo $sitename; ?>js/ajax.js"></script>
<!-- jQuery  -->
<script src="<?php echo $sitename; ?>assets/js/jquery.min.js"></script>

<script src="<?php echo $sitename; ?>plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        if ($("#editor").length > 0) {
            tinymce.init({
                selector: "textarea#editor",
                theme: "modern",
                height: 300,

                font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
//                fontFamilySelection: true,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }
    });</script>
    
            <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>




<!-- jQuery  -->
<script src="<?php echo $sitename; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo $sitename; ?>assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
<script src="<?php echo $sitename; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $sitename; ?>assets/js/detect.js"></script>
<script src="<?php echo $sitename; ?>assets/js/fastclick.js"></script>
<script src="<?php echo $sitename; ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo $sitename; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo $sitename; ?>assets/js/waves.js"></script>
<script src="<?php echo $sitename; ?>assets/js/wow.min.js"></script>
<script src="<?php echo $sitename; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo $sitename; ?>assets/js/jquery.scrollTo.min.js"></script>

<script src="<?php echo $sitename; ?>plugins/moment/moment.js"></script>
<script src="<?php echo $sitename; ?>plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="<?php echo $sitename; ?>assets/js/jquery.core.js"></script>
<script src="<?php echo $sitename; ?>assets/js/jquery.app.js"></script>

<script src="<?php echo $sitename; ?>assets/pages/jquery.form-pickers.init.js"></script>


<!-- Required datatable js -->
<script src="<?php echo $sitename; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- jQuery  -->
        <script src="<?php echo $sitename; ?>plugins/counterup/jquery.counterup.min.js"></script>
        
<!-- Responsive examples -->
<script src="<?php echo $sitename; ?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/datatables/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        // Default Datatable
        $('#datatable').DataTable();
        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });
        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });
        // Responsive Datatable
        $('#responsive-datatable').DataTable();
        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });
        $(function () {
            $("#datepicker1").datepicker();
        });
        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
  
    function deleteimage(a, b, c, d, e, f) {

        $.ajax({
            type: "POST",
            url: "<?php echo $sitename; ?>config/functions_ajax.php",
            data: {image: a, id: b, table: c, path: d, images: e, pid: f},
            success: function (data) {
               // alert(data);   
                $('#delimage').html(data);
            }

        });
    }

    function deleteimage1(a, b, c, d, e, f) {

        $.ajax({
            type: "POST",
            url: "<?php echo $sitename; ?>config/functions_ajax.php",
            data: {image: a, id: b, table: c, path: d, images: e, pid: f},
            success: function (data) {
                //alert(data);   
                $('#delimage1').html(data);
            }

        });
    }
</script>

     <script type="text/javascript">
$(function() {
setTimeout(function() { $("#hideDiv").fadeOut(500); }, 2000)

})
        </script>  

<script src="<?php echo $sitename; ?>plugins/moment/moment.js"></script>
<script src="<?php echo $sitename; ?>plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo $sitename; ?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>


</body>
</html>
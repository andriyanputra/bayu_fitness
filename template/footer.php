<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="../assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--Colorbox-->
<script src="../assets/js/plugins/colorbox/jquery.colorbox.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="../assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="../assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../assets/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="../assets/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="../assets/js/bootstrap-filestyle.js"></script> 
<!-- Numeric -->
<!--<script type="text/javascript" src="http://rawgit.com/BobKnothe/autoNumeric/master/autoNumeric.js"></script>-->
<script src="../assets/js/autoNumeric.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/AdminLTE/demo.js" type="text/javascript"></script>
<script type="text/javascript">
    // ========================Jam========================================== //
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
    // ========================Akhir Jam========================================== //
</script>
<script type="text/javascript">
    $("#data_supplier").dataTable();
    $("#data_pembelian").dataTable();
    $("#stock_barang").dataTable();
</script>
<script type="text/javascript">
    //options method for call datepicker
    $(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".lihat").colorbox({rel:'lihat', transition:"none", width:"75%", height:"75%"});
    });
</script>
 <script type="text/javascript">
    $('.auto').autoNumeric('init');
    $(":file").filestyle({buttonName: "btn-primary"});
    //image upload
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#gambar_nodin').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function(){
        bacaGambar(this);
    });
</script>
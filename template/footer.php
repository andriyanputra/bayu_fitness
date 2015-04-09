<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../assets/js/rapa.js" type="text/javascript"></script>
<script src="../assets/js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.10.3 -->
<script src="../assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--Colorbox-->
<script src="../assets/js/plugins/colorbox/jquery.colorbox.js" type="text/javascript"></script>
<!-- Modal.js -->
<script src="../assets/frontend/js/modal.js" type="text/javascript"></script>
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
<!-- Url Live -->
<script src="../assets/js/url/jquery.urlive.js"></script>
<script src="../assets/js/url/jquery.urlive.min.js"></script>
<!-- wysihtml5 -->
<!--<script src="../assets/js/wysihtml5/wysihtml5-0.3.0.js"></script>
<script src="../assets/js/wysihtml5/prettify.js"></script>
<script src="../assets/js/wysihtml5/jquery.iframe-transport.js"></script>
<script src="../assets/js/wysihtml5/jquery.fileupload.js"></script>
<script src="../assets/js/wysihtml5/wysihtml5-image-upload.js"></script>-->
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
    function realisasi(){
            
        $("#response").hide(); //sebagai div response (gaya2 loading image aja :D)
        $.ajax({
            url: "../data.php", //ambil data dari data.php
            cache: false, //data ga di simpan ke browser
            type: "GET", //tipe sinkron GET, bisa pake post, terserah aja
            dataType: "json", //data tipe nya sebagai json
            timeout:3000, //set 3 detik respon, jika lama berarti gagal
            beforeSend: function() {     
                $("#response").show(); //penggaya loading muncul ;D
                $('#response').html("<img class='text-center' src='../assets/img/ajax-loader.gif' />");                       
            },
            success : function (data) {
                $("#response").hide(); //penggaya loading dimatikan :(  
                var graph = Morris.Bar({ //di sini inisialkan graph sebagai morris chart area
                    element: 'contoh-chart1', //masukin chart nya nanti di div id=contoh-chart
                    data: data, //set data dari callback success function
                    xkey: 'y', //ini yang tadi sebagai data x (bawah)
                    ykeys: ['jumlah'], //datanya berupa jumlah penjualan tadi, json data
                    labels: ['Jml. Member'], //Label data dibikin Penjualan        
                    barColors: ['#3C8DBC'],
                    //lineColors: ['#2b44d2'], //bikin warna line nya
                });
            }
        });
    }

    $(document).ready(function()
    {           
        realisasi(); //nah nanti dipanggil di sini
    });                
</script>
<script type="text/javascript">
    function realisasi2(){
            
        $("#res").hide(); //sebagai div response (gaya2 loading image aja :D)
        $.ajax({
            url: "../data2.php", //ambil data dari data.php
            cache: false, //data ga di simpan ke browser
            type: "GET", //tipe sinkron GET, bisa pake post, terserah aja
            dataType: "json", //data tipe nya sebagai json
            timeout:3000, //set 3 detik respon, jika lama berarti gagal
            beforeSend: function() {     
                $("#res").show(); //penggaya loading muncul ;D
                $('#res').html("<img class='text-center' src='../assets/img/ajax-loader.gif' />");                       
            },
            success : function (data) {
                $("#res").hide(); //penggaya loading dimatikan :(  
                var graph = Morris.Bar({ //di sini inisialkan graph sebagai morris chart area
                    element: 'contoh-chart2', //masukin chart nya nanti di div id=contoh-chart
                    data: data, //set data dari callback success function
                    xkey: 'y', //ini yang tadi sebagai data x (bawah)
                    ykeys: ['jumlah1', 'jumlah2'], //datanya berupa jumlah penjualan tadi, json data
                    labels: ['Jml. Member'], //Label data dibikin Penjualan        
                    barColors: ['#3C8DBC'],
                    //lineColors: ['#2b44d2'], //bikin warna line nya
                });
            }
        });
    }
    
    $(document).ready(function()
    {           
        realisasi2(); //nah nanti dipanggil di sini
    });                
</script>
<script type="text/javascript">
    /*$(document).ready(function() {
        $('.wysihtml5').wysihtml5({
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": true, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": true, //Button to insert an image. Default true,
            "color": false //Button to change color of font
        });
        $(prettyPrint);
    });*/
</script>
<script type="text/javascript">
    $("#data_supplier").dataTable();
    $("#data_pembelian").dataTable();
    $("#stock_barang").dataTable();
    $("#user").dataTable();
    $("#anggota").dataTable();
    $("#notif").dataTable();
    $("#artikel").dataTable();
    $("#event").dataTable();
</script>
<script type="text/javascript">
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
    //options method for call datepicker
    $(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
</script>
<script type="text/javascript">
    $("#add_user").modal("hide");
    $("#add_member").modal("hide");
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
<script type="text/javascript">
    function showDiv(elem){
        if(elem.value == 'tambah'){
            document.getElementById('jabatan_baru').style.display = "block";
        }else{
            document.getElementById('jabatan_baru').style.display = "none";
        }
    }
</script>
<script type="text/javascript">
    function hideshow(which){
    if (!document.getElementById)
        return
    if (which.style.display=="block")
        which.style.display="none"
    else
        which.style.display="block"
    }
    </script>
    <script type="text/javascript">
    var password = document.getElementById("password")
      , confirm_password = document.getElementById("conf_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Tidak Cocok");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<script type="text/javascript">
    $("#url").on("input propertychange", function () {
        $("#url").urlive({
            callbacks: {
                onStart: function () {
                    $(".loading").show();
                    $(".urlive-container").urlive("remove");
                },
                onSuccess: function (data) {
                    $(".loading").hide();
                    $(".urlive-container").urlive("remove");
                },
                noData: function () {
                    $(".loading").hide();
                }
            }
        });
    }).trigger("input");
</script>
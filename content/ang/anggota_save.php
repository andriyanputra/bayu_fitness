<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1) {

        if($_POST['simpan'] == 'Simpan'){
            
        }

    }else{
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Oopss!",   
                      text: "Restricted Page !",   
                      type: "warning",
                      showCancelButton: false
                }, function(){
                    window.history.back();
                })
            }, 200);
          </script>
        <?php
    }
?>
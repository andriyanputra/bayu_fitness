<?php
	@session_start();

	if($_SESSION['NIP_PEGAWAI'] == 115623210){

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
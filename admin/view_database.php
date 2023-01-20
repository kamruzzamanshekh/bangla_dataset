<?php
session_start();
require_once 'header.php';
require_once('database.php');

if(isset($_SESSION['login']))
{

}
else
{
  header("location:login.php");

}
?>
<body>
  <?php require_once ('navbar.php'); ?>
 <br><br><br><br>
    <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="text-center">Full Dataset</h1>
                <div id="ajax_wrapper">
                    <?php
                        require_once 'pagination.php';
                    ?>
                </div>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).on( "click", ".pagination a", function(e) {
    var pageValue = $(this).attr("data-page");
    $.ajax({
        url: 'pagination.php?limit=25&page='+pageValue,
	    type: "GET",
	    success: function(data){
            $("#ajax_wrapper").html(data);
        }
    });
    e.preventDefault();
});
    </script>
</body>
</html>

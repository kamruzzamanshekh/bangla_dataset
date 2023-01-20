<?php
session_start();
require_once 'header.php';
include("database.php");
?>
<tbody>
	<?php require_once('navbar.php'); ?>

	<div class="container m-top m-bottom" >
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Log as Admin</h4>
						<form action="" method="post">
							<div class="">
								<label for="">Admin ID</label>
								<input class="form-control" type="text" name="id" value="">
							</div>
							<div class="">
								<label for="">Password</label>
								<input class="form-control" type="password" name="password" value="">
							</div>
							<div class="text-center p-3">
							<button class="btn btn-primary " type="submit" name="submit">sign In</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</tbody>



<?php

/* if login is pressed it extract the info from db */
if (isset($_REQUEST['submit'])) {

	extract($_REQUEST);
	$nn = "select * from admin where admin_id='$id' and admin_pass='$password'";

	$i = select($nn);
	if($i)
	{
			$num = mysqli_num_rows($i);
			if ($num == 1) {
				while ($r = mysqli_fetch_array($i)) {
					$_SESSION['login'] = $r[1];
					// echo "alert(".$_SESSION['login'].")";
					// $id = $_SESSION['login'];
					// $statement = $db->prepare("select * from contributors where contributor_id='$id'");
					// $statement->execute();
					// $value = $statement->fetchAll()[0];
					// $_SESSION['id'] = $value['id'];

					echo "<script>
				window.location='index.php';
				</script>";
				}
			} else {
				echo "<script>alert('Something Went Wrong Please Try Again Later');
				window.location='login.php';
				</script>";
			}
	}else {
		echo "<script>alert('Something Went Wrong Please Try Again Later');
		window.location='login.php';
		</script>";
	}



}
?>

<footer>
	<?php  ?>
</footer>

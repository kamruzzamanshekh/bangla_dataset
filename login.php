<?php
session_start();
require_once 'header.php';
include("config.php");
?>
<tbody>
	<?php require_once('navbar.php'); ?>

	<div class="container m-top m-bottom" >
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Log In</h4>
						<form action="" method="post">
							<div class="">
								<label for="">Contribute_Name</label>
								<input class="form-control" type="text" name="name" value="">
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
	$nn = "select * from contributors where c_name='$name' and c_pass='$password'";

	$i = select($nn);
	if($i)
	{
			$num = mysqli_num_rows($i);
			if ($num == 1) {
				while ($r = mysqli_fetch_array($i)) {
					$_SESSION['id'] = $r[0];
					$_SESSION['name'] = $r[1];
					// echo "<script>alert(".$_SESSION['login'].")</script>";
					// $id = $_SESSION['login'];
					// $statement = $db->prepare("select * from contributors where contributor_id='$id'");
					// $statement->execute();
					// $value = $statement->fetchAll()[0];
					// $_SESSION['id'] = $value['id'];
        // echo '<script>alert("Successfully log to '.$_SESSION['name'].'")</script>';

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

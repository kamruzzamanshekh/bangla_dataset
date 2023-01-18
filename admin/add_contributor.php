<?php
session_start();
require_once 'header.php';
require_once('config.php');

if(isset($_SESSION['login']))
{

}
else
{
  header("location:login.php");

}
if (isset($_POST['add'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Name can not be empty');
    } else if (empty($_POST['pass'])) {
      throw new Exception('Job can not be empty');
    }


    $statement = $db->prepare("insert into contributors (c_name, c_pass) values(?,?)");
    $statement->execute(array($_POST['name'], $_POST['pass'] ));
    echo '<script>alert("Add Successful")</script>';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>

<body>
    <?php require_once ('navbar.php'); ?></br></br></br>
    <div class="  container w-50  h-100 d-flex justify-content-center">
      <div id="content">
        <form class="form-container shadow mt-5 p-5" action="" method="post">
            <h2>Add new Contributor</h2>
        <div class="form-control">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
        </div>
        <div class="form-control">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="col text-center">
          <button type="submit" class="btn btn-primary btn-lg text-center" name="add">ADD</button>
        </div>

      </form>
    </div>
    </div>
</body>
<!---Content Part -->

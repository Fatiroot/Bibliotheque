<?php
session_start();
// include __DIR__ . '/../../../App/Models/User.php';
include __DIR__ . '/../../../vendor/autoload.php';

use App\Models\User;




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
         crossorigin="anonymous">
    <link rel="stylesheet" href="../../../Public/css/dashboard.css">
    <title>admin dashboard</title>
</head>
<body>
<div class="option">
	<div class="logo">
		<div class="dashboto-logo">
		</div>
		<p class="logo rog">BiBliO</p>
	</div>
    <br><br><br>
	
	<div class="clear"></div>
	<ul class="menu">
		<a href="dashboard.php">
			<i class="fa fa-dashboard"></i>
			Dashboard
		</a>
		<br>
		<a href="../admin/user/show.php">
        <i class="fa-solid fa-user"></i>
			Users
		</a>
		<a href="">
			<i class="fa fa-book"></i>
			Books
		</a>
		<a href="../../auth/login.php">
        <i class=" fa-solid fa-arrow-right-from-bracket"></i>
			Log Out
		</a>
	
	</ul>
</div>

<div class="dashboard-heading">
	<div class="panel">
	</div>
	<div class="all">
		<div class="starter-stats">
			<div class="blok">
				
				<div class="no">
					<p >Asset Types</p>
					<p>3</p>
				</div>
			</div>

			<div class="blok">
				
				<div class="no">
					<p>Total Gains</p>
					<p>-100.01 BLONION</p>
				</div>
			</div>

			<div class="blok">
				
				<div class="no">
					<p>Longest HODL</p>
					<p>8 Months</p>
				</div>
			</div>
			<div class="clear"></div>
			<div class="gains">
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Fullname</th>
      <th scope="col">Fullname</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	<?php
	$user = new User('','','', '', '', '');
	$users = $user->getUsers();
	
	    if (empty($users)) {
            echo '<tr><td colspan="6">No users found.</td></tr>';
        } else {
            foreach ($users as $user) {
				// var_dump($user);

	?>
    <tr>
     <td><?=$user->getFullName() ?></td>
     <td><?=$user->getLastname()?></td>
     <td><?=$user->getEmail()?></td>
     <td><?=$user->getPhone()?></td>
     <td><?=$user->getRole()?></td>
      <td>
	<form action="edit.php" method="post">
			<input type="hidden" name="id" value="<?=$user->getId()?>">
			<button type="submit" name="edit" style="background: none; border: none;">
			<a href=""><i class="fa-solid fa-pen"></i></a>
			</button>
	</form>

    <form action="../../../App/Controllers/UserController.php" method="Post">
		<input type="hidden" name="id" value="<?=$user->getId()?>">
		<button type="submit" name="delete" style="background: none; border: none;">
        <a href="" ><i class="fa-solid fa-trash"></i></a>
		</button>
    </form>
      </td>
    </tr>
	<?php
	}
}
	?>
  </tbody>
</table>
			</div>
	</div>

</div>
<script src="../../Public/js/dashboard.js"></script>
</body>
</html>
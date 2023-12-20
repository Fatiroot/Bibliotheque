<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../Public/css/dashboard.css">
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
		<a href="../auth/login.php">
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
				<canvas id="myChart"></canvas>
			</div>

		</div>

	</div>

</div>
<script src="../../Public/js/dashboard.js"></script>
</body>
</html>
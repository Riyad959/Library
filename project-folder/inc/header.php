<?php
include 'inc/connection.php';
$not = 0;
$res = mysqli_query($link, "select * from request_books where read1='no'");
$not = mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Library Management System</title>
	<link rel="stylesheet" href="inc/css/bootstrap.min.css">
	<link rel="stylesheet" href="inc/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="inc/css/datatables.min.css">
	<link rel="stylesheet" href="inc/css/pro1.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
</head>

<body>
	<div class="main-content">
		<div class="wrapper">
			<div class="left-sidebar">
				<div class="p-title">
					<h3><a href=""><i class="fas fa-book"></i><span>lms</span></a></h3>
				</div>
				<div class="gap-40"></div>
				<div class="profile">
					<div class="profile-pic">
						<?php
						$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
						while ($row = mysqli_fetch_array($res)) {
							?><img src="<?php echo $row["photo"]; ?> " height="" width="" alt="something wrong"
								class="rounded-circle"></a> <?php
						}
						?>
					</div>
					<div class="profile-info text-center">
						<span>Welcome!</span>
						<h2>
							<?php
							$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
							while ($row = mysqli_fetch_array($res)) {
								$name = $row["name"];
								echo $name;
							}

							?>

						</h2>
					</div>
				</div>
				<div class="gap-30"></div>
				<div class="sidebar-menu">
					<h3>General</h3>
					<div class="border"></div>
					<ul>
						<li class="menu <?php if ($page == 'home') {
							echo 'active';
						} ?>">
							<a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a>
						</li>

						<li class="menu <?php if ($page == 'profile') {
							echo 'active';
						} ?>">
							<a href="profile.php"><i class="fas fa-id-card"></i>profile</a>
						</li>
						<li class="menu <?php if ($page == 'sinfo') {
							echo 'active';
						} ?>">
							<a href="all-student-info.php"><i class="fas fa-desktop"></i>all student information</a>
						</li>
						<li class="menu <?php if ($page == 'tinfo') {
							echo 'active';
						} ?>">
							<a href="all-teacher-info.php"><i class="fas fa-desktop"></i>all teacher information</a>
						</li>
						<li class="menu menu-toggle2">
							<a href="#"><i class="fas fa-location-arrow"></i>manage book <span
									class="fa fa-chevron-down"></span></a>
							<ul class="menus2">
								<li><a href="add-book.php">add book</a></li>
								<li><a href="display-books.php">display books</a></li>
							</ul>
						</li>
						<li class="menu menu-toggle1">
							<a href="#"><i class="fas fa-list-alt"></i>issue book <span
									class="fa fa-chevron-down"></span></a>
							<ul class="menus1">
								<li><a href="student-issue-book.php">student issue book</a></li>
								<li><a href="teacher-issue-book.php">teacher issue book</a></li>
							</ul>
						</li>
						<li class="menu menu-toggle3">
							<a href="#"><i class="fas fa-users"></i>manage users <span
									class="fa fa-chevron-down"></span></a>
							<ul class="menus3">
								<li><a href="add-student.php">add student</a></li>
								<li><a href="add-teacher.php">add teacher</a></li>
							</ul>
						</li>
						<li class="menu <?php if ($page == 'ibook') {
							echo 'active';
						} ?>">
							<a href="issued-books.php"><i class="fas fa-bookmark"></i>issued books</a>
						</li>
						<li class="menu <?php if ($page == 'rbook') {
							echo 'active';
						} ?>">
							<a href="requested-books.php"><i class="fas fa-book"></i>view requested books</a>
						</li>
						<li class="menu menu-toggle4">
							<a href="#"><i class="far fa-share-square"></i>send message to user <span
									class="fa fa-chevron-down"></span></a>
							<ul class="menus4">
								<li><a href="send-to-student.php">send to student</a></li>
								<li><a href="send-to-teacher.php">send to teacher</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="content">
				<div class="inner">
					<div class="heading text-center">
						<h3>Librarian control panel</h3>
					</div>
					<div class="header-profile text-right">
						<ul>
							<li class="icon">
								<a href="requested-books.php"><i class="fas fa-bell"></i></a>
								<span class="count"
									onclick="window.location='requested-books.php'"><b><?php echo $not; ?></b></span>
							</li>
							<li class="dropdown">
								<?php
								$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
								while ($row = mysqli_fetch_array($res)) {
									?><a href="" class="dropdown-toggle" data-toggle="dropdown"><img
											src="<?php echo $row["photo"]; ?>"
											alt=""><span><?php echo $_SESSION["username"]; ?></span></a> <?php
								}
								?>
								<ul class="dropdown-menu">
									<li class="user-header text-center">
										<?php
										$res = mysqli_query($link, "select * from lib_registration where username='" . $_SESSION['username'] . "'");
										while ($row = mysqli_fetch_array($res)) {
											?><img src="<?php echo $row["photo"]; ?>" alt=""> <?php
										}
										?>
										<p><?php echo $_SESSION["username"]; ?> - Librarian</p>
									</li>
									<li class="user-footer">
										<ul>
											<li>
												<a href="profile.php">profile</a>
											</li>
											<li>
												<a href="logout.php">logout</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
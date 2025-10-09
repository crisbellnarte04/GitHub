<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include "db_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$tasks = get_all_tasks_by_id($conn, $_SESSION['id']);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>My Tasks</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1">
				<h4 class="title">My Tasks</h4>
				<?php if (isset($_GET['success'])) { ?>
					<div class="success" role="alert">
						<?php echo stripcslashes($_GET['success']); ?>
					</div>
				<?php } ?>
				<?php if ($tasks != 0) { ?>
					<table class="main-table">
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Description</th>
							<th>Status</th>
							<th>Due Date</th>
							<th>Action</th>
						</tr>
						<?php $i = 0;
						foreach ($tasks as $task) {
							switch ($task['status']) {
								case 'pending':
									$badgeClass = 'bg-warning';

									break;

								case 'in_progress':
									$badgeClass = 'bg-primary';

									break;

								case 'completed':
									$badgeClass = 'bg-success';
									$status = 'delivering';
									break;

								default:
							}
							if ($task['due_date'] == '0000-00-00') {
								$due_date = 'No deadline';
							} else {
								$due_date = $task['due_date'];
							}
						?>
							<tr>
								<td><?= ++$i ?></td>
								<td><?= $task['title'] ?></td>
								<td><?= $task['description'] ?></td>
								<td class="text-center">
									<span class="badge rounded-pill text-bg     <?= $badgeClass ?> p-2 text-capitalize" style="letter-spacing:1px; font-size:13px;"><?= $task['status'] ?></span>

								</td>
								<td><?= $due_date ?></td>

								<td>
									<a href="edit-task-employee.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
								</td>
							</tr>
						<?php	} ?>
					</table>
				<?php } else { ?>
					<h3>Empty</h3>
				<?php  } ?>

			</section>
		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(2)");
			active.classList.add("active");
		</script>

	</body>

	</html>
<?php } else {
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
?>
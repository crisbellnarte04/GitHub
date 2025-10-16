<style>
    a {
        text-decoration: none;
        color: white;
    }

    nav.side-bar {
    position: fixed;
    top: 70px; /* same as header height */
    left: 0;
    width: 220px;
    height: calc(100% - 70px); /* fill remaining height */
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(10px);
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    z-index: 900;
}


    nav.side-bar .user-p {
        text-align: center;
        padding: 10px 0;
    }

    nav.side-bar .user-p img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
        border: 2px solid rgba(255,255,255,0.6);
    }

    nav.side-bar .user-p h4,
    nav.side-bar .user-p span {
        color: #fff;
    }

    nav.side-bar ul#navList {
        list-style: none;
        padding-left: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    nav.side-bar ul#navList a {
        color: white;
        text-decoration: none;
    }

    nav.side-bar ul#navList li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s;
    }

    nav.side-bar ul#navList li:hover {
        background: rgba(255, 255, 255, 0.2);
        cursor: pointer;
    }

    nav.side-bar ul#navList li i {
        min-width: 20px;
        text-align: center;
    }
</style>

<nav class="side-bar">
    <div class="user-p">
        <img src="img/avatar.png" alt="Avatar">
        <h4><?= $_SESSION['username'] ?></h4>
        <span><?= $_SESSION['role'] ?></span>
    </div>

    <ul id="navList">
        <?php if($_SESSION['role'] == "employee"){ ?>
            <a href="index.php"><li><i class="fa fa-tachometer"></i><span>Dashboard</span></li></a>
            <a href="profile.php"><li><i class="fa fa-user"></i><span>Profile</span></li></a>
            <a href="my_task.php"><li><i class="fa fa-calendar"></i><span>My Task</span></li></a>
            <a href="logout.php"><li><i class="fa fa-sign-out"></i><span>Logout</span></li></a>
        <?php } else if($_SESSION['role'] == "admin"){ ?>
            <a href="index.php"><li><i class="fa fa-tachometer"></i><span>Dashboard</span></li></a>
            <a href="user.php"><li><i class="fa fa-users"></i><span>Manage Users</span></li></a>
            <a href="create_task.php"><li><i class="fa fa-check-square"></i><span>Create Task</span></li></a>
            <a href="task.php"><li><i class="fa fa-tasks"></i><span>All Tasks</span></li></a>
            <a href="admin_appointment.php"><li><i class="fa fa-calendar"></i><span>Appointments</span></li></a>
            <a href="logout.php"><li><i class="fa fa-sign-out"></i><span>Logout</span></li></a>
        <?php } else if($_SESSION['role'] == "doctor"){ ?>
            <a href="manipage_doc.php"><li><i class="fa fa-tachometer"></i><span>Dashboard</span></li></a>
            <a href="doc_appointment.php"><li><i class="fa fa-calendar-check-o"></i><span>Appointments</span></li></a>
            <a href="doc_availability.php"><li><i class="fa fa-calendar"></i><span>My Schedule</span></li></a>
            <a href="logout.php"><li><i class="fa fa-sign-out"></i><span>Logout</span></li></a>
        <?php } ?>
    </ul>
</nav>

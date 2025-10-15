<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "doctor") {
    include "db_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";
    include "inc/bootstrap.php";
    $user_id = $_SESSION['id'];
    $today = date("Y-m-d");
    $time = strtotime("+7 days", time());
    $today_date = date("Y-m-d", $time);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>All Tasks</title>

    </head>
    <style>
        /* Body background image */
body {
    background: url("img/bg.jpg") center/cover no-repeat;
    color: #fff;
    font-family: 'Times New Roman', serif;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Fix header and sidebar positioning */
header.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px; /* adjust if your header height is different */
    z-index: 1000; /* keep above sidebar */
}

nav.side-bar {
    position: fixed;
    top: 70px; /* same as header height */
    left: 0;
    width: 220px; /* adjust to your sidebar width */
    height: calc(100% - 70px); /* remaining height below header */
    background: rgba(0,0,0,0.6);
    padding-top: 20px;
    z-index: 900;
}

/* Main body content offsets */
.body {
    margin-left: 220px; /* same as sidebar width */
    margin-top: 70px;   /* same as header height */
    padding: 20px;
}

/* Card styling to match other pages */
.card {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

/* Form styling */
form#saveForm, form#edit {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 10px;
}

/* Table styling */
table th, table td {
    text-align: center;
    font-size: 15px;
}

.table-responsive {
    max-height: 500px;
    overflow-y: auto;
}

/* Button styles */
.btn-primary {
    background-color: #0C6217;
    border: none;
}

.btn-primary:hover {
    background-color: #095012;
}

/* Modal adjustments */
.modal-content {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: #fff;
}

/* Counter badges */
.count {
    font-weight: 600;
    letter-spacing: 3px;
    color: #fff;
}

    </style>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1">

                <?php if (isset($_GET['success'])) { ?>
                    <div class="success" role="alert">
                        <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>
                <div class="card mt-5">
                    <form class="row g-3 p-5" id="saveForm">
                        <div class="col-md-6">
                            <label for="fname" class="form-label text-capitalize">Date:</label>
                            <input type="date" class="form-control" name="date" min="<?php echo $today_date; ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="fname" class="form-label text-capitalize">time:</label>

                            <input type="text" class="form-control" name="time" placeholder="put time ranges">
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="card-footer border-0 d-flex flex-row-reverse" style="background-color:transparent;">
                            <button type="submit" class="btn btn-primary ">Save</button>
                        </div>
                    </form>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">No.</th>
                                        <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DATE</th>
                                        <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">TIME</th>

                                        <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = '0';
                                    $fetch = "SELECT * FROM `doc_avail` where `d_id` = '$user_id' ";
                                    $result = mysqli_query($sqli, query: $fetch);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $date = $row['date'];
                                        $time = $row['time'];
                                        $id = $row['id'];
                                        $count++;


                                        echo '<tr>
                                                              <td style="font-size: 18px;" class="text-center">
                                                                ' . $count . '
                                                            </td>
                                                           
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . $date . '</td>
                                                         <td style="font-size: 15px;" class="text-center text-uppercase">
                                                               ' . $time . '
                                                 
                                                            </td>
                                                            <td class="text-center">
                                                            <form id="deleteForm">
                                                                <div class="d-flex justify-content-center"">
                                                                        <button class="btn btn-sm btn-primary ml-2" data-bs-toggle="modal" data-bs-target="#edit' . $id . '" type="button" style="background:#0C6217">Edit</button>
                                                                        <button class="btn btn-sm btn-primary mr-2"  type="submit" style="background-color:red; color:white;">Delete</button>
                                                                        <input type="hidden" name="id" value="'.$id.'"
                                                                             
                                                                        ';

                                        echo '
                                                            </form></div>
                                                            </td>
                                                        </tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <?php

        $fetch_appointment = "SELECT * FROM `doc_avail`";
        $result = mysqli_query($sqli, $fetch_appointment);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $time = $row['time'];
            $date = $row['date'];
        ?>
            <div class="modal fade" id="edit<?php echo $id; ?>" aria-hidden="true" aria-labelledby="edit" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="edit">Edit Scheudule</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="edit">
                                <div class="col-md-6">
                                    <label for="date" class="form-label text-capitalize">date:</label>
                                    <input name="date" class="form-control" id="date" type="date" value="<?php echo $date; ?>" min=<?php echo $today_date;?>>
                                </div>
                                <div class="col-md-6">
                                    <label for="time" class="form-label text-capitalize">time:</label>
                                    <input name="time" class="form-control" id="time" type="text" value="<?php echo $time; ?>">
                                </div>


                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-primary" name="decline" id="declinedBtn">
                                        Submit
                                    </button>
                                    <input name="id" class="form-control" id="id" type="hidden" value="<?php echo $id; ?>">


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
<?php
        }
        include "inc/imports.php";
?>
<script>
    $(document).on('submit', '#saveForm', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("save", true);
        $.ajax({
            url: "app/appointment.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var res = jQuery.parseJSON(data);
                if (res.status == 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something Went Wrong.',
                        text: res.msg,
                        timer: 10000
                    })
                } else if (res.status == 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS',
                        text: res.msg,
                        timer: 2000
                    }).then(function() {
                        location.reload();
                    });
                }
            }

        });

    });
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("edit", true);
        $.ajax({
            url: "app/appointment.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var res = jQuery.parseJSON(data);
                if (res.status == 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something Went Wrong.',
                        text: res.msg,
                        timer: 10000
                    })
                } else if (res.status == 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS',
                        text: res.msg,
                        timer: 2000
                    }).then(function() {
                        location.reload();
                    });
                }
            }

        });

    });
    $(document).on('submit', '#deleteForm', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("delete", true);
        $.ajax({
            url: "app/appointment.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var res = jQuery.parseJSON(data);
                if (res.status == 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something Went Wrong.',
                        text: res.msg,
                        timer: 10000
                    })
                } else if (res.status == 201) {
                    Swal.fire({
                        icon: 'success',
                        title: 'SUCCESS',
                        text: res.msg,
                        timer: 2000
                    }).then(function() {
                        location.reload();
                    });
                }
            }

        });

    });
</script>
<?php
} else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>
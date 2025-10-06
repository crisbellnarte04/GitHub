<?php
session_start();
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id       = $_POST['user_id'];
    $clinic_id     = $_POST['clinic_id'];
    $doctor_id     = $_POST['doctor_id'];
    $date_of_visit = $_POST['date_of_visit'];
    $time_of_visit = $_POST['time_of_visit'];

    // Validate date
    if (strtotime($date_of_visit) < strtotime(date("Y-m-d"))) {
        die("You cannot book an appointment in the past.");
    }

    try {
        $sql = "INSERT INTO appointments (user_id, doctor_id, clinic_id, date_of_visit, time_of_visit)
                VALUES (:user_id, :doctor_id, :clinic_id, :date_of_visit, :time_of_visit)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':doctor_id' => $doctor_id,
            ':clinic_id' => $clinic_id,
            ':date_of_visit' => $date_of_visit,
            ':time_of_visit' => $time_of_visit
        ]);

        echo "<script>alert('Appointment booked successfully!'); window.location.href='book_appointment.php';</script>";

    } catch (PDOException $e) {
        echo "Error booking appointment: " . $e->getMessage();
    }
}
?>

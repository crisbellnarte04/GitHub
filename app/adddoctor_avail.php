<?php
session_start();
include "db_connection.php";

// Access control: only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $clinic_id = $_POST['clinic_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $slot_duration = intval($_POST['slot_duration_minutes']);

    // Optional: Validate times (start < end)
    if (strtotime($start_time) >= strtotime($end_time)) {
        $_SESSION['error'] = "Start time must be before end time.";
        header("Location: doctor_availability.php");
        exit;
    }

    // Optional: Check for overlapping availability for the same doctor & clinic & day

    // Insert availability
    $stmt = $conn->prepare("INSERT INTO doctor_availability (doctor_id, clinic_id, day_of_week, start_time, end_time, slot_duration_minutes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$doctor_id, $clinic_id, $day_of_week, $start_time, $end_time, $slot_duration]);

    $_SESSION['success'] = "Availability added successfully.";
    header("Location: doctor_availability.php");
    exit;
} else {
    header("Location: doctor_availability.php");
    exit;
}
?>

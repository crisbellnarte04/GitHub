<?php
session_start();
include "db_connection.php";

// Access control: only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch doctors and clinics
$doctors = $conn->query("SELECT id, full_name FROM doctors")->fetchAll(PDO::FETCH_ASSOC);
$clinics = $conn->query("SELECT id, name FROM clinics")->fetchAll(PDO::FETCH_ASSOC);

// Fetch existing availabilities
$availability = $conn->query("
    SELECT da.*, d.full_name AS doctor_name, c.name AS clinic_name
    FROM doctor_availability da
    JOIN doctors d ON da.doctor_id = d.id
    JOIN clinics c ON da.clinic_id = c.id
    ORDER BY d.full_name, FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), start_time
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Availability - Admin</title>
    <style>
        body { font-family: Arial; padding: 40px; background: #f5f5f5; }
        table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 10px; }
        table { background: #fff; width: 100%; margin-bottom: 30px; }
        form { background: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background: green; color: white; border: none; }
        h2 { margin-bottom: 10px; }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['success'])) {
    echo '<p style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
    unset($_SESSION['error']);
}
?>

    <h2>Doctor Availability</h2>
    <table>
        <tr>
            <th>Doctor</th>
            <th>Clinic</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Slot Duration</th>
        </tr>
        <?php if ($availability): ?>
            <?php foreach ($availability as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($row['clinic_name']) ?></td>
                    <td><?= $row['day_of_week'] ?></td>
                    <td><?= $row['start_time'] ?></td>
                    <td><?= $row['end_time'] ?></td>
                    <td><?= $row['slot_duration_minutes'] ?> mins</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No availability defined.</td></tr>
        <?php endif; ?>
    </table>

    <h2>Add New Availability</h2>
    <form method="POST" action="add_availability.php">
        <label>Doctor:</label>
        <select name="doctor_id" required>
            <option value="">-- Select Doctor --</option>
            <?php foreach ($doctors as $doc): ?>
                <option value="<?= $doc['id'] ?>"><?= htmlspecialchars($doc['full_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Clinic:</label>
        <select name="clinic_id" required>
            <option value="">-- Select Clinic --</option>
            <?php foreach ($clinics as $clinic): ?>
                <option value="<?= $clinic['id'] ?>"><?= htmlspecialchars($clinic['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Day of the Week:</label>
        <select name="day_of_week" required>
            <?php foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day): ?>
                <option value="<?= $day ?>"><?= $day ?></option>
            <?php endforeach; ?>
        </select>

        <label>Start Time:</label>
        <input type="time" name="start_time" required>

        <label>End Time:</label>
        <input type="time" name="end_time" required>

        <label>Slot Duration (minutes):</label>
        <input type="number" name="slot_duration_minutes" value="15" required min="5">

        <button type="submit">Add Availability</button>
    </form>

</body>
</html>

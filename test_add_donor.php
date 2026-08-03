<?php
session_start();

// Fake login for testing
$_SESSION['user_id'] = 1;
$_SESSION['user_role'] = 'admin';
$_SESSION['fullname'] = 'Test User';

// Include necessary files
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Test data
$data = [
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john.doe@example.com',
    'contact' => '09123456789',
    'dob' => '1990-01-01',
    'blood_type' => 'O+',
    'sex' => 'Male',
    'address' => '123 Test Street'
];

// Call addDonor
$result = addDonor($data);

echo "<pre>";
print_r($result);
echo "</pre>";

if ($result['success']) {
    echo "Donor added successfully!";
} else {
    echo "Error: " . $result['message'];
}
?>
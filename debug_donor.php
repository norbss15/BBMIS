<?php
session_start();

// Fake login for testing
$_SESSION['user_id'] = 1;
$_SESSION['user_role'] = 'admin';
$_SESSION['fullname'] = 'Test User';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

require_once 'includes/db.php';
require_once 'includes/functions.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Simulate the AJAX request from saveDonor()
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_donor') {
    header('Content-Type: application/json');
    
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid security token. Please refresh the page.']);
        exit;
    }
    
    // Prepare data like in saveDonor()
    $data = [
        'firstname' => $_POST['firstname'] ?? '',
        'lastname' => $_POST['lastname'] ?? '',
        'email' => $_POST['email'] ?? '',
        'contact' => $_POST['contact'] ?? '',
        'dob' => $_POST['dob'] ?? '',
        'blood_type' => $_POST['blood_type'] ?? '',
        'sex' => $_POST['sex'] ?? '',
        'address' => $_POST['address'] ?? ''
    ];
    
    // Debug: Show what we received
    error_log("Donor data received: " . print_r($data, true));
    
    // Validate input
    $errors = validateDonorInput($data);
    if (!empty($errors)) {
        error_log("Validation errors: " . implode('. ', $errors));
        echo json_encode(['success' => false, 'message' => implode('. ', $errors)]);
        exit;
    }
    
    // Try to add donor
    try {
        $result = addDonor($data);
        error_log("addDonor result: " . print_r($result, true));
        echo json_encode($result);
    } catch (Exception $e) {
        error_log("Exception in addDonor: " . $e->getMessage());
        error_log("Trace: " . $e->getTraceAsString());
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Donor Creation</title>
</head>
<body>
    <h1>Debug Donor Creation</h1>
    <form id="donorForm">
        <input type="hidden" name="action" value="add_donor">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        
        <div>
            <label>First name:</label>
            <input type="text" name="firstname" value="John">
        </div>
        <div>
            <label>Last name:</label>
            <input type="text" name="lastname" value="Doe">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="john.doe@example.com">
        </div>
        <div>
            <label>Contact:</label>
            <input type="tel" name="contact" value="09123456789">
        </div>
        <div>
            <label>Date of Birth:</label>
            <input type="date" name="dob" value="1990-01-01">
        </div>
        <div>
            <label>Blood Type:</label>
            <select name="blood_type">
                <option value="O+">O+</option>
            </select>
        </div>
        <div>
            <label>Sex:</label>
            <select name="sex">
                <option value="Male">Male</option>
            </select>
        </div>
        <div>
            <label>Address:</label>
            <input type="text" name="address" value="123 Test Street">
        </div>
        <button type="submit">Add Donor</button>
    </form>
    
    <div id="result"></div>

    <script>
    document.getElementById('donorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('debug_donor.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            console.log('Response:', data);
        })
        .catch(error => {
            document.getElementById('result').innerHTML = '<pre>Error: ' + error + '</pre>';
            console.error('Error:', error);
        });
    });
    </script>
</body>
</html>
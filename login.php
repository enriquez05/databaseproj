<?php
include('config/db.php');

// LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_user = $_POST['uname'];
    $password_uer = $_POST['psw'];

    // Validate user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username_user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Direct comparison if passwords are not hashed (not recommended)
        if ($password_uer === $user['password']) {
            $response = array(
                "user_id" => $user_id,
                "message" => "[SUCCESS] Login successful!"
            );
            echo json_encode($response);
        } else {
            $response = [
                "user_id" => '',
                "message" => "[ERROR] Incorrect username or password."
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            "user_id" => '',
            "message" => "[ERROR] Incorrect username or password."
        ];
        echo json_encode($response);
    }

    $stmt->close();
}

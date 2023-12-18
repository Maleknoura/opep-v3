<?php
include "config.Php";
class User extends Config
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->conn();
    }

    public function saveUser($userName, $userEmail, $userPassword, $roleId)
    {
        $insert = "INSERT INTO users (userName, userEmail, userPassword, roleId) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($insert);

        if ($stmt) {
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $stmt->bindParam(":name", $userName);
            $stmt->bindParam(":email", $userEmail);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":role", $roleId);

            $stmt->execute();
            $userId = $this->conn->lastInsertId();
            return $userId;
        } else {
            return "Error preparing statement: " . $this->conn->errorInfo()[2];
        }
    }

    public function loginUser($email, $password)
    {
        $select = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = $this->conn->prepare($select);
        $stmt->bindParam("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row["userId"];
            $userName = $row["userName"];
            $password_db = $row["userPassword"];
            $roleId = $row["roleId"];
            $isVerified = $row["isVerified"];

            if (password_verify($password, $password_db)) {
                switch ($roleId) {
                    case 1:
                        if ($isVerified == 1) {
                            // ... (code pour la redirection client)
                            return true;
                        } else {
                            return "Your account is locked, please contact support";
                        }
                        break;
                    case 2:
                        if ($isVerified == 1) {
                            // ... (code pour la redirection admin)
                            return true;
                        } else {
                            return "Account locked or disactivated, please contact your supervisor";
                        }
                        break;
                    case 3:
                        // ... (code pour la redirection admin)
                        return true;
                        break;
                    case 4:
                        // ... (code pour la redirection vers le rôle)
                        return true;
                        break;
                }
            } else {
                return 'Incorrect email or password';
            }
        } else {
            return 'Incorrect email or password';
        }
    }
}
?>

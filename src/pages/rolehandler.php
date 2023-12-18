<?php
include "user.php";
class RoleHandler extends User {
    public $conn;

    public function __construct()
    {
        $this->conn = $this->conn();
    }

    public function assignRole($userId, $roleId, $isVerified )
    {
        try {
            $update = "UPDATE users SET roleId = ?, isVerified = ? WHERE userId = ?";
            $stmt = $this->conn->prepare($update);

            if ($stmt) {
                $stmt->bindParam(":role", $userId);
                $stmt->bindParam(":role", $roleId);
                $stmt->bindParam(":role", $isVerified);

                $stmt->execute();
                $stmt->closeCursor();

               
                if ($roleId == 1) {
                    $insert = "INSERT INTO carts (userId) VALUES (?)";
                    $stmt = $this->conn->prepare($insert);

                    if ($stmt) {
                        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
                        $stmt->execute();
                        $stmt->closeCursor();
                    } 
                }

              
                $select = "SELECT * FROM users WHERE userId = ?";
                $stmt = $this->conn->prepare($select);
                $stmt->bindParam(1, $userId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                $userName = $result['userName'];

              
                $_SESSION['userId'] = $userId;

                if ($roleId == 1) {
                    // $_SESSION['client_cart'] = $cartId;
                    $_SESSION['client_name'] = $userName;
                } elseif ($roleId == 2) {
                    $_SESSION['admin_name'] = $userName;
                }

                return true;
            } else {
                return "Error preparing statement: " . implode(" ", $this->conn->errorInfo());
            }
        } catch (PDOException $e) {
            return "PDO Exception: " . $e->getMessage();
        }
    }
}

?>

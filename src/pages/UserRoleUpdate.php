<?php

class UserRoleUpdate
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateRole($role, $id)
    {
        try {
            $sql = "UPDATE users SET roleId = ? WHERE userId = ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                return "sqlerror";
            }

            $stmt->bindParam(1, $role, PDO::PARAM_INT);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->handleUserRole($role, $id);

            return "success";
        } catch (PDOException $e) {
            return "error";
        }
    }

    private function handleUserRole($role, $id)
    {
        session_start();

        if ($role == "1") {
            $_SESSION["admin"] = "admin";
            $sql = "SELECT userName FROM users WHERE userId = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION["name"] = $row["nom"];
                header("Location: ../pages/dashboard.php");
                exit();
            } else {
                echo "Error executing SQL: " . implode(" ", $stmt->errorInfo());
            }
        } elseif ($role == "2") {
            $this->createUserCart($id);
        }
    }

    private function createUserCart($id)
    {
        $sql = "INSERT INTO cart (userId) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            echo "error";
        } else {
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $lastInsertedID = $this->conn->lastInsertId();
            $_SESSION["panierId"] = $lastInsertedID;

            $_SESSION["client"] = "client";
            $_SESSION["idUser"] = $id;

            header("Location: ../pages/index.php");
            exit();
        }
    }
}

// Usage example:

if (isset($_POST["role-submit"])) {
    require "../Config/config.php";
   
    $role = $_POST["role"];
    session_start();
    $id = $_SESSION["userid"];

    if (empty($role)) {
        header("Location: ../pages/role.php?error=emptyfields");
        exit();
    } else {
        $userRoleUpdate = new UserRoleUpdate($conn);
        $result = $userRoleUpdate->updateRole($role, $id);

        switch ($result) {
            case "success":
                // No need to redirect here as it's handled in the updateRole method
                break;
            case "sqlerror":
                header("Location: ../pages/role.php?error=sqlerror");
                exit();
            default:
                header("Location: ../pages/role.php?error=" . $result);
                exit();
        }
    }
} else {
 echo"khalid";
}

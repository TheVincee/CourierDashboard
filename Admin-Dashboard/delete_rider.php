<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $query = $conn->prepare("DELETE FROM riders WHERE id = ?");
    if ($query->execute([$id])) {
        echo json_encode(["status" => "success", "message" => "Rider deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete rider!"]);
    }
}
?>

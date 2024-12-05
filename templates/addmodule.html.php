<form action="" method="post">
    <div>
        <label for="name">Module Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3" cols="50" required></textarea>
    </div>
    <input type="submit" name="submit" value="Add Module">
</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO modules (name, description) VALUES (:name, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'description' => $description]);
    
    echo "Module added successfully!";
}
?>
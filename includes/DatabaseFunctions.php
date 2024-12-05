<?php
include_once 'DatabaseConnection.php';
define('BASE_URL', '/COMP1841/Coursework');
define('UPLOAD_PATH', '/uploads');

function getAllUsers($pdo) {
    $sql = "SELECT * FROM users ORDER BY created_at DESC";
    return query($pdo, $sql)->fetchAll();
}

function getUser($pdo, $id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    return query($pdo, $sql, [':id' => $id])->fetch();
}

function addUser($pdo, $username, $email, $password, $is_admin = 0) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password, is_admin, created_at) VALUES (:username, :email, :password, :is_admin, NOW())";
    query($pdo, $sql, [':username' => $username, ':email' => $email, ':password' => $hash, ':is_admin' => $is_admin]);
}

function updateUser($pdo, $id, $username, $email, $is_admin) {
    $sql = "UPDATE users SET username = :username, email = :email, is_admin = :is_admin WHERE id = :id";
    query($pdo, $sql, [':id' => $id, ':username' => $username, ':email' => $email, ':is_admin' => $is_admin]);
}

function deleteUser($pdo, $userId) {
    try {
        $pdo->beginTransaction();

        $sql = "DELETE FROM comments WHERE user_id = :userId";
        query($pdo, $sql, [':userId' => $userId]);

        $sql = "DELETE FROM posts WHERE user_id = :userId";
        query($pdo, $sql, [':userId' => $userId]);

        $sql = "DELETE FROM messages WHERE user_id = :userId";
        query($pdo, $sql, [':userId' => $userId]);

        $sql = "DELETE FROM users WHERE id = :userId";
        query($pdo, $sql, [':userId' => $userId]);

        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function authenticateUser($pdo, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $user = query($pdo, $sql, [':username' => $username])->fetch();
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function getAllPosts($pdo) {
    $sql = "SELECT p.*, u.username, m.name AS module_name FROM posts p
            JOIN users u ON p.user_id = u.id
            JOIN modules m ON p.module_id = m.id
            ORDER BY p.created_at DESC";
    return query($pdo, $sql)->fetchAll();
}

function getPost($pdo, $id) {
    $stmt = $pdo->prepare('SELECT posts.*, users.username, modules.name AS module_name 
                           FROM posts 
                           JOIN users ON posts.user_id = users.id 
                           JOIN modules ON posts.module_id = modules.id 
                           WHERE posts.id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $post = $stmt->fetch();

    if ($post) {
        $post['image_url'] = $post['image_url'] ?? null;
        return $post;
    }
    return false;
}

function addPost($pdo, $title, $content, $user_id, $module_id, $image_url) {
    $sql = "INSERT INTO posts (title, content, user_id, module_id, image_url, created_at)
            VALUES (:title, :content, :user_id, :module_id, :image_url, NOW())";
    query($pdo, $sql, [
        ':title' => $title,
        ':content' => $content,
        ':user_id' => $user_id,
        ':module_id' => $module_id,
        ':image_url' => $image_url
    ]);
}

function updatePost($pdo, $id, $title, $content, $module_id, $image_url) {
    $sql = "UPDATE posts SET title = :title, content = :content, 
            module_id = :module_id, image_url = :image_url, 
            updated_at = NOW() WHERE id = :id";
    $parameters = [
        ':id' => $id,
        ':title' => $title,
        ':content' => $content,
        ':module_id' => $module_id,
        ':image_url' => $image_url
    ];
    query($pdo, $sql, $parameters);
}

function deletePost($pdo, $id) {
    $sql = "DELETE FROM posts WHERE id = :id";
    query($pdo, $sql, [':id' => $id]);
}

function getAllModules($pdo) {
    $sql = "SELECT * FROM modules";
    return query($pdo, $sql)->fetchAll();
}

function getModules($pdo) {
    $stmt = $pdo->query('SELECT * FROM modules ORDER BY name');
    return $stmt->fetchAll();
}

function getModule($pdo, $id) {
    $stmt = $pdo->prepare('SELECT * FROM modules WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function addModule($pdo, $name, $description) {
    $sql = "INSERT INTO modules (name, description) VALUES (:name, :description)";
    query($pdo, $sql, ['name' => $name, 'description' => $description]);
}

function updateModule($pdo, $id, $name, $description) {
    $sql = "UPDATE modules SET name = :name, description = :description WHERE id = :id";
    $parameters = [
        ':id' => $id,
        ':name' => $name,
        ':description' => $description
    ];
    query($pdo, $sql, $parameters);
}

function deleteModule($pdo, $moduleId) {
    try {
        $pdo->beginTransaction();

        $sql = "DELETE FROM posts WHERE module_id = :moduleId";
        query($pdo, $sql, [':moduleId' => $moduleId]);
        
        $sql = "DELETE FROM modules WHERE id = :moduleId";
        query($pdo, $sql, [':moduleId' => $moduleId]);

        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function getComments($pdo, $postId) {
    $sql = "SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = :post_id ORDER BY c.created_at DESC";
    return query($pdo, $sql, [':post_id' => $postId])->fetchAll();
}

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function getTotalPosts($pdo) {
    $sql = "SELECT COUNT(*) FROM posts";
    return query($pdo, $sql)->fetchColumn();
}

function getTotalUsers($pdo) {
    $sql = "SELECT COUNT(*) FROM users";
    return query($pdo, $sql)->fetchColumn();
}

function getTotalModules($pdo) {
    $sql = "SELECT COUNT(*) FROM modules";
    return query($pdo, $sql)->fetchColumn();
}
    function getRecentPosts($pdo, $limit) {
        $sql = "SELECT p.*, u.username, m.name AS module_name
                FROM posts p
                JOIN users u ON p.user_id = u.id
                JOIN modules m ON p.module_id = m.id
                ORDER BY p.created_at DESC
                LIMIT " . intval($limit);
        return query($pdo, $sql)->fetchAll();
    }

function registerUser($pdo, $username, $email, $password) {
    $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
    $existing = query($pdo, $sql, [':username' => $username, ':email' => $email])->fetch();
    
    if ($existing) {
        return "Username or email already exists";
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password, created_at) 
            VALUES (:username, :email, :password, NOW())";
    query($pdo, $sql, [':username' => $username, ':email' => $email, ':password' => $hash]);
    
    return true;
}

function addMessage($pdo, $user_id, $subject, $content) {
    $sql = "INSERT INTO messages (user_id, subject, content, status, created_at) 
            VALUES (:user_id, :subject, :content, 'unread', NOW())";
    $parameters = [
        ':user_id' => $user_id,
        ':subject' => $subject,
        ':content' => $content
    ];
    query($pdo, $sql, $parameters);
}

function getAllMessages($pdo) {
    $sql = "SELECT messages.*, users.username 
            FROM messages 
            JOIN users ON messages.user_id = users.id 
            ORDER BY messages.created_at DESC";
    return query($pdo, $sql);
}

function getUserProfile($pdo, $id) {
    $sql = "SELECT id, username, email, bio, profile_picture, social_media, created_at FROM users WHERE id = :id";
    return query($pdo, $sql, [':id' => $id])->fetch();
}

function updateUserProfile($pdo, $id, $username, $email, $bio, $profile_picture, $social_media) {
    $sql = "UPDATE users SET username = :username, email = :email, bio = :bio, profile_picture = :profile_picture, social_media = :social_media WHERE id = :id";
    query($pdo, $sql, [
        ':id' => $id,
        ':username' => $username,
        ':email' => $email,
        ':bio' => $bio,
        ':profile_picture' => $profile_picture,
        ':social_media' => json_encode($social_media)
    ]);
}

function addComment($pdo, $post_id, $user_id, $content, $image_url = null) {
    $sql = "INSERT INTO comments (post_id, user_id, content, image_url, created_at) VALUES (:post_id, :user_id, :content, :image_url, NOW())";
    query($pdo, $sql, [':post_id' => $post_id, ':user_id' => $user_id, ':content' => $content, ':image_url' => $image_url]);
}

function getCommentsForPost($pdo, $post_id) {
    $sql = "SELECT c.*, u.username, u.profile_picture FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.post_id = :post_id 
            ORDER BY c.created_at DESC";
    return query($pdo, $sql, [':post_id' => $post_id])->fetchAll();
}

function deleteMessage($pdo, $messageId) {
    $sql = "DELETE FROM messages WHERE id = :id";
    query($pdo, $sql, [':id' => $messageId]);
}

function markMessageAsRead($pdo, $messageId) {
    $sql = "UPDATE messages SET status = 'read' WHERE id = :id";
    query($pdo, $sql, [':id' => $messageId]);
}

function getMessageById($pdo, $messageId) {
    $sql = "SELECT messages.*, users.username 
            FROM messages 
            JOIN users ON messages.user_id = users.id 
            WHERE messages.id = :id";
    $parameters = [':id' => $messageId];
    $stmt = query($pdo, $sql, $parameters);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getImageUrl($imagePath) {
    return BASE_URL . '/' . ltrim($imagePath, './');
}

function getTotalMessages($pdo) {
    $sql = "SELECT COUNT(*) FROM messages";
    return query($pdo, $sql)->fetchColumn();
}
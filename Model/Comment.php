<?php

namespace Model;

use Core\Database;
use PDO;

class Comment
{
    // 1. Lấy danh sách comment cho Admin (có phân trang + JOIN news)
    public static function getAll($limit, $offset)
    {
        $db = Database::getInstance()->getConnection();

        $sql = "
            SELECT c.*, n.title AS news_title
            FROM comments c
            LEFT JOIN news n ON c.news_id = n.id
            ORDER BY c.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Đếm tổng comment
    public static function count()
    {
        $db = Database::getInstance()->getConnection();
        return (int)$db->query("SELECT COUNT(*) FROM comments")->fetchColumn();
    }

    // 3. Lấy comment theo bài viết (chỉ approved)
    public static function getByNewsId($news_id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            SELECT *
            FROM comments
            WHERE news_id = :news_id AND status = 'approved'
            ORDER BY created_at DESC
        ");

        $stmt->execute([':news_id' => (int)$news_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Tạo mới comment — mặc định pending
    public static function create($data)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            INSERT INTO comments (news_id, name, email, content, status)
            VALUES (:news_id, :name, :email, :content, 'pending')
        ");

        return $stmt->execute([
            ':news_id' => $data['news_id'],
            ':name'    => $data['name'],
            ':email'   => $data['email'],
            ':content' => $data['content'],
        ]);
    }

    // 5. Tìm comment theo ID
    public static function findById($id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM comments WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => (int)$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 6. Approve comment
    public static function approve($id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("UPDATE comments SET status = 'approved' WHERE id = :id");
        return $stmt->execute([':id' => (int)$id]);
    }

    // 7. Reject comment
    public static function reject($id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("UPDATE comments SET status = 'rejected' WHERE id = :id");
        return $stmt->execute([':id' => (int)$id]);
    }

    // 8. Xóa comment
    public static function delete($id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("DELETE FROM comments WHERE id = :id");
        return $stmt->execute([':id' => (int)$id]);
    }
}

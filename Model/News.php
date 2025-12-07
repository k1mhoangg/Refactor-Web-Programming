<?php

namespace Model;

use Core\Database;
use PDO;

class News
{
    // Lấy tất cả bài viết (Admin)
    public static function getAll($limit, $offset)
    {
        $db = Database::getInstance()->getConnection();
        
        $stmt = $db->prepare("
            SELECT id, title, slug, summary, image_url, created_at, is_published
            FROM news
            ORDER BY created_at DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tất cả bài viết đã xuất bản
    public static function count()
    {
        $db = Database::getInstance()->getConnection();
        return (int) $db->query("SELECT COUNT(*) FROM news WHERE is_published = 1")->fetchColumn();
    }

    // Lấy tin nổi bật
    public static function getHighlight($limit = 3)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT title, slug
            FROM news
            WHERE is_published = 1
            ORDER BY created_at DESC
            LIMIT :limit
        ");
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm bài viết theo slug
    public static function findBySlug($slug)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM news WHERE slug = :slug LIMIT 1");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy bài viết liên quan
    public static function getRelated($slug, $limit = 4)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT title, slug, image_url 
            FROM news 
            WHERE slug != :slug AND is_published = 1 
            ORDER BY created_at DESC 
            LIMIT :limit
        ");
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm bài viết theo ID
    public static function findById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM news WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // === PHẦN SEARCH / PHÂN TRANG ===
    public static function getPublished($limit, $offset, $keyword = '')
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT id, title, slug, summary, image_url, created_at, is_published 
                FROM news 
                WHERE is_published = 1";
        
        $stmt = $db->prepare($sql . (!empty($keyword) ? " AND (title LIKE :keyword1 OR summary LIKE :keyword2)" : "") . " ORDER BY created_at DESC LIMIT :limit OFFSET :offset");

        if (!empty($keyword)) {
            $stmt->bindValue(':keyword1', "%$keyword%", PDO::PARAM_STR);
            $stmt->bindValue(':keyword2', "%$keyword%", PDO::PARAM_STR);
        }
        // Bind LIMIT và OFFSET kiểu int
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countPublished($keyword = '')
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) FROM news WHERE is_published = 1";

        if (!empty($keyword)) {
            $sql .= " AND (title LIKE :keyword1 OR summary LIKE :keyword2)";
        }

        $stmt = $db->prepare($sql);

        if (!empty($keyword)) {
            $stmt->bindValue(':keyword1', "%$keyword%", PDO::PARAM_STR);
            $stmt->bindValue(':keyword2', "%$keyword%", PDO::PARAM_STR);
        }

        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}

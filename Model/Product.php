<?php
namespace Model;

use \Core\Database;
use \PDO;
use \Exception;

class Product
{
    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO products (name, description, price, discount_price, category, stock, image_url, is_featured, is_active) VALUES (:name,:description,:price,:discount_price,:category,:stock,:image_url,:is_featured,:is_active)");
        $stmt->execute([
            ':name' => $data['name'] ?? '',
            ':description' => $data['description'] ?? '',
            ':price' => $data['price'] ?? 0,
            ':discount_price' => $data['discount_price'] ?? null,
            ':category' => $data['category'] ?? null,
            ':stock' => $data['stock'] ?? 0,
            ':image_url' => $data['image_url'] ?? null,
            ':is_featured' => !empty($data['is_featured']) ? 1 : 0,
            ':is_active' => isset($data['is_active']) ? (int) $data['is_active'] : 1,
        ]);
        return (int) $db->lastInsertId();
    }

    public static function updateById(int $id, array $data): bool
    {
        $allowed = ['name', 'description', 'price', 'discount_price', 'category', 'stock', 'image_url', 'is_featured', 'is_active'];
        $sets = [];
        $params = [':id' => $id];
        foreach ($data as $k => $v) {
            if (!in_array($k, $allowed))
                continue;
            $sets[] = "`$k` = :$k";
            if ($k === 'is_featured' || $k === 'is_active')
                $v = $v ? 1 : 0;
            $params[":$k"] = $v;
        }
        if (empty($sets))
            return false;
        $sql = "UPDATE products SET " . implode(', ', $sets) . " WHERE id = :id";
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function deleteById(int $id): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}

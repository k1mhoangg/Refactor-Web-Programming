<?php
namespace Model;

use \Core\Database;
use \PDO;
use \Exception;

class Page
{
    private $id;
    private $slug;
    private $title;
    private $content;
    private $meta;

    public function __construct($slug, $title, $content, $meta = null, $id = null)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->content = $content;
        $this->meta = $meta;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getMeta()
    {
        return $this->meta;
    }

    public static function all()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT id, slug, title, content, meta, created_at, updated_at FROM pages ORDER BY updated_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, slug, title, content, meta, created_at, updated_at FROM pages WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function findBySlug(string $slug)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, slug, title, content, meta, created_at, updated_at FROM pages WHERE slug = :slug LIMIT 1");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function create(array $data): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO pages (slug, title, content, meta) VALUES (:slug, :title, :content, :meta)");
        return $stmt->execute([
            ':slug' => $data['slug'],
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':meta' => $data['meta'] ?? null
        ]);
    }

    public static function updateById(int $id, array $data): bool
    {
        $allowed = ['slug', 'title', 'content', 'meta'];
        $sets = [];
        $params = [':id' => $id];
        foreach ($data as $k => $v) {
            if (!in_array($k, $allowed))
                continue;
            $sets[] = "`$k` = :{$k}";
            $params[":{$k}"] = $v;
        }
        if (empty($sets))
            return false;
        $sql = "UPDATE pages SET " . implode(', ', $sets) . " WHERE id = :id";
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public static function deleteById(int $id): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM pages WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}

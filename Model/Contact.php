<?php


namespace Model;

use \Core\Database;

class Contact
{
    private $name;
    private $email;
    private $message;
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMessage()
    {
        return $this->message;
    }

    public function save()
    {
        $db = Database::getInstance()->getConnection();
        // Validation and sanitization content
        $this->name = filter_var($this->name, FILTER_SANITIZE_STRING);
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $this->message = filter_var($this->message, FILTER_SANITIZE_STRING);

        $stmt = $db->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':message', $this->message);
        return $stmt->execute();
    }

    public static function getAll()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM contacts");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function test()
    {
        echo "<div>Contact model test method called.</div>";
    }
}
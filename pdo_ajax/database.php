<?php
class database
{
   private $dsn = "mysql:host=localhost;dbname=pdo_ajax";
   private $user = "root";
   private $pass = "";
   public $conn;

   public function __construct()
   {
      try {
         $this->conn = new PDO($this->dsn, $this->user, $this->pass);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         echo 'ERROR: ' . $e->getMessage();
      }
   }

   public function insert($fname, $lname, $email, $phone)
   {
      $sql = "INSERT INTO users (first_name, last_name, email, phone) VALUES (:fname, :lname, :email, :phone)";
      $pre = $this->conn->prepare($sql);
      $pre->bindParam(':fname', $fname, PDO::PARAM_STR);
      $pre->bindParam(':lname', $lname, PDO::PARAM_STR);
      $pre->bindParam(':email', $email, PDO::PARAM_STR);
      $pre->bindParam(':phone', $phone, PDO::PARAM_INT);
      $pre->execute();
      return true;
   }

   public function read()
   {
      $data = array();
      $sql = "SELECT * FROM users";
      $pre = $this->conn->prepare($sql);
      $pre->execute();
      // $result = $pre->fetchAll(PDO::FETCH_ASSOC);
      // foreach ($result as $row) {
      //    $data[] = $row;
      // }
      while ($result = $pre->fetchAll(PDO::FETCH_ASSOC)) {
         $data = $result;
      }
      // echo '<pre>';
      return ($data);
      // echo '</pre>';
   }

   public function update($id, $fname, $lname, $email, $phone)
   {
      $sql = "UPDATE users SET first_name=:fname, last_name=:lname, email=:email, phone=:phone WHERE id=:id";
      $pre = $this->conn->prepare($sql);
      $pre->bindParam(':id', $id, PDO::PARAM_INT);
      $pre->bindParam(':fname', $fname, PDO::PARAM_STR);
      $pre->bindParam(':lname', $lname, PDO::PARAM_STR);
      $pre->bindParam(':email', $email, PDO::PARAM_STR);
      $pre->bindParam(':phone', $phone, PDO::PARAM_STR);
      $pre->execute();
      return true;
   }

   public function delete($id)
   {
      $sql = "DELETE FROM users WHERE id=:id";
      $pre = $this->conn->prepare($sql);
      $pre->bindParam(':id', $id, PDO::PARAM_INT);
      $pre->execute();
      return true;
   }

   public function getUserId($id)
   {
      $sql = "SELECT * FROM users WHERE id=:id";
      $pre = $this->conn->prepare($sql);
      $pre->bindParam(':id', $id, PDO::PARAM_INT);
      $pre->execute();
      $result = $pre->fetch(PDO::FETCH_ASSOC);
      // print_r($result);
      return $result;
   }

   public function totalCountRow()
   {
      $sql = "SELECT * FROM users";
      $pre = $this->conn->prepare($sql);
      $pre->execute();
      $count = $pre->rowCount();
      return $count;
   }
}
// $ob = new database();
// $ob->insert('nhat', 'thang', 'thangnhat@gmail.com', 01234123);
// $ob->update(19, 'hop', 'hop12', 'hop@gmail.com', '0123123123');
// $ob->delete(19);
// $ob->getUserId(18);
// $ob->totalCountRow();
// $ob->read();

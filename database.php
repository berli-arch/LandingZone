<?php
  function write($street, $city, $postal, $state_id, $uid, $gender, $name, $surname, $birthdate, $address_id, $email, $phone, $hash, $image_hash) {
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "";
    $dbname = "account";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $prepare = $conn->prepare("INSERT INTO address (address_id, street, city, postal, state_id)
        VALUES (:address_id, :street, :city, :postal, :state_id)");
      $prepare->bindParam(':address_id', $address_id);
      $prepare->bindParam(':street', $street);
      $prepare->bindParam(':city', $city);
      $prepare->bindParam(':postal', $postal);
      $prepare->bindParam(':state_id', $state_id);

      echo "Address parameter binding successfull<br>";
      $prepare->execute();
      echo "Execution successfull<br>";

      $prepare = $conn->prepare("INSERT INTO user (uid, gender, name, surname, birthdate, address_id, email, phone, hash, image_hash)
        VALUES (:uid, :gender, :name, :surname, :birthdate, :address_id, :email, :phone, :hash, :image_hash)");
      $prepare->bindParam(':uid', $uid);
      $prepare->bindParam(':gender', $gender);
      $prepare->bindParam(':name', $name);
      $prepare->bindParam(':surname', $surname);
      $prepare->bindParam(':birthdate', $birthdate);
      $prepare->bindParam(':address_id', $address_id);
      $prepare->bindParam(':email', $email);
      $prepare->bindParam(':phone', $phone);
      $prepare->bindParam(':hash', $hash);
      $prepare->bindParam(':image_hash', $image_hash);

      echo "User parameter binding successfull<br>";
      $prepare->execute();
      echo "Successfully executed<br>";

    } catch(PDOException $e) {
      echo "Execution failed<br>";

      print_r($e->errorInfo);
    }
  }

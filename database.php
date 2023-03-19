<!--
  LandingZone
  Marcel.BERLINGER
  17.03.2023
  v0.1

  Handles the database communication
-->

<?php
  function createConn() {
    $conn = null;

    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "";
    $dbname = "account";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    }

    return $conn;
  }

  function write($street, $city, $postal, $state_id, $uid, $gender, $name, $surname, $birthdate, $address_id, $email, $phone, $hash, $image_hash) {
    $success = false;
    try {
      $conn = createConn();
      if($conn == null) {
        return false;
      }

      $prepare = $conn->prepare("INSERT INTO address (address_id, street, city, postal, state_id)
        VALUES (:address_id, :street, :city, :postal, :state_id)");
      $prepare->bindParam(':address_id', $address_id);
      $prepare->bindParam(':street', $street);
      $prepare->bindParam(':city', $city);
      $prepare->bindParam(':postal', $postal);
      $prepare->bindParam(':state_id', $state_id);

      //echo "Address parameter binding successfull<br>";
      $prepare->execute();
      //echo "Execution successfull<br>";

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

      //echo "User parameter binding successfull<br>";
      $prepare->execute();
      //echo "Successfully executed<br>";

      $success = true;
    } catch(PDOException $e) {
      //echo $e->getMessage();
    }


    return $success;
  }

  function checkUserHash($hash) {
    $correct = false;
    if(isset($hash)) {
      try {
        $conn = createConn();
        if(!$conn) {
          return false;
        }

        $prepare = $conn->prepare("SELECT hash FROM user
            WHERE hash = :hash");
        $prepare->bindParam(':hash', $hash);

        $prepare->execute();

        $array = $prepare->fetchAll();
        if(count($array) > 0) {
          $correct = true;
        }
      } catch(PDOException $e) {
      }
    }

    return $correct;
  }

  function getUserInfo($hash) {
    if(isset($hash)) {
      try {
        $conn = createConn();
        if (!$conn) {
          return false;
        }

        $prepare = $conn->prepare("SELECT gender, name, surname, birthdate, email, phone FROM user
            WHERE hash = :hash");
        $prepare->bindParam(':hash', $hash);

        $prepare->execute();

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
      }
    }

    return null;
  }

  function getUserImage($hash) {
    if(isset($hash)) {
      try {
        $conn = createConn();
        if (!$conn) {
          return false;
        }

        $prepare = $conn->prepare("SELECT image_hash FROM user
            WHERE hash = :hash");
        $prepare->bindParam(':hash', $hash);

        $prepare->execute();

        return $prepare->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
      }
    }

    return null;
  }

  function getNextUID() {
    $next_uid = null;

    try {
      $conn = createConn();
      if (!$conn) {
        return false;
      }

      $prepare = $conn->prepare("SELECT MIN(u.uid + 1) as uid FROM user u
            LEFT JOIN user u2 ON u2.uid = u.uid + 1
            WHERE u2.uid IS NULL");

      $prepare->execute();

      $row = $prepare->fetchAll(PDO::FETCH_ASSOC)[0];
      foreach($row as $col) {
        $next_uid = $col;
      }
    } catch(PDOException $e) {
      //echo $e->getMessage();
    }

    return $next_uid;
  }

  function getNextAddressID() {
    $next_address_id = null;

    try {
      $conn = createConn();
      if (!$conn) {
        return false;
      }

      $prepare = $conn->prepare("SELECT MIN(a.address_id + 1) FROM address a
            LEFT JOIN address a2 ON a2.address_id = a.address_id + 1
            WHERE a2.address_id IS NULL");

      $prepare->execute();

      $row = $prepare->fetchAll(PDO::FETCH_ASSOC)[0];
      foreach($row as $col) {
        $next_address_id = $col;
      }
    } catch(PDOException $e) {
      //echo $e->getMessage();
    }

    return $next_address_id;
  }

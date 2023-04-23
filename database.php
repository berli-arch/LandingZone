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

    $servername = "bm2023.mysql.database.azure.com";
    $username = "bm2023";
    $password = "Lbs4ever.";
    $dbname = "account";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo $e;
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

      // Checking if the user already exists in the database
      $prepare = $conn->prepare("SELECT gender, name, surname, birthdate, email, phone, hash, image_hash FROM user
        WHERE gender = :gender AND name = :name AND surname = :surname AND birthdate = :birthdate AND email = :email
        AND phone = :phone AND hash = :hash AND image_hash = :image_hash");
      $prepare->bindParam(':gender', $gender);
      $prepare->bindParam(':name', $name);
      $prepare->bindParam(':surname', $surname);
      $prepare->bindParam(':birthdate', $birthdate);
      $prepare->bindParam(':email', $email);
      $prepare->bindParam(':phone', $phone);
      $prepare->bindParam(':hash', $hash);
      $prepare->bindParam(':image_hash', $image_hash);

      $prepare->execute();
      /*$info = $prepare->errorInfo();
      if($info[0] != '0000'
        || $info[1] != ''
        || $info[2] != '') {
        return false;
      }*/

      $rows = $prepare->fetchAll(PDO::FETCH_ASSOC);
      if(!empty($rows)) {
        return false;
      }

      // Checking if the address already exists in the database
      $prepare = $conn->prepare("SELECT street, city, postal FROM address
        WHERE street = :street AND city = :city AND postal = :postal");
      $prepare->bindParam(':street', $street);
      $prepare->bindParam(':city', $city);
      $prepare->bindParam(':postal', $postal);

      $prepare->execute();
      /*$info = $prepare->errorInfo();
      if($info[0] != '0000'
        || $info[1] != ''
        || $info[2] != '') {
        return false;
      }*/

      $rows = $prepare->fetchAll(PDO::FETCH_ASSOC);
      if(!empty($rows)) {
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
      // echo $e->getMessage();
    }

    return $success;
  }

  function checkUserHash($hash) {
    echo "Checking user hash..";

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
        // echo $e->getMessage();
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
        // echo $e->getMessage();
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
        $e->getMessage();
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
      echo $e->getMessage();
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

<?php


class Database{
    var $dbh;

    function __construct()
    {
        try
        {
            /** Please refer to config.php for the values of DB_HOST, DB_NAME, DB_USERNAME and DB_PASSWORD */
            $this->dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $e) {
            echo "Database connection failed";
            die();
        }
    }

    function get_left($lang){
      try{
        $returnData = array();
        $stmt = $this->dbh->prepare("SELECT * FROM $lang ORDER BY Status ASC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass();
            $obj->word = $row["Word"];
            $obj->meaning = $row["Meaning"];
            $obj->status = $row["Status"];
            $obj->timestamp = $row["Timestamp"];
            $returnData[] = $obj;
        }
        return $returnData;
    }catch (PDOException $e){
        echo "get_locations failed.";
        die();
    }
    }

    function get_lang(){
      try{
        $returnData = array();
        $stmt = $this->dbh->prepare("SELECT * FROM languages");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass();
            $obj->language = $row["language"];
            $returnData[] = $obj;
        }
        return $returnData;

      }catch (PDOException $e){
          echo "get_locations failed.";
          die();
    }
  }

    function group_exists($group){
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM sessions WHERE room=:room");
            $stmt->bindParam(':room', $group);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "group_exists failed.";
            die();
        }
    }

    function session_exists($user, $group){
        try {
            $stmt = $this->dbh->prepare("SELECT * FROM sessions WHERE room=:room AND user=:user");
            $stmt->bindParam(':room', $group);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "session_exists failed.";
            die();
        }
    }

    function navigation_exists($group){
      try{
        $stmt = $this->dbh->prepare("SELECT * FROM navigation WHERE room=:room");
        $stmt->bindParam(":room",$group);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
      }catch(PDOException $e){
          echo "navigation_exists failed.";
          die();
      }
    }

    function update_location($user, $group, $latlng, $name, $message){
        try {
            if($this->session_exists($user, $group)){
                $stmt = $this->dbh->prepare("UPDATE sessions SET user=:user, room=:room, latlng=:latlng, name=:name, messages=:messages, timestamp=CURRENT_TIMESTAMP WHERE room=:room AND user=:user");
            } else {
                $stmt = $this->dbh->prepare("INSERT INTO sessions (room, user, name, latlng, messages) VALUES (:room, :user, :name, :latlng, :messages)");
            }
            $stmt->bindParam(":user", $user);
            $stmt->bindParam(":room", $group);
            $stmt->bindParam(":latlng", $latlng);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":messages", $message);
            $stmt->execute();
        }catch(PDOException $e){
            echo "update_location failed.";
            die();
        }
    }

    function get_locations($user, $group, $includeCurrentUser = false){
        try {
            $returnData = array();
            if ($includeCurrentUser){
                $stmt = $this->dbh->prepare("SELECT * FROM sessions WHERE room=:room");
            }
            else{
                $stmt = $this->dbh->prepare("SELECT * FROM sessions WHERE room=:room AND user <> :user");
                $stmt->bindParam(":user", $user);
            }
            $stmt->bindParam(":room", $group);

            $stmt->execute();
            //$stmt->bind_result($id, $token, $calendarid);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $obj = new stdClass();
                $obj->user = $row["user"];
                $obj->name = $row["name"];
                $obj->latlng = $row["latlng"];
                $obj->messages = $row["messages"];
                $returnData[] = $obj;
            }
            return $returnData;
        }catch (PDOException $e){
            echo "get_locations failed.";
            die();
        }
    }

    function set_navigation($group,$latlng){
      try{
        if($this->navigation_exists($group)){
            $stmt = $this->dbh->prepare("UPDATE navigation SET room=:room, latlng=:latlng, timestamp=CURRENT_TIMESTAMP WHERE room=:room");
        } else {
            $stmt = $this->dbh->prepare("INSERT INTO navigation (room, latlng) VALUES (:room,:latlng)");
        }
        $stmt->bindparam(":room",$group);
        $stmt->bindparam(":latlng",$latlng);
        $stmt->execute();
      }catch(PDOException $e){
          echo "set_navigation failed.";
          die();
      }
    }

    function get_navigation($group){
      try{
        $returnData;
        $stmt = $this->dbh->prepare("SELECT * FROM navigation WHERE room=:room");
        $stmt->bindParam(":room",$group);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $returnData = $row["latlng"];
          }
          return $returnData;
        }
        else{
          return false;
        }

        }catch (PDOException $e){
            echo "get_navigation failed.";
            die();
        }
      }

    function delete_old_locations(){
        try {
            $stmt = $this->dbh->prepare("DELETE FROM sessions WHERE timestamp < (NOW() - INTERVAL 10 SECOND)");
            $stmt->execute();
            $stmt = $this->dbh->prepare("DELETE FROM navigation WHERE timestamp < (NOW() - INTERVAL 6 HOUR)");
            $stmt->execute();
        }catch (PDOException $e){
            echo "delete_old_locations failed.";
            die();
        }
    }

    function add_user($userID, $userPass){
        try {
            $stmt = $this->dbh->prepare("INSERT INTO users (userid, userpass) VALUES (:userid, :userpass)");
            $stmt->bindParam(':userid', $userID);
            $stmt->bindParam(':userpass', $userPass);
            $stmt->execute();
        }catch(PDOException $e){
            echo "add_user failed.";
            die();
        }
    }

    function valid_user($userID, $userPass){
        $stmt = $this->dbh->prepare("SELECT * FROM users WHERE userid = :userid ");
        $stmt->bindParam(':userid', $userID);
        $stmt->execute();
        $stmtArray = $stmt->fetch();
        if($stmtArray["userpass"] == $userPass){
            return true;
        } else {
            return false;
        }
    }
}

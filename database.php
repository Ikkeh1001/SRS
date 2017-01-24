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
        $stmt = $this->dbh->prepare("SELECT * FROM languages ORDER BY language ASC");
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

  function set_word($lang,$word,$meaning,$status,$timestamp){
    try{
      if($this->word_exists($lang,$word)){
        $stmt = $this->dbh->prepare("UPDATE $lang SET word=:word, meaning=:meaning, status=:status, timestamp=:timestamp WHERE word=:word");
      }
      else{
      $stmt = $this->dbh->prepare("INSERT INTO $lang (word, meaning, status, timestamp) VALUES (:word, :meaning, :status, :timestamp)");
    }

      $stmt->bindParam(':word', $word);
      $stmt->bindParam(':meaning', $meaning);
      $stmt->bindParam(':status', $status);
      $stmt->bindParam(':timestamp', $timestamp);
      $stmt->execute();
    }catch (PDOException $e){
        echo "get_locations failed.";
        die();
  }
}

function update_status($lang,$word,$status,$timestamp){
  try{
    $stmt = $this->dbh->prepare("UPDATE $lang SET status=:status, timestamp=:timestamp WHERE word=:word");
    $stmt->bindParam(':word', $word);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->execute();
  }catch (PDOException $e){
      echo "get_locations failed.";
      die();
}
}

  function set_lang($lang){
    try{
      if($this->lang_exists($lang)){
      die();
    }
    else{
    $stmt = $this->dbh->prepare("INSERT INTO languages (language) VALUES (:language)");
    $stmt->bindParam(':language', $lang);
    $stmt->execute();
    $stmt = $this->dbh->prepare("CREATE TABLE $lang (
      `Id` int(6) NOT NULL AUTO_INCREMENT,
      `Word` varchar(40) NOT NULL,
      `Meaning` varchar(100) NOT NULL,
      `Status` varchar(4) NOT NULL,
      `Timestamp` bigint(20) NOT NULL,
      PRIMARY KEY (`Id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
    $stmt->execute();
  }

  }catch (PDOException $e){
      echo "get_locations failed.";
      die();
}
}

    function word_exists($lang,$word){
      try {
        $stmt = $this->dbh->prepare("SELECT * FROM $lang WHERE word=:word");
        $stmt->bindParam(':word', $word);
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

  function lang_exists($lang){
    try {
      $stmt = $this->dbh->prepare("SELECT * FROM languages WHERE language=:lang");
      $stmt->bindParam(':lang', $lang);
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

}

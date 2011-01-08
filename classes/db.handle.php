<?php
class Db_handle
{
  function __construct($config="") {
    $this->config = $config;
    $this->connect();

    if(!$this->connection) {
      $err = 'failed to connect to server ' . $this->config['server'] . '<br />';
      
      echo $err;
    }

    mysql_select_db($this->config["db_name"], $this->connection);
  }

  public function connect() {
    $this->connection = mysql_connect($this->config['server'], $this->config['username'], $this->config['password']);

    return $this->connection;
  }

  public function get($table, $req, $where, $val) {
    if($table) {
    /* tests last two params to see whether a condition is necessary */
      if($where && $val) {
        /* if last two exist then run this query */
        $query = mysql_query("SELECT " . $req . " FROM " . $table . " WHERE " . $where . " = '" . $val . "'");
      } else {
        /* else run this query */
        $query = mysql_query("SELECT " . $req . " FROM " . $table);
      }

      while($row = mysql_fetch_assoc($query)) {
        /* return the query results */
        $results[] = $row;
      }

      return $results;
    }
  }

  public function createUser($table, $username, $password, $email) {
    if($table && $username && $password) {
      mysql_query("INSERT INTO " . $table . " (username, password, email) VALUES ('" . $username . "','" . $password . "','" . $email . "')");
      return true;
    } else {
      return false;
    }
  }

  public function validator($table, $testagainst, $tester, $errmsg) {
    if($table && $testagainst && $tester) {
      $check = mysql_query("SELECT * FROM " . $table . " WHERE " . $testagainst . " = '" . $tester . "'");

      if(mysql_fetch_assoc($check)) {
        return false;
      } else {
        return true;
      }
    }
  }
}

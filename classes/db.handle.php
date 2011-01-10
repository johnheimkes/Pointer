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

  public function get($table, $req, $where, $val, $order, $order_by) {
    if($table && $req) {
    /* tests last two params to see whether a condition is necessary */
      if($where && $val && $order && $order_by) {
        $query = mysql_query("SELECT " . $req . " FROM " . $table . " WHERE " . $where . " = '" . $val . "' ORDER BY " . $order . " " . $order_by);
      } else if($where && $val) {
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

  public function get_two_cond($table, $req, $where1, $val1, $where2, $val2) {
    if($table && $req && $where1 && $val1 && $where2 && $val2) {
      $query = mysql_query("SELECT " . $req . " FROM " . $table . " WHERE " . $where1 . " = '" . $val1 . "' AND " . $where2 . " = '" . $val2 . "'");

      while($row = mysql_fetch_assoc($query)) {
        $res[] = $row;
      }

      return $res;
    }
  }

  public function check_user($table, $user_field, $name, $pass_field, $pass) {
    if($table && $name && $pass) {
      $query = mysql_query("SELECT * FROM " . $table . " WHERE " . $user_field . " = '" . $name . "' AND " . $pass_field . " = '" . $pass . "'");

      if(mysql_fetch_assoc($query)) {
        return true;
      } else {
        return false;
      }
    }
  }

  public function create_user($table, $username, $password, $email) {
    if($table && $username && $password) {
      mysql_query("INSERT INTO " . $table . " (username, password, email) VALUES ('" . $username . "','" . $password . "','" . $email . "')");
      return true;
    } else {
      return false;
    }
  }

  public function update($table, $user, $name, $val) {
    if($table && $user && $name && $val) {
      mysql_query("UPDATE " . $table . " SET value='" . $val . "' WHERE creator='" . $user . "' AND name='" . $name . "'");
    }
  }

  public function validate_uniqueness($table, $testagainst, $tester) {
    if($table && $testagainst && $tester) {
      $check = mysql_query("SELECT * FROM " . $table . " WHERE " . $testagainst . " = '" . $tester . "'");

      if(mysql_fetch_assoc($check)) {
        return false;
      } else {
        return true;
      }
    }
  }

  public function validate_email($addr) {
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $addr)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
      return false;
    }

    $email_array = explode("@", $addr);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
      if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
        return false;
      }
    }
  
    // Check if domain is IP. If not, 
    // it should be valid domain name
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
      $domain_array = explode(".", $email_array[1]);
      if (sizeof($domain_array) < 2) {
          return false; // Not enough parts to domain
      }
      for ($i = 0; $i < sizeof($domain_array); $i++) {
        if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
          return false;
        }
      }
    }
    return true;
  }

  public function create_person($table, $field, $value) {
    if($table && $field && $value) {
      
    } else {
      return false;
    }
  }
}

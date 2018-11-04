<?php

class User {
   private $id = 0;
   private $ign = "";
   private $uuid = "";
   private $password = "";
   private $firstname = "";
   private $lastname = "";
   private $admin = false;
   // createtime will be stored in the class using the native SQL datetime format
   private $createtime = "";
   // lastlogin will be stored in the class using the native SQL datetime format
   private $lastlogin = "";
   // lastbadlogin will be stored in the class using the native SQL datetime format
   private $lastbadlogin = "";
   private $badlogincount = 0;
   // lastupdate will be stored in the class using the native SQL datetime format
   private $lastupdate = "";
   private $acl_status = false;
   private $acl_console = false;
   private $acl_graves = false;
   private $acl_screen = false;
   private $acl_files = false;
   private $acl_players = false;

   public function getID() {
      return intval($this->id);
   }

   public function getIGN($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->ign);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->ign, ENT_QUOTES);
            break;
         default:
            return $this->ign;
            break;
      }
   }

   public function getUUID($flag = 0) {
      return $this->uuid;
   }

   public function getFirstName($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->firstname);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->firstname, ENT_QUOTES);
            break;
         default:
            return $this->firstname;
            break;
      }
   }

   public function getLastName($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->lastname);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->lastname, ENT_QUOTES);
            break;
         default:
            return $this->lastname;
            break;
      }
   }

   public function getFullName($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->firstname . " " . $this->lastname);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->firstname . " " . $this->lastname, ENT_QUOTES);
            break;
         default:
            return $this->firstname . " " . $this->lastname;
            break;
      }
   }

   public function getPhone($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->phone);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->phone, ENT_QUOTES);
            break;
         default:
            return $this->phone;
            break;
      }
   }

   public function getAdmin($flag = 0) {
      switch ($flag) {
         case BOOLEANDB:
            return ($this->admin) ? "true" : "false";
            break;
         default:
            return $this->admin;
            break;
      }
   }

   public function getAccountType($flag = 0) {
      switch ($flag) {
         case ACCOUNTTYPEPRETTY:
            return VALID_ACCOUNTTYPES[$this->accounttype];
            break;
         default:
            return $this->accounttype;
            break;
      }
   }

   public function getHowHear($flag = 0) {
      switch ($flag) {
         case HTMLSAFE:
            return htmlspecialchars($this->howhear);
            break;
         case HTMLFORMSAFE:
            return htmlspecialchars($this->howhear, ENT_QUOTES);
            break;
         default:
            return $this->howhear;
            break;
      }
   }

   public function isAdmin() {
      return $this->admin;
   }

   public function isJobSeeker() {
      if ( $this->getAccountType() == "jobseeker" ) {
         return true;
      } else {
         return false;
      }
   }

   public function isSkillSeeker() {
      if ( $this->getAccountType() == "company" ) {
         return true;
      } else {
         return false;
      }
   }

   public function getCreateTime($flag = 0) {
      switch ($flag) {
         case TIMESTAMP:
            return strtotime($this->createtime);
            break;
         case PRETTY:
            return date("F j Y H:i:s", strtotime($this->createtime));
            break;
         default:
            return $this->createtime;
            break;
      }
   }

   public function getLastLogin($flag = 0) {
      switch ($flag) {
         case TIMESTAMP:
            return strtotime($this->lastlogin);
            break;
         case PRETTY:
            return date("F j Y H:i:s", strtotime($this->lastlogin));
            break;
         default:
            return $this->lastlogin;
            break;
      }
   }

   public function getLastBadLogin($flag = 0) {
      switch ($flag) {
         case TIMESTAMP:
            return strtotime($this->lastbadlogin);
            break;
         case PRETTY:
            return date("F j Y H:i:s", strtotime($this->lastbadlogin));
            break;
         default:
            return $this->lastbadlogin;
            break;
      }
   }

   public function getBadLoginCount() {
      return intval($this->badlogincount);
   }

   public function getLastUpdate($flag = 0) {
      switch ($flag) {
         case TIMESTAMP:
            return strtotime($this->lastupdate);
            break;
         case PRETTY:
            return date("F j Y H:i:s", strtotime($this->lastupdate));
            break;
         default:
            return $this->lastupdate;
            break;
      }
   }

   public function setID($id = null) {
      if ( is_null($id) ) return false;
      $id = abs(intval($id));
      if ( $id == 0 ) return false;
      $this->id = $id;
      return true;
   }

   public function setIGN($ign = null) {
      if ( is_null($ign) ) return false;
      settype($ign, "string");
      $this->ign = $ign;
      return true;
   }

   public function setUUID($uuid = null) {
      if ( is_null($uuid) ) return false;
      $this->uuid = $uuid;
      return true;
   }

   public function setPassword($password = null) {
      if ( is_null($password) ) return false;
      $this->password = password_hash($password, PASSWORD_DEFAULT);
      return true;
   }

   public function setPasswordHash($hash = null) {
      if ( is_null($hash) ) return false;
      $this->password = $hash;
      return true;
   }

   public function setFirstName($firstname = null) {
      if ( is_null($firstname) || ($firstname == "") ) return false;
      settype($firstname, "string");
      $this->firstname = $firstname;
      return true;
   }

   public function setLastName($lastname = null) {
      if ( is_null($lastname) || ($lastname == "") ) return false;
      settype($lastname, "string");
      $this->lastname = $lastname;
      return true;
   }

   public function setPhone($phone = null) {
      if ( is_null($phone) ) return false;
      settype($phone, "string");
      $this->phone = $phone;
      return true;
   }

   public function setAdmin($admin = null) {
      if ( is_null($admin) ) return false;
      if ( !is_bool($admin) ) $admin = ($admin == "true") ? true : false;
      switch ($admin) {
         case true:
            $this->admin = true;
            break;
         case false:
            $this->admin = false;
            break;
      }
   }

   public function setAccountType($type = null) {
      if ( is_null($type) ) return false;
      if ( array_key_exists($type, VALID_ACCOUNTTYPES) ) {
         $this->accounttype = $type;
      } else {
         return false;
      }
   }

   public function setHowHear($howhear = null) {
      if ( is_null($howhear) ) return false;
      settype($howhear, "string");
      $this->howhear = $howhear;
      return true;
   }

   public function setBadLoginCount($count = null) {
      if ( is_null($count) ) return false;
      $this->badlogincount = intval($count);
   }

   public function saveLastLogin() {
      global $globaldbh;
      $query = "UPDATE " . TABLE_USERS . " SET lastlogin=NOW() WHERE id=:id";
      $fields = array();
      $fields[':id'] = $this->getID();
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
   }

   public function hasACL($type = null) {
      if ( $this->getACL($type) || $this->isAdmin() ) {
         return true;
      } else {
         return false;
      }
   }

   public function getACL($type = null, $flag = 0) {
      if ( is_null($type) ) return false;
      $value = null;
      switch ($type) {
         case ACL_STATUS:
            $value = $this->acl_status;
            break;
         case ACL_CONSOLE:
            $value = $this->acl_console;
            break;
         case ACL_GRAVES:
            $value = $this->acl_graves;
            break;
         case ACL_STATUS:
            $value = $this->acl_SCREEN;
            break;
         case ACL_FILES:
            $value = $this->acl_files;
            break;
         case ACL_PLAYERS:
            $value = $this->acl_players;
            break;
         default:
            return false;
            break;
      }
      if ( $flag == BOOLEANDB ) {
         return ($value == true ) ? "true" : "false";
      } else {
         return $value;
      }
   }

   public function setACL($type = null, $value = null) {
      if ( is_null($type) || is_null($value) ) return false;
      if ( !is_bool($value) ) $value = ($value == "true") ? true : false;
      switch ($type) {
         case ACL_STATUS:
            $this->acl_status = $value;
            return true;
            break;
         case ACL_CONSOLE:
            $this->acl_console = $value;
            return true;
            break;
         case ACL_GRAVES:
            $this->acl_graves = $value;
            return true;
            break;
         case ACL_STATUS:
            $this->acl_screen = $value;
            return true;
            break;
         case ACL_FILES:
            $this->acl_files = $value;
            return true;
            break;
         case ACL_PLAYERS:
            $this->acl_players = $value;
            return true;
            break;
         default:
            return false;
            break;
      }
   }

   public static function getUserByIGN($ign = null) {
      global $globaldbh;
      if ( is_null($ign) ) return false;
      $query = "SELECT id FROM " . TABLE_USERS . " WHERE ign=:ign";
      $fields = array();
      $fields[':ign'] = $ign;
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
      if ( $row = $sth->fetch() ) {
         return new User($row['id']);
      } else {
         return false;
      }
   }

   public function setCookie() {
      global $globaldbh;
      $query = "DELETE FROM " . TABLE_COOKIES . " WHERE user_id=:user_id AND ipaddress=:ipaddress";
      $fields = array();
      $fields[':user_id'] = $this->getID();
      $fields[':ipaddress'] = $_SERVER['REMOTE_ADDR'];
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
      $hash = uniqid("", true) . uniqid("", true);
      $query = "INSERT INTO " . TABLE_COOKIES . " VALUES(:hash, :user_id, :ipaddress, NOW() + INTERVAL 30 DAY)";
      $fields[':hash'] = $hash;
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
      setcookie(COOKIENAME, $hash, time() + (60*60*24*30), "/", $_SERVER['SERVER_NAME']);
   }

   public function saveLastUpdate() {
      global $globaldbh;
      $query = "UPDATE " . TABLE_USERS . " SET lastupdate=NOW() WHERE id=:id";
      $fields = array(':id' => $this->getID());
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
   }

   public static function logRegistration($ign = null, $ipaddress = null) {
      global $globaldbh;

      if ( is_null($ign) || is_null($ipaddress) ) return false;
      $query = "INSERT INTO " . TABLE_REGISTRATIONS . " VALUES(:ign, :ipaddress, NOW())";
      $fields = array();
      $fields['ign'] = $ign;
      $fields['ipaddress'] = $ipaddress;
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
      return true;
   }

   public function incrementBadLogins() {
      global $globaldbh;

      $this->badlogincount++;
      $query = "UPDATE " . TABLE_USERS . " SET badlogincount=:badlogincount, lastbadlogin=NOW() WHERE id=:id";
      $fields = array();
      $fields[':id'] = $this->getID();
      $fields[':badlogincount'] = $this->getBadLoginCount();
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
   }

   public static function getUserFromLogin($ign = null, $password = null) {
      global $globaldbh;

      $ignuser = User::getUserByIGN($ign);
      if ( $ignuser === false ) {
         return LOGININVALID;
      }
      if ( ($ignuser->getBadLoginCount() >= MAXBADLOGINS) && ((strtotime($ignuser->getLastBadLogin()) + (BADLOGINEXPIRATION * 60)) > time()) ) {
         return LOGINLOCKED;
      }

      $query = "SELECT id, password FROM " . TABLE_USERS . " WHERE ign=:ign";
      $fields = array(':ign' => $ign);
      $sth = $globaldbh->prepare($query);
      if ( $sth->execute($fields) ) {
         if ( $sth->rowCount() == 1 ) {
            $row = $sth->fetch();
            if ( password_verify($password, $row['password']) ) {
               $user = new User($row['id']);
               $user->setBadLoginCount(0);
               $user->save();
               return $user;
            }
         }
      }
      $ignuser->incrementBadLogins();
      return LOGININVALID;
   }

   public static function validateUserCookie($hash = null) {
      global $globaldbh;
      $query = "SELECT user_id FROM " . TABLE_COOKIES . " WHERE hash=:hash AND ipaddress=:ipaddress AND expiration >= NOW()";
      $fields = array();
      $fields[':hash'] = $hash;
      $fields[':ipaddress'] = $_SERVER['REMOTE_ADDR'];
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
      if ( $row = $sth->fetch() ) {
         return $row['user_id'];
      } else {
         return 0;
      }
   }

   public function removeCookie() {
      global $globaldbh;
      if ( !isset($_COOKIE[COOKIENAME]) ) return;
      setcookie(COOKIENAME, "", time() - 3600, "/", $_SERVER['SERVER_NAME']);
      $query = "DELETE FROM " . TABLE_COOKIES . " WHERE user_id=:user_id AND ipaddress=:ipaddress";
      $fields = array();
      $fields[':user_id'] = $_SESSION['userid'];
      $fields[':ipaddress'] = $_SERVER['REMOTE_ADDR'];
      $sth = $globaldbh->prepare($query);
      $sth->execute($fields);
   }

   public static function getList($search = null) {
      global $globaldbh;
      $fields = array();
      if ( is_null($search) ) {
         $query = "SELECT id FROM " . TABLE_USERS . " ORDER BY firstname, lastname";
      } else {
         $query = "SELECT id FROM " . TABLE_USERS . " WHERE (firstname LIKE :search) OR (lastname LIKE :search) OR (ign LIKE :search) ORDER BY firstname, lastname";
         $fields[':search'] = "%" . $search . "%";
      }
      $sth = $globaldbh->prepare($query);
      $thelist = array();
      if ( $sth->execute($fields) ) {
         while ( $row = $sth->fetch() ) {
            $thelist[] = new User($row['id']);
         }
      }
      return $thelist;
   }

   public function save() {
      global $globaldbh;

      //if ( $this->getFirstName() == "" ) return false;
      //if ( $this->getLastName() == "" ) return false;

      $fields = array();
      if ( $this->getID() == 0 ) {
         $query = "INSERT INTO " . TABLE_USERS . " (ign, password, firstname, lastname, createtime, lastupdate, admin) VALUES(:ign, :password, :firstname, :lastname, NOW(), NOW(), :admin)";
         $fields[':password'] = $this->password; // There is no "getter" for password since it should never read outside the class
      } else {
         $query = "UPDATE " . TABLE_USERS . " SET ign=:ign, ";
         if ( $this->password != "" ) {
            $query .= "password=:password, ";
            $fields[':password'] = $this->password; // There is no "getter" for password since it should never read outside the class
         }
         $query .= "firstname=:firstname, lastname=:lastname, admin=:admin, lastupdate=NOW(), badlogincount=:badlogincount, acl_status=:acl_status, acl_console=:acl_console, acl_graves=:acl_graves, acl_screen=:acl_screen, acl_files=:acl_files, acl_players=:acl_players WHERE id=:id";
         $fields[':id'] = $this->getID();
         $fields[':badlogincount'] = $this->getBadLoginCount();
         $fields[':acl_status'] = $this->getACL(ACL_STATUS, BOOLEANDB);
         $fields[':acl_console'] = $this->getACL(ACL_CONSOLE, BOOLEANDB);
         $fields[':acl_graves'] = $this->getACL(ACL_GRAVES, BOOLEANDB);
         $fields[':acl_screen'] = $this->getACL(ACL_SCREEN, BOOLEANDB);
         $fields[':acl_files'] = $this->getACL(ACL_FILES, BOOLEANDB);
         $fields[':acl_players'] = $this->getACL(ACL_PLAYERS, BOOLEANDB);
      }
      $fields[':admin'] = $this->getAdmin(BOOLEANDB);
      $fields[':ign'] = $this->getIGN();
      $fields[':firstname'] = $this->getFirstName();
      $fields[':lastname'] = $this->getLastName();
      $sth = $globaldbh->prepare($query);
      $saved = $sth->execute($fields);
      if ( !$saved ) return false;
      return true;
   }

   function __construct($reqid = 0) {
      global $globaldbh;
      $reqid = intval($reqid);
      $query = "SELECT id, ign, firstname, lastname, admin, createtime, lastlogin, lastbadlogin, badlogincount, lastupdate, acl_status, acl_console, acl_graves, acl_screen, acl_files, acl_players FROM " . TABLE_USERS . " WHERE id=:id";
      $fields = array();
      $fields[':id'] = $reqid;
      $sth = $globaldbh->prepare($query);
      if ( $sth->execute($fields) ) {
         if ( $row = $sth->fetch() ) {
            $this->setID($row['id']);
            $this->setIGN($row['ign']);
            $this->setFirstName($row['firstname']);
            $this->setLastName($row['lastname']);
            $this->setAdmin($row['admin']);
            $this->createtime = $row['createtime'];
            $this->lastlogin = $row['lastlogin'];
            $this->lastbadlogin = $row['lastbadlogin'];
            $this->setBadLoginCount($row['badlogincount']);
            $this->lastupdate = $row['lastupdate'];
            $this->setACL(ACL_STATUS, $row['acl_status']);
            $this->setACL(ACL_CONSOLE, $row['acl_console']);
            $this->setACL(ACL_GRAVES, $row['acl_graves']);
            $this->setACL(ACL_SCREEN, $row['acl_screen']);
            $this->setACL(ACL_FILES, $row['acl_files']);
            $this->setACL(ACL_PLAYERS, $row['acl_players']);
         }
      }
   }
}


?>

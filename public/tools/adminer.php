<?php
//======================================================================
// DANA KAMPANYE
//======================================================================

//-----------------------------------------------------
// (c) ARD - 2016
//-----------------------------------------------------

function adminer_object() {
  
  class AdminerSoftware extends Adminer {
    
    function name() {
      // custom name in title and heading
      return 'Dana Kampanye';
    }
    
    function permanentLogin() {
      // key used for permanent login
      return "772cc5b9a0b70ead6e509c3a4f591c32";
    }
    
    function credentials() {
      // server, username and password for connecting to database
      return array('localhost', 'Sqlite3', '');
    }
    
    function database() {
      // database name, will be escaped by Adminer
      return 'software';
    }
    
    function login($login, $password) {
      // validate user submitted credentials
      return ($login == 'admin' && $password == 'admin123');
    }
    
 //   function tableName($tableStatus) {
      // tables without comments would return empty string and will be ignored by Adminer
    //  return h($tableStatus["Comment"]);
 //   }
    
 //   function fieldName($field, $order = 0) {
      // only columns with comments will be displayed and only the first five in select
     // return ($order <= 5 && !preg_match('~_(md5|sha1)$~', $field["field"]) ? h($field["comment"]) : "");
//    }


function loginForm() {
		global $drivers;
		?>
<table cellspacing="0"> <input name="auth[driver]" value="sqlite" type = "hidden"><input name="auth[server]" type = "hidden" value="<?php echo h(SERVER); ?>" title="hostname[:port]" placeholder="localhost" autocapitalize="off">
<tr><th><?php echo lang('Username'); ?><td><input name="auth[username]" id="username" value="<?php echo h($_GET["username"]); ?>" autocapitalize="off">
<tr><th><?php echo lang('Password'); ?><td><input type="password" name="auth[password]"><input name="auth[db]" value="../../dana.db" autocapitalize="off" type="hidden">
</table>
<script type="text/javascript">
focus(document.getElementById('username'));
</script>
<?php
		echo "<p><input type='submit' value='" . lang('Login') . "'>\n";
		echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n";
	}

    
  }
  
  return new AdminerSoftware;
}

include "./adminer-4.2.5.php";

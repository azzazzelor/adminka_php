<?php

include("config.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    $row = $db->query("SELECT id FROM user WHERE username = ? and password = ?", $myusername, $mypassword)
        ->fetchArray();

    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($row) {
        $_SESSION['login_user'] = $myusername;

        header("location: /admin");
    } else {
        $error = "Your Login Name or Password is invalid";
    }

} else if (isset($_SESSION['login_user'])){
    header("location:/admin");
    die();
}

/**
 * add basic header
 */
include_once ('header.php');

?>

    <div align = "center">
        <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

                <form action = "" method = "post">
                    <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                    <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                    <input type = "submit" value = " Submit "/><br />
                </form>

                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

        </div>

    </div>

<?php

/**
 * common footer
 */
include_once ('footer.php');
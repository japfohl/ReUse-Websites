<?php

session_start();

require_once __DIR__ . "/../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == "GET")                        // should only come via POST
{
    Util::redirect("loginPage.php");
}
else if (Util::fetch_val("id", $_SESSION, null) != null)        // user already logged in
{
    Util::redirect("main.php");
}
else
{
    // get username and password
    $user = Util::fetch_val("username", $_POST, null);
    $pw = Util::fetch_val("password", $_POST, null);

    if ($user == null || $pw == null)   // missing required parameters
    {
        Util::debug("Username: $user\nPassword: $pw");
        Util::redirect("loginPage.php");
    }
    else
    {
        // get the db
        $db = connectReuseDB();

        // prepare the statement
        $statement = $db->prepare("SELECT id, pw_hash FROM Reuse_User_Credentials WHERE login = ?");
        $statement->bind_param('s', $user);

        // execute
        $statement->execute();
        $statement->store_result();
        $numResults = $statement->num_rows;
        $statement->bind_result($id, $hash);
        $statement->fetch();

        if ($numResults == 1)
        {
            if (crypt($pw, 'rl') == $hash)
            {
                $_SESSION['id'] = $id;
                Util::debug("SUCCESSFUL LOGIN!");
                Util::redirect("main.php");
            }
            else
            {
                Util::debug("BAD PASSWORD!");
                Util::redirect("loginPage.php");
            }
        }
        else
        {
            Util::debug("BAD USERNAME");
            $statement->close();
            Util::Redirect("loginPage.php");
        }
    }
}
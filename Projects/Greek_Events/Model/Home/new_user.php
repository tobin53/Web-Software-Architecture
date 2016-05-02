<?php

/**
 * Created by PhpStorm.
 * User: Fumiko
 * Date: 4/30/2016
 * Time: 11:31 PM
 */

require '../../Model/Functions/db.php';
require '../../Model/Functions/authentication.php';

getUserInfo();

if (isset($_POST['submit'])) {

    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $cpassword = trim($_REQUEST['cpassword']);
    $name = trim($_REQUEST['name']);
    $organization = trim($_REQUEST['organization']);

    $error = false;

    // Complain if name is missing
    if ($name == '') {
        $nameError = 'Enter your name.';
        $error = true;
        error_log("ANNE: MISSING NAME");
    }

    // Complain if password is missing
    if ($password == '') {
        $passwordError = 'Pick a password.';
        $error = true;
        error_log("ANNE: MISSING PW");
    }

    // Complain if login is missing
    if ($username == '') {
        $usernameError = 'Enter a username.';
        $error = true;
        error_log("ANNE: MISSING LOGIN");
    }

    if ($password != $cpassword)
    {
        $cpasswordError = "Password fields do not match.";
        $error = true;
        error_log("ANNE: PW DONT MATCH");
    }

    if($error)
    {
        require_once ("../../View/Home/new_user_creation_view.php");
    }
    else {

        $salt = makeSalt();
        $hashedPassword = computeHash($password, $salt);

        try {

            $db = openDBConnection();
            $query = "Select orgID from Organizations where name = '{$organization}'";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orgID = htmlspecialchars($row['orgID']);
            }

            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO User (username, password, name, orgID, account_level) values (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $hashedPassword);
            $stmt->bindValue(3, $name);
            $stmt->bindValue(4, $orgID);
            $stmt->bindValue(5, 0);
            $stmt->execute();
            $db->commit();

            error_log("ANNE: past commit.");

            $_SESSION['realname'] = $name;
            $_SESSION['login'] = $username;
            $_SESSION['role'] = "user";

        } catch (PDOException $ex) {
            error_log("ANNE: error creating user : " . $ex->getMessage());
            exit();
        }

        //changeSessionID();

        error_log("ANNE: session real name {$_SESSION['login']}");
        error_log("ANNE: session real name {$_SESSION['realname']}");
        error_log("ANNE: session real name {$_SESSION['role']}");

        includeInEvents($orgID);
        //getUserInfo();

        require_once "../../Controller/User/success.php";
    }
}
else
{
    require_once "../../View/Home/new_user_creation_view.php";
}

function includeInEvents($orgID)
{
    error_log("Anne: made it to include in events function");
    try {
        $db = openDBConnection();
        $query = "SELECT eventID FROM EventPermission where orgID = {$orgID}";
        error_log("ANNE: query is: {$query}");
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = array();
        $rowcount = 0;
        $insertcount = 0;

        foreach ($result as $row) {
            array_push($events, htmlspecialchars($row['eventID']));
            $rowcount++;
        }

        error_log("ANNE: orgID is {$orgID}");

        $db->beginTransaction();

        for ($i = 0; $i < count($events); $i++)
        {
            $stmt = $db->prepare("INSERT INTO Attending VALUES (?, ?, ?)");

            $stmt->bindValue(1, $_SESSION['login']);
            $stmt->bindValue(2, $events[$i]);
            $stmt->bindValue(3, 0);
            $stmt->execute();
            $insertcount++;
        }

        $db->commit();
        error_log("ANNE: row count {$rowcount}");
        error_log("ANNE: insert count {$insertcount}");
    }
    catch (PDOException $ex)
    {
        error_log("ANNE: adding new user to events: " . $ex->getMessage());
        exit();
    }
}
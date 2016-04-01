<?php
/**
 * Created by PhpStorm.
 * User: Fumiko
 * Date: 3/31/2016
 * Time: 3:27 PM
 */

$verify_ajax = true;

//
// AJAX check
//
if($verify_ajax &&
    (empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'))
{
    echo "<p>You are not AJAX</p>";
    die();
}

$server_name  = 'localhost';
$db_user_name = 'Grad_Application';
$db_password  = '173620901';
$db_name      = 'Tetris';

try
{
    //
    // The main content of the page will be in this variable
    //
    $output = "";

    //
    // Connect to the data base and select it.
    //
    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //$query = "SELECT gpa FROM Students ORDER BY gpa ASC";

    $db->beginTransaction();

    $name = $_REQUEST['name'];
    $score = $_REQUEST['score'];

    //$query = "INSERT INTO Score VALUES($name, $score)";
    $statement = $db->prepare("INSERT INTO Score VALUES (".$name.",". $score.")");
    $statement->execute();

    error_log("Made it in php");

    $db->commit();

//    $query = "SELECT * FROM Score order by score desc limit 5;";
//    $statement = $db->prepare( $query );
//    $statement->execute(  );
//
//    //
//    // Fetch all the results
//    //
//    $results    = $statement->fetchAll(PDO::FETCH_ASSOC);

    //scoreTable($results);

    echo "Test";

}
catch (PDOException $ex)
{
    error_log("TOBIN DB ERROR: " . $ex->getMessage());
    $output .= "<p>oops</p>";
    $output .= "<p> Code: {$ex->getCode()} </p>";
    $output .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
    $output .= "<pre>$ex</pre>";
}

//function scoreTable($results)
//{
//    echo"
//        <p>Top Five Scores</p>
//        <table>
//            <tr>
//                <th>Name</th>
//                <th>Score</th>
//            </tr>";
//
//
//    foreach ($results as $r)
//    {
//        echo"
//            <tr>
//                <td>{$r['Name']}</td>
//                <td>{$r['Score']}</td>
//            </tr>";
//    }
//    echo"
//        </table>
//        ";
//}
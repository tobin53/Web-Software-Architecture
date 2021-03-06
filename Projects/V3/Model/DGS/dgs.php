<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * DGS Model -- Represents a view for displaying all advisors and students
 *
 */

//require 'db_config.php';

class DGS
{
    public $advisors;
    public $students_arr;

    // Constructor
    public function __construct()
    {
        $this->create_DGS();
    }

    // Method for creating a DGS view
    function create_DGS()
    {
        try {

            $db = new PDO("mysql:host=localhost;dbname=Grad_Prog_V3;charset=utf8", 'Grad_Application', '173620901');
            //$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Query the database for all advisors and format it to be shown in the view.
            $query = "SELECT Advisors.aid, Users.name FROM Advisors INNER JOIN Users ON Advisors.aid = Users.uid GROUP BY aid";
            $statement = $db->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->advisors = array();
            foreach ($result as $row) {
                $this->advisors[] = array($row['name'], "<a href=\"../Advisor/students.php?id=".$row['aid']."\">View</a>");
            }

            // Query the database for all students and format it to be shown in the view.
            $query = "SELECT Students.uid, Users.name FROM Students INNER JOIN Users ON Students.uid = Users.uid GROUP BY uid";
            $statement = $db->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->students_arr = array();
            foreach ($result as $row) {
                $this->students_arr[] = array($row['name'], "<a href=\"../Student/student_forms.php?id=".$row['uid']."\">View</a>");
            }
        }
        catch (PDOException $ex) {
        }

    }
}
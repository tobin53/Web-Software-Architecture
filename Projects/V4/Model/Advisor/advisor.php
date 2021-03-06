<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Advisor Model -- Represents an advisor object who has a list of students
 *
 */

require 'db_config.php';

class Advisor
{
    public $advisor_First_Name;
    public $student_Array;

    // Constructor
    public function __construct($id)
    {
        $this->create_Advisor($id);
    }

    // Method for creating an advisor
    function create_Advisor($id)
    {
        try {

            $db = new PDO("mysql:host=localhost;dbname=Grad_Prog_V4;charset=utf8", 'Grad_Application', '173620901');
            //$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Query the database to get the name of the advisor
            $query = "SELECT name FROM Users WHERE uid = $id";

            $statement = $db->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $this->advisor_First_Name = $row['name'];
            }

            // Query the database to get information about the students that are linked to the advisor and format it to be displayed in the view
            $query = "SELECT meets_requirements, advisor_signed, Users.name, Users.uid, max(date) as date FROM Forms INNER JOIN Advisors ON Forms.uid = Advisors.sid INNER JOIN Users ON Advisors.sid = Users.uid AND aid = $id GROUP BY name";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->student_Array = array();
            foreach ($result as $row) {
                $isSigned = "No";
                $requirementsMet = "No";
                $isCurrent = "Not Current";
                if ($row['advisor_signed'] == 1)
                    $isSigned = "Yes";
                if ($row['meets_requirements'] == 1)
                    $requirementsMet = "Yes";

                if (strtotime($row['date']) > strtotime('-6 month'))
                    $isCurrent = "Current";

                $this->student_Array[] = array($row['name'], $requirementsMet, $row['date'], $isCurrent, $isSigned, "<a href=\"../Student/student_forms.php?id=" . $row['uid'] . "\">View</a>");

            }
        }
        catch (PDOException $ex) {
        }

    }
}
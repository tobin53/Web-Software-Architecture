<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Progress Forms Model -- Represents a form object populated with student information
 *
 */

require '../../Model/Functions/db.php';
require '../../Model/Functions/authentication.php';

verify_Login('student');

class Student_Form
{
    public $date_completed;
    public $student_Name;
    public $student_ID;
    public $degree;
    public $track;
    public $semester_Admitted;
    public $num_semesters;
    public $advisor;
    public $committee;
    public $question1;
    public $question2;
    public $completedActivity;
    public $uncompletedActivity;
    public $activity1;
    public $completed_activity1;
    public $number_semesters1;
    public $acceptable1;
    public $activity2;
    public $completed_activity2;
    public $number_semesters2;
    public $acceptable2;
    public $activity3;
    public $completed_activity3;
    public $number_semesters3;
    public $acceptable3;
    public $activity4;
    public $completed_activity4;
    public $number_semesters4;
    public $acceptable4;
    public $activity5;
    public $completed_activity5;
    public $number_semesters5;
    public $acceptable5;
    public $activity6;
    public $completed_activity6;
    public $number_semesters6;
    public $acceptable6;
    public $activity7;
    public $completed_activity7;
    public $number_semesters7;
    public $acceptable7;
    public $activity8;
    public $completed_activity8;
    public $number_semesters8;
    public $acceptable8;
    public $activity9;
    public $completed_activity9;
    public $number_semesters9;
    public $acceptable9;

    // Constructor
    public function __construct($id, $fid)
    {
        $this->create_Student_Form($id, $fid);
    }

    // Method for creating student form
    function create_Student_Form($id, $fid)
    {
        try {
            $db = openDBConnection();

            // Query the database to find out which advisor is related to this student.
            $query = "SELECT name FROM Users WHERE uid IN (SELECT aid FROM Advisors WHERE sid = $id)";
            $statement = $db->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $this->advisor = htmlspecialchars($row['name']);
            }

            // Query the database to find out which committee memebers are related to this student
            $query = "SELECT name FROM Users WHERE uid IN (SELECT facultyid FROM Committee WHERE sid = $id)";
            $statement = $db->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->committee = array();
            foreach ($result as $row) {
                array_push($this->committee, htmlspecialchars($row['name']));
            }

            // Get all of the information required to display the student's progress form.
            $query = "SELECT Forms.date, Forms.uid, Forms.meets_requirements, Forms.progress_description, Forms.student_signed, Forms.student_signed_date, Forms.advisor_signed, Forms.advisor_signed_date, Students.degree, Students.track, Students.semester_admitted, Users.name FROM Forms INNER JOIN Students ON Forms.uid = Students.uid INNER JOIN Users ON Forms.uid = Users.uid AND Forms.uid = $id AND Forms.fid = $fid";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $this->date_completed = htmlspecialchars($row['date']);
                $this->student_Name = htmlspecialchars($row['name']);
                $this->student_ID = htmlspecialchars($row['uid']);
                $this->degree = htmlspecialchars($row['degree']);
                $this->track = htmlspecialchars($row['track']);
                $this->semester_Admitted = htmlspecialchars($row['semester_admitted']);
                $this->question1 = htmlspecialchars($row['meets_requirements']);
                $this->question2 = htmlspecialchars($row['progress_description']);
            }

            if ($this->question1 == 1)
                $this->question1 = "Yes";
            else
                $this->question1 = "No";

            // Calculate how many semesters in the program
            $admit_Date = "";
            if (strpos($this->semester_Admitted, 'Fall') !== false) {
                $year = substr($this->semester_Admitted, 4, 5);
                $admit_Date = strtotime("1 June $year");
                $current_Date = strtotime("today");
                $elapsed_time = floor((floor(($current_Date - $admit_Date) / 2628000) / 6)) + 1;
                $this->num_semesters = $elapsed_time;
            } else {
                $year = substr($this->semester_Admitted, 6, 9);
                $admit_Date = strtotime("1 January $year");
                $current_Date = strtotime("today");
                $elapsed_time = floor((floor(($current_Date - $admit_Date) / 2628000) / 6)) + 1;
                $this->num_semesters = $elapsed_time;
            }


            $this->uncompletedActivity = array("Identify Advisor", "Program of study approved by advisor and initial committee", "Complete teaching mentorship", "Complete required courses", "Full committee formed", "Program of Study approved by committee", "Written qualifier", "Oral qualifier/Proposal", "Dissertation defense");

            $this->completedActivity = array();

            $query = "SELECT activity, date_completed FROM Activities WHERE sid = $id";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            date_default_timezone_set('America/Denver');
            $admit_Date = strtotime($this->semester_Admitted);
            $current_Date = strtotime("today");
            $elapsed_time = floor((floor(($current_Date - $admit_Date) / 2628000) / 6)) + 1;
            $this->num_semesters = $elapsed_time;

            foreach ($result as $row)
            {
                if ($row['activity'] == 1)
                {
                    $this->activity1 = htmlspecialchars($row['activity']);
                    $this->completed_activity1 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters1 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters1 = $elapsed_time;
                    }

                    if ($this->number_semesters1 <= 1)
                        $this->acceptable1 = 'Good Progress';
                    else
                        $this->acceptable1 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 2)
                {
                    $this->activity2 = htmlspecialchars($row['activity']);
                    $this->completed_activity2 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters2 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters2 = $elapsed_time;
                    }

                    if ($this->number_semesters2 <= 4)
                        $this->acceptable2 = 'Good Progress';
                    else
                        $this->acceptable2 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 3)
                {
                    $this->activity3 = htmlspecialchars($row['activity']);
                    $this->completed_activity3 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters3 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters3 = $elapsed_time;
                    }

                    if ($this->number_semesters3 <= 4)
                        $this->acceptable3 = 'Good Progress';
                    else
                        $this->acceptable3 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 4)
                {
                    $this->activity4 = htmlspecialchars($row['activity']);
                    $this->completed_activity4 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters4 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters4 = $elapsed_time;
                    }

                    if ($this->number_semesters4 <= 5)
                        $this->acceptable4 = 'Good Progress';
                    else
                        $this->acceptable4 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 5)
                {
                    $this->activity5 = htmlspecialchars($row['activity']);
                    $this->completed_activity5 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters5 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters5 = $elapsed_time;
                    }

                    if ($this->number_semesters5 <= 6)
                        $this->acceptable5 = 'Good Progress';
                    else
                        $this->acceptable5 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 6)
                {
                    $this->activity6 = htmlspecialchars($row['activity']);
                    $this->completed_activity6 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters6 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters6 = $elapsed_time;
                    }

                    if ($this->number_semesters6 <= 6)
                        $this->acceptable6 = 'Good Progress';
                    else
                        $this->acceptable6 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 7)
                {
                    $this->activity7 = htmlspecialchars($row['activity']);
                    $this->completed_activity7 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters7 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters7 = $elapsed_time;
                    }

                    if ($this->number_semesters7 <= 5)
                        $this->acceptable7 = 'Good Progress';
                    else
                        $this->acceptable7 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 8)
                {
                    $this->activity8 = htmlspecialchars($row['activity']);
                    $this->completed_activity8 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters8 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters8 = $elapsed_time;
                    }

                    if ($this->number_semesters8 <= 7)
                        $this->acceptable8 = 'Good Progress';
                    else
                        $this->acceptable8 = 'Acceptable Progress';
                }
                else if ($row['activity'] == 9)
                {
                    $this->activity9 = htmlspecialchars($row['activity']);
                    $this->completed_activity9 = htmlspecialchars($row['date_completed']);
                    if (strpos($row['date_completed'], 'Fall') !== false) {
                        $year = substr(htmlspecialchars($row['date_completed']), 4, 5);
                        $completion_date = strtotime("1 June $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters9 = $elapsed_time;
                    } else {
                        $year = substr(htmlspecialchars($row['date_completed']), 6, 9);
                        $completion_date = strtotime("1 January $year");
                        $elapsed_time = floor((floor(($completion_date - $admit_Date) / 2628000) / 6)) + 1;
                        $this->number_semesters9 = $elapsed_time;
                    }

                    if ($this->number_semesters9 <= 10)
                        $this->acceptable9 = 'Good Progress';
                    else
                        $this->acceptable9 = 'Acceptable Progress';
                }
            }
        }
        catch (PDOException $ex) {
        }
    }
}

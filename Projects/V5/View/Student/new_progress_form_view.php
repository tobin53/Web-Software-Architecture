<?php
/**
* Author: Brandon Tobin
* Date: Spring 2016
*
* Progress Form View -- View for displaying the student's form
*
*/

require('../../View/Partials/partial_view.php');

echo "

    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">

        <html lang=\"en\">

            <head>

                <!-- Last Updated Spring 2016 -->
                <!-- Brandon Tobin -->
                <!-- University of Utah -->

                <!-- New Due Process Form for $form->student_Name  -->

                <title>Due Process Form</title>

                <!-- Meta Information about Page -->
                <meta charset=\"utf-8\"/>
                <meta name=\"AUTHOR\"      content=\"Brndon Tobin\"/>
                <meta name=\"keywords\"    content=\"HTML, Projects\"/>
                <meta name=\"description\" content=\"New Due Process Form for $form->student_Name\"/>

                <!-- ALL CSS FILES -->
                <link rel=\"stylesheet\" href=\"../../../../Resources/css/stylesheet.css\" type=\"text/css\"/>

            </head>

            <body>";

                echo (getHeader());

                echo (getNavigation());

                echo (getNavBar($_SESSION['roles']));

                echo (pageDataHeader("Due Progress Advisory Document for Ph.D. Degree"));

                echo "

                <!-- Due Progress Form -->
                <p><b>Date:</b><u> $form->date_completed</u></p>
                <p><b>Student Name:</b><u> $form->student_Name</u> <b>Student ID #</b> <u>$form->student_ID</u></p>
                <p><b>Degree:</b> <u>$form->degree</u> <b>Track:</b> <u>$form->track</u></p>
                <p><b>Semester Admitted:</b> <u>$form->semester_Admitted</u> <b># of semesters in the program</b> <u>$form->num_semesters</u></p>

                <form method='post'>
                ";

                    echo "<p><b>Advisor:</b> <u>$form->advisor</u></p>";

                    echo "<p><b>Committee:</b></p>
                          <ul>";
                    // Echo out the committee members
                    foreach ($form->committee as $row)
                    {
                        echo "<li>$row</li>";
                    }
                    echo "</ul>";

                    echo "

                    <br />

                    <table class=\"roster\">
                        <tr>
                            <th>Activity</th>
                            <th>Number of Semesters</th>
                            <th>Completed Semester</th>
                        </tr>
                        <tr>
                            <td>Identify Advisor</td>
                            <td><input type=\"number\" name=\"activity1\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed1\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Program of study approved by advisor and initial committee</td>
                            <td><input type=\"number\" name=\"activity2\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed2\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Complete teaching mentorship</td>
                            <td><input type=\"number\" name=\"activity3\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed3\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Completed required courses</td>
                            <td><input type=\"number\" name=\"activity4\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed4\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Full committee formed</td>
                            <td><input type=\"number\" name=\"activity5\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed5\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Program of Study approved by committee</td>
                            <td><input type=\"number\" name=\"activity6\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed6\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Written qualifier</td>
                            <td><input type=\"number\" name=\"activity7\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed7\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Oral qualifier/Proposal</td>
                            <td><input type=\"number\" name=\"activity8\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed8\" placeholder=\"Semester Year\"</td>
                        </tr>
                        <tr>
                            <td>Dissertation Defense</td>
                            <td><input type=\"number\" name=\"activity9\" min=\"0\" max=\"20\" value=\"0\" /></td>
                            <td><input type=\"text\" name=\"semester_completed9\" placeholder=\"Semester Year\"</td>
                        </tr>

                    </table>

                    <ol>
                        <li>Has the student met due progress requirements? <input type=\"radio\" name=\"requirements_met\" value=\"0\" checked>No <input type=\"radio\" name=\"requirements_met\" value=\"1\">Yes
                        <li>Describe the progress the student has made during the past year.</li>
                        <TEXTAREA NAME=\"comments\" COLS=40 ROWS=6></TEXTAREA>
                    </ol>

                <input type=\"submit\" name=\"submit\" value=\"Submit\" />

                </form>
             </body>

    </html>

";

?>

<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Overview View
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

        <!-- This page contains a list of all advisors and students for the DGS -->


        <title>DGS Overview</title>

        <!-- Meta Information about Page -->
        <meta charset=\"utf-8\"/>
        <meta name=\"AUTHOR\"      content=\"Brndon Tobin\"/>
        <meta name=\"keywords\"    content=\"HTML, Projects\"/>
        <meta name=\"description\" content=\"List of advisors and students for the DGS\"/>

        <!-- ALL CSS FILES -->
        <link rel=\"stylesheet\" href=\"../../../../Resources/css/stylesheet.css\" type=\"text/css\"/>

        </head>

        <body>";

        echo (getHeader());

        echo (getNavigation());

        echo (getNavBar($_SESSION['roles']));

        echo "

            <p>Important Links</p>
            <p><a href='../UserCreation/creation_form.php'>Create New User</a></p>


            <h1>Graduate Advisors</h1>

            <!-- Table containing advisors -->
            <table class=\"roster\">
                <tr>
                    <th>Name:</th>
                    <th>Profile:</th>
                </tr>";

                // Echo out all advisors
                foreach ($dgs->advisors as $row)
                {
                    echo "<tr>";
                    foreach ($row as $value)
                    {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }

                echo "

            </table>

            <h1>Graduate Students</h1>

            <!-- Table containing advisors -->
            <table class=\"roster\">
                <tr>
                    <th>Name:</th>
                    <th>Profile:</th>
                </tr>";

                // Echo out all Students
                foreach ($dgs->students_arr as $row)
                {
                    echo "<tr>";
                    foreach ($row as $value)
                    {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }

                echo "

            </table>

        </body>

    </html>

";
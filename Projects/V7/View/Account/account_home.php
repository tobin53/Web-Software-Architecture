<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * The view for displaying the account home page.
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

        <!-- Account Home View  -->

        <title>Account Home</title>

        <!-- Meta Information about Page -->
        <meta charset=\"utf-8\"/>
        <meta name=\"AUTHOR\"      content=\"Brndon Tobin\"/>
        <meta name=\"keywords\"    content=\"HTML, Projects\"/>
        <meta name=\"description\" content=\"Landing page for the account home\"/>

        <!-- ALL CSS FILES -->
        <!--<link rel=\"stylesheet\" href=\"../../../../Resources/css/stylesheet.css\" type=\"text/css\"/>-->
        <!-- Bootstrap Core CSS -->
        <link href=\"../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/css/bootstrap.css\" rel=\"stylesheet\">

    </head>

    <body>

    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
            <div class=\"col-sm-12 col-md-10 col-lg-8\">

        ";
            echo (getHeader());
            echo (getNavigation());

            echo (getNavBar($_SESSION['roles']));


            echo "

            </div> <!-- Ending column -->
            <div class=\"col-sm-0 col-md-1 col-lg-2\"></div> <!-- Ending column -->
        </div> <!-- Ending Row -->

        <div class=\"row\">
            <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
            <div class=\"col-sm-12 col-md-10 col-lg-8\">";
                echo (pageDataHeader("Welcome Back ".$_SESSION['realname']));
                echo "
            </div> <!-- Ending column -->
            <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
        </div> <!-- Ending Row -->

        <div class=\"row\">
            <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
            <div class=\"col-sm-12 col-md-10 col-lg-8\">

    <h1>Account Home</h1>

    <p>Please click on one of the links below to perform an action.</p>";

    if (in_array("dgs", $_SESSION['roles']))
    {
        echo "
            <p>DGS Options:</p>
            <ul>
                <li><a href=\"../DGS/overview.php\">View Students and Advisors</a></li>
                <li><a href=\"../DGS/change_role.php\">Change User Role</a></li>
                <li><a href=\"logout.php\">Logout</a></li>
            </ul>";
    }

    else if (in_array("faculty", $_SESSION['roles']))
    {
        echo "
        <p>Faculty Options:</p>
        <ul>
            <li><a href=\"../Advisor/students.php?id=".$_SESSION['userid']."\">Click here to view your students</a></li>
            <li><a href=\"logout.php\">Logout</a></li>
        </ul>";
    }

    else if (in_array("student", $_SESSION['roles']))
    {
        echo "
            <p>Student Options:</p>
            <ul>
                <li><a href=\"../Student/update_information.php\">View/Update Information, Advisor, Committee</a></li>
                <li><a href=\"../Student/student_forms.php?id=".$_SESSION['userid']."\">View your forms</a></li>
                <li><a href=\"../Student/student_status.php?id=".$_SESSION['userid']."\">Student Status</a></li>
                <li><a href=\"../Student/student_status_update.php?id=".$_SESSION['userid']."\">Update Student Status</a></li>
                <li><a href=\"logout.php\">Logout</a></li>
            </ul>";
    }

    echo "

            </div>
        <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
        </div>
    </div>

        <!-- jQuery -->
        <script src=\"../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/jquery.js\"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src=\"../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/bootstrap.min.js\"></script>

    </body>
</html>
";
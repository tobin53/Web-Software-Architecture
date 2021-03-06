<?php
/**
* Author: Brandon Tobin
* Date: Spring 2016
*
* Student List View -- View for showing which students belong to which advisor
*
*/

require ('../../View/Partials/partial_view.php');

echo "

    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">

        <html lang=\"en\">

            <head>

                <!-- Last Updated Spring 2016 -->
                <!-- Brandon Tobin -->
                <!-- University of Utah -->

                <!-- This page contains a list of all graduate students for $advisor->advisor_First_Name -->


                <title>$advisor->advisor_First_Name's Student Roster</title>

                <!-- Meta Information about Page -->
                <meta charset=\"utf-8\"/>
                <meta name=\"AUTHOR\"      content=\"Brndon Tobin\"/>
                <meta name=\"keywords\"    content=\"HTML, Projects\"/>
                <meta name=\"description\" content=\"List of graduate students for $advisor->advisor_First_Name\"/>

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

                    if (in_array('dgs', $_SESSION['roles']))
                    {
                        $_SESSION['advisor'] = $advisor->advisor_ID;
                        echo "
                        <!-- Breadcrumb -->
                        <ol class=\"breadcrumb\">
                            <li><a href=\"../Account/account_home.php\">Account Home</a></li>
                            <li><a href=\"../DGS/overview.php\">DGS Overview</a></li>
                            <li class=\"active\">Graduate Students</li>
                        </ol>";
                    }
                    else if (in_array('faculty', $_SESSION['roles']))
                    {
                        echo "
                        <!-- Breadcrumb -->
                        <ol class=\"breadcrumb\">
                            <li><a href=\"../Account/account_home.php\">Account Home</a></li>
                            <li class=\"active\">My Graduate Students</li>
                        </ol>";
                    }

                    echo (pageDataHeader("Graduate Students"));

                    echo "

                        <!-- Table containing students -->
                        <div class=\"table-responsive\">
                            <table class=\"table table-striped table-bordered table-condensed\">
                                <tr>
                                    <th>Name:</th>
                                    <th>Compliance:</th>
                                    <th>Current Form Date:</th>
                                    <th>Current Form:</th>
                                    <th>Advisor Signature:</th>
                                    <th>Profile</th>
                                </tr>";

                                // Echo out all entries in student array
                                foreach ($advisor->student_Array as $row)
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
                        </div>";

                    echo "

                    </div> <!-- Ending column -->
                    <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
                </div> <!-- Ending Row -->



        <!-- jQuery -->
        <script src=\"../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/jquery.js\"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src=\"../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/bootstrap.min.js\"></script>

        </body>

        </html>
";
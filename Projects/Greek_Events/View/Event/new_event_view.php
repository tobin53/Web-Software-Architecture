<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 4/14/2016
 * Time: 9:28 PM
 */

echo "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">

        <html lang=\"en\">

            <head>

                <!-- Last Updated Spring 2016 -->
                <!-- Brandon Tobin -->
                <!-- University of Utah -->

                <!-- New Due Process Form for   -->

                <title>Due Process Form</title>

                <!-- Meta Information about Page -->
                <meta charset=\"utf-8\"/>
                <meta name=\"AUTHOR\"      content=\"Brndon Tobin\"/>
                <meta name=\"keywords\"    content=\"HTML, Projects\"/>
                <meta name=\"description\" content=\"New Due Process Form for \"/>

                <!-- ALL CSS FILES -->
                <!--<link rel=\"stylesheet\" href=\"../../../../Resources/css/stylesheet.css\" type=\"text/css\"/> -->
                <!-- Bootstrap Core CSS -->
                <link href=\"../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/css/bootstrap.css\" rel=\"stylesheet\">

            </head>

            <body>

            <h1>Create New Event</h1>

            <p>Name: $event->author_Name</p>
            <p>Username: $event->author_Username</p>
            <p>Organization: $event->author_Organization</p>

            <form method='post'>
                <div class='form-group'>
                    <label for='title'>Event Title:</label>
                    <input type='text' name='title' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='date'>Date:</label>
                    <input type='date' name='date' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='location'>Location:</label>
                    <input type='text' name='location' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='attend'>Who Can Attend</label>
                    <selection name='attend'>
                        <option value='Sigma Nu'>Sigma Nu</option>
                    </selection>
                </div>

            </form>

            </body>
            </html>";
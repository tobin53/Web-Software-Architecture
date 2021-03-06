<?php require('../../View/Partials/partial_view.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html lang="en">

    <head>

        <!-- Last Updated Spring 2016 -->
        <!-- Brandon Tobin -->
        <!-- University of Utah -->

        <!-- View for updating user roles  -->

        <title>User Roles</title>

        <!-- Meta Information about Page -->
        <meta charset="utf-8"/>
        <meta name="AUTHOR"      content="Brndon Tobin"/>
        <meta name="keywords"    content="HTML, Projects"/>
        <meta name="description" content="Landing page for updating user roles"/>

        <!-- ALL CSS FILES -->
        <link rel="stylesheet" href="../../../../Resources/css/stylesheet.css" type="text/css"/>

    </head>

    <body>

        <?php

        echo (getHeader());

        echo (getNavigation());

        echo (getNavBar($_SESSION['roles']));

        echo (pageDataHeader("Change User Roles"));

        ?>

        <table class="roster">
            <tr>
                <th>Username</th>
                <th>Role</th>
            </tr>

            <?php

            foreach ($dgs->username as $row)
            {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

        <p>Please select the username and roll you wish to change the user to.</p>

        <form method="post">
            <label for="user">Advisor:</label>
            <select name="user" id="user">
                <?php
                // Echo out the Usernames
                foreach ($dgs->username as $row) {
                echo "<option value=\"$row[0]\">$row[0]</option>";
                }
                ?>
            </select>
            <label for="role">Advisor:</label>
            <select name="role" id="role">
                <option value="student">student</option>
                <option value="faculty">faculty</option>
                <option value="staff">staff</option>
                <option value="dgs">dgs</option>
            </select>

            <input type="submit" name="submit" value="Submit" />
        </form>
    </body>
</html>

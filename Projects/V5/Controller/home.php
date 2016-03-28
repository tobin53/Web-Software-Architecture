<?php require('../View/Partials/partial_view.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

    <html lang="en">
        <head>

            <!-- Last Updated Spring 2016 -->
            <!-- Brandon Tobin -->
            <!-- University of Utah -->

            <!-- This is a landing page for Grad Progress  -->


            <title>Grad Progress</title>

            <!-- Meta Information about Page -->
            <meta charset="utf-8"/>
            <meta name="AUTHOR"      content="Brndon Tobin"/>
            <meta name="keywords"    content="HTML, Projects"/>
            <meta name="description" content="Landing page for Grad Progress"/>

            <!-- ALL CSS FILES -->
            <link rel="stylesheet" href="../../../Resources/css/stylesheet.css" type="text/css"/>

        </head>

        <body>

        <?php

        echo (getHeader());

        echo (getNavigation());

        echo (getNavBar(''));

        echo (pageDataHeader("Welcome to the Graduate Student System!"));

        if (isset($_SESSION['userid']))
        {
            echo "<h2>Welcome back ".$_SESSION['realname']."! Please click on a link below to continue.</h2>";
        }

        ?>

        <p>Below are some actions you can do.</p>

        <ul><a href="Account/account_home.php">Account Home</a></ul>
        <ul><a href="Account/creation_form.php">Register</a></ul>

        </body>

    </html>


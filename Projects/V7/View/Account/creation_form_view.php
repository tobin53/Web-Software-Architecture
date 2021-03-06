<?php

if (isset($_REQUEST['submit']) && isset($_REQUEST['username']) && isset($_REQUEST['password']))
{
    verify_Login('');

    header("Location: account_home.php");
}

?>

<!--/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * User Creation Form View -- View for displaying the the user creation form
 *
 */-->

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

        <html lang="en">

            <head>

                <!-- Last Updated Spring 2016 -->
                <!-- Brandon Tobin -->
                <!-- University of Utah -->

                <!-- Account Creation -->

                <title>Account Creation</title>

                <!-- Meta Information about Page -->
                <meta charset="utf-8"/>
                <meta name="AUTHOR"      content="Brndon Tobin"/>
                <meta name="keywords"    content="HTML, Projects"/>
                <meta name="description" content="Landing page for account creation"/>

                <!-- ALL CSS FILES -->
                <!--<link rel="stylesheet" href="../../../../Resources/css/stylesheet.css" type="text/css"/>-->
                <!-- Bootstrap Core CSS -->
                <link href="../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">

            </head>

            <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-0 col-md-1 col-lg-1"></div>
                    <div class="col-sm-12 col-md-10 col-lg-10">

                <div id="header">
                    <h1>University of Utah - CS 4540</h1>
                    <h2>Web Software Architecture - Spring 2016</h2>
                    <h2>Brandon Tobin</h2>
                    <h2>Grad Progress - Assignment 6</h2>
                </div>

                <nav class="navbar navbar-default navbar-inverse topnav " role="navigation">
                    <div class="container topnav">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand topnav" href="#">Website Links</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                             <ul class="nav navbar-nav">
                                <li>
                                    <a href="../../../../index.html">Home</a>
                                </li>
                                <li>
                                    <a href="../../../../Projects/">Projects</a>
                                </li>
                                <li>
                                    <a href="../../../../Class_Examples/">Examples</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                </nav>

                <!-- Navigation -->
                <nav class="navbar navbar-custom " role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Welcome Please Login To Continue</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form method="post" class="navbar-form navbar-right">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">Sign In</button>
                            </form>
                        </div>
                    <!-- /.navbar-collapse -->
                    </div>
                <!-- /.container -->
                </nav>

                <h1>New User Creation Form</h1>

                <p>Please fill in the information below to register for a new user account.</p>

                <!-- Creation form for new user -->
                <form method="post">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed">
                            <tr>
                                <td><label for="name">Full Name:</label></td>
                                <td><input type="text" name="name" id="name" required/></td>
                                <td><span style="color:red"><?php echo $nameError ?></span></td>
                            </tr>
                            <tr>
                                <td><label for="uid">uID Number</label></td>
                                <td><input type="text" size="20" name="uid" id="uid" placeholder="0123456" /></td>
                                <td><span style="color:red"><?php echo $uidError ?></span></td>

                            </tr>
                            <tr>
                                <td><label for="username">Username:</label></td>
                                <td><input type="text" size="20" name="username" id="username" required/></td>
                                <td><span style="color:red"><?php echo $loginError ?></span></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password</label></td>
                                <td><input type="password" size="20" name="password" id="password" /></td>
                                <td><span style="color:red"><?php echo $passwordError ?></span></td>
                            </tr>
                            <tr>
                                <td><label for="password">Confirm Password</label></td>
                                <td><input type="password" size="20" name="confirmedPassword" id="confirmedPassword" /></td>
                                <td><span style="color:red"><?php echo $confirmedPasswordError ?></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-success btn-lg" type="submit" name="submit" value="Register">
                                        Register
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-lg" type="submit" name="submit" value="Cancel">
                                        Cancel
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                            </tr>
                        </table>
                    </div>
                </form>

                </div>
                <div class="col-sm-0 col-md-1 col-lg-1"></div>
            </div>
        </div>


            <!-- jQuery -->
            <script src="../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
            </body>
        </html>

<?php

require('../../View/Partials/partial_view.php');

echo "
    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">

        <html lang=\"en\">

            <head>

                <!-- Last Updated Spring 2016 -->
                <!-- Fumiko Anne Aoki -->
                <!-- University of Utah -->

                <!-- New User Creation Page  -->

                <title>Create Account</title>

                <!-- Meta Information about Page -->
                <meta charset=\"utf-8\"/>
                <meta name=\"AUTHOR\"      content=\"Fumiko Aoki\"/>
                <meta name=\"keywords\"    content=\"HTML, Projects\"/>
                <meta name=\"description\" content=\"New User Creation Page\"/>

                <!-- Bootstrap Core CSS -->
                <link href=\"../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/css/bootstrap.css\" rel=\"stylesheet\">

            </head>

            <body>
                <div class=\"container-fluid\">
                    <div class=\"row\">
                        <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
                        <div class=\"col-sm-12 col-md-10 col-lg-8\">";

                            echo getNavBarWithoutRoles();

                            echo "
                            <h1>Create Account</h1>

                            <form method='post'>
                                <div class=\"form-group\">
                                    <label for=\"username\">Username</label>
                                    <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" placeholder=\"Username\">
                                    <p class=\"text-danger\">{$usernameError}</p>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"password\">Password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" placeholder=\"Password\">
                                    <p class=\"text-danger\">{$passwordError}</p>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"cpassword\">Confirm Password</label>
                                    <input type=\"password\" class=\"form-control\" id=\"cpassword\" name=\"cpassword\" placeholder=\"Password\">
                                    <p class=\"text-danger\">{$cpasswordError}</p>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"name\">Name</label>
                                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Name\">
                                    <p class=\"text-danger\">{$nameError}</p>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"organization\">Greek Organization</label>
                                    <select class=\"form-control\" id='organization' name='organization'>
                                        <option>Alpha Chi Omega</option>
                                        <option>Alpha Phi</option>
                                        <option>Chi Omega</option>
                                        <option>Delta Gamma</option>
                                        <option>Delta Sigma Phi</option>
                                        <option>Kappa Delta Chi</option>
                                        <option>Kappa Kappa Gamma</option>
                                        <option>Kappa Sigma</option>
                                        <option>Omega Delta Phi</option>
                                        <option>Phi Delta Theta</option>
                                        <option>Pi Beta Phi</option>
                                        <option>Pi Kappa Alpha</option>
                                        <option>Sigma Chi</option>
                                        <option>Sigma Nu</option>
                                        <option>Sigma Phi Epsilon</option>
                                        <option>Triangle</option>
                                    </select>
                                </div>
                                <input type='submit' class='btn btn-info' name='submit' value='Submit'>
                            </form>

                        </div>
                        <div class=\"col-sm-0 col-md-1 col-lg-2\"></div>
                    </div>
                </div>

                <!-- jQuery -->
                <script src=\"../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/jquery.js\"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src=\"../../../../Resources/Bootstrap/bootstrap-3.3.6-dist/js/bootstrap.min.js\"></script>

        </body>
    </html>";







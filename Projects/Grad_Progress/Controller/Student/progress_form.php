<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Progress Forms Controller
 *
 */

set_include_path("../../Model/Student/" .PATH_SEPARATOR . "../../View/Student/");

require_once 'progress_form.php';

$id = $_GET['id'];

$form = new Student_Form($id);

require "student_form_view.php";

?>
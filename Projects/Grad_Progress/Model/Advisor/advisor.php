<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Student List Model
 *
 */

class Advisor
{
    public $advisor_First_Name;
    public $advisor_Last_Name;
    public $student_Array;
    public $student_Count;

    public function __construct($id)
    {
        if ($id == 1) {
            $this->create_Peter();
        }
        if ($id == 2) {
            $this->create_James();
        }
        if ($id == 3) {
            $this->create_Brandon();
        }
    }

    function create_Peter()
    {
        $this->advisor_First_Name = 'Peter';
        $this->advisor_Last_Name = 'James';
        $this->student_Array = array("Anne Smith", "In", "January 18, 2016", "Current", "Yes", "View");
        $this->student_Count = 1;
    }

    function create_James()
    {
        $this->advisor_First_Name = 'James';
        $this->advisor_Last_Name = 'Good';
        $this->student_Array = array("Mike Jones", "Out", "December 23, 2014", "Out of Date", "No", "View",
            "Brad Rust", "Out", "October 20, 2015", "Out of Date", "Yes", "View",
            "Neal Cates", "In", "December 25, 2015", "Current", "Yes", "View",
            "Sam Bradford", "Out", "November 10, 2012", "Out of Date", "No", "View");
    }

    function create_Brandon()
    {
        $this->advisor_First_Name = 'Brandon';
        $this->advisor_Last_Name = 'Barnes';
        $this->student_Array = array("Jessica Brown", "In", "January 19, 2016", "Current", "Yes", "View");
    }

}
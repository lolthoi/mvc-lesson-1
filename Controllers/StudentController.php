<?php

namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Models\StudentModel;
use mvc\Models\StudentReponsitory;
use mvc\Models\StudentResourceModel;

class StudentController extends Controller
{
    function index()
    {
        $student = new StudentResourceModel;
        $d['students'] = $student->get();
        $this->set($d);
//        var_dump($student->get());
//        die();
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["name"])) {
            $student = new StudentReponsitory();
            $studentModel = new StudentModel;
            $studentModel->setName($_POST["name"]);
            $studentModel->setAge($_POST["age"]);
            if ($student->add($studentModel)) {
                header("Location: " . WEBROOT . "students/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        $student = new StudentReponsitory();
        $d["student"] = $student->get($id);
        if (isset($_POST["name"])) {
            $studentModel = new StudentModel();
            $studentModel->setId($id);
            $studentModel->setName($_POST["name"]);
            $studentModel->setAge($_POST["age"]);
            if ($student->edit($studentModel)) {
                header("Location: " . WEBROOT . "students/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $student = new StudentReponsitory();
        $studentModel = new StudentModel;
        $studentModel->setId($id);
        if ($student->delete($studentModel)) {
            header("Location: " . WEBROOT . "students/index");
        }
    }
}
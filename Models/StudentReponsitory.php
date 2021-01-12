<?php

namespace mvc\Models;

use mvc\Models\StudentResourceModel;

class StudentReponsitory
{
    private $studentResourceModel;

    public function __construct()
    {
        return $this->studentResourceModel = new StudentResourceModel;
    }

    public function add($model)
    {
        return $this->studentResourceModel->save($model);
    }

    public function edit($model)
    {
        return $this->studentResourceModel->save($model);
    }

    public function delete($model)
    {
        return $this->studentResourceModel->delete($model);
    }

    public function get($id)
    {
        return $this->studentResourceModel->get($id);
    }

    public function getAll()
    {
        return $this->studentResourceModel->get();
    }
}

<?php

namespace mvc\Models;

use mvc\Core\ResourceModel;

class StudentResourceModel extends ResourceModel
{
    public function __construct()
    {
        $this->_init('students', 'id', new StudentModel);
    }
}
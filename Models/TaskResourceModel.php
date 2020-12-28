<?php

namespace mvc\Models;

use mvc\Core\ResourceModel;

class TaskResourceModel extends ResourceModel
{
    public function __construct()
    {
        $this->_init('tasks', 'id', new TaskModel);
    }
}
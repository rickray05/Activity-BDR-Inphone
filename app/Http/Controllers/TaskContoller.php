<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Task;

class TaskContoller extends Controller
{
    public function getTask()
    {
    	$tasks = Task::getTask();

    	var_dump($tasks);die;
    }
}

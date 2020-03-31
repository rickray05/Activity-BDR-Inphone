<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Task;
class TaskContoller extends Controller
{
    public function getTask()
    {
    	$tasks = Task::getTask();

    	return json_encode($tasks,true);
    }

    public function get_detailTask($id)
    {
    	$tasks = Task::getTask($id);

    	return json_encode($tasks,true);
    }

    public function post_completeTask(Request $request)
    {
    	$input = $request->all();

    	$tasks = Task::CompleteTask($input['id']);

    	return json_encode($tasks,true);
    }

    public function post_newTask(Request $request)
    {
    	$input = $request->all();

    	if (empty($input['type'])) {
    		return json_encode(array("message" =>"Bad move! Try removing the task instead of deleting its content."),true);
    	}else{
    		if ($input['type'] != "shopping" && $input['type'] != "work") {
    			return json_encode(array("message" =>"The task type you provided is not supported. You can only use shopping or work."),true);
    		}else{

    			$tasks = Task::newTask($input);

    			return json_encode($tasks,true);
    		}
    	}

    	
    }

    public function post_deleteTask(Request $request)
    {
    	$input = $request->all();

    	$tasks = Task::deleteTask($input['uuid']);

    	return json_encode($tasks,true);
    }

    public function post_editTask(Request $request)
    {
    	$input = $request->all();

    	if (empty($input['type'])) {
    		return json_encode(array("message" =>"Bad move! Try removing the task instead of deleting its content."),true);
    	}else{
    		if ($input['type'] != "shopping" && $input['type'] != "work") {
    			return json_encode(array("message" =>"The task type you provided is not supported. You can only use shopping or work."),true);
    		}else{

    			$tasks = Task::editTask($input);

    			return json_encode($tasks,true);
    		}
    	}
    }
}

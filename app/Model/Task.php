<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	static private $data = array();


    public static function getTask($id = null)
    {
    	$file = file_get_contents('tasks.txt');
		static::$data = json_decode($file,true);

    	$data = array();

    	if ($id) {
    		foreach (static::$data as $key => $value) {
    			if ($value['uuid'] == $id) {
    				$data = $value;
    			}
    		}
    	}else
    		$data = static::$data;


    	if (!empty($data)) {
    		return $data;
    	}else{
    		return array("message" => "Wow. You have nothing else to do. Enjoy the rest of your day!");
    	}

    	
    }

    public static function CompleteTask($id){
    	$file = file_get_contents('tasks.txt');
		static::$data = json_decode($file,true);

    	$data = array();

    	foreach (static::$data as &$value) {
    		if ($value['uuid'] == $id) {
    			$value['done'] = true;
				$data = $value;
			}
    	}

    	if (!empty($data)) {
    		return $data;
    	}else{
    		return array("message" => "This task does not exist or has already been completed.");
    	}
    }

    public static function newTask($input){

    	$file = file_get_contents('tasks.txt');
		static::$data = json_decode($file,true);

    	$data = array();
    	$id = 0;
    	foreach (static::$data as &$value) {
    		if ($value['uuid'] > $id) {
    			$id = $value['uuid'];
    		}
    	}

    	static::$data[] = array(
    		"uuid"         => $id+1,
			"type"         => $input["type"],
			"content"      => $input["content"],
			"sort_order"   => 1,
			"done"         => false,
			"date_created" => date("Y-m-d H:i:s")
    	);

		$file = fopen('tasks.txt','w');

		fwrite($file, print_r(json_encode(static::$data,true), true));

		fclose($file);

    	return static::$data;
    }

    public static function deleteTask($id){

    	$file = file_get_contents('tasks.txt');
		static::$data = json_decode($file,true);

    	$data = array();
    	$keyUuid = null;
    	foreach (static::$data as $key => $value) {
    		if ($value['uuid'] == $id) {
    			$keyUuid = $key;
    		}
    	}

    	if ($keyUuid) {
    		unset(static::$data[$keyUuid]);
    	}else{
    		return array("message" => "Good news! The task you were trying to delete didn't even exist.");
    	}

		$file = fopen('tasks.txt','w');

		fwrite($file, print_r(json_encode(static::$data,true), true));

		fclose($file);

    	return static::$data;
    }

    public static function editTask($input){

    	$file = file_get_contents('tasks.txt');
		static::$data = json_decode($file,true);

    	$data = array();
    	$exists = null;
    	foreach (static::$data as $key => &$value) {
    		if ($value['uuid'] == $input['uuid']) {
    			$value['type'] = $input['type'];
    			$value['content'] = $input['content'];
    			$value['sort_order'] = $input['sort_order'];
    			$value['done'] = $input['done'];

    			$exists = true;
    		}
    	}

    	if ($exists) {
    		$file = fopen('tasks.txt','w');

			fwrite($file, print_r(json_encode(static::$data,true), true));

			fclose($file);

	    	return static::$data;
    	}else{
    		return array("message" => "Are you a hacker or something? The task you were trying to edit doesn't exist.");
    	}
    	
    }
}

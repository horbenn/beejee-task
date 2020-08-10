<?php


namespace App\Controllers;


use App\Components\Controller;

class TasksController extends Controller
{

    public function create()
    {
        return view('create_task');
    }

    public function createPost()
    {

    }

}
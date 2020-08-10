<?php

namespace App\Controllers;


use App\Components\Controller;
use App\Components\Html;
use App\Models\Task;
use App\Repositories\TaskRepository;

class IndexController extends Controller
{
    protected $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    public function index()
    {
        $page = $this->get('page') ?? 1;
        $sort = $this->get('sort');

        $tasks = $this->taskRepository->paginate($page, 3, $sort);

        $total = $this->taskRepository->total();

        $paginator = Html::paginator($page, 3, $total);

        return view('index', [
            'tasks' => $tasks,
            'total' => $total,
            'paginator' => $paginator,
        ]);
    }

}
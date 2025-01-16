<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    protected $gameModel;

    public function __construct()
    {
        $this->gameModel = new GameModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Game Portal - Play Free Online Games',
            'games' => $this->gameModel->where('status', 'active')->findAll()
        ];

        return view('home', $data);
    }
}

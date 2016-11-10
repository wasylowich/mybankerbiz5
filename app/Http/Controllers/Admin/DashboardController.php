<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Mybankerbiz\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $data['tasks'] = [
                [
                        'name' => 'Build Mybanker.biz admin section',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create layouts for customers & bankers',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Experiment with composer packages for Laravel',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Prepare something for Crazy Friday - Day #1',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Incorporate Vue.js',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];

        return view('admin.dashboard.index', $data);
    }
}

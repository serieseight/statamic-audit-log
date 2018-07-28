<?php

namespace Statamic\Addons\AuditLog;

use Statamic\Extend\Controller;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->view('index', [
            'events' => Event::latest()->get()
        ]);
    }

    public function show($id)
    {
        return $this->view('show', [
            'event' => Event::find($id)
        ]);
    }
}

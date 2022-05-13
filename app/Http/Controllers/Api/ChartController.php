<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function sendEntries()
    {
        $entries = Entry::orderBy('date')->pluck('date', 'value');

        return response($entries, 200);
    }
}

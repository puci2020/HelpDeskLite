<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;

class TagController
{
    public function index()
    {
        return Tag::all();
    }
}

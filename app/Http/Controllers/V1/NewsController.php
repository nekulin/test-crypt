<?php


namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return News::filter(request: request())
            ->paginate();
    }
}

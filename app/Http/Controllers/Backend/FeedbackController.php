<?php

namespace App\Http\Controllers\Backend;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedbacks = Feedback::query()->paginate(20);

        return view('backend.feedback.index', compact('feedbacks'));
    }
}

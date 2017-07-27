<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function create()
    {
        return view('frontend.feedback.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $feedback = new Feedback();
        $feedback->content = $request->get('content');
        Auth::id() && $feedback->user_id = Auth::id();
        $feedback->save();

        return redirect()->route('feedback.success');
    }

    public function success()
    {
        return view('frontend.feedback.success');
    }
}

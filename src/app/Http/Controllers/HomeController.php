<?php

namespace App\Http\Controllers;

use App\Model\Bid;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function feedback()
    {
        return view('feedback.feedback');
    }

    public function fb(StoreBid $request)
    {
        $path = $request->file('file')->store('user-files');
        Bid::create([
            'theme'   => $request->theme,
            'message' => $request->message,
            'file'    => $path,
            'user_id' => Auth::user()->id
        ]);
        return back()->with('success', 'Your application is registered');
    }

    public function download(Request $request)
    {
        $path = storage_path('app/' . urldecode($request->file));
        return response()->download($path);
    }

    public function feedbackAll()
    {
        $countPaginate = 10;
        $data          = DB::table('bids')->select(DB::raw('bids.*,users.name,users.email'))->join('users', 'users.id',
                '=', 'bids.user_id')->orderBy('id', 'desc')->paginate($countPaginate);
        $count         = ($data->currentPage() * $countPaginate + 1) - $countPaginate;
        return view('feedback.feedback_all', compact('data', 'count'));
    }

    public function readed(Request $request)
    {
    $bid = Bid::findOrFail($request->id);
    $newData = $bid->readed == '0'?'1':'0';
    $bid->readed = $newData;
    if($bid->save())
    {
        return response()->json(['success'=>'data changed']);
    }
    else{
        return abort(500, 'Something went wrong');
    }
    }
}

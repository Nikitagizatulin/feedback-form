<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBid;
use App\Mail\UserApplication;
use App\Model\Bid;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

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
     * Checking last application of user. If he isset and time less 24
     * - return integer time in milliseconds
     * after which you can send an application
     *
     * @access private
     * @return int
     */
    private function checkLastBid()
    {

        $uid = Auth::user()->id;
        $lastBid = Bid::where('user_id', $uid)->orderBy('id', 'desc')->first();
        if (!$lastBid) {
            return 0;
        }
        $time = $lastBid->created_at;
        $time = Carbon::parse($time);
        $now = Carbon::now();
        $dif = $now->diffInSeconds($time);
        $twentyFourHours = 86400;
        dd([$time, $now , $dif]);
//        array:3 [▼
//  0 => Carbon @1546693752 {#221 ▼
//        date: 2019-01-05 15:09:12.0 Europe/Kiev (+02:00)
//  }
//  1 => Carbon @1546693752 {#228 ▼
//        date: 2019-01-05 15:09:12.041487 Europe/Kiev (+02:00)
//  }
//  2 => 86399
//]

        if ($dif >= $twentyFourHours) {
            return 0;
        } else {
            return $twentyFourHours - $dif; //86399 -- here the problem
        }
    }

    /**
     * This method return view with time in millisecond
     */
    public function feedback()
    {
        /**
         * @var int time in millisecond
         */
        $difTime = $this->checkLastBid();
        return view('feedback.feedback', compact('difTime'));
    }

    public function fb(StoreBid $request)
    {
        $timeToNewBid = $this->checkLastBid();
        if (!empty($timeToNewBid)) {
            $time = Carbon::now()->addSeconds($timeToNewBid)->diffForHumans();
            return back()->with('error',
                'It is allowed to send one application per day. Before the opportunity to send an application ' . $time);
        }
        $path = $request->file('file')->store('public/images');
        $userId = Auth::user()->id;
        $lastId = Bid::create([
            'theme' => $request->theme,
            'message' => $request->message,
            'file' => $path,
            'user_id' => $userId,
        ]);
        $lastId = $lastId->id;
        $mailManager = User::where('user_role', 'manager')->first();
        Mail::to($mailManager->email)
            ->queue(new UserApplication([
                'theme' => $request->theme,
                'message' => $request->message,
                'pathFile' => $path,
                'userId' => $userId,
                'lastId' => $lastId,
            ]));

        return back()->with('success', 'Your application is registered');
    }

    public function download(Request $request)
    {
        $path = storage_path('app/public/images/' . urldecode($request->file));
        return response()->download($path);
    }

    public function feedbackAll()
    {
        /**
         * @var int Count of pagination item in the page
         */
        $countPaginate = 10;
        $data = DB::table('bids')
            ->select(DB::raw('bids.*,users.name,users.email'))
            ->join('users','users.id','=', 'bids.user_id')
            ->orderBy('id', 'desc')
            ->paginate($countPaginate);
        $count = ($data->currentPage() * $countPaginate + 1) - $countPaginate;
        return view('feedback.feedback_all', compact('data', 'count'));
    }

    public function readed(Request $request)
    {
        $bid = Bid::findOrFail($request->id);
        $newData = $bid->readed == '0' ? '1' : '0';
        $bid->readed = $newData;
        if ($bid->save()) {
            return response()->json(['success' => 'data changed']);
        } else {
            return abort(500, 'Something went wrong');
        }
    }

    public function readmore(Request $request)
    {
        $bid = Bid::findOrFail($request->id);
        return $bid->toJson();
    }
}

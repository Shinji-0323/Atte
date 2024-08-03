<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;

class AttendanceController extends Controller
{
    public function index()
    {
        $now_date = Carbon::today();
        $user_id = Auth::user()->id;
        $confirm_date = Work::where('user_id', $user_id)
            ->where('date', $now_date)
            ->first();

        if (!$confirm_date) {
            $status = 0;
        } else {
            $status = Auth::user()->status;
        }
        return view('index', compact('status'));
    }

    public function startWork(Request $request)
    {
        $user = Auth::user();
        $oldTimestamp = Work::where('user_id',$user->id)->latest()->first();

        $oldTimestampDay = '';

        if($oldTimestamp) {
            $oldTimestampStartWork = new Carbon($oldTimestamp->startWork);
            $oldTimestampDay = $oldTimestampStartWork->startOfDay();
        }
        $newTimestampDay = Carbon::today();

        if(($oldTimestampDay == $newTimestampDay) && (empty($oldTimestamp->endWork))){
            return redirect('/');
        };


        $time = Work::create([
            'user_id' => $user->id,
            'date' => Carbon::now(),
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function endWork(Request $request)
    {
        $user = Auth::user();
        $endWork = Work::where('user_id',$user->id)->latest()->first();

        if( !empty($endWork->endWork)) {
            return redirect()->back();
        }
        $endWork->update([
            'end_time' => Carbon::now()
        ]);

        return redirect('/');
        }

    public function startRest(Request $request)
    {
        $user = Auth::user();
        $work = Work::where('user_id',$user->id)->latest()->first();

        $attendance = Rest::create([
            'work_id' => $work->id,
            'start_time' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function endRest(Request $request)
    {
        $user = Auth::user();
        $work = Work::where('user_id',$user->id)->latest()->first();
        $endRest = Rest::where('work_id',$work->id)->latest()->first();

        $endRest->update([
            'end_time' => Carbon::now(),
        ]);

        return redirect('/');
    }

}
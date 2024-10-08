<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $now_date = Carbon::today();
        $user_id = Auth::user()->id;
        $work = Work::where('user_id', $user_id)
            ->whereDate('date', $now_date)
            ->first();

        if (!$work) {
            $status = 1; // 勤務開始前
        } elseif ($work && !$work->work_end) {
            $rest = Rest::where('work_id', $work->id)
                ->orderBy('rest_start', 'desc')
                ->first();
            if (!$rest) {
                $status = 2; // 勤務中
            } elseif ($rest && !$rest->rest_end) {
                $status = 3; // 休憩中
            } else {
                $status = 2; // 勤務中
            }
        } else {
            $status = 4; // 勤務終了
        }


        return view('index', compact('status'));
    }

    public function startWork(Request $request)
    {
        $user = Auth::user();
        $oldTimestamp = Work::where('user_id',$user->id)->latest()->first();

        $time = Work::create([
            'user_id' => $user->id,
            'date' => Carbon::now(),
            'work_start' => Carbon::now(),
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
            'work_end' => Carbon::now()
        ]);

        return redirect('/');
    }

    public function startRest(Request $request)
    {
        $user = Auth::user();
        $work = Work::where('user_id',$user->id)->latest()->first();

        $attendance = Rest::create([
            'work_id' => $work->id,
            'rest_start' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function endRest(Request $request)
    {
        $user = Auth::user();
        $work = Work::where('user_id',$user->id)->latest()->first();
        $endRest = Rest::where('work_id',$work->id)->latest()->first();

        $endRest->update([
            'rest_end' => Carbon::now(),
        ]);

        return redirect('/');
    }

    public function getAttendance(Request $request)
    {
        $displayDate = $request->query('displayDate', Carbon::today()->toDateString());
        $displayDate = Carbon::parse($displayDate);

        $attendances = DB::table('rests')
            ->rightJoin('works', 'rests.work_id', '=', 'works.id')
            ->join('users', 'works.user_id', '=', 'users.id')
            ->whereDate('works.date', $displayDate)
            ->paginate(5)
            ->appends(['displayDate' => $displayDate->toDateString()]);

        return view('attendance', compact('attendances', 'displayDate'));
    }

    public function postAttendance(Request $request)
    {
        $displayDate = Carbon::parse($request->input('displayDate'));

        if ($request->has('prevDate')) {
            $displayDate->subDay();
        }

        if ($request->has('nextDate')) {
            $displayDate->addDay();
        }

        $attendances = DB::table('rests')
            ->rightJoin('works', 'rests.work_id', '=', 'works.id')
            ->join('users', 'works.user_id', '=', 'users.id')
            ->whereDate('works.date', $displayDate)
            ->paginate(5)
            ->appends(['displayDate' => $displayDate->toDateString()]);

        return view('attendance', compact('attendances', 'displayDate'));
    }

    public function user()
    {
        $users = User::paginate(5);
        $displayDate = Carbon::now();

        foreach ($users as $user) {
            $work = Work::where('user_id', $user->id)
                ->whereDate('date', $displayDate)
                ->first();

            if (!$work) {
                $user->status = 1; // 勤務開始前
            } elseif ($work && !$work->work_end) {
                $rest = Rest::where('work_id', $work->id)
                    ->orderBy('rest_start', 'desc')
                    ->first();
                if (!$rest) {
                    $user->status = 2; // 勤務中
                } elseif ($rest && !$rest->rest_end) {
                    $user->status = 3; // 休憩中
                } else {
                    $user->status = 2; // 勤務中
                }
            } else {
                $user->status = 4; // 勤務終了
            }
        }

        return view('/user', compact('users', 'displayDate'));
    }

    public function userData(Request $request)
    {
        $displayUser = Auth::user()->name;
        $attendances = DB::table('rests')
        ->rightJoin('works', 'rests.work_id', '=', 'works.id')
        ->join('users', 'works.user_id', '=', 'users.id')
        ->where('name', $displayUser)
        ->paginate(5);
        $userList = User::all();

        return view('users_data', compact('attendances', 'displayUser', 'userList'));
    }

    public function userDataPer(Request $request)
    {
        $searchName = $request->input('search_name');
        $user = User::where('name', $searchName)->first();
        $displayUser = $user ? $user->name : null;

        $attendances = DB::table('rests')
        ->rightJoin('works', 'rests.work_id', '=', 'works.id')
        ->join('users', 'works.user_id', '=', 'users.id')
            ->where('name', $searchName)
            ->paginate(5);

        $userList = User::all();

        return view('users_data', compact('attendances', 'displayUser', 'userList'));
    }
}
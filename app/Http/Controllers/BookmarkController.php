<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        return auth()->user()->bookmarks()->toggle($question);
    }

    public function index()
    {   $arr = [];
        $questions = DB::table('question_user')->where('user_id','=', auth()->user()->id)->pluck('question_id');
        foreach ($questions as $key=>$value)
        {
            array_push($arr, DB::table('questions')->where('id','=',$value)->get());
        }
        return $arr;
    }

    public function flag($id)
    {
        $flag = DB::table('papers')->where('id',$id)->pluck('flags');
        DB::table('papers')->where('id',$id)->update(['flags'=>$flag[0]+1]);
        return ['message'=>'success'];
    }
}

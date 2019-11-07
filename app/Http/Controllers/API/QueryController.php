<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       $arr=[];
            $col = DB::table('papers')->pluck('subject');
            $file = DB::table('papers')->pluck('file');
            $year = DB::table('papers')->pluck('year');
            $sem = DB::table('papers')->pluck('exam');
            $date = DB::table('papers')->pluck('updated');
            $description = DB::table('papers')->pluck('description');
            array_push($arr,$col,$file,$year,$sem,$date,$description);
            return [$arr, DB::table('papers')->get()];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['src'] === 'user')
        {
            $data = DB::table('papers')->where('year', 'LIKE',$request['option'])
                                                                ->where('subject','=', $request['subject'])
                                                                ->where('exam', '=', $request['sem'])->get();

            return $data;
        }
        else
        {
            $this->authorize('isAdmin');
            $this->validate($request,[
                'path' => 'required|string|max:191',
                'subject' => 'required|string|max:191',
                'sem' => 'required|string|max:191',
                'year' => 'required|string|max:191',
            ]);

            DB::table('papers')->insert([
               'subject' => strtoupper($request['subject']),
               'exam' => $request['sem'],
               'year' => $request['year'],
               'description' => $request['des'],
                'file' => $request['path'],
                'size' => $request['size']
            ]);

            Question::create([
                'subject' => strtoupper($request['subject']),
                'exam' => $request['sem'],
                'year' => $request['year'],
                'description' => $request['des'],
                'file' => $request['path'],
                'size' => $request['size']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return DB::table('question_user')->where('user_id','=', $id)->pluck('question_id');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        DB::table('papers')->where('id','=',$id)->delete();
        DB::table('question_user')->where('question_id','=',$id)->delete();
        DB::table('questions')->where('id','=',$id)->delete();
        return ['message' => 'Deletion successful'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $exams = Exam::all();
        // $exams = Exam::where('enable', 1)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(1);
        // return view('exam.index', compact('exams'));
        $user = Auth::user();
        if ($user and $user->can('建立測驗')) {
            $exams = Exam::orderBy('created_at', 'desc')
                ->paginate(3);
        } else {
            $exams = Exam::where('enable', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(2);
        }

        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        //
        //dd($request);
        // $exam          = new Exam;
        // $exam->title   = $request->title;
        // $exam->user_id = $request->user_id;
        // $exam->enable  = $request->enable;
        // $exam->save();

        // Exam::create([
        //     'title'   => $request->title,
        //     'user_id' => $request->user_id,
        //     'enable'  => $request->enable,
        // ]);
        // $this->validate($request, [
        //     'title' => 'required|min:2|max:255',
        // ], [
        //     'required' => '「:attribute」為必填欄位',
        //     'min'      => '「:attribute」至少要 :min 個字',
        //     'max'      => '「:attribute」最多只能 :max 個字',
        // ]);
        Exam::create($request->all());
        return redirect()->route('exam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
        // $exam = Exam::find($id);
        // dd($exam);
        // $topics = Topic::where('exam_id', $exam->id)->get();
        // return view('exam.show', ['exam' => $exam, 'topics' => $topics]);
        return view('exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
        // $method = 'patch';
        // $action = "/exam/" . $exam->id;
        // $action = route('exam.edit', $exam->id);
        // return view('exam.create', compact('exam', 'method', 'action'));
        return view('exam.create', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());
        return redirect()->route('exam.show', $exam->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

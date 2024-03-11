<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\QuestionImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Question;

class QuestionController extends Controller
{
    // index
    public function index()
    {

        if (request()->ajax()) {
            $query = Question::orderBy('created_at', 'desc')
                ->with('createdBy')
                ->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }
        return view('admin.questions.index');
    }

    // create
    public function create()
    {
        return view('questions.create');
    }

    // store
    public function store(Request $request)
    {

        try {



            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'correct_option' => 'required',
                'status' => 'required',
                'score' => 'required',
            ]);


            if ($validator->fails()) {
                toastr()->addError($validator->errors()->first());
                return redirect()->back();
            }

            $question = new Question();
            $question->title = $request->title;
            $question->option_a = $request->option_a;
            $question->option_b = $request->option_b;
            $question->option_c = $request->option_c;
            $question->option_d = $request->option_d;
            $question->correct_option = $request->correct_option;
            $question->score = $request->score;
            $question->status = $request->status;
            $question->description = $request->description;
            if ($request->image) {
                $image = $request->file('image');
                $image_name = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('/images/question/image'), $image_name);
                $image_name = 'images/question/image/' . $image_name;
                $question->image = $image_name;
            }
            $question->created_by = auth()->user()->id;
            $question->updated_by = auth()->user()->id;

            $question->save();
            toastr()->success('Question created successfully');
            return redirect()->route('admin.questions.index');
        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->back();
        }
    }

    // edit
    public function edit($id)
    {
        $question = Question::find($id);
        return view('questions.edit', compact('question'));
    }

    // upload
    public function upload(Request $request)
    {
        try {
            $file = $request->file('file');

            Excel::import(new QuestionImport, $file);
            dd($file);
            toastr()->success('Questions uploaded successfully');
            return redirect()->route('admin.questions.index');
        } catch (\Throwable $th) {
            toastr()->addError($th->getMessage());
            return redirect()->back();
        }
    }
}

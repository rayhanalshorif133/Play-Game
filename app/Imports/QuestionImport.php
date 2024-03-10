<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToCollection, WithHeadingRow
{


    // collection
    public function collection(Collection $rows)
    {
        $rows->each(function ($item,$index) {
            if($index > 0){
                $question = new Question();
                $question->title = $item['1'];
                $question->option_a = $item['2'];
                $question->option_b = $item['3'];
                $question->option_c = $item['4'];
                $question->correct_option = 'option_a';
                $question->created_by = Auth::id();
                $question->updated_by = Auth::id();
                $question->status = 'active';
                $question->score = 0;
                $question->save();
            }
        });
    }
}

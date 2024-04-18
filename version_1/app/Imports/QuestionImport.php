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

                $options = [$item['2'],$item['3'],$item['4']];
                $answer = $item['2'];

                // shuffle options
                $options = collect($options)->shuffle();

                // find ans
                $correct_option = array_search($answer, $options->toArray());

                if($correct_option == 0){
                    $correct_option = 'option_a';
                }else if($correct_option == 1){
                    $correct_option = 'option_b';
                }else{
                    $correct_option = 'option_c';
                }

                $question = new Question();
                $question->campaign_id = 1;
                $question->title = $item['1'];
                $question->option_a = $options[0];
                $question->option_b = $options[1];
                $question->option_c = $options[2];

                $question->correct_option = $correct_option;
                $question->created_by = Auth::id();
                $question->updated_by = Auth::id();
                $question->status = 1;
                $question->score = 1;
                $question->save();
            }
        });
    }
}

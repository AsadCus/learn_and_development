<?php

namespace Database\Seeders;

use App\Models\Score;
use App\Models\ScoreDetail;
use App\Models\ScoreForm;
use App\Models\ScoreGrade;
use App\Models\ScoreResult;
use App\Models\ScoreType;
use App\Models\ScoreValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $score_grade = [
            [
                'score' => 'SB',
                'point' => '91 - 100'
            ],
            [
                'score' => 'B',
                'point' => '81 - 90'
            ],
            [
                'score' => 'C',
                'point' => '70 - 80'
            ],
            [
                'score' => 'K',
                'point' => '1 - 69'
            ],
        ];

        foreach ($score_grade as $key => $value) {
            ScoreGrade::create($value);
        }

        $score_type = [
            [
                'scoring_type' => 'presentation',
                'score_weight' => 30
            ],
            [
                'scoring_type' => 'job desc',
                'score_weight' => 40
            ],
            [
                'scoring_type' => 'attitude',
                'score_weight' => 30
            ],
        ];

        foreach ($score_type as $key => $value) {
            ScoreType::create($value);
        }

        $score_form = [
            [
                'form' => 'presentation',
                'scoring_type_id' => 1
            ],
            [
                'form' => 'job desc',
                'scoring_type_id' => 2
            ],
            [
                'form' => 'absen',
                'scoring_type_id' => 3
            ],
            [
                'form' => 'sikap & komunikasi',
                'scoring_type_id' => 3
            ],
        ];

        foreach ($score_form as $key => $value) {
            ScoreForm::create($value);
        }

        $score_value = [
            [
                'form_id' => 1,
                'score_select_name' => 'oke',
                'value' => 100,
            ],
            [
                'form_id' => 1,
                'score_select_name' => 'not oke',
                'value' => 50,
            ],
            [
                'form_id' => 2,
                'score_select_name' => 'excellent',
                'value' => 100,
            ],
            [
                'form_id' => 2,
                'score_select_name' => 'good',
                'value' => 62.5,
            ],
            [
                'form_id' => 2,
                'score_select_name' => 'not good',
                'value' => 35,
            ],
            [
                'form_id' => 3,
                'score_select_name' => 'oke',
                'value' => 100,
            ],
            [
                'form_id' => 3,
                'score_select_name' => 'not oke',
                'value' => 0,
            ],
            [
                'form_id' => 4,
                'score_select_name' => 'oke',
                'value' => 100,
            ],
            [
                'form_id' => 4,
                'score_select_name' => 'not oke',
                'value' => 0,
            ],
        ];

        foreach ($score_value as $key => $value) {
            ScoreValue::create($value);
        }

        $scores = [
            [
                'student_id' => 1,
                'scoring_by_user_id' => 9,
                'score_grade' => 'B',
                'point' => 85,
            ],
            [
                'student_id' => 2,
                'scoring_by_user_id' => 9,
                'score_grade' => 'B',
                'point' => 85,
            ],
            [
                'student_id' => 3,
                'scoring_by_user_id' => 10,
                'score_grade' => 'C',
                'point' => 70,
            ],
            [
                'student_id' => 3,
                'scoring_by_user_id' => 10,
                'score_grade' => 'B',
                'point' => 85,
            ],
        ];

        foreach ($scores as $key => $value) {
            Score::create($value);
        }

        $score_results = [
            [
                'student_id' => 1,
                'score_grade' => 'B',
                'point' => 85,
            ],
            [
                'student_id' => 2,
                'score_grade' => 'B',
                'point' => 85,
            ],
            [
                'student_id' => 3,
                'score_grade' => 'C',
                'point' => 77.5,
            ],
        ];

        foreach ($score_results as $key => $value) {
            ScoreResult::create($value);
        }

        $score_detail = [
            [
                'score_id' => 1,
                'form_id' => 1,
                'value_id' => 1,
            ],
            [
                'score_id' => 1,
                'form_id' => 2,
                'value_id' => 3,
            ],
            [
                'score_id' => 1,
                'form_id' => 3,
                'value_id' => 7,
            ],
            [
                'score_id' => 1,
                'form_id' => 4,
                'value_id' => 8,
            ],
            [
                'score_id' => 2,
                'form_id' => 1,
                'value_id' => 1,
            ],
            [
                'score_id' => 2,
                'form_id' => 2,
                'value_id' => 3,
            ],
            [
                'score_id' => 2,
                'form_id' => 3,
                'value_id' => 6,
            ],
            [
                'score_id' => 2,
                'form_id' => 4,
                'value_id' => 9,
            ],
            [
                'score_id' => 3,
                'form_id' => 1,
                'value_id' => 2,
            ],
            [
                'score_id' => 3,
                'form_id' => 2,
                'value_id' => 4,
            ],
            [
                'score_id' => 3,
                'form_id' => 3,
                'value_id' => 6,
            ],
            [
                'score_id' => 3,
                'form_id' => 4,
                'value_id' => 8,
            ],
            [
                'score_id' => 4,
                'form_id' => 1,
                'value_id' => 1,
            ],
            [
                'score_id' => 4,
                'form_id' => 2,
                'value_id' => 3,
            ],
            [
                'score_id' => 4,
                'form_id' => 3,
                'value_id' => 7,
            ],
            [
                'score_id' => 4,
                'form_id' => 4,
                'value_id' => 8,
            ],
        ];

        foreach ($score_detail as $key => $value) {
            ScoreDetail::create($value);
        }
    }
}

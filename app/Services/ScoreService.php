<?php

namespace App\Services;

use App\Models\Score;
use App\Models\ScoreDetail;
use App\Models\ScoreForm;
use App\Models\ScoreGrade;
use App\Models\ScoreResult;
use App\Models\ScoreType;
use App\Models\ScoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreService
{
    public function __construct(ScoreType $scoreType, ScoreForm $scoreForm, ScoreDetail $scoreDetail, ScoreGrade $scoreGrade, Score $score, ScoreResult $scoreResult, ScoreValue $scoreValue)
    {
        $this->scoreType = $scoreType;
        $this->scoreForm = $scoreForm;
        $this->scoreValue = $scoreValue;
        $this->scoreDetail = $scoreDetail;
        $this->scoreGrade = $scoreGrade;
        $this->score = $score;
        $this->scoreResult = $scoreResult;
    }
    
    public function handleGetAllScore()
    {
        $data = $this->score->all();
        return $data;
    }

    public function handleGetAllScoreResult()
    {
        $data = $this->scoreResult->all();
        return $data;
    }

    public function handleGetAllForm()
    {
        $data = $this->scoreForm->get();
        return $data;
    }

    public function handleGetAllFormValue()
    {
        $data = $this->scoreValue->get();
        return $data;
    }

    public function handleGetStudentScore($id)
    {
        $data = $this->score->where('student_id', $id)->get();
        return $data;
    }

    public function handleGetStudentDetailScore($id)
    {
        $dataScoreType = $this->scoreType->get();
        $dataScore = $this->score->where('student_id', $id)->get();

        if ($dataScore) {
            // issue asue
            // honourable mention bangsam
            foreach($dataScore as $index){
                for ($b=0; $b < count($dataScoreType);$b++) { 
                    $countArrayForm[] = count($dataScoreType[$b]->score_forms);
                    $dataforsumvalue[] = $this->scoreDetail->where('score_id', $index->id)
                    ->whereHas('score_form', function ($q) use($b){
                        $q->where('scoring_type_id', $b+1);
                    })->get();
                }
            }
            // issue assue  
    
            foreach ($dataScore as $dskey => $dsitem) {
                foreach ($dataforsumvalue as $dfsvkey => $item) {
                    if (count($item) > 1) {
                        // for ($c=0; $c < count($item); $c++) { 
                        //     $value2[] = $item[$c]->score_value->value;
                        // }
                        foreach ($item as $ikey => $i) {
                                $value2[$ikey] = $i->score_value->value;
                        }
                        $dataValue[] = array_sum($value2)/count($item);
                    } else {
                        $dataValue[] = $item[0]->score_value->value;
                    }
                    foreach ($dataScoreType as $dstkey => $dstitem) {
                        $scoringTypeName[] = $dstitem->scoring_type;
                        
                    }
                    $data[$dfsvkey] = [
                        'scoring_type' => $scoringTypeName[$dfsvkey],
                        'point' => $dataValue[$dfsvkey],
                        'created_at' => $dsitem->created_at,
                    ];
                }
            }
        }
        // dd($data);

        return $data ?? [];
    }

    public function handlePostStoreScore($request)
    {
        $dataScoreType = $this->scoreType->get();
        $dataScoreGrade = $this->scoreGrade->get();
        $dataScoreForm = $this->scoreForm->get();
        $dataValueId = $request->value;
        $dataValue = $this->scoreValue->whereIn('id', $dataValueId)->get()->groupBy('score_form.scoring_type_id');

        foreach ($dataValue as $dvkey => $item) {
            if (count($item) > 1) {
                for ($c=0; $c < count($item); $c++) { 
                    $value2[] = $item[$c]->value;
                }
                $value[] = array_sum($value2)/count($item);
            } else {
                $value[] = $item[0]->value;
            }
        }
        foreach ($dataScoreType as $dstkey => $dstitem) {
            $valueBeforeResult[] = $value[$dstkey] * $dstitem->score_weight / 100;
        }
        $point = array_sum($valueBeforeResult);
        foreach ($dataScoreGrade as $dsgkey => $item) {
            $rangeGrade[$dsgkey] = explode(' - ', $item->point);
            if (($rangeGrade[$dsgkey][0] <= $point) && ($point <= $rangeGrade[$dsgkey][1])) {
                $scoreGrade = $item->score;
                $datates = [
                    'score' => $item->score,
                    'value' => $point,
                    'detail' => $value,
                    'detail_after_weight' => $valueBeforeResult,
                ];
            }
        }
        $dataScore = [
            'student_id' => $request->student_id,
            'scoring_by_user_id' => Auth::user()->id,
            'point' => $point,
            'score_grade' => $scoreGrade,
        ];
        $storedScore = $this->score->create($dataScore);
        $scoreId = $storedScore->id;
        foreach ($request->value as $reqkey => $reqitem) {
            foreach ($dataScoreForm as $dsfkey => $dsfitem) {
                $form_id[] = $dsfitem->id;
            }
            $storedDetail[] = $this->scoreDetail->create([
                'score_id' => $scoreId,
                'form_id' => $form_id[$reqkey],
                'value_id' => $reqitem,
            ]);
        }
        $dataScoreStudent = $this->score->where('student_id', $request->student_id)->get();
        foreach ($dataScoreStudent as $dskey => $dssitem) {
            $pointScoreStudent[] = $dssitem->point;
        }
        $resultPoint = array_sum($pointScoreStudent) / count($dataScoreStudent);
        foreach ($dataScoreGrade as $dsgkey => $item) {
            $rangeGrade[$dsgkey] = explode(' - ', $item->point);
            if (($rangeGrade[$dsgkey][0] <= $resultPoint) && ($resultPoint <= $rangeGrade[$dsgkey][1])) {
                $resultScoreGrade = $item->score;
            }
        }
        $dataScoreResult = $this->scoreResult->where('student_id', $request->student_id)->update([
            'score_grade' => $resultScoreGrade,
            'point' => $resultPoint,
        ]);
        return([
            'score' => $storedScore,
            'score_result' => $dataScoreResult,
            'score_detail' => $storedDetail,
        ]);
    }

    public function handleGetEditScore($id)
    {   
        $data = $this->score->find($id);
        return $data;
    }

    public function handlePutUpdateScore($request)
    {
        $this->score->find($request->id)->update([
        ]);
    }

    public function handlePutDeactiveScore($request)
    {
        $data = $this->score->findorfail($request->id);
        // $data->delete();
    }
}
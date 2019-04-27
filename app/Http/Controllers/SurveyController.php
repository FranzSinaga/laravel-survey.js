<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SurveyCollection;
use App\Survey;
use App\Answer;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $post = new Survey([
            'status_id' => 0,
            'json' => $request->get('json')
        ]);

        $post->save();

        return response()->json('success');
    }

    public function edit($id){
//        $post = Survey::find($id);
        $data = Survey::where('survey_id', $id)->firstOrFail();
        return response()->json($data);
    }

    public function getAnswer($id){
        $user = Answer::where('survey_id', $id)->get() ;
//        return response()->json($user);
        return new SurveyCollection($user);
    }

    public function getAnswerById($id){
        $user = Answer::where('id', $id)->first() ;
        return response()->json($user);
//        return new SurveyCollection($user);
    }

    public function getAnswerResult($id){
        $user = Survey::where('survey_id', $id)->first() ;
        return response()->json($user);
//        return new SurveyCollection($user);
    }

    public function update($id, Request $request){
        $survey = Survey::where('survey_id', $id)->firstOrFail();
        $survey->json = $request->json;
        $survey->save();
        return response()->json('successfully updated');
    }
}

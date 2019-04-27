<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SurveyCollection;
use App\Answer;
use App\Survey;

class AnswerController extends Controller
{
    public function save($id, Request $request){

        $post = new Answer();
        $post->survey_id = $id;
        $post->jsonAnswer = $request->json;
        $post->save();

        return response()->json('successfully updated');
    }
}

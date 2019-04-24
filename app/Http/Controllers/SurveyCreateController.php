<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SurveyCollection;
use App\Survey;
use App\SurveyCreate;

class SurveyCreateController extends Controller
{
    public function store(Request $request)
    {
        $post = new SurveyCreate();
        $post->name = $request->name;
        $post->save();

        $data = SurveyCreate::where('name', $request->name)->firstOrFail();
//        $Survey = new Survey([
//            'survey_id' => $request->get('id')
//        ]);
        $Survey = new Survey();
        $Survey->survey_id = $data->id;
        $Survey->save();
        return response()->json('successfully added');
    }

    public function index(){
        return new SurveyCollection(SurveyCreate::all());
    }
}

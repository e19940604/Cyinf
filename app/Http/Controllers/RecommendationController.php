<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\RecommendationRepository;
use Storage;

class RecommendationController extends Controller
{
    protected $recommendationRepository;

    function __construct(RecommendationRepository $recommendationRepository){
    	$this->recommendationRepository = $recommendationRepository;
    }

    public function update(Request $request){
    	if($request->get('apikey') !== env('APP_KEY') || !$request->hasFile('recommendation'))
    		return response()->json(['Bad req'], 400);

    	$path = storage_path("app/recommendation");
    	$filename = sha1($request->file('recommendation')->getPathName());

    	$request->file('recommendation')->move(storage_path("app/recommendation"), $filename);

    	$recommendation_json_str = file_get_contents($path.'/'.$filename);
    	$recommendation_data    = json_decode($recommendation_json_str, true);
    	if(empty($recommendation_data))
    		return response()->json(['Bad file', 'file' => $recommendation_json_str], 400);

    	$this->recommendationRepository->updateRecommendation($recommendation_data);
    	return response()->json(['success'], 200);
    }

}

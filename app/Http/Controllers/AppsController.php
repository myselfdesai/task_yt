<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class AppsController extends Controller
{
    public function youtube_search_list(Request $request){
      $maxResults = 12; //set default video list
      $video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults='.$maxResults.'&q='.$request->search_query.'&type=video&key='.env('YOUTUBE_KEY').''));
      $response = array(
          'status' => 'success',
          'msg' => $video_list,
      );
      return response()->json($response);
    }
}

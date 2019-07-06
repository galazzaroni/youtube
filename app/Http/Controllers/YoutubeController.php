<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;
use Validator; 

class YoutubeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $input = $request->all();
        
        // valido request
        $validator = Validator::make($input, [
            'search' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Realizo busqueda con lo recibido por get
        $video = Youtube::searchVideos($input['search']);
        if (!$video) {
            return $this->sendError('error.', 'Video not found');
        }
        
        // convierto stdclass a array para luego recorrerlo
        $result = json_decode(json_encode($video), true);

        // obtengo todos los ids de los 10 videos
        foreach ($result as $row=>$key){
            $jsonVideos[] = $key['id']['videoId'];
        }
        // guardo todos los ids en una variable separado por coma para pasarlo como parametro a getVideoInfo()
        $videosIds = implode (", ", $jsonVideos);
        $videosList = Youtube::getVideoInfo([$videosIds]);

        // convierto stdclass a array
        $videosList = json_decode(json_encode($videosList), true);

        // recorro $videosList y guardo los datos formateados en $videos
        $videos = array();
        foreach ($videosList as $video=>$key){
            $videos[] = array('publishedAt' => $key['snippet']['publishedAt'],
                            'id' => $key['id'],
                            'title' => $key['snippet']['title'],
                            'description' => $key['snippet']['description'],
                            'thumbnails' => $key['snippet']['thumbnails']['default']['url'],
                            'extra' => array(
                                'likes' => $key['statistics']['likeCount'],
                                'dislikes' => $key['statistics']['dislikeCount'],
                                'comments' => $key['statistics']['commentCount']
                            )
                        );
        }
        
        // retorno la respuesta
        return $this->sendResponse($videos, '10 results were returned.');
    }
}

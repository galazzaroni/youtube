<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class YoutubeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Youtube::search('muse');
        if (!$video) {
            return $this->sendError('Not Found', '', 400);
        }
        
        $result = json_decode(json_encode($video), true);

        foreach ($result as $row=>$key){
            //var_dump($key['id']);
            var_dump($key['snippet']['publishedAt']);
           // $data['thumbnail'] = $key['thumbnail'];
        }

        /*foreach ($data as $row=>$key) {
            $return['publishedAt'] = $key['publishedAt'];
            $return['title'] = $key['title'];
            $return['description'] = $key['description'];

        }*/


        /*
            "published_at": "2009-10-09T13:15:12.000Z",
            "id": "X8f5RgwY8CI",
            "title": "MUSE - Algorithm [Official Music Video]",       
            "description": "Description here...",
            "thumbnail": "https://i.ytimg.com/vi/TPE9uSFFxrI/default.jpg",
                "extra": {
                    "something": "extra"
                }
            }
        */

        //print_r($data);
        print_r($result);
        //$video = Youtube::getVideoInfo('rie-hPVJ7Sw');
        //return $this->sendResponse($video, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

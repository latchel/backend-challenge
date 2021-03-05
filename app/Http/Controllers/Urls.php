<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use DB;
use App\Url;
use App\User;
use App\FavoriteUrl;

class Urls extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::loginWithToken($request->input('token'));

        if (!$user) {
            abort(403);
        }

        foreach ($user->urls as $url) {
            $url->load("data");
        }

        return $user->urls;
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
        $user = User::loginWithToken($request->input('token'));

        if (!$user) {
            abort(403);
        }

        $validated = $request->validate([
            // 'link' => 'unique:url,url',
        ]);

        $url = Url::create([
            'user_id' => $user->id,
            'url' => $request->input('link')
        ]);

        $client = new Client();
        $key = Url::API_KEY;
        
        $request = $client->request('GET', "http://api.linkpreview.net/?key=$key&q=" . $url->url);
        $response = json_decode($request->getBody()->getContents(), true);
        
        $url->data()->create([
            'title' => $response['title'] ? $response['title'] : "Untitled",
            'description' => !empty($response['description']) ? $response['description'] : 'No description',
            'image' => isset($response['image']) ? $response['image'] : public_path() . 'default.png',
            'url' => $response['url'],
        ]);
        $url->refresh();
        $url->load('data');

        return $url;
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

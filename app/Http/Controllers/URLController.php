<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Math;
use App\Url;
use App\Redirect;
use Jenssegers\Agent\Agent;
use Session;
use Validator;

class URLController extends Controller
{
    public function index(){
        $my_id = time() . 2;
        $base62 = Math::to_base($my_id, 62);

        return $my_id;
    }


    /**
     * Shorten new URL
     * 
     * @param Request $request
     * 
     * @return redirect('/dashboard')
     */
    public function shorten(Request $request){
        
        $rules = [
            'alias' => 'bail|nullable|min:6|unique:urls,url',
            'url' => 'required|url',
        ];

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()){
            // return $validator->errors();
            Session::flash('error', 'There are some errors in your input!');
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        $url = $request['url'];
        $alias = $request['alias'];
        $title = $request['title'];
        $description = $request['description'];

        // Grab title of a webpage
        if(!$request['title'])
        {
            $fp = file_get_contents($url);
            if (!$fp) 
                $title = '';
            $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
            if (!$res) 
                $title = '';

            // Clean up title: remove EOL's and excessive whitespace.
            $title = preg_replace('/\s+/', ' ', $title_matches[1]);
            $title = trim($title);

        }

        
        // Grab description of a webpage
        if(!$description){
            $tags = get_meta_tags($url);

            $description = $tags['description'];
        }

        if (!$alias) {
            $time = time() . auth()->user()->id;
            $alias = Math::to_base($time, 62);
        }

        $new_url = new Url;
        $new_url->url = $alias ;
        $new_url->long_url = $url;
        $new_url->title = $title;
        $new_url->description = $description;
        $new_url->user_id = auth()->user()->id;
        $new_url->save();

        Session::flash('success', 'URL has been shortened!');

        return redirect('/dashboard');

        // return $new_url;

    }

    /**
     * Returns URL's details
     * 
     * @param $id
     */
    public function url($id){

        $url = Url::where('url', $id)->get()->first();
        
        $redirects = Redirect::where('url_id', $url->id)->get();
        
        return view('url')->with([
            'url' => $url,
            'redirects' => $redirects,
        ]);
    }

    /**
     * Edit a URL
     * 
     * @param $id
     * 
     * return redirect()
     */
    public function edit($id){

        $url = Url::where('url', $id)->first();

        return view('edit', compact('url'));
    }

    /**
     * Update url
     * 
     * @param $id
     * 
     * return redirect()
     */
    public function update(Request $request, $id){

        $url = Url::where('url', $id)->first();

        $url->url = $request['alias'];
        $url->long_url = $request['url'];
        $url->save();

        Session::flash('success', 'URL value has been updated!');

        return redirect('u/'. $id);
    }

    /**
     * Redirects to the long URL
     * 
     * @param $id
     * 
     * @return redirect
     */
    public function redirect($id){

        // Increment clicks
        $url = Url::where('url', $id)->firstOrFail();

        if(! $url->is_active){
            abort(404);
        }

        $url->clicks = $url->clicks + 1;
        $url->save();


        // Grab User Agent details
        $agent = new Agent();
        $platform = $agent->platform();
        $browser = $agent->browser();
        $device = ($agent->isPhone())? 1: ($agent->isTablet() ? 2: 3);
        
        
        // Grab redirect details
        $redirect = new Redirect;
        $redirect->url_id = $url->id;
        $redirect->ip = request()->ip(); 
        $redirect->browser = $browser; 
        $redirect->device = $device; 
        $redirect->platform = $platform; 
        $redirect->save();

        return redirect($url->long_url);

    }

    /**
     * Toggle active/inactive
     * 
     * @param Request $request
     * 
     * return redirect
     */
    public function toggle(Request $request, $id){

        $url = Url::where('url', $id)->firstOrFail();

        // return $url;

        $url->is_active = ($request['active'])? 1:0;
        $url->save();

        Session::flash('success', 'Change has been made');

        return redirect('u/'. $id);
    }


    /**
     * Provides data to Charts
     * 
     * @param $id
     * 
     * @return $data 
     */
    public function chart(Request $request){

        $id = $request['id'];
        
        $redirects = Redirect::where('url_id', $id)->get();

        // Devices
        $mobile = count($redirects->filter(function($r){
            return $r['device'] === 1;
        }));
        $tablet = count($redirects->filter(function($r){
            return $r['device'] === 2;
        }));
        $desktop = count($redirects->filter(function($r){
            return $r['device'] === 3;
        }));
        $other_devices = count($redirects->filter(function($r){
            $devices = [1,2,3];
            return (!in_array($r['device'], $devices));
        }));
        


        // Platform
        $windows = count($redirects->filter(function($r){
            return $r['platform'] === 'Windows';
        }));
        $android = count($redirects->filter(function($r){
            return $r['platform'] === 'AndroidOS';
        }));
        $ios = count($redirects->filter(function($r){
            return $r['platform'] === 'iOS';
        }));
        $ubuntu = count($redirects->filter(function($r){
            return $r['platform'] === 'Ubuntu';
        }));
        $other_platforms = count($redirects->filter(function($r){
            $platforms = ['Windows', 'Ubuntu', 'AndroidOS', 'iOS'];
            return (!in_array($r['platform'], $platforms));
        }));


        // Browser
        $chrome = count($redirects->filter(function($r){
            return $r['browser'] === 'Chrome';
        }));
        $safari = count($redirects->filter(function($r){
            return $r['browser'] === 'Safari';
        }));
        $firefox = count($redirects->filter(function($r){
            return $r['browser'] === 'FireFox';
        }));
        $edge = count($redirects->filter(function($r){
            return $r['browser'] === 'Edge';
        }));
        $other_browsers = count($redirects->filter(function($r){
            $browsers = ['Chrome', 'Firefox', 'Edge', 'Safari'];
            return (!in_array($r['browser'], $browsers));
        }));

        return response()->json([
            'devices'=>array(
                'mobile'=> $mobile,
                'tablet'=> $tablet,
                'desktop'=>$desktop,
                'others'=> $other_devices
            ),

            'platforms' => array(
                'windows'=> $windows,
                'android'=> $android,
                'ios'=> $ios,
                'ubuntu'=> $ubuntu,
                'others'=> $other_platforms,
            ),

            'browsers'=> array(
                'chrome'=> $chrome,
                'firefox'=> $firefox,
                'edge'=> $edge,
                'safari'=> $safari,
                'others'=> $other_browsers,
            )
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Twitter;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Stubs\OAuth1ProviderStub;
use SocialiteProviders\Manager\Stubs\OAuth2ProviderStub;

class TwitterController extends Controller
{

    public function redirectToProvider() {
        
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback() {
        $user = Socialite::driver('twitter')->user();

        if (Twitter::where('user_id','=', Auth::user()->id)->first() ){

        }else{
            $twitter = new Twitter;
            $twitter->user_id = Auth::user()->id;
            $twitter->twitter_id = $user->id;
            $twitter->email = $user->email;
            $twitter->name = $user->name;
            $twitter->avatar = $user->avatar;
            $twitter->token = $user->token;
            $twitter->tokenSecret = $user->tokenSecret;
            $twitter->save();
        }

        return redirect('twitter/dashboard');
    }


    
    public function dashboard(){

        return view('twitter.dashboard');
    }

    
    public function tweet(Request $request){

        $twitter = Twitter::where('user_id','=', Auth::user()->id)->first();
        
        $stack = HandlerStack::create();

        $auth = new Oauth1([
            'consumer_key'    => 'gQ3bXaeZCY1nLGHsf2OrjmrYP',
            'consumer_secret' => 'dI7EcB47RdF9d1OMKWXKTz9dIW0GuSUn5tgo5gJiIl4bJEIoVo',
            'token'           => $twitter->token,
            'token_secret'    => $twitter->tokenSecret,
        ]);

        $stack->push($auth);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/1.1/',
            'handler' => $stack,
            'auth' => 'oauth',
        ]);

        $response = $client
            ->post('statuses/update.json', [
                'query' => ['status' => $request->status]
            ]);

        return $response->getBody();

    }

    public function message(Request $request){
        $twitter = Twitter::where('user_id','=', Auth::user()->id)->first();

        $stack = HandlerStack::create();

        $auth = new Oauth1([
            'consumer_key'    => 'gQ3bXaeZCY1nLGHsf2OrjmrYP',
            'consumer_secret' => 'dI7EcB47RdF9d1OMKWXKTz9dIW0GuSUn5tgo5gJiIl4bJEIoVo',
            'token'           => $twitter->token,
            'token_secret'    => $twitter->tokenSecret,
        ]);

        $stack->push($auth);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com/1.1/',
            'handler' => $stack,
            'auth' => 'oauth',
        ]);

        $response = $client
            ->post('direct_messages/new.json', [
                'query' => [
                    'text' => $request->text,
                    'screen_name' => $request->screen_name
                ]
            ]);

        return $response->getBody();

    }
    
    

}

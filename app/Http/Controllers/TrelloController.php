<?php

namespace App\Http\Controllers;

use App\Trello;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TrelloController extends Controller
{
    public function redirectToProvider() {

        return Socialite::driver('trello')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback() {
        $user = Socialite::driver('trello')->user();

        if ( Trello::where('user_id','=', Auth::user()->id)->first() ){

            $user_trello = trello::where('user_id','=', Auth::user()->id)->first();
            $user_trello->trello_id = $user->user['id'];
            $user_trello->email = $user->user['email'];
            $user_trello->name = $user->user['fullName'];
            $user_trello->token = $user->token;
            $user_trello->tokenSecret = $user->tokenSecret;
            $user_trello->save();

        } else {
            $trello = new Trello;
            $trello->user_id = Auth::user()->id;
            $trello->trello_id = $user->user['id'];
            $trello->email = $user->user['email'];
            $trello->name = $user->user['fullName'];
            $trello->token = $user->token;
            $trello->tokenSecret = $user->tokenSecret;
            $trello->save();
        }
        
        return redirect('/home');
    }


    public function dashboard(){

        return view('trello.dashboard');
    }


    public function create_list(Request $request){

        $trello = Trello::where('user_id','=', Auth::user()->id)->first();

        $stack = HandlerStack::create();

        $auth = new Oauth1([
            'consumer_key'    => '11f8fe97697386aef404b0fd5f352dbb',
            'consumer_secret' => '9340ec158b6fe451d0206faabb4e62e15c31557c6ec487bfc4c50b1aa32a881d',
            'token'           => $trello->token,
            'token_secret'    => $trello->tokenSecret,
        ]);

        $stack->push($auth);

        $client = new Client([
            'base_uri' => 'https://api.trello.com/',
            'handler' => $stack,
            'auth' => 'oauth',
        ]);

        $response = $client
            ->post('1/lists', [
                'query' => [
                    'name' => $request->name,
                    'idBoard'=> $request->idBoard,
                ]
            ]);

        return $response->getBody();

    }

    public function create_card(Request $request){
        $trello = Trello::where('user_id','=', Auth::user()->id)->first();

        $stack = HandlerStack::create();

        $auth = new Oauth1([
            'consumer_key'    => '11f8fe97697386aef404b0fd5f352dbb',
            'consumer_secret' => '9340ec158b6fe451d0206faabb4e62e15c31557c6ec487bfc4c50b1aa32a881d',
            'token'           => $trello->token,
            'token_secret'    => $trello->tokenSecret,
        ]);

        $stack->push($auth);

        $client = new Client([
            'base_uri' => 'https://api.trello.com/',
            'handler' => $stack,
            'auth' => 'oauth',
        ]);

        $response = $client
            ->post('1/cards', [
                'query' => [
                    'name' => $request->name,
                    'due' => $request->due,
                    'idList' => $request->idList,
                ]
            ]);

        return $response->getBody();

    }

}

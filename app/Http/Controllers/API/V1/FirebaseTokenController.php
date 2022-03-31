<?php

namespace App\Http\Controllers\API\V1;

use App\FirebaseToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFirebaseTokenRequest;
use App\Http\Resources\FirebaseTokenCollection;
use \App\Http\Resources\FirebaseToken as FirebaseTokenResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirebaseTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FirebaseToken $firebaseToken)
    {
        try {

            $firebaseTokens = $firebaseToken->get();

            return response()->json([
                'api_status' => 1,
                'api_http'   => 200,
                'message'    => trans('firebase_tokens.index.success'),
                'dataBag'    => [
                    'firebase_tokens' => new FirebaseTokenCollection($firebaseTokens)
                ]
            ]);


        } catch (\Exception $exception) {
            report($exception);

            return response()->json([
                'api_status' => 0,
                'api_http'   => $exception->getCode(),
                'message'    => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFirebaseTokenRequest $storeFirebaseTokenRequest
     * @param  \App\FirebaseToken $firebaseToken
     * @return \Illuminate\Http\Response
     */
//    public function store(StoreFirebaseTokenRequest $storeFirebaseTokenRequest, FirebaseToken $firebaseToken)
    public function store(Request $request, FirebaseToken $firebaseToken)
    {
        try {
            $user = \App\User::where('id',$request->user_id)->first();
            if($user){
                DB::table('users')->where('id',$request->user_id)->update(['device_token' => $request->device_token]);
            }
            $firebase = \App\FirebaseToken::where('user_id',$request->user_id)->first();
            if($firebase){
                DB::table('firebase_tokens')->where('user_id',$request->user_id)->update(['device_token' => $request->device_token]);
            }else{
                $firebase_notification = new \App\FirebaseToken();
                $firebase_notification->user_id = $request->user_id;
                $firebase_notification->device_token = $request->device_token;
                $firebase_notification->notification = $request->notification;
                $firebase_notification->save();

            }


            return response()->json([
                'api_status' => 1,
                'api_http'   => 200,
                'message'    => trans('firebase_tokens.store.success'),
            ]);
        } catch (\Exception $exception) {
            report($exception);

            return response()->json([
                'api_status' => 0,
                'api_http'   => $exception->getCode(),
                'message'    => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FirebaseToken  $firebaseToken
     * @return \Illuminate\Http\Response
     */
    public function show(FirebaseToken $firebaseToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreFirebaseTokenRequest $storeFirebaseTokenRequest
     * @param  \App\FirebaseToken $firebaseToken
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFirebaseTokenRequest $storeFirebaseTokenRequest, FirebaseToken $firebaseToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FirebaseToken  $firebaseToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(FirebaseToken $firebaseToken)
    {
        //
    }
}

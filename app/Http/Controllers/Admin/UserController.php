<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $userNotActive = User::where('in_active', false)->where('role_id', NULL)->get();
        $userActive = User::where('in_active', true)->where('role_id', NULL)->get();

        return view('pages.user.index', compact('userActive', 'userNotActive'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $activeStatus = $user->in_active;;

        if($activeStatus){
            $user->update([
                'in_active' => false
            ]);

            $sendmail = Mail::to($user->email)->send(new SendEmail($user,'unactivated'));

            return redirect()->route('user.index')->with('success', 'User has unactivated');
        }else{
            $user->update([
                'in_active' => true
            ]);

            $sendmail = Mail::to($user->email)->send(new SendEmail($user,'activated'));

            return redirect()->route('user.index')->with('success', 'User has activated');
        }
    }

    public function sendNotification($title, $body, $token){
        $data = [
            'title' => $title,
            'body' => $body,
        ];

        $device_token = [];
        
        foreach($token as $t){
            // dd($t);
            $device_token[] = $t;
        }

        // dd($device_token);

        $payload = [
            'registration_ids' => $device_token,
            'notification' => $data
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAASY77r3w:APA91bHfnwyWmKUH8V-rwnSwdJQvd6SM5_fjrWdRzVpHWbxj4bQq9SW1DIVdIHpIPu9S8Qc0U0d3T5BZmmRxrpCzVbsfdGARM2HbJEERRYeTs57j07R_mwjZiQHfPtav9FXvpvELSUne"
            ),
        ));

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);
        
        return response()->json([
            'message' => 'Berhasil mengirim notif',
            'status' => 200,
            'data' => json_encode($response)
        ], 200);
    }
}

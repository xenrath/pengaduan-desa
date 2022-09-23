<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\User;

class AdminComplaintController extends Controller
{
    public function index(){
        $waiting = Complaint::with(['complaintCategory', 'user'])->where('status', 'Waiting')->orderBy('created_at')->get();
        $approved = Complaint::with(['complaintCategory', 'user'])->where('status', 'Approved')->orderBy('created_at')->get();
        $declines = Complaint::with(['complaintCategory', 'user'])->where('status', 'Decline')->orderBy('created_at')->get();
        $finished = Complaint::with(['complaintCategory', 'user'])->where('status', 'Finished')->orderBy('created_at')->get();
        
        return view('pages.complaint.index', compact('approved', 'waiting', 'declines', 'finished'));
    }

    public function show($id){
        $complaint = Complaint::with(['complaintCategory', 'user'])->findOrFail($id);
        // dd($complaint);

        return view('pages.complaint.complaint-detail', compact('complaint'));
    }

    public function update(Request $request, $id){
        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status' => $request->status
        ]);

        $deviceToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        // dd($deviceToken);

        $this->sendNotification("Pemberitahuan", "Pengaduan ".$complaint->complaint_content." telah di ".$request->status, $deviceToken);

        return redirect()->route('complaint.index');
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

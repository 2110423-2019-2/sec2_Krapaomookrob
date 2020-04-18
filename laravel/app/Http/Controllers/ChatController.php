<?php

namespace App\Http\Controllers;

use App\Message;
use Auth;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

define('DIALOGFLOW_KEY' , env("DIALOGFLOW_KEY", null));

class ChatController extends Controller
{
    public function getChatList(Request $request)
    {
        $receiver = $request->$receiver;
        $sender = Auth::user()->id;
        $m1 = Message::where('sender_id', $sender)->where('receiver_id', $receiver)->get();
        $m2 = Message::where('sender_id', $receiver)->where('receiver_id', $sender)->get();
        return $m1->concat($m2)->sortBy('id')->values()->all();
    }

    public function sendMessage(Request $request)
    {
        $content = $content->content;
        $receiver = $request->$receiver;
        $sender = Auth::user()->id;
        $message = Message::create([
              'content' => $content,
              'sender_id' => $sender,
              'receiver_id' => $receiver
            ]);
        //receiver == 1 is AI
        if($receiver != 1){
            broadcast(new MessageSent($message))->toOthers();
            return ['status' => 'Message Sent!'];
        }else{
          $dialogflow = $this->processOutput($content);
          $reply = Message::create([
                'content' => $dialogflow,
                'sender_id' => 1,
                'receiver_id' => $sender
              ]);
          return $reply;
        }
    }

    public function processOutput($msg){
      $encode = rawurlencode($msg);
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.dialogflow.com/v1/query?v=20150910&lang=th&query={$encode}&sessionId=12345",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer ".DIALOGFLOW_KEY
        ),
      ));
      $response = json_decode(curl_exec($curl), true);
      curl_close($curl);
      return $response['result']['fulfillment']['messages'][0]['speech'];
    }
}

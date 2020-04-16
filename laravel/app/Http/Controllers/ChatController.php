<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Auth;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
{
   
    public function getChatList(Request $request)
    {
        $receiver = $request->receiver;
        $sender = Auth::user()->id;
        $m1 = Message::where('sender_id', $sender)->where('receiver_id', $receiver)->get();
        $m2 = Message::where('sender_id', $receiver)->where('receiver_id', $sender)->get();
        return $m1->concat($m2)->sortBy('id')->values()->all();
    }

    public function sendMessage(Request $request)
    {
        $content = $request->content;
        $receiver = $request->receiver;
        $sender = Auth::user()->id;
        $message = Message::create([
              'content' => $content,
              'sender_id' => $sender,
              'receiver_id' => $receiver
            ]);
        //receiver == 1 is AI
        if($receiver != 1){
            broadcast(new MessageSent($message))->toOthers();
        }else{
          $dialogflow = "Sawadee";
          $reply = Message::create([
                'content' => $dialogflow,
                'sender_id' => 1,
                'receiver_id' => $sender
              ]);
          broadcast(new MessageSent($reply));
        }
        return ['status' => 'Message sent!'];
    }

    public function getReceiverList(Request $request){
        $user_id = auth()->user()->id;
        $r1 = Message::where('receiver_id', $user_id)->distinct()->get(['sender_id'])->pluck('sender_id');
        $r2 = Message::where('sender_id', $user_id)->distinct()->get(['receiver_id'])->pluck('receiver_id');
        $AI = 1;
        if($request->receiver_id){
            $receiver_ids = array_unique($r1->concat($r2)->prepend($AI)->prepend($request->receiver_id)->toArray());
            $receiver = User::find($request->receiver_id, ['id', 'name', 'image']);
        }
        else{
            $receiver_ids = array_unique($r1->concat($r2)->prepend($AI)->toArray());
            $receiver = User::find($AI, ['id', 'name', 'image']);
        }
        $receiverList = User::find($receiver_ids, ['id', 'name', 'image']);
        return ['receiverList' => $receiverList, 'receiver' => $receiver];
    }
}

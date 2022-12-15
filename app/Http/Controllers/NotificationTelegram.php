<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendNotificationTelegram;

class NotificationTelegram extends Controller
{
    public function transaction_notif_tele(){

        $data = [
            'id_transaksi' => 'TRK000001',
            'total' => 20000
        ];

        Notification::send('banyak barang', new SendNotificationTelegram('test')); 
        // $user->notify(new SendNotification($invoice));
    }

    // public function sendOfferNotification() {
    //     $userSchema = User::first();
  
    //     $offerData = [
    //         'name' => 'BOGO',
    //         'body' => 'You received an offer.',
    //         'thanks' => 'Thank you',
    //         'offerText' => 'Check out the offer',
    //         'offerUrl' => url('/'),
    //         'offer_id' => 007
    //     ];
  
    //     Notification::send($userSchema, new OffersNotification($offerData));
   
    //     dd('Task completed!');
    // }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Rental;
use App\Models\Notification;
use Carbon\Carbon;

#[Signature('app:cancel-expired-deposits')]
#[Description('Command description')]
class CancelExpiredDeposits extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
      $rentals = Rental::with([
    'payment',
    'rentalDetails.equipment'
])
->where('status', 'menunggu')
->where('deposit_status', 'belum_bayar')
->whereDate(
    'deposit_deadline',
    '<',
    Carbon::today()
)
->get();
    /** @var \App\Models\Rental $rental */

    foreach($rentals as $rental){

        if ($rental->deposit_status == 'belum_bayar') {

            foreach($rental->rentalDetails as $detail){

                $detail->equipment->increment(
                    'stock',
                    $detail->quantity
                );

            }

            $rental->update([

    'status' => 'dibatalkan',

    'deposit_status' => 'expired',

]);

            Notification::create([

                'user_id'=>$rental->user_id,

                'title'=>'Penyewaan Dibatalkan',

                'message' =>
'Penyewaan dibatalkan karena Anda tidak melakukan pembayaran deposit sebelum batas waktu.',

                'is_read'=>false

            ]);

        }

    }

    return self::SUCCESS;
    }
}

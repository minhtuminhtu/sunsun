<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ConfirmMail extends Mailable {
    use Queueable, SerializesModels;

    private $booking_data;

    /**
     * Create a new message instance.
     *
     * @param $booking_data
     */
    public function __construct($booking_data) {
        $this->booking_data = $booking_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $booking_data = $this->booking_data;
        return $this->text('sunsun.mails.booking.confirm')
                    ->subject('【ぬか酸素Sun燦】予約確認のお知らせ')
                    ->with(
                      [
                            'booking_data' => $booking_data
                      ]);
    }
}

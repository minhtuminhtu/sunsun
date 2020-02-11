<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotMail extends Mailable {
    use Queueable, SerializesModels;
    protected $forgot_data;

    /**
     * Create a new message instance.
     *
     * @param $forgot_data
     */
    public function __construct($forgot_data) {
        $this->forgot_data = $forgot_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $forgot_data = $this->forgot_data;
        return $this->text('sunsun.mails.user.complete')
            ->subject('【ぬか天国Sun燦】ユーザー登録完了のお知らせ')
            ->with(
                [
                    'user_data' => $forgot_data
                ]);
    }
}

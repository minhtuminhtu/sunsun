<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompleteMail extends Mailable {
    use Queueable, SerializesModels;
    protected $user_data;

    /**
     * Create a new message instance.
     *
     * @param $user_data
     */
    public function __construct($user_data) {
        $this->user_data = $user_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $user_data = $this->user_data;
        return $this->text('sunsun.mails.user.complete')
            ->subject('【ぬか天国Sun燦】ユーザー登録完了のお知らせ')
            ->with(
                [
                    'user_data' => $user_data
                ]);
    }
}

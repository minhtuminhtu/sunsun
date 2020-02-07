{{ isset($booking_data->booking_data['name'])?$booking_data->booking_data['name']:'' }} 様

この度は、【ぬか天国Sun燦】にご予約いただき、誠にありがとうございます。
ご予約を下記の内容で承りましたのでご確認下さい。

＜＜ご予約内容・注意事項＞＞
@php
    //Regex lấy đoạn body của html
    preg_match('|confirm"[^>]*>(.*?)(?=\<div class="foot-confirm")|si', $booking_data->booking_html, $match);
    echo preg_replace('/\s+/', '
', str_replace(' ', '', strip_tags($match[1])));
@endphp

■アクセス・詳細情報
http://sun-sun33.com/shop

＜＜ご購入金額＞＞

@php
    //Regex lấy đoạn body của html
    preg_match('|table-bordered"[^>]*>(.*?)(?=\<\/tfoot>)|si', $booking_data->payment_html, $match);

    //Change mark thành kí tự cần
    $string_remove_space = preg_replace('/\s+mark_remove_space\s+/', '', strip_tags($match[1]));
    $string_change_colon = preg_replace('/\s+mark_colon\s+/', '：', $string_remove_space);
    $string_change_space = preg_replace('/\s+mark_space\s+/', '  ', $string_change_colon);
    $string_change_yen = preg_replace('/\s+mark_yen\s+/', '円', $string_change_space);
    echo $string_change_yen_newline = preg_replace('/\s+mark_yen_newline\s+/', '円
', $string_change_yen);
@endphp


何かご不明な点等ございましたら、下記お問合せ先までご連絡いただければ幸いです。

どうぞよろしくお願い申し上げます。

-----------------------------------------------------------
ぬか天国 Sun燦
〒656-0131 兵庫県南あわじ市広田中筋296-1
ホームページ http://sun-sun33.com
メールアドレス：pac@printpac.co.jp
TEL：0799-20-7801　FAX：0799-20-7802

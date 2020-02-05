{{ isset($booking_data->booking_data['name'])?$booking_data->booking_data['name']:'' }} 様

この度は、【ぬか天国Sun燦】にご予約いただき、誠にありがとうございます。
ご予約を下記の内容で承りましたのでご確認下さい。

＜＜ご予約内容・注意事項＞＞
@php
    preg_match('|confirm"[^>]*>(.*?)(?=\<div class="foot-confirm")|si', $booking_data->booking_html, $match);
    echo preg_replace('/\s+/', '
', str_replace(' ', '', strip_tags($match[1])));
@endphp

■アクセス・詳細情報
http://sun-sun33.com/shop

＜＜ご購入金額＞＞
@php
    preg_match('|table-bordered"[^>]*>(.*?)(?=\<\/tfoot>)|si', $booking_data->payment_html, $match);
    $re = '/\s+/';
    $str = strip_tags($match[1]);

    preg_match_all($re, $str, $matches, PREG_SET_ORDER);
    $i = 1;
    while(preg_match($re, $str)){
        if($i < count($matches) - 1){
           if($i%3 == 0){
               $str = preg_replace($re, 'space', $str, 1);
           }else if($i%3 == 1){
               $str = preg_replace($re, 'newline', $str, 1);
           }else{
               $str = preg_replace($re, '：', $str, 1);
           }
        }else{
            $str = preg_replace($re, 'space', $str, 1);
        }

        $i++;
    }


    $str = str_replace('space',' ', $str);
    $str = str_replace('newline','
', $str);
    echo $str;
@endphp


何かご不明な点等ございましたら、下記お問合せ先までご連絡いただければ幸いです。

どうぞよろしくお願い申し上げます。

-----------------------------------------------------------
ぬか天国 Sun燦
〒656-0131 兵庫県南あわじ市広田中筋296-1
ホームページ http://sun-sun33.com
メールアドレス：pac@printpac.co.jp
TEL：0799-20-7801　FAX：0799-20-7802

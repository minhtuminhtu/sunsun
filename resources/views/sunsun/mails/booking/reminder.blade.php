{{ isset($booking_data->booking_data['name'])?$booking_data->booking_data['name']:'' }} 様

この度は、【ぬか天国Sun燦】にご予約いただき、誠にありがとうございます。
ご予約の日程が近づいてまいりましたので、ご予約内容をご確認ください。

＜＜ご予約内容・注意事項＞＞
@php
    preg_match('|confirm"[^>]*>(.*?)(?=\<div class="foot-confirm")|si', $booking_data->booking_html, $match);
    echo preg_replace('/\s+/', '
', str_replace(' ', '', strip_tags($match[1])));
@endphp

■アクセス・詳細情報
http://sun-sun33.com/shop

何かご不明な点等ございましたら、下記お問合せ先までご連絡いただければ幸いです。

どうぞよろしくお願い申し上げます。

-----------------------------------------------------------
ぬか天国 Sun燦
〒656-0131 兵庫県南あわじ市広田中筋296-1
ホームページ http://sun-sun33.com
メールアドレス：pac@printpac.co.jp
TEL：0799-20-7801　FAX：0799-20-7802

<html xmlns="https://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title>Sun-sun33</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <meta name="format-detection" content="telephone=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <style type="text/css">
		.h3_title {
			font-size: 14px !important;
			font-weight: 500;
            margin-bottom: 0;
            margin: 0 30px !important;
		}
        .p_title{
            margin: 0 30px !important;
        }
        .main_title{
            padding-top: 30px !important;
        }
        .left_logo{
            padding-top: 30px !important;
            margin: 0 30px !important;
        }
        .footer {
           width: 100%!important;
           color: white!important;
           text-align: center!important;
        }
        .footer-text{
            background-color: #513e29;
            color: #fff;
            padding: 10px!important;
        }
        .mail-container{
            width: 600px !important;
            margin: 0 auto !important;
            background-image: url('https://booking.sun-sun33.com/sunsun/imgs/bg.png');
            padding-top: 10px !important;
        }
        .mail-data{
            width: calc(100% - 20px);
            height: calc(100% - 10px);
            background-color: #fff;
            margin: 0 10px 0 10px !important;
        }
        span {
            display: inline-block !important;
        }
        header.main-header.mean-container {
            display: none;
        }
        footer.main-footer {
            display: none;
        }
        .foot-confirm {
            display: none;
        }
	</style>
</head>
<body class="mail-container">
    <div  class="mail-data">
        <div class="h3_title" style="margin-top: 10px; padding-bottom: 10px;">{{ isset($booking_data->booking_data['name'])?$booking_data->booking_data['name']:'' }} 様</div>
        <div class="h3_title" style="margin-top: 0; padding-bottom: 10px;">
            <span>この度は、【ぬか天国Sun燦】にご予約いただき、誠にありがとうございます。</span>
            <span>ご予約を下記の内容で承りましたのでご確認下さい。</span>
        </div>
        <div class="h3_title" style="margin-top: 0; padding-bottom: 10px;">
            <span>＜＜ご予約内容・注意事項＞＞</span>
        </div>
        <div class="p_title" style="margin-top: 0; padding-bottom: 10px;">
            @php
                echo $booking_data->booking_html;
            @endphp
        </div>
        <div class="h3_title" style="margin-top: 0; padding-bottom: 10px;">
            <div>
                <span>■アクセス・詳細情報</span>
            </div>
            <div>
                <span><a href="http://sun-sun33.com/shop">http://sun-sun33.com/shop</a></span>
            </div>
        </div>
        <div class="h3_title" style="margin-top: 0; padding-bottom: 10px;">
            <span>何かご不明な点等ございましたら、下記お問合せ先までご連絡いただければ幸いです。</span>
        </div>
        <div class="h3_title" style="margin-top: 0; padding-bottom: 40px;">
            <span>どうぞよろしくお願い申し上げます。</span>
        </div>

        <div class="h3_title" style="margin-top: 0; padding-bottom: 10px;">
            <div align="center">
                <span>-----------------------------------------------------------</span>
            </div>
            <div>
                <span>ぬか天国 Sun燦</span>
            </div>
            <div>
                <span>〒656-0131 兵庫県南あわじ市広田中筋296-1</span>
            </div>
            <div>
                <span>ホームページ <a href="http://sun-sun33.com">http://sun-sun33.com</a></span>
            </div>
            <div>
                <span>メールアドレス：pac@printpac.co.jp</span>
            </div>
            <div>
                <span>TEL：0799-20-7801　FAX：0799-20-7802</span>
            </div>
        </div>
    </div>
</body>
</html>

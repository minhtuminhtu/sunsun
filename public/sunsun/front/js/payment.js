!function(e){var r={};function a(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=r,a.d=function(e,r,t){a.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,r){if(1&r&&(e=a(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(a.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var n in e)a.d(t,n,function(r){return e[r]}.bind(null,n));return t},a.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(r,"a",r),r},a.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},a.p="/",a(a.s=12)}({12:function(e,r,a){e.exports=a(13)},13:function(e,r){$((function(){function e(e){var r=e.match(/[^\x00-\xff]/g);return e.length+(r?r.length:0)}var r;$(".payment-method").off("change"),$(".payment-method").on("change",(function(){"credit-card"==$(this).prop("id")?$(".credit-card").show():$(".credit-card").hide()})),$("#card-number, #card-expire, #card-secret").off("keypress"),$("#card-number, #card-expire, #card-secret").on("keypress",(function(e){(e.which<48||e.which>57)&&e.preventDefault()})),$("#email").off("keypress keyup keydown change"),$("#email").on("keypress keyup keydown change",(function(r){var a,t,n=$("#email").val().replace(/[^0-9a-zA-Z@.０-９Ａ-Ｚａ-ｚ＠]/,""),s="";if(n.length!=e(n))for(var i=0;i<n.length;i++)2==e(n.charAt(i))?s+=(a=n.charAt(i),t=void 0,t=a.charCodeAt(0)-65248,String.fromCharCode(t)):s+=n.charAt(i);else s=n;s=s.replace(/[^0-9a-zA-Z@.]/,""),$("#email").val(s)})),$(".card").on("show.bs.collapse",(function(){$(this).find(".payment-method").prop("checked",!0)})),$('[data-toggle="collapse"]').on("click",(function(e){$(this).parents(".accordion").find(".collapse.show")&&($(this).index('[data-toggle="collapse"]')==$(".collapse.show").index(".collapse")&&e.stopPropagation())})),$(".custom-link").off("click"),$(".custom-link").on("click",(function(){Swal.fire({confirmButtonColor:"#d7751e",html:'<div class="hint-content"><div><div class="hint-head">セキュリティコードとは、カード裏面の署名欄やカード表面のカード番号近くに記載されている3桁または4桁の数字です</div><div  class="hint-title">VISA/Mastercard/JCB/Diners</div><div class="hint-align"><img src="sunsun/imgs/hint-visa.png" /></div><div  class="hint-title">American Express</div><div class="hint-align"><img src="sunsun/imgs/hint-ame.png" /></div></div></div>',showCloseButton:!0,showConfirmButton:!1,customClass:"swal-height",confirmButtonText:"閉じる",showClass:{popup:"animated fadeInDown faster"},hideClass:{popup:"animated fadeOutUp faster"},cancelButtonText:'<i class="fa fa-thumbs-down"></i>',allowOutsideClick:!1})})),$("#card-number").off("keyup"),$("#card-number").on("keyup",(function(e){if(0!==$("#card-number").val().length){switch($("#card-number").val($("#card-number").val().replace(/\D/g,"").replace(/(\d{4})/g,"$1 ").trim()),function(e){if(!function(e){if(!/^[\d\-\s]+$/.test(e))return!1;for(var r=0,a=0,t=!1,n=e.replace(/\D/g,""),s=n.length-1;s>=0;s--){var i=n.charAt(s);a=parseInt(i,10),t&&(a*=2)>9&&(a-=9),r+=a,t=!t}return r%10==0}(e))return"";for(var r="",a=[{regEx:/^4[0-9]{5}/gi,cardType:"VISA"},{regEx:/^5[1-5][0-9]{4}/gi,cardType:"MASTERCARD"},{regEx:/^3[47][0-9]{3}/gi,cardType:"AMEX"},{regEx:/^(?:2131|1800|35\d{3})\d{11}$/gi,cardType:"JCB"}],t=0;t<a.length;t++)if(e.match(a[t].regEx)){r=a[t].cardType;break}if(0===e.indexOf("50")||0===e.indexOf("60")||0===e.indexOf("65"))for(var n="508500-508999|606985-607984|608001-608500|652150-653149".split("|"),s=0;s<n.length;s++){var i=parseInt(n[s].split("-")[0],10),o=parseInt(n[s].split("-")[1],10);if(e.substr(0,6)>=i&&e.substr(0,6)<=o&&e.length>=6){r="RUPAY";break}}return r}($("#card-number").val().replace(/\D/g,""))){case"VISA":"VISA"!==r&&$(".card-img").html('<img src="sunsun/svg/cc-visa.svg" class="img-fluid scale-image" alt="">'),r="VISA";break;case"MASTERCARD":"MASTERCARD"!==r&&$(".card-img").html('<img src="sunsun/svg/cc-mastercard.svg" class="img-fluid scale-image" alt="">'),r="MASTERCARD";break;case"AMEX":"AMEX"!==r&&$(".card-img").html('<img src="sunsun/svg/cc-amex.svg" class="img-fluid scale-image" alt="">'),r="AMEX";break;case"JCB":"JCB"!==r&&$(".card-img").html('<img src="sunsun/svg/cc-jcb.svg" class="img-fluid scale-image" alt="">'),r="JCB";break;default:"NONE"!==r&&$(".card-img").html('<img src="sunsun/svg/cc-blank.svg" class="img-fluid scale-image" alt="">'),r="NONE"}$(this).parent().find("span:first-child").css("display","inline"),$(this).removeClass("typing-none"),$(this).addClass("typing")}else console.log("bbb"),$(this).parent().find("span:first-child").css("display","none"),$(this).removeClass("typing"),$(this).addClass("typing-none")})),$("#card-secret").off("keyup"),$("#card-secret").on("keyup",(function(){if(0!==$("#card-secret").val().length){$(this).parent().find("span:first-child").css("display","inline"),$(this).removeClass("typing-none"),$(this).addClass("typing");var e=$("#card-secret").val().replace(/\D/g,"");$("#card-secret").val(e)}else $(this).parent().find("span:first-child").css("display","none"),$(this).removeClass("typing"),$(this).addClass("typing-none")})),$("#make_payment").off("click"),$("#make_payment").on("click",(function(){n()}));var n=function(){"1"===$("input[type=radio][name=payment-method]:checked").val()?t():a()}}));var a=function(){var e=$("form.booking").serializeArray();$("#Token").val(""),console.log(e),$.ajax({url:"/make_payment",type:"POST",data:e,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){void 0!==(e=JSON.parse(e)).error?(Swal.fire({icon:"warning",text:" 入力した内容を確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}),$("p.note-error").remove(),$(".validate_failed").removeClass("validate_failed"),$.each(e.error,(function(e,r){switch($("#"+r).addClass("validate_failed"),console.log(r),r){case"name":$("#"+r).parent().after('<p class="note-error node-text"> お名前をカタカナで入力してください。</p>');break;case"phone":$("#"+r).parent().after('<p class="note-error node-text"> 電話番号は数字のみを入力してください。</p>');break;case"email":$("#"+r).parent().after('<p class="note-error node-text"> 入力したメールアドレスを確認してください。</p>')}})),$.each(e.clear,(function(e,r){$("#"+r).removeClass("validate_failed")}))):void 0!==e.status&&"success"==e.status?($("#bookingID").val(e.message.bookingID),$("#tranID").val(e.message.tranID),$("#completeForm").submit()):void 0!==e.status&&"error"==e.status&&Swal.fire({icon:"warning",text:e.message,confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1})},complete:function(){loader.css({display:"none"})}})};function t(){if(""!=function(e){if(!function(e){if(!/^[\d\-\s]+$/.test(e))return!1;for(var r=0,a=0,t=!1,n=e.replace(/\D/g,""),s=n.length-1;s>=0;s--){var i=n.charAt(s);a=parseInt(i,10),t&&(a*=2)>9&&(a-=9),r+=a,t=!t}return r%10==0}(e))return"";for(var r="",a=[{regEx:/^4[0-9]{5}/gi,cardType:"VISA"},{regEx:/^5[1-5][0-9]{4}/gi,cardType:"MASTERCARD"},{regEx:/^3[47][0-9]{3}/gi,cardType:"AMEX"},{regEx:/^(?:2131|1800|35\d{3})\d{11}$/gi,cardType:"JCB"}],t=0;t<a.length;t++)if(e.match(a[t].regEx)){r=a[t].cardType;break}if(0===e.indexOf("50")||0===e.indexOf("60")||0===e.indexOf("65"))for(var n="508500-508999|606985-607984|608001-608500|652150-653149".split("|"),s=0;s<n.length;s++){var i=parseInt(n[s].split("-")[0],10),o=parseInt(n[s].split("-")[1],10);if(e.substr(0,6)>=i&&e.substr(0,6)<=o&&e.length>=6){r="RUPAY";break}}return r}($("#card-number").val().replace(/\D/g,""))){payment_init();var e=$("#card-number").val().replace(/\D/g,""),r=$("#expire-year").val().toString()+$("#expire-month").val().toString(),a=$("#card-secret").val().replace(/\D/g,"");Multipayment.getToken({cardno:e,expire:r,securitycode:a,tokennumber:1},execPurchase)}else $("#card-number").addClass("error"),$("#card-secret").addClass("error"),$("#expire-month").addClass("error"),$("#expire-year").addClass("error"),$("#card-number").after('<p class="note-error node-text">正しいカード番号を入力してください。</p>')}"undefined"==typeof execPurchase&&(execPurchase=function(e){console.log(e),$("p.note-error").remove(),"000"!=e.resultCode?($("#card-number").addClass("error"),$("#card-secret").addClass("error"),$("#expire-month").addClass("error"),$("#expire-year").addClass("error"),$("#card-number").after('<p class="note-error node-text">正しいカード番号を入力してください。</p>')):($("#card-number").removeClass("error"),$("#card-secret").removeClass("error"),$("#expire-month").removeClass("error"),$("#expire-year").removeClass("error"),$("#Token").val(e.tokenObject.token),a())})}});
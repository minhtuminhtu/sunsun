$((function(){var e=$(".main-head__top"),t=$("#input-current__date"),o=t.datepicker({language:"ja",weekStart:1,dateFormat:"yyyy/mm/dd",autoclose:!0,onSelect:function(){var e=$(this).datepicker("getDate");e.setDate(e.getDate()+1-(e.getDay()||7));var t=new Date(e.getTime());t.setDate(t.getDate()+6)}});$("#button-current__date").off("click"),$("#button-current__date").on("click",(function(e){$("#input-current__date").focus()})),$("#input-current__view").off("click"),$("#input-current__view").on("click",(function(e){$("#input-current__date").focus()})),t.on("input change",(function(e){var t,o,a=$(this).val().split("/").join("");t=moment(new Date($("#input-current__date").val())),o=new Array("日","月","火","水","木","金","土"),$("#input-current__view").val(t.format("YYYY")+"/"+t.format("MM")+"/"+t.format("DD")+"("+o[t.weekday()]+")"),window.location.href=$curent_url+"?date="+a})),""===t.val()&&(o.datepicker("setDate",new Date),t.trigger("input")),e.on("click",".prev-date",(function(e){var a=o.datepicker("getDate");a.setTime(a.getTime()-864e5),o.datepicker("setDate",a),t.trigger("input")})),e.on("click",".next-date",(function(e){var a=o.datepicker("getDate");a.setTime(a.getTime()+864e5),o.datepicker("setDate",a),t.trigger("input")}));var a=$("#edit_booking");a.on("show.bs.modal",(function(e){$(".modal .modal-dialog").attr("class","modal-dialog modal-dialog-centered zoomIn  animated faster")})),$("#edit_booking").off("click",".btn-cancel"),$("#edit_booking").on("click",".btn-cancel",(function(e){$(".modal .modal-dialog").attr("class","modal-dialog modal-dialog-centered zoomOut  animated faster"),setTimeout((function(){a.modal("hide")}),500)})),$("#edit_booking").off("click",".btn-delete"),$("#edit_booking").on("click",".btn-delete",(function(e){var t=window.location.origin+"/sunsun/imgs/icons/delete.png",o=$("#edit_booking").find("#booking_id").val(),a=$("#edit_booking").find("#ref_booking_id").val(),n="予約者の予約を削除すると、同行者の予約も削除されます。全ての予約を削除しますか？";""!=a&&(n="同行者の予約を削除しても、予約者の予約は削除されません。同行者の予約を削除しますか？"),Swal.fire({target:"#edit_booking",text:n,imageUrl:t,imageWidth:"5em",imageHeight:"5em",showCancelButton:!0,confirmButtonColor:"#ff0000",cancelButtonColor:"#ffc000",confirmButtonText:"削除する",cancelButtonText:"キャンセル",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(e){e.value&&$.ajax({url:"/admin/delete_booking",type:"POST",data:{booking_id:o,ref_booking_id:a},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){!0===(e=JSON.parse(e)).status&&($("#edit_booking").modal("hide"),window.location.reload())},complete:function(){loader.css({display:"none"})}})}))}));var n=function(e,t,o){var n=$(e).find(".booking-id").val(),i=e.parentElement.parentElement.id.replace("row_","");"05"==t&&(i=e.id.replace("r_pet_","").split("-")[0]);var r="";if("01"==t){r="1";for(var l=e.parentElement.classList,s=0;s<l.length;s++)if(l[s].indexOf("famale")>0){r="2";break}}var d="";(""!=n&&null!=n||(d=$("#input-current__date").val(),"02"!=t))&&$.ajax({url:"/admin/edit_booking",type:"POST",data:{new:0,booking_id:n,type_admin:t,sex_admin:r,date_admin:d,time_admin:i,bed_admin:o},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){a.find(".mail-booking").html(e),a.modal({show:!0,backdrop:"static",keyboard:!1}),c()},complete:function(){loader.css({display:"none"})},error:function(e){419===e.status&&Swal.fire({text:"セッションがタイムアウトされました。ウェブサイトをリロードしてください。",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(e){e.value&&window.location.reload(!0)}))}})};function i(e){if(null!=e&&""!=e)return e.split("_")[1]}function r(e){var t=new Date(e);return!isNaN(t.getTime())&&6!=(t=moment(t)).weekday()&&0!=t.weekday()}$(".main-col__data").not(".bg-free").not(".bg-dis").off("click"),$(".main-col__data").not(".bg-free").not(".bg-dis").on("click",(function(e){$(this).find(".control-align_center").text()||n(this,"01",i(this.id))})),$(".main-col__pet").not(".space-white").not(".head").not(".bg-dis").off("click"),$(".main-col__pet").not(".space-white").not(".head").not(".bg-dis").on("click",(function(e){n(this,"05","")})),$(".main-col__wt").not(".not-wt").not(".head").not(".bg-dis").off("click"),$(".main-col__wt").not(".not-wt").not(".head").not(".bg-dis").on("click",(function(e){n(this,"02",i(this.id))})),$("#go-weekly").off("click"),$("#go-weekly").on("click",(function(e){var t=o.datepicker("getDate"),a=moment(t).clone().startOf("isoweek"),n=moment(a).add(0,"days").format("YMMDD"),i=moment(a).add(6,"days").format("YMMDD"),r=$curent_url.substring(0,$curent_url.length-3)+"weekly";window.location.href=r+"?date_from="+n+"&date_to="+i})),$("#go-monthly").off("click"),$("#go-monthly").on("click",(function(e){var t=o.datepicker("getDate"),a=moment(t).format("YMM"),n=$curent_url.substring(0,$curent_url.length-3)+"monthly";window.location.href=n+"?date="+a})),$("#go-user").off("click"),$("#go-user").on("click",(function(e){var t=$curent_url.substring(0,$curent_url.length-9)+"admin/msuser";window.location.href=t})),$("#go-timeoff").off("click"),$("#go-timeoff").on("click",(function(e){var t=$curent_url.substring(0,$curent_url.length-9)+"admin/time_off";window.location.href=t})),$("#edit_booking").off("click",".btn-update"),$("#edit_booking").on("click",".btn-update",(function(e){if(e.preventDefault(),"03"==JSON.parse($("#course").val()).kubun_id){$("#date").removeClass("validate_failed");var t=$("#date-value").val(),o=!1;if(null!=t&&t.length>=8&&(o=r(t=t.substring(0,4)+"/"+t.substring(4,6)+"/"+t.substring(6,8))),!o)return void $("#date").addClass("validate_failed")}if($("p.note-error").remove(),"0"===$("select[name=gender]").val())$("select[name=gender]").addClass("validate_failed"),$("select[name=gender]").after('<p class="note-error node-text">性別が空白できません。</p>');else if(void 0===$("#room").val()||"01"==JSON.parse($("#room").val()).kubun_id||""!=$("#range_date_start").val()&&"－"!=$("#range_date_start").val()&&""!=$("#range_date_end").val()&&"－"!=$("#range_date_end").val()){var a=$("form.booking").serializeArray();$.ajax({url:$site_url+"/admin/update_booking",type:"POST",data:a,dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){0==e.status&&"validate"==e.type?(s(e.message.booking),l(e.message.payment),Swal.fire({icon:"warning",text:"入力した内容を確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1})):($("#edit_booking").modal("hide"),window.location.reload())},complete:function(){loader.css({display:"none"})},error:function(e){419===e.status&&Swal.fire({target:"#edit_booking",text:"セッションがタイムアウトされました。ウェブサイトをリロードしてください。",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(e){e.value&&window.location.reload(!0)}))}})}else $("#range_date_start").addClass("validate_failed"),$("#range_date_end").addClass("validate_failed"),$("#range_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> 宿泊日は空白できません。</p>')})),$("#edit_booking").on("click","#credit-card",(function(e){return!1}));var l=function(e){$("p.note-error").remove(),$.each(e.error,(function(e,t){switch($("#"+t).css({border:"solid 1px #f50000"}),t){case"name":$("#"+t).parent().after('<p class="note-error node-text"> お名前をカタカナで入力してください。</p>');break;case"phone":$("#"+t).parent().after('<p class="note-error node-text"> 電話番号は数字のみを入力してください。</p>');break;case"email":$("#"+t).parent().after('<p class="note-error node-text"> 入力したメールアドレスを確認してください。</p>')}})),$.each(e.clear,(function(e,t){$("#"+t).css({border:"solid 1px #ced4da"})}))},s=function(e){if($("p.note-error").remove(),void 0!==e.clear_border_red&&$.each(e.clear_border_red,(function(e,t){$("#"+t.element).css({border:"solid 1px #ced4da"}),$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #ced4da"}),$("select[name=gender]").css({border:"solid 1px #ced4da"})})),void 0!==e.error_time_transport&&$.each(e.error_time_transport,(function(e,t){var o=$("#"+t.element);o.css({border:"solid 1px #f50000"});var a=JSON.parse($("#repeat_user").val());"01"==a.kubun_id?o.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>'):"02"==a.kubun_id&&o.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>'),$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #f50000"})})),void 0!==e.error_time_gender&&$.each(e.error_time_gender,(function(e,t){var o=$("#"+t.element);o.css({border:"solid 1px #f50000"}),o.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>'),$("select[name=gender]").css({border:"solid 1px #f50000"})})),void 0!==e.error_time_empty&&$.each(e.error_time_empty,(function(e,t){var o=$("#"+t.element);o.css({border:"solid 1px #f50000"}),o.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>')})),void 0!==e.room_select_error){$.each(e.room_select_error,(function(e,t){$("#"+t.element).css({border:"solid 1px #f50000"})}));var t="選択された日は予約できません";"1"==e.room_error_holiday&&(t="定休日が含まれているため予約できません"),$("#range_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+t+"。</p>")}void 0!==e.error_fasting_plan_holyday&&($.each(e.error_fasting_plan_holyday,(function(e,t){$("#"+t.element).addClass("validate_failed")})),t="定休日が含まれているため予約できません",$("#plan_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+t+"。</p>"))};"undefined"==typeof load_search_event&&(load_search_event=function(){$(".list-group-item").off("click"),$(".list-group-item").on("click",(function(e){var t=$(this).find(".search-element").val();$.ajax({url:"/admin/ajax_name_search",type:"POST",data:{name:t},success:function(e){var o="";e=e.result,$.each(e,(function(e,t){var a=null==t.ref_booking_id?"":"同行者",n="";switch(t.course){case"01":n="入浴";break;case"02":n="朝リ";break;case"03":n="貸切";break;case"04":n="断食初";break;case"05":n="Pet";break;case"06":n="断食リ";break;case"07":n="昼ス";break;case"08":n="美肌";break;case"09":n="免疫";break;case"10":n="昼り";break;default:n=""}var i=moment(t.service_date).format("Y/M/D"),r=parseInt(t.time.substr(0,2),10),l=t.time.substr(2,2);o+="<li class=\"list-group-item link-class list-body\"><input type='hidden' class='bookingSeclect' value='"+t.booking_id+"' /><input type='hidden' class='dateSeclect' value='"+t.service_date+"' /><input type='hidden' class='timeSeclect' value='"+t.time+"' />"+t.name+a+" ["+n+"] "+i+" "+r+":"+l+"</li>"})),Swal.fire({html:'<ul><li class="list-group-item link-class list-head">'+t+"</li>"+o+"</ul>",text:" 入力した内容を確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:500,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}),$("#search").val(""),$("#result").html(""),$(".search-button").html(""),$(".list-group-item.list-body").off("click"),$(".list-group-item.list-body").on("click",(function(e){$("#bookingSeclect").val($(this).find(".bookingSeclect").val()),$("#timeSeclect").val($(this).find(".timeSeclect").val()),$("#selectCourse").attr("action",$("#selectCourse").attr("action")+"?date="+$(this).find(".dateSeclect").val()).submit()}))},beforeSend:function(){loader.css({display:"block"})},complete:function(){loader.css({display:"none"})}})}))});var c=function(){$("#collapseOne").collapse("hide"),$("#headingOne").on("click",(function(e){e.preventDefault()})),$(".card").on("show.bs.collapse",(function(){$(this).find(".payment-method").prop("checked",!0)})),$('[data-toggle="collapse"]').on("click",(function(e){if("nav"!==$(this).attr("id")){var t=$(this).index('[data-toggle="collapse"]');(0===t||$(this).parents(".accordion").find(".collapse.show")&&t===$(".collapse.show").index(".collapse"))&&e.stopPropagation()}}))};$(document).bind("contextmenu",(function(e){e.preventDefault()})),$(".main-col__data").not(".bg-free").not(".bg-dis").contextmenu((function(){var e=$(this).find(".payment_id").val();""!==e&&void 0!==e&&Swal.fire({html:"オーダーID: "+e,showCloseButton:!0,showConfirmButton:!1,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1})})),$(".main-col__pet").not(".space-white").not(".head").not(".bg-dis").contextmenu((function(){var e=$(this).find(".payment_id").val();""!==e&&void 0!==e&&Swal.fire({html:"オーダーID: "+e,showCloseButton:!0,showConfirmButton:!1,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1})})),$(".main-col__wt").not(".not-wt").not(".head").not(".bg-dis").contextmenu((function(){var e=$(this).find(".payment_id").val();""!==e&&void 0!==e&&Swal.fire({html:"オーダーID: "+e,showCloseButton:!0,showConfirmButton:!1,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1})})),$("#txt_notes").focusout((function(){$.ajax({url:"/admin/ajax_save_notes",type:"POST",data:{date_notes:$("#input-current__date").val(),txt_notes:$("#txt_notes").val().trim()},success:function(e){console.log(e)}})}))}));
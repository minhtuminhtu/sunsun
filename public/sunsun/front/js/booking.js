!function(e){var t={};function a(n){if(t[n])return t[n].exports;var i=t[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,a),i.l=!0,i.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)a.d(n,i,function(t){return e[t]}.bind(null,i));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=8)}({8:function(e,t,a){e.exports=a(9)},9:function(e,t){function a(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var n="3,4",i=!1,o=!1,d=!1,l="";$((function(){var e=0,t=$("#modal_confirm");window.onpopstate=function(t){!1===t.state.booking&&0!==e?$("#back_2_booking").submit():(e++,history.forward())},history.pushState({booking:!1},"Not checked",""),history.pushState({booking:!0},"Checked",""),history.back();var a=$("#choice_date_time"),b=["日","月","火","水","木","金","土"],h=moment();3==h.weekday()?h=moment(h).add(2,"days"):4==h.weekday()&&(h=moment(h).add(1,"days"));var g=moment(h).add(1,"days"),k=function(e,t,a,n){$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #ced4da"}),""==e&&(e=$("#course").val());var i={service:e,course_data:t,course_time:a,pop_data:n};"on"==$("input[name=add_new_user]").val()&&(i.add_new_user="on"),$.ajax({url:$site_url+"/get_service",type:"POST",data:i,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){$(".service-warp").empty().append(e).hide().fadeIn("slow"),w(!0),f(),M(),function(){var e=document.getElementById("course");if(null==e||null==e)return;var t=JSON.parse(e.value);if("05"==t.kubun_id)return;var a,n=document.getElementById("lunch"),i=document.getElementById("whitening"),o=document.getElementById("pet_keeping"),d=document.getElementById("lunch_guest_num"),l="01",r="01",s="01";if("01"==t.kubun_id){if(null==n||null==n)return;l=v(n)}if("01"==t.kubun_id||"02"==t.kubun_id||"03"==t.kubun_id){if(null==i||null==i)return;r=v(i)}if("03"==t.kubun_id){if(null==d||null==d)return;s=v(d)}if(null==o||null==o)return;a=v(o),("01"!=l||"01"!=r||"01"!=s||"01"!=a)&&y("btn-collapse-between")}()},complete:function(){loader.css({display:"none"})}})};t.on("shown.bs.modal",(function(e){$("#confirm_cancel").off("click"),$("#confirm_cancel").on("click",(function(e){e.preventDefault(),t.modal("hide")})),$("#confirm_ok").off("click"),$("#confirm_ok").on("click",(function(e){e.preventDefault(),d=!0,t.modal("hide")})),$("#edit_booking .modal-dialog").css("opacity",.7)})),t.on("hidden.bs.modal",(function(e){d?k($("#course").val(),$("#course_data").val(),$("#course_time").val(),$("#pop_data").val()):$("#course").val(l),$("#edit_booking .modal-dialog").css("opacity",1),$("body").addClass("modal-open")})),$("#course").on("focusin",(function(){l=$("#course").val()})),$("#course").on("change",(function(){"undefined"!=typeof _date_admin&&""!=_date_admin||!o?k($("#course").val(),$("#course_data").val(),$("#course_time").val(),$("#pop_data").val()):(d=!1,t.modal({show:!0,backdrop:!1,keyboard:!1}))})),"undefined"!=typeof _date_admin&&""!=_date_admin||k($("#pick_course").val(),$("#course_data").val(),$("#course_time").val(),$("#pop_data").val());var w=function(){var e=h.format("Y")+"/"+h.format("MM")+"/"+h.format("DD"),t=g.format("Y")+"/"+g.format("MM")+"/"+g.format("DD");function a(){var e=n;return void 0!==$("#course")&&null!=$("#course")&&$("#course").val().indexOf('"kubun_id":"03"')>=0&&(e+="6,0"),e}if(""==$("#date").val()&&void 0!==$("#date").val()&&$("#date").val(e),""==$("#plan_date_start").val()&&$("#plan_date_start").val(e),""==$("#plan_date_end").val()&&$("#plan_date_end").val(t),$("#room").off("change"),$("#room").on("change",(function(){var e=JSON.parse($("#room").val());"01"==e.kubun_id?$(".room").hide():$.ajax({url:$site_url+"/get_free_room",type:"POST",data:{room:e.kubun_id},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){e=JSON.parse(e),$(".input-daterange").datepicker("destroy"),$("#range_date_start").val(e.now);var t=moment(new Date(e.now));2==t.weekday()?$("#range_date_end").val(t.add(3,"days").format("Y/MM/DD")):$("#range_date_end").val(t.add(1,"days").format("Y/MM/DD"));$("#course").val().indexOf('"kubun_id":"03"'),window.location.href.includes("admin")?$(".input-daterange").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:a(),datesDisabled:e.date_selected,weekStart:1,orientation:"bottom"}):$(".input-daterange").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:a(),datesDisabled:e.date_selected,weekStart:1,orientation:"bottom"});var n=moment(new Date($("#range_date_start").val())),i=moment(new Date($("#range_date_end").val()));$("#range_date_start-view").val(n.format("YYYY")+"年"+n.format("MM")+"月"+n.format("DD")+"日("+b[n.weekday()]+")"),$("#range_date_end-view").val(i.format("YYYY")+"年"+i.format("MM")+"月"+i.format("DD")+"日("+b[i.weekday()]+")"),$("#range_date_start-value").val(n.format("YYYYMMDD")),$("#range_date_end-value").val(i.format("YYYYMMDD")),p(),$(".room").show()},complete:function(){loader.css({display:"none"})}})})),$("#whitening").off("change"),$("#whitening").on("change",(function(){"01"==JSON.parse($("#whitening").val()).kubun_id?$(".whitening").hide():$(".whitening").show()})),DatePicker={hideOldDays:function(){var e=$("td.old.day");e.length>0&&(e.css("visibility","hidden"),7===e.length&&e.parent().hide())},hideNewDays:function(){var e=$("td.new.day");e.length>0&&e.hide()},hideOtherMonthDays:function(){DatePicker.hideOldDays(),DatePicker.hideNewDays()}},window.location.href.includes("admin")?($("#date").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",startDate:new Date,autoclose:!0,daysOfWeekDisabled:a(),datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}),"undefined"!=typeof _date_admin&&""!=_date_admin&&(o||function(){if("05"==_type_admin){var e=document.getElementById("course");if(null==e||null==e)return;for(var t=e.length,a=0;a<t;a++){if("05"==JSON.parse(e[a].value).kubun_id){e.value=e[a].value;break}}}else _type_admin="01";$("#course").change()}(),void 0!==$("#date")&&null!=$("#date")&&$("#date").val(_date_admin)),o=!0):$("#date").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",startDate:new Date,autoclose:!0,daysOfWeekDisabled:a(),datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}),$("#date").datepicker().off("hide"),$("#date").datepicker().on("hide",(function(e){!function(){$("#error_time_0").val("－"),$("#time\\[0\\]\\[value\\]").val(0),$("#time\\[0\\]\\[bed\\]").val(0),$("#time\\[0\\]\\[json\\]").val(""),$(".time-content").empty(),$("#time1-value").val(0),$("#time1-bed").val(0),$("#time1-view").val("－"),$("#time\\[0\\]\\[json\\]").val(""),$("#time2-value").val(0),$("#time2-bed").val(0),$("#time2-view").val("－"),$("#time\\[1\\]\\[json\\]").val(""),$("#time_room_value").val(0),$("#time_room_bed").val(0),$("#time_room_view").val("－"),$("#time\\[0\\]\\[json\\]").val(""),$("#time_room_time1").val("0"),$("#time_room_time2").val("0"),$("#time_room_pet_0").val("－"),$("#time_room_pet_json").val(""),$("#whitening-time_view").val("－"),$("#whitening-time_value").val("0"),$("#whitening_data\\[json\\]").val("");var e=moment(new Date($("#date").val())),t=new Array("日","月","火","水","木","金","土");$("#date").val(e.format("YYYY")+"/"+e.format("MM")+"/"+e.format("DD")+"("+t[e.weekday()]+")"),$("#date-value").val(e.format("YYYYMMDD")),$("#date-view").val(e.format("YYYY")+"年"+e.format("MM")+"月"+e.format("DD")+"日("+t[e.weekday()]+")")}()})),$("#date").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays()})),i&&void 0!==$("#date").val()&&""!=$("#date").val()){var d=moment(new Date($("#date").val())),l=d.format("Y")+"/"+d.format("MM")+"/"+d.format("DD")+"("+b[d.weekday()]+")";$("#date").val(l)}window.location.href.includes("admin")?$(".input-daterange").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}):$(".input-daterange").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"});var r=function(){var e=moment(new Date($("#plan_date_start").val()));return 5==e.weekday()?e.add(4,"days").toDate():e.add(6,"days").toDate()};window.location.href.includes("admin")?$("#plan_date_start").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}):$("#plan_date_start").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}),window.location.href.includes("admin")?$("#plan_date_end").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,endDate:r(),daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}):$("#plan_date_end").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,endDate:r(),daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"});var f=[];$("#range_date_start").datepicker().on("hide",(function(){})),$("#plan_date_start").datepicker().on("hide",(function(){$("#plan_date_end").datepicker("destroy"),-1==$.inArray(moment(new Date($("#plan_date_start").val())).format("YYYY-MM-DD"),f)&&$("#plan_date_end").val(moment(new Date($("#plan_date_start").val())).add(0,"days").format("YYYY/MM/DD")),window.location.href.includes("admin")?$("#plan_date_end").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date($("#plan_date_start").val()),endDate:r(),daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}):$("#plan_date_end").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date($("#plan_date_start").val()),endDate:r(),daysOfWeekDisabled:n,datesDisabled:_date_holiday,weekStart:1,orientation:"bottom"}),$("#plan_date_end").focus()}));var v=function(e){var t=_($("#plan_date_start").val(),$("#plan_date_end").val());t.forEach((function(a,n){var i=moment(a+" 00:00 +0000","YYYY-MM-DD HH:mm Z").utc().format("X")+"000";0==n||n==t.length-1?(e&&0==n||!e&&n==t.length-1?$("td[data-date='"+i+"']").css("background-image","linear-gradient(to bottom, #08c, #0044cc)"):$("td[data-date='"+i+"']").css("background","#9e9e9e"),$("td[data-date='"+i+"']").css("color","#fff")):($("td[data-date='"+i+"']").css("background","#eee"),$("td[data-date='"+i+"']").css("border-radius","unset"),$("td[data-date='"+i+"']").css("color","#212529"))}))};$("#plan_date_start").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays(),v(!0)})),$("#plan_date_end").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays(),v(!1)})),$("#plan_date_end").datepicker().on("hide",(function(e){f=_($("#plan_date_start").val(),$("#plan_date_end").val())})),$(".input-daterange").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays()})),$(".agecheck").on("click",(function(){$(".agecheck").removeClass("color-active"),$(".agecheck").addClass("btn-outline-warning"),$(this).addClass("color-active"),$(this).removeClass("btn-outline-warning"),$("#agecheck").val($(this).val()),"1"==$(this).val()||"2"==$(this).val()?$(".age-left").css("visibility","hidden"):"3"==$(this).val()&&$(".age-left").css("visibility","visible")})),$(".room_range_date").on("change blur",(function(){var e=moment(new Date($("#range_date_start").val())),t=moment(new Date($("#range_date_end").val()));$("#range_date_start-view").val(e.format("YYYY")+"年"+e.format("MM")+"月"+e.format("DD")+"日("+b[e.weekday()]+")"),$("#range_date_end-view").val(t.format("YYYY")+"年"+t.format("MM")+"月"+t.format("DD")+"日("+b[t.weekday()]+")"),$("#range_date_start-value").val(e.format("YYYYMMDD")),$("#range_date_end-value").val(t.format("YYYYMMDD"))})),s(),m(),c(),u(),p(),i=!1};a.on("show.bs.modal",(function(e){$(".modal .modal-dialog").attr("class","modal-dialog modal-dialog-centered zoomIn  animated faster")})),a.on("hide.bs.modal",(function(e){window.location.href.includes("admin")}));var D=function(){window.location.href.includes("admin")?$(".modal .modal-dialog").first().attr("class","modal-dialog  modal-dialog-centered  zoomOut  animated faster"):($(".modal .modal-dialog").attr("class","modal-dialog  modal-dialog-centered  zoomOut  animated faster"),$(".modal-backdrop.show").css("opacity","0")),setTimeout((function(){a.modal("hide")}),500)};$("#confirm_cancel").off("click"),$("#confirm_cancel").on("click",(function(e){e.preventDefault(),d=!1,t.modal("hide")})),$("#confirm_ok").off("click"),$("#confirm_ok").on("click",(function(e){e.preventDefault(),d=!0,t.modal("hide")})),$("#btn-cancel").off("click"),$("#btn-cancel").on("click",(function(e){D()})),a.off("hidden.bs.modal"),a.on("hidden.bs.modal",(function(){a.find(".modal-body-time").empty(),$(".set-time").removeClass("edit"),window.location.href.includes("admin")&&($("#edit_booking").css("z-index",""),$("body").addClass("modal-open"))})),a.draggable({handle:".title-table-time"}),a.off("click","#js-save-time"),a.on("click","#js-save-time",(function(e){var t=a.find("input[name=time]:checked").val(),n=a.find("input[name=time]:checked").closest("div").find(".bed").val(),i=a.find("input[name=time]:checked").closest("div").find("input[name=data-json]").val(),o=$(".booking-time").length,d=t.replace(/[^0-9]/g,"");if(1==$("#new-time").val()){var l=$('<div class="block-content-1 margin-top-mini"> <div class="block-content-1-left"><div class="timedate-block set-time">    <input name="time['+o+'][view]" type="text" class="form-control time js-set-time booking-time bg-white" id="error_time_'+o+'" readonly="readonly"  value="" /><input name="time['+o+'][value]" class="time_value" id="time['+o+'][value]" type="hidden" value=""><input name="time['+o+'][bed]" class="time_bed" id="time['+o+'][bed]" type="hidden" value=""><input name="time['+o+'][json]" class="data-json_input" id="time['+o+'][json]" type="hidden" ><input name="time['+o+'][element]" id="" type="hidden" value="error_time_'+o+'"></div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');l.find(".data-json_input").val(i),$(".time-content").append(l),r(),s(),$(".booking-time").last().val(t),$(".time_value").last().val(d),$(".time_bed").last().val(n)}else $(".set-time.edit input.time").val(t),$(".set-time.edit input.time").parent().find(".time_value").val(d),$(".set-time.edit input.time").parent().find(".time_bed").val(n);function m(e,t){return(e+="").length>=t?e:new Array(t-e.length+1).join("0")+e}if($(".set-time.edit input.time").parent().find("#time1-value").val(d),$(".set-time.edit input.time").parent().find("#time2-value").val(d),$(".set-time.edit input.time").parent().find("#time1-bed").val(n),$(".set-time.edit input.time").parent().find("#time2-bed").val(n),$(".set-time.edit input.time").parent().find("#time_room_value").val(m(d,4)),$(".set-time.edit input.time").parent().find("#time_room_bed").val(n),$(".set-time.edit input.time").parent().find(".time_from").val(d),$(".set-time.edit input.time").parent().find(".time_to").val(d),$(".set-time.edit input.time").parent().find(".time_bed").val(n),$(".set-time.edit input.time").parent().find(".data-json_input").val(i),t.includes("～")){var c=t.split("～");$(".set-time.edit input.time").parent().find("#time_room_time1").val(m(c[0].replace(/[^0-9]/g,""),4)),$(".set-time.edit input.time").parent().find("#time_room_time2").val(m(c[1].replace(/[^0-9]/g,""),4)),$(".set-time.edit input.time").parent().find("#whitening-time_value").val(m(c[0].replace(/[^0-9]/g,""),4)+"-"+m(c[1].replace(/[^0-9]/g,""),4))}D()})),$("li.dropdown-item").off("click"),$("li.dropdown-item").on("click",(function(){$("li.dropdown-item").removeClass("active"),$(this).addClass("active"),$("#bus_arrive_time_slide").val($(this).find(".bus_arrive_time_slide").val()),$("#bus_time_first").text($(this).find(".bus_time_first").text()),$("#bus_time_second").text($(this).find(".bus_time_second").text());$(this);$.ajax({url:$site_url+"/validate_before_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){Y(e,!1)},complete:function(){loader.css({display:"none"})}})})),$("#repeat_user").off("change"),$("#repeat_user").on("change",(function(e){"01"==JSON.parse($("#repeat_user").val()).kubun_id?$("#hint-repeat").text("※バスの場合、到着時間から30分以内の予約はできません。希望時間が選択できない場合は　バス到着時間をご確認ください。"):$("#hint-repeat").text("※バスの場合、到着時間から15分以内の予約はできません。希望時間が選択できない場合は　バス到着時間をご確認ください。");$(this);$.ajax({url:$site_url+"/validate_before_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){Y(e,!1)},complete:function(){loader.css({display:"none"})}})})),$("#transport").off("change"),$("#transport").on("change",(function(e){"01"==JSON.parse($("#transport").val()).kubun_id?$(".bus").hide():$(".bus").show();$(this);$.ajax({url:$site_url+"/validate_before_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){Y(e,!1)},complete:function(){loader.css({display:"none"})}})})),$(".btn-booking").off("click"),$(".btn-booking").on("click",(function(e){e.preventDefault();var t=$(this);$.ajax({url:$site_url+"/save_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){"OK"==e.status?t.hasClass("add-new-people")?window.location.href=$site_url+"/booking?add_new_user=on":window.location.href=$site_url+"/confirm":Y(e)},complete:function(){loader.css({display:"none"})}})}));var Y=function(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];if($("p.note-error").remove(),$(".validate_failed").removeClass("validate_failed"),void 0===e.error_time_transport&&void 0===e.error_time_gender&&void 0===e.error_time_empty&&void 0===e.room_select_error&&void 0===e.error_fasting_plan_holyday||!t||Swal.fire({icon:"warning",text:"入力した内容を確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}),void 0!==e.error_time_transport&&$.each(e.error_time_transport,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed");var n=JSON.parse($("#repeat_user").val());"01"==n.kubun_id?a.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>'):"02"==n.kubun_id&&a.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>'),$("#bus_arrive_time_slide").closest("button").addClass("validate_failed")})),void 0!==e.error_time_gender&&$.each(e.error_time_gender,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed"),a.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>'),$("select[name=gender]").addClass("validate_failed")})),void 0!==e.error_time_empty&&t&&$.each(e.error_time_empty,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed"),a.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>')})),void 0!==e.room_select_error){$.each(e.room_select_error,(function(e,t){$("#"+t.element).addClass("validate_failed")}));var a="選択された日は予約できません";"1"==e.room_error_holiday&&(a="定休日が含まれているため予約できません"),$("#range_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+a+"。</p>")}if(void 0!==e.error_fasting_plan_holyday){$.each(e.error_fasting_plan_holyday,(function(e,t){$("#"+t.element).addClass("validate_failed")}));a="定休日が含まれているため予約できません";$("#plan_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+a+"。</p>")}},M=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,t=$(".time-list").attr("value");e||1==t||($(".time-list").append('<div class="booking-field choice-time"><input value="0" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+h.format("MM")+"/"+h.format("DD")+"("+b[h.weekday()]+')</label><input name="date[0][day][view]" value="'+h.format("MM")+"/"+h.format("DD")+"("+b[h.weekday()]+')" type="hidden" ><input name="date[0][day][value]" value="'+h.format("YYYY")+h.format("MM")+h.format("DD")+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date[0][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[0][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[0][from][view]" type="text" id="time_bath_10" class="time form-control js-set-time bg-white" data-date_value="'+h.format("YYYY")+h.format("MM")+h.format("DD")+'" data-date_type="form" readonly="readonly"  value="－" />    <input name="time[0][from][json]" type="hidden" class="data-json_input" value="" /><input name="time[0][from][element]" type="hidden" value="time_bath_10" /><input class="bus_first" type="hidden" value="1"></div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[0][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[0][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[0][to][view]" type="text" id="time_bath_11" class="time form-control js-set-time bg-white" data-date_value="'+h.format("YYYY")+h.format("MM")+h.format("DD")+'" data-date_type="to"  readonly="readonly"  value="－" />    <input name="time[0][to][json]" type="hidden" class="data-json_input" value="" /><input name="time[0][to][element]" type="hidden" value="time_bath_11" /><input class="bus_first" type="hidden" value="1"></div>    <div class="icon-time mt-1"></div></div>    </div></div>'),$(".time-list").append('<div class="booking-field choice-time"><input value="1" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+g.format("MM")+"/"+g.format("DD")+"("+b[g.weekday()]+')</label><input name="date[1][day][view]" value="'+g.format("MM")+"/"+g.format("DD")+"("+b[g.weekday()]+')" type="hidden" ><input name="date[1][day][value]" value="'+h.format("YYYY")+g.format("MM")+g.format("DD")+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date[1][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[1][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[1][from][view]" type="text" id="time_bath_21" class="time form-control js-set-time bg-white" data-date_value="'+g.format("YYYY")+g.format("MM")+g.format("DD")+'"  data-date_type="form"  readonly="readonly"  value="－" />   <input name="time[1][from][json]" id="" type="hidden" class="data-json_input" value="" /><input name="time[1][from][element]" type="hidden" value="time_bath_21" /> </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[1][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[1][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="time[1][to][json]" type="hidden" class="data-json_input" value="" /><input name="time[1][to][element]" type="hidden" value="time_bath_22" /><input name="date[1][to][view]" type="text" id="time_bath_22" class="time form-control js-set-time bg-white" data-date_value="'+g.format("YYYY")+g.format("MM")+g.format("DD")+'"  data-date_type="to" readonly="readonly"  value="－" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>')),$(".range_date").change((function(){var e=_($("#plan_date_start").val(),$("#plan_date_end").val());$(".time-list").empty(),moment.locale("ja"),e.forEach((function(e,t){var a=moment(e),n=a.format("YYYY"),i=a.format("MM"),o=a.format("DD"),d=a.weekday(),l="";0===t&&(l='<input class="bus_first" type="hidden" value="1">'),$(".time-list").append('<div class="booking-field choice-time"><input value="'+t+'" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+i+"/"+o+"("+b[d]+')</label><input name="date['+t+'][day][view]" value="'+i+"/"+o+"("+b[d]+')" type="hidden" ><input name="date['+t+'][day][value]" value="'+n+i+o+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date['+t+'][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date['+t+'][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date['+t+'][from][view]" type="text" id="time_bath_'+t+'1"  class="time form-control js-set-time bg-white" data-date_value="'+n+i+o+'" data-date_type="form"  readonly="readonly"  value="－" />    <input name="time['+t+'][from][element]" type="hidden" value="time_bath_'+t+'1" />'+l+'<input name="time['+t+'][from][json]" type="hidden" class="data-json_input" value="" /></div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date['+t+'][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date['+t+'][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="time['+t+'][to][json]" type="hidden" class="data-json_input" value="" /><input name="time['+t+'][to][element]" type="hidden" value="time_bath_'+t+'2" />'+l+'<input name="date['+t+'][to][view]" type="text" id="time_bath_'+t+'2" class="time form-control js-set-time bg-white" data-date_value="'+n+i+o+'" data-date_type="to"  readonly="readonly"  value="－" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>')}));var t=moment(new Date($("#plan_date_start").val())),a=moment(new Date($("#plan_date_end").val()));$("#plan_date_start-value").val(t.format("YYYY")+t.format("MM")+t.format("DD")),$("#plan_date_end-value").val(a.format("YYYY")+a.format("MM")+a.format("DD")),$("#plan_date_start-view").val(t.format("YYYY")+"年"+t.format("MM")+"月"+t.format("DD")+"日("+b[t.weekday()]+")"),$("#plan_date_end-view").val(a.format("YYYY")+"年"+a.format("MM")+"月"+a.format("DD")+"日("+b[a.weekday()]+")"),w()})),w()};M()}));var r=function(){$(".svg-button").off("click"),$(".svg-button").on("click",(function(){var e=this;window.location.href.includes("admin")?Swal.fire({target:"#edit_booking",text:"予約時間を削除します、よろしいですか?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(t){t.value&&$($(e).parent().parent().remove())})):Swal.fire({text:"予約時間を削除します、よろしいですか?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(t){t.value&&$($(e).parent().parent().remove())}))}))};var s=function(){var e=$("#choice_date_time"),t=$(".js-set-time");t.off("click"),t.on("click",(function(){var t=$(this).parent().find(".bus_first").val(),a=$(this);void 0!==t?$("#bus_first").val(1):$("#bus_first").val(0);var n=$("form.booking").serializeArray(),i={name:"data_get_attr"},o={};o.date=a.attr("data-date_value"),o.date_type=a.attr("data-date_type"),i.value=JSON.stringify(o),n.push(i);var d=this.name,l=d.replace("view","value");$.each(n,(function(){this.name!=d&&this.name!=l||(this.value="")})),$.ajax({url:"/get_time_room",type:"POST",data:n,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){a.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(e.find(".modal-body-time").html(t),e.modal({show:!0,backdrop:!1,keyboard:!1}),$("#edit_booking").css("z-index","0")):(e.find(".modal-body-time").html(t),e.modal({show:!0,backdrop:"static",keyboard:!1}))},complete:function(){loader.css({display:"none"})}})}))},m=function(){var e=$("#choice_date_time"),t=$(".js-set-room");t.off("click"),t.on("click",(function(){var t=$(this),a=$("form.booking").serializeArray(),n={name:"data_get_attr"},i={};i.date=t.attr("data-date_value"),i.date_type=t.attr("data-date_type"),n.value=JSON.stringify(i),a.push(n),$.ajax({url:$site_url+"/book_room",type:"POST",data:a,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(a){t.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(e.find(".modal-body-time").html(a),e.modal({show:!0,backdrop:!1,keyboard:!1}),$("#edit_booking").css("z-index","0")):(e.find(".modal-body-time").html(a),e.modal({show:!0,backdrop:"static",keyboard:!1}))},complete:function(){loader.css({display:"none"})}})}))},c=function(){var e=$("#choice_date_time"),t=$(".js-set-room_wt");t.off("click"),t.on("click",(function(){var t=$(this),n=$("form.booking").serializeArray(),i={name:"data_get_attr"};n.push(i),$.ajax({url:$site_url+"/book_time_room_wt",type:"POST",data:n,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(n){t.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(e.find(".modal-body-time").html(n),e.modal(a({show:!0,backdrop:"static"},"backdrop",!1)),$("#edit_booking").css("z-index","0")):(e.find(".modal-body-time").html(n),e.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},u=function(){var e=$("#choice_date_time"),t=$(".js-set-room_pet");t.off("click"),t.on("click",(function(){var t=$(this),n=$("form.booking").serializeArray(),i={name:"data_get_attr"},o={};o.date=t.attr("data-date_value"),o.date_type=t.attr("data-date_type"),i.value=JSON.stringify(o),n.push(i),$.ajax({url:$site_url+"/book_time_room_pet",type:"POST",data:n,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(n){t.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(e.find(".modal-body-time").html(n),e.modal(a({show:!0,backdrop:"static"},"backdrop",!1)),$("#edit_booking").css("z-index","0")):(e.find(".modal-body-time").html(n),e.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},f=function(){var e=$("#choice_date_time");r();var t=["日","月","火","水","木","金","土"],a=moment();3==a.weekday()?a=moment(a).add(2,"days"):4==a.weekday()&&(a=moment(a).add(1,"days"));moment(a).add(1,"days");$("#add-time").off("click"),$("#add-time").on("click",(function(){var t=$(this),a=$("form.booking").serializeArray(),n={name:"data_get_attr"},i={};i.date=t.attr("data-date_value"),i.date_type=t.attr("data-date_type"),i.new=1,n.value=JSON.stringify(i),a.push(n),$.ajax({url:"/get_time_room",type:"POST",data:a,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(a){t.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(e.find(".modal-body-time").html(a),e.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(e.find(".modal-body-time").html(a),e.modal("show"))},complete:function(){loader.css({display:"none"})}})})),$("#gender").off("change"),$("#gender").on("change",(function(e){$(this);$.ajax({url:$site_url+"/validate_before_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){n(e,!1)},complete:function(){loader.css({display:"none"})}})}));var n=function(e){var t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];if($("p.note-error").remove(),$(".validate_failed").removeClass("validate_failed"),void 0===e.error_time_transport&&void 0===e.error_time_gender&&void 0===e.error_time_empty&&void 0===e.room_select_error&&void 0===e.error_fasting_plan_holyday||!t||Swal.fire({icon:"warning",text:"入力した内容を確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}),void 0!==e.error_time_transport&&$.each(e.error_time_transport,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed");var n=JSON.parse($("#repeat_user").val());"01"==n.kubun_id?a.parent().after('<p class="note-error node-text">バス停からの移動と初回説明の時間があるので、バスの到着時間から30分以内の予約はできません。</p>'):"02"==n.kubun_id&&a.parent().after('<p class="note-error node-text">バス停からの移動があるので、バスの到着時間から15分以内の予約はできません。</p>'),$("#bus_arrive_time_slide").closest("button").addClass("validate_failed")})),void 0!==e.error_time_gender&&$.each(e.error_time_gender,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed"),a.parent().after('<p class="note-error node-text"> 選択された時間は予約できません。</p>'),$("select[name=gender]").addClass("validate_failed")})),void 0!==e.error_time_empty&&t&&$.each(e.error_time_empty,(function(e,t){var a=$("#"+t.element);a.addClass("validate_failed"),a.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>')})),void 0!==e.room_select_error){$.each(e.room_select_error,(function(e,t){$("#"+t.element).addClass("validate_failed")}));var a="選択された日は予約できません";"1"==e.room_error_holiday&&(a="定休日が含まれているため予約できません"),$("#range_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+a+"。</p>")}if(void 0!==e.error_fasting_plan_holyday){$.each(e.error_fasting_plan_holyday,(function(e,t){$("#"+t.element).addClass("validate_failed")}));a="定休日が含まれているため予約できません";$("#plan_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> '+a+"。</p>")}};$(".collapse-between").off("hidden.bs.collapse"),$(".collapse-between").on("hidden.bs.collapse",(function(){$("#btn-collapse-between").attr("src","/sunsun/svg/plus.svg")})),$(".collapse-between").off("shown.bs.collapse"),$(".collapse-between").on("shown.bs.collapse",(function(){$("#btn-collapse-between").attr("src","/sunsun/svg/hide.svg")})),$(".collapse-finish").off("hidden.bs.collapse"),$(".collapse-finish").on("hidden.bs.collapse",(function(){$("#btn-collapse-finish").attr("src","/sunsun/svg/plus.svg")})),$(".collapse-finish").off("shown.bs.collapse"),$(".collapse-finish").on("shown.bs.collapse",(function(){$("#btn-collapse-finish").attr("src","/sunsun/svg/hide.svg")})),$("#edit_booking").off("click",".show_history"),$("#edit_booking").on("click",".show_history",(function(t){t.preventDefault();var a=$("#edit_booking").find("#booking_id").val();$.ajax({url:$site_url+"/admin/show_history",type:"POST",data:{booking_id:a,is_history:!0},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.find(".modal-body-time").html(t),e.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")},complete:function(){loader.css({display:"none"})}})})),$(document).on("touchmove",(function(){$("#date").blur(),$("#range_date_start").blur(),$("#range_date_end").blur(),$("#plan_date_start").blur(),$("#plan_date_end").blur()}));var i=$("#date").val(),o=moment(new Date(i));$("#date-value").val(o.format("YYYY")+o.format("MM")+o.format("DD")),$("#date-view").val(i);var d=$("#plan_date_start").val(),l=$("#plan_date_end").val(),s=moment(new Date(d)),m=moment(new Date(l));$("#plan_date_start-value").val(s.format("YYYY")+s.format("MM")+s.format("DD")),$("#plan_date_end-value").val(m.format("YYYY")+m.format("MM")+m.format("DD")),$("#plan_date_start-view").val(s.format("YYYY")+"年"+s.format("MM")+"月"+s.format("DD")+"日("+t[s.weekday()]+")"),$("#plan_date_end-view").val(m.format("YYYY")+"年"+m.format("MM")+"月"+m.format("DD")+"日("+t[m.weekday()]+")")};function _(e,t){var a=[],n=moment(new Date(e));for(t=moment(new Date(t));n<=t;)3!=moment(n).weekday()&&4!=moment(n).weekday()&&a.push(moment(n).format("YYYY-MM-DD")),n=moment(n).add(1,"days");return a}function p(){var e=document.getElementById("room");if(null!=e&&null!=e){for(var t=JSON.parse(e.value),a=document.getElementById("stay_guest_num"),n=a.length,i=0;i<n;i++){a[i].hidden=!1;var o=JSON.parse(a[i].value);"02"==o.kubun_id&&"04"==t.kubun_id&&(a[i].hidden=!0),"03"!=o.kubun_id||"03"!=t.kubun_id&&"04"!=t.kubun_id||(a[i].hidden=!0)}"01"==t.kubun_id||y("btn-collapse-finish")||(a.value=a[0].value)}}function v(e){return JSON.parse(e.value).kubun_id}function y(e){return e="#"+e,$(e)[0].src.indexOf("plus")>0&&($(e).click(),!0)}}});
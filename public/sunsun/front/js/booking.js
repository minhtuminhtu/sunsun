!function(e){var t={};function a(i){if(t[i])return t[i].exports;var o=t[i]={i:i,l:!1,exports:{}};return e[i].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,i){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(a.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(i,o,function(t){return e[t]}.bind(null,o));return i},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=8)}({8:function(e,t,a){e.exports=a(9)},9:function(e,t){$((function(){var e=$("#choice_date_time"),t=["日","月","火","水","木","金","土"],m=moment();3==m.weekday()?m=moment(m).add(2,"days"):4==m.weekday()&&(m=moment(m).add(1,"days"));var c=moment(m).add(1,"days");s();var u=function(e,t,a){$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #ced4da"}),""==e&&(e=$("#course").val());var i={service:e,course_data:t,course_time:a};"on"==$("input[name=add_new_user]").val()&&(i.add_new_user="on"),$.ajax({url:$site_url+"/get_service",type:"POST",data:i,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){$(".service-warp").empty().append(e).hide().fadeIn("slow"),f(),l(),_()},complete:function(){loader.css({display:"none"})}})};$("#course").on("change",(function(){u($("#course").val(),$("#course_data").val(),$("#course_time").val())})),u($("#pick_course").val(),$("#course_data").val(),$("#course_time").val());var f=function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];var e=m.format("Y")+"/"+m.format("MM")+"/"+m.format("DD"),a=c.format("Y")+"/"+c.format("MM")+"/"+c.format("DD");if(""==$("#date").val()&&$("#date").val(e),""==$("#plan_date_start").val()&&$("#plan_date_start").val(e),""==$("#plan_date_end").val()&&$("#plan_date_end").val(a),$("#room").off("change"),$("#room").on("change",(function(){var e=JSON.parse($("#room").val());"01"==e.kubun_id?$(".room").hide():$.ajax({url:$site_url+"/get_free_room",type:"POST",data:{room:e.kubun_id},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){console.log(e),e=JSON.parse(e),console.log(e.now),$(".input-daterange").datepicker("destroy"),$("#range_date_start").val(e.now),$("#range_date_end").val(e.now),$(".input-daterange").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:"3,4",datesDisabled:e.date_selected,weekStart:1,orientation:"bottom"});var a=moment(new Date($("#range_date_start").val())),i=moment(new Date($("#range_date_end").val()));$("#range_date_start-view").val(a.format("YYYY")+"年"+a.format("MM")+"月"+a.format("DD")+"日("+t[a.weekday()]+")"),$("#range_date_end-view").val(i.format("YYYY")+"年"+i.format("MM")+"月"+i.format("DD")+"日("+t[i.weekday()]+")"),$("#range_date_start-value").val(a.format("YYYYMMDD")),$("#range_date_end-value").val(i.format("YYYYMMDD")),$(".room").show()},complete:function(){loader.css({display:"none"})}})})),$("#whitening").off("change"),$("#whitening").on("change",(function(){"01"==JSON.parse($("#whitening").val()).kubun_id?$(".whitening").hide():$(".whitening").show()})),DatePicker={hideOldDays:function(){var e=$("td.old.day");e.length>0&&(e.css("visibility","hidden"),7===e.length&&e.parent().hide())},hideNewDays:function(){var e=$("td.new.day");e.length>0&&e.hide()},hideOtherMonthDays:function(){DatePicker.hideOldDays(),DatePicker.hideNewDays()}},window.location.href.includes("admin")?(console.log("admin"),$("#date").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",startDate:new Date,autoclose:!0,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"})):$("#date").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",startDate:new Date,autoclose:!0,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}),$("#date").datepicker().off("hide"),$("#date").datepicker().on("hide",(function(e){_()})),$("#date").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays()})),""!=$("#date").val()){var l=moment(new Date($("#date").val())),s=l.format("Y")+"/"+l.format("MM")+"/"+l.format("DD");$("#date").val(s+"("+t[moment(new Date(s)).weekday()]+")")}window.location.href.includes("admin")?$(".input-daterange").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}):$(".input-daterange").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"});var u=function(){var e=moment(new Date($("#plan_date_start").val()));return 5==e.weekday()?e.add(4,"days").toDate():e.add(6,"days").toDate()};window.location.href.includes("admin")?$("#plan_date_start").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}):$("#plan_date_start").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}),window.location.href.includes("admin")?$("#plan_date_end").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,endDate:u(),daysOfWeekDisabled:"3,4,5,6",weekStart:1,orientation:"bottom"}):$("#plan_date_end").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date,endDate:u(),daysOfWeekDisabled:"3,4,5,6",weekStart:1,orientation:"bottom"});var f=[];$("#range_date_start").datepicker().on("hide",(function(){})),$("#plan_date_start").datepicker().on("hide",(function(){$("#plan_date_end").datepicker("destroy"),-1==$.inArray(moment(new Date($("#plan_date_start").val())).format("YYYY-MM-DD"),f)&&$("#plan_date_end").val(moment(new Date($("#plan_date_start").val())).add(0,"days").format("YYYY/MM/DD")),window.location.href.includes("admin")?$("#plan_date_end").datepicker({container:".mail-booking",language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date($("#plan_date_start").val()),endDate:u(),daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}):$("#plan_date_end").datepicker({language:"ja",dateFormat:"yyyy/mm/dd",autoclose:!0,startDate:new Date($("#plan_date_start").val()),endDate:u(),daysOfWeekDisabled:"3,4",weekStart:1,orientation:"bottom"}),$("#plan_date_end").focus()}));var p=function(e){var t=r($("#plan_date_start").val(),$("#plan_date_end").val());t.forEach((function(a,i){var o=moment(a+" 00:00 +0000","YYYY-MM-DD HH:mm Z").utc().format("X")+"000";0==i||i==t.length-1?(e&&0==i||!e&&i==t.length-1?$("td[data-date='"+o+"']").css("background-image","linear-gradient(to bottom, #08c, #0044cc)"):$("td[data-date='"+o+"']").css("background","#9e9e9e"),$("td[data-date='"+o+"']").css("color","#fff")):($("td[data-date='"+o+"']").css("background","#eee"),$("td[data-date='"+o+"']").css("border-radius","unset"),$("td[data-date='"+o+"']").css("color","#212529"))}))};function _(){var e=moment(new Date($("#date").val())),t=new Array("日","月","火","水","木","金","土");$("#date").val(e.format("YYYY")+"/"+e.format("MM")+"/"+e.format("DD")+"("+t[e.weekday()]+")"),$("#date-value").val(e.format("YYYYMMDD")),$("#date-view").val(e.format("YYYY")+"年"+e.format("MM")+"月"+e.format("DD")+"日("+t[e.weekday()]+")")}$("#plan_date_start").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays(),p(!0)})),$("#plan_date_end").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays(),p(!1)})),$("#plan_date_end").datepicker().on("hide",(function(e){f=r($("#plan_date_start").val(),$("#plan_date_end").val())})),$(".input-daterange").datepicker().on("show",(function(e){DatePicker.hideOtherMonthDays()})),$(".agecheck").on("click",(function(){$(".agecheck").removeClass("color-active"),$(".agecheck").addClass("btn-outline-warning"),$(this).addClass("color-active"),$(this).removeClass("btn-outline-warning"),$("#agecheck").val($(this).val()),"1"==$(this).val()||"2"==$(this).val()?$(".age-left").css("visibility","hidden"):"3"==$(this).val()&&$(".age-left").css("visibility","visible")})),$(".room_range_date").on("change blur",(function(){var e=moment(new Date($("#range_date_start").val())),a=moment(new Date($("#range_date_end").val()));$("#range_date_start-view").val(e.format("YYYY")+"年"+e.format("MM")+"月"+e.format("DD")+"日("+t[e.weekday()]+")"),$("#range_date_end-view").val(a.format("YYYY")+"年"+a.format("MM")+"月"+a.format("DD")+"日("+t[a.weekday()]+")"),$("#range_date_start-value").val(e.format("YYYYMMDD")),$("#range_date_end-value").val(a.format("YYYYMMDD"))})),i(),o(),n(),d()};f(),e.on("show.bs.modal",(function(e){$(".modal .modal-dialog").attr("class","modal-dialog modal-dialog-centered zoomIn  animated faster")})),e.off("hidden.bs.modal"),e.on("hidden.bs.modal",(function(){e.find(".modal-body-time").empty(),$(".set-time").removeClass("edit"),window.location.href.includes("admin")&&($("#edit_booking").css("z-index",""),$("body").addClass("modal-open"))})),e.off("click","#js-save-time"),e.on("click","#js-save-time",(function(t){var o=e.find("input[name=time]:checked").val(),n=e.find("input[name=time]:checked").closest("div").find(".bed").val(),d=e.find("input[name=time]:checked").closest("div").find("input[name=data-json]").val(),l=$(".booking-time").length,r=r=o.replace(/[^0-9]/g,"");if(1==$("#new-time").val()){var s=$('<div class="block-content-1 margin-top-mini"> <div class="block-content-1-left"><div class="timedate-block set-time">    <input name="time['+l+'][view]" type="text" class="form-control time js-set-time booking-time bg-white" id="error_time_'+l+'" readonly="readonly"  value="" /><input name="time['+l+'][value]" class="time_value" id="time['+l+'][value]" type="hidden" value=""><input name="time['+l+'][bed]" class="time_bed" id="time['+l+'][bed]" type="hidden" value=""><input name="time['+l+'][json]" class="data-json_input" id="time['+l+'][json]" type="hidden" ><input name="time['+l+'][element]" id="" type="hidden" value="error_time_'+l+'"></div> </div> <div class="block-content-1-right"><img class="svg-button" src="/sunsun/svg/close.svg" alt="Close" /></div>           </div>');s.find(".data-json_input").val(d),$(".time-content").append(s),a(),i(),$(".booking-time").last().val(o),$(".time_value").last().val(r),$(".time_bed").last().val(n)}else console.log("set time"),console.log($(".set-time.edit input.time").parent()),$(".set-time.edit input.time").val(o),$(".set-time.edit input.time").parent().find(".time_value").val(r),$(".set-time.edit input.time").parent().find(".time_bed").val(n);function m(e,t){return(e+="").length>=t?e:new Array(t-e.length+1).join("0")+e}if($(".set-time.edit input.time").parent().find("#time1-value").val(r),$(".set-time.edit input.time").parent().find("#time2-value").val(r),$(".set-time.edit input.time").parent().find("#time1-bed").val(n),$(".set-time.edit input.time").parent().find("#time2-bed").val(n),$(".set-time.edit input.time").parent().find("#time_room_value").val(m(r,4)),$(".set-time.edit input.time").parent().find("#time_room_bed").val(n),$(".set-time.edit input.time").parent().find(".time_from").val(r),$(".set-time.edit input.time").parent().find(".time_to").val(r),$(".set-time.edit input.time").parent().find(".time_bed").val(n),$(".set-time.edit input.time").parent().find(".data-json_input").val(d),o.includes("～")){var c=o.split("～");$(".set-time.edit input.time").parent().find("#time_room_time1").val(m(c[0].replace(/[^0-9]/g,""),4)),$(".set-time.edit input.time").parent().find("#time_room_time2").val(m(c[1].replace(/[^0-9]/g,""),4)),$(".set-time.edit input.time").parent().find("#whitening-time_value").val(m(c[0].replace(/[^0-9]/g,""),4)+"-"+m(c[1].replace(/[^0-9]/g,""),4))}e.modal("hide")})),$(".btn-booking").click((function(e){e.preventDefault();var t=$(this);$.ajax({url:$site_url+"/save_booking",type:"POST",data:$("form.booking").serializeArray(),dataType:"JSON",beforeSend:function(){loader.css({display:"block"})},success:function(e){console.log(e),"OK"==e.status?t.hasClass("add-new-people")?window.location.href=$site_url+"/booking?add_new_user=on":window.location.href=$site_url+"/confirm":p(e)},complete:function(){loader.css({display:"none"})}})}));var p=function(e){$("p.note-error").remove(),void 0!==e.clear_border_red&&$.each(e.clear_border_red,(function(e,t){$("#"+t.element).css({border:"solid 1px #ced4da"}),$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #ced4da"}),$("select[name=gender]").css({border:"solid 1px #ced4da"})})),void 0===e.error_time_transport&&void 0===e.error_time_gender&&void 0===e.error_time_empty&&void 0===e.room_select_error||Swal.fire({icon:"warning",text:"入力した情報を再確認してください。",confirmButtonColor:"#d7751e",confirmButtonText:"閉じる",width:350,showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}),void 0!==e.error_time_transport&&$.each(e.error_time_transport,(function(e,t){var a=$("#"+t.element);a.css({border:"solid 1px #f50000"}),a.parent().after('<p class="note-error node-text"> 予約時間は洲本ICのバスの送迎時間以降にならないといけないのです。</p>'),$("#bus_arrive_time_slide").closest("button").css({border:"solid 1px #f50000"})})),void 0!==e.error_time_gender&&$.each(e.error_time_gender,(function(e,t){var a=$("#"+t.element);a.css({border:"solid 1px #f50000"}),a.parent().after('<p class="note-error node-text"> 予約時間は選択された性別に適当していません。</p>'),$("select[name=gender]").css({border:"solid 1px #f50000"})})),void 0!==e.error_time_empty&&$.each(e.error_time_empty,(function(e,t){var a=$("#"+t.element);a.css({border:"solid 1px #f50000"}),a.parent().after('<p class="note-error node-text"> 予約時間を選択してください。</p>')})),void 0!==e.room_select_error&&($.each(e.room_select_error,(function(e,t){$("#"+t.element).css({border:"solid 1px #f50000"})})),$("#range_date_start").parent().parent().after('<p class="note-error node-text booking-laber-padding"> 宿泊日の時間が無効になっています。</p>'))},_=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,a=$(".time-list").attr("value");e||1==a||($(".time-list").append('<div class="booking-field choice-time"><input value="0" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+m.format("MM")+"/"+m.format("DD")+"("+t[m.weekday()]+')</label><input name="date[0][day][view]" value="'+m.format("MM")+"/"+m.format("DD")+"("+t[m.weekday()]+')" type="hidden" ><input name="date[0][day][value]" value="'+m.format("YYYY")+m.format("MM")+m.format("DD")+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date[0][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[0][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[0][from][view]" type="text" id="time_bath_10" class="time form-control js-set-time bg-white" data-date_value="'+m.format("YYYY")+m.format("MM")+m.format("DD")+'" data-date_type="form" readonly="readonly"  value="00:00" />    <input name="time[0][from][json]" type="hidden" class="data-json_input" value="" /><input name="time[0][from][element]" type="hidden" value="time_bath_10" /></div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[0][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[0][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[0][to][view]" type="text" id="time_bath_11" class="time form-control js-set-time bg-white" data-date_value="'+m.format("YYYY")+m.format("MM")+m.format("DD")+'" data-date_type="to"  readonly="readonly"  value="00:00" />    <input name="time[0][to][json]" type="hidden" class="data-json_input" value="" /><input name="time[0][to][element]" type="hidden" value="time_bath_11" /></div>    <div class="icon-time mt-1"></div></div>    </div></div>'),$(".time-list").append('<div class="booking-field choice-time"><input value="1" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+c.format("MM")+"/"+c.format("DD")+"("+t[c.weekday()]+')</label><input name="date[1][day][view]" value="'+c.format("MM")+"/"+c.format("DD")+"("+t[c.weekday()]+')" type="hidden" ><input name="date[1][day][value]" value="'+m.format("YYYY")+c.format("MM")+c.format("DD")+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date[1][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date[1][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date[1][from][view]" type="text" id="time_bath_21" class="time form-control js-set-time bg-white" data-date_value="'+c.format("YYYY")+c.format("MM")+c.format("DD")+'"  data-date_type="form"  readonly="readonly"  value="00:00" />   <input name="time[1][from][json]" id="" type="hidden" class="data-json_input" value="" /><input name="time[1][from][element]" type="hidden" value="time_bath_21" /> </div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date[1][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date[1][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="time[1][to][json]" type="hidden" class="data-json_input" value="" /><input name="time[1][to][element]" type="hidden" value="time_bath_22" /><input name="date[1][to][view]" type="text" id="time_bath_22" class="time form-control js-set-time bg-white" data-date_value="'+c.format("YYYY")+c.format("MM")+c.format("DD")+'"  data-date_type="to" readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>')),$(".range_date").change((function(){var e=r($("#plan_date_start").val(),$("#plan_date_end").val());$(".time-list").empty(),moment.locale("ja"),e.forEach((function(e,a){var i=moment(e),o=i.format("YYYY"),n=i.format("MM"),d=i.format("DD"),l=i.weekday();$(".time-list").append('<div class="booking-field choice-time"><input value="'+a+'" class="time_index" type="hidden" ><div class="booking-field-label label-data pt-2"><label class="">'+n+"/"+d+"("+t[l]+')</label><input name="date['+a+'][day][view]" value="'+n+"/"+d+"("+t[l]+')" type="hidden" ><input name="date['+a+'][day][value]" value="'+o+n+d+'" type="hidden" ></div>    <div class="booking-field-content date-time"><div class="choice-data-time set-time time-start">    <div class="set-time"><input name="date['+a+'][from][value]" type="hidden" class="time_from time_value"  readonly="readonly"  value="0" /><input name="date['+a+'][from][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="date['+a+'][from][view]" type="text" id="time_bath_'+a+'1"  class="time form-control js-set-time bg-white" data-date_value="'+o+n+d+'" data-date_type="form"  readonly="readonly"  value="00:00" />    <input name="time['+a+'][from][element]" type="hidden" value="time_bath_'+a+'1" /><input name="time['+a+'][from][json]" type="hidden" class="data-json_input" value="" /></div>    <div class="icon-time mt-1"></div></div><div class="choice-data-time set-time time-end">    <div class="set-time"><input name="date['+a+'][to][value]" type="hidden" class="time_to time_value"  readonly="readonly"  value="0" /><input name="date['+a+'][to][bed]" type="hidden" class="time_bed"  readonly="readonly"  value="1" /><input name="time['+a+'][to][json]" type="hidden" class="data-json_input" value="" /><input name="time['+a+'][to][element]" type="hidden" value="time_bath_'+a+'2" /><input name="date['+a+'][to][view]" type="text" id="time_bath_'+a+'2" class="time form-control js-set-time bg-white" data-date_value="'+o+n+d+'" data-date_type="to"  readonly="readonly"  value="00:00" />    </div>    <div class="icon-time mt-1"></div></div>    </div></div>')}));var a=moment(new Date($("#plan_date_start").val())),i=moment(new Date($("#plan_date_end").val()));$("#plan_date_start-value").val(a.format("YYYY")+a.format("MM")+a.format("DD")),$("#plan_date_end-value").val(i.format("YYYY")+i.format("MM")+i.format("DD")),$("#plan_date_start-view").val(a.format("YYYY")+"年"+a.format("MM")+"月"+a.format("DD")+"日("+t[a.weekday()]+")"),$("#plan_date_end-view").val(i.format("YYYY")+"年"+i.format("MM")+"月"+i.format("DD")+"日("+t[i.weekday()]+")"),f()})),f()};_()}));var a=function(){$(".svg-button").off("click"),$(".svg-button").on("click",(function(){var e=this;window.location.href.includes("admin")?Swal.fire({target:"#edit_booking",title:"削除しますか？",text:"しかし、復旧できません。よろしいですか!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(t){t.value&&$($(e).parent().parent().remove())})):Swal.fire({title:"削除しますか？",text:"しかし、復旧できません。よろしいですか!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d7751e",cancelButtonColor:"#343a40",confirmButtonText:"はい",cancelButtonText:"いいえ",showClass:{popup:"animated zoomIn faster"},hideClass:{popup:"animated zoomOut faster"},allowOutsideClick:!1}).then((function(t){t.value&&$($(e).parent().parent().remove())}))}))};var i=function(){modal_choice_time=$("#choice_date_time");var e=$(".js-set-time");e.off("click"),e.on("click",(function(){var e=$(this),t=$("form.booking").serializeArray(),a={name:"data_get_attr"},i={};i.date=e.attr("data-date_value"),i.date_type=e.attr("data-date_type"),a.value=JSON.stringify(i),t.push(a),$.ajax({url:"/get_time_room",type:"POST",data:t,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},o=function(){var e=$(".js-set-room");e.off("click"),e.on("click",(function(){var e=$(this),t=$("form.booking").serializeArray(),a={name:"data_get_attr"},i={};i.date=e.attr("data-date_value"),i.date_type=e.attr("data-date_type"),a.value=JSON.stringify(i),t.push(a),$.ajax({url:$site_url+"/book_room",type:"POST",data:t,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},n=function(){var e=$(".js-set-room_wt");e.off("click"),e.on("click",(function(){var e=$(this),t=$("form.booking").serializeArray(),a={name:"data_get_attr"};t.push(a),$.ajax({url:$site_url+"/book_time_room_wt",type:"POST",data:t,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},d=function(){var e=$(".js-set-room_pet");e.off("click"),e.on("click",(function(){var e=$(this),t=$("form.booking").serializeArray(),a={name:"data_get_attr"},i={};i.date=e.attr("data-date_value"),i.date_type=e.attr("data-date_type"),a.value=JSON.stringify(i),t.push(a),$.ajax({url:$site_url+"/book_time_room_pet",type:"POST",data:t,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal("show"))},complete:function(){loader.css({display:"none"})}})}))},l=function(){a();var e=["日","月","火","水","木","金","土"],t=moment();3==t.weekday()?t=moment(t).add(2,"days"):4==t.weekday()&&(t=moment(t).add(1,"days"));var i=moment(t).add(1,"days");$("#add-time").off("click"),$("#add-time").on("click",(function(){var e=$(this),t=$("form.booking").serializeArray(),a={name:"data_get_attr"},i={};i.date=e.attr("data-date_value"),i.date_type=e.attr("data-date_type"),i.new=1,a.value=JSON.stringify(i),t.push(a),$.ajax({url:"/get_time_room",type:"POST",data:t,dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(t){e.closest(".set-time").addClass("edit"),window.location.href.includes("admin")?(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")):(modal_choice_time.find(".modal-body-time").html(t),modal_choice_time.modal("show"))},complete:function(){loader.css({display:"none"})}})})),$(".collapse-between").off("hidden.bs.collapse"),$(".collapse-between").on("hidden.bs.collapse",(function(){$("#btn-collapse-between").attr("src","/sunsun/svg/plus.svg")})),$(".collapse-between").off("shown.bs.collapse"),$(".collapse-between").on("shown.bs.collapse",(function(){$("#btn-collapse-between").attr("src","/sunsun/svg/hide.svg")})),$(".collapse-finish").off("hidden.bs.collapse"),$(".collapse-finish").on("hidden.bs.collapse",(function(){$("#btn-collapse-finish").attr("src","/sunsun/svg/plus.svg")})),$(".collapse-finish").off("shown.bs.collapse"),$(".collapse-finish").on("shown.bs.collapse",(function(){$("#btn-collapse-finish").attr("src","/sunsun/svg/hide.svg")})),$("#edit_booking").off("click",".show_history"),$("#edit_booking").on("click",".show_history",(function(e){e.preventDefault();var t=$("#edit_booking").find("#booking_id").val();$.ajax({url:$site_url+"/admin/show_history",type:"POST",data:{booking_id:t,is_history:!0},dataType:"text",beforeSend:function(){loader.css({display:"block"})},success:function(e){modal,body,time.find(".modal_time-body").html(e),modal,body,time.modal({show:!0,backdrop:!1}),$("#edit_booking").css("z-index","0")},complete:function(){loader.css({display:"none"})}})})),$(document).on("touchmove",(function(){$("#date").blur(),$("#range_date_start").blur(),$("#range_date_end").blur(),$("#plan_date_start").blur(),$("#plan_date_end").blur()})),$("#date-value").val(t.format("YYYYMMDD")),$("#date-view").val(t.format("YYYY")+"年"+t.format("MM")+"月"+t.format("DD")+"日("+e[t.weekday()]+")"),$("#plan_date_start-value").val(t.format("YYYY")+t.format("MM")+t.format("DD")),$("#plan_date_end-value").val(i.format("YYYY")+i.format("MM")+i.format("DD")),$("#plan_date_start-view").val(t.format("YYYY")+"年"+t.format("MM")+"月"+t.format("DD")+"日("+e[t.weekday()]+")"),$("#plan_date_end-view").val(i.format("YYYY")+"年"+i.format("MM")+"月"+i.format("DD")+"日("+e[i.weekday()]+")")};function r(e,t){var a=[],i=moment(new Date(e));for(t=moment(new Date(t));i<=t;)3!=moment(i).weekday()&&4!=moment(i).weekday()&&a.push(moment(i).format("YYYY-MM-DD")),i=moment(i).add(1,"days");return a}var s=function(){$("#transport").on("change",(function(){"01"==JSON.parse($("#transport").val()).kubun_id?$(".bus").hide():$(".bus").show()})),$("li.dropdown-item").off("click"),$("li.dropdown-item").on("click",(function(){$("li.dropdown-item").removeClass("active"),$(this).addClass("active"),$("#bus_arrive_time_slide").val($(this).find(".bus_arrive_time_slide").val()),$("#bus_time_first").text($(this).find(".bus_time_first").text()),$("#bus_time_second").text($(this).find(".bus_time_second").text())}))}}});
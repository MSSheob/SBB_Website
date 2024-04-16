var mecSingleEventDisplayer={getSinglePage:function(id,occurrence,time,ajaxurl,layout,image_popup){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-modal-preloader');jQuery.ajax({url:ajaxurl,data:"action=mec_load_single_page&id="+id+(occurrence!=null?"&occurrence="+occurrence:"")+(time!=null?"&time="+time:"")+"&layout="+layout,type:"get",success:function(response){jQuery('.mec-modal-result').removeClass("mec-modal-preloader");jQuery.featherlight(response);setTimeout(function()
{if(typeof grecaptcha!=='undefined'&&jQuery('#g-recaptcha').length>0)
{grecaptcha.render("g-recaptcha",{sitekey:mecdata.recapcha_key});}},1000);if(image_popup!=0){if(jQuery('.featherlight-content .mec-events-content a img').length>0){jQuery('.featherlight-content .mec-events-content a img').each(function(){jQuery(this).closest('a').attr('data-featherlight','image');});}}else{jQuery('.featherlight-content .mec-events-content a img').remove();jQuery('.featherlight-content .mec-events-content img').remove();}
if(typeof mecdata.enableSingleFluent!='undefined'&&mecdata.enableSingleFluent){mecFluentSinglePage();}},error:function(){}});}};(function($){$.fn.mecSearchForm=function(options){var settings=$.extend({id:0,search_form_element:'',atts:'',callback:function(){}},options);$("#mec_sf_category_"+settings.id).on('change',function(e){search();});$("#mec_sf_location_"+settings.id).on('change',function(e){search();});$("#mec_sf_organizer_"+settings.id).on('change',function(e){search();});$("#mec_sf_speaker_"+settings.id).on('change',function(e){search();});$("#mec_sf_tag_"+settings.id).on('change',function(e){search();});$("#mec_sf_label_"+settings.id).on('change',function(e){search();});$("#mec_sf_s_"+settings.id).on('change',function(e){search();});$("#mec_sf_address_s_"+settings.id).on('change',function(e){search();});var mec_sf_month_selector="#mec_sf_month_"+settings.id;var mec_sf_year_selector="#mec_sf_year_"+settings.id;mec_sf_month_selector+=(', '+mec_sf_year_selector);$(mec_sf_month_selector).on('change',function(e){if($(mec_sf_year_selector).find('option:eq(0)').val()=='none')
{var mec_month_val=$(mec_sf_month_selector).val();var mec_year_val=$(mec_sf_year_selector).val();if((mec_month_val!='none'&&mec_year_val!='none')||((mec_month_val=='none'&&mec_year_val=='none')))search();}else search();});$("#mec_sf_event_type_"+settings.id).on('change',function(e){search();});$("#mec_sf_event_type_2_"+settings.id).on('change',function(e){search();});$("#mec_sf_attribute_"+settings.id).on('change',function(e){search();});if(settings.fields&&settings.fields!=null&&settings.fields.length>0){for(var k in settings.fields){$("#mec_sf_"+settings.fields[k]+'_'+settings.id).on('change',function(e){search();});}}
function search(){var s=$("#mec_sf_s_"+settings.id).length?$("#mec_sf_s_"+settings.id).val():'';var address=$("#mec_sf_address_s_"+settings.id).length?$("#mec_sf_address_s_"+settings.id).val():'';var category=$("#mec_sf_category_"+settings.id).length?$("#mec_sf_category_"+settings.id).val():'';var location=$("#mec_sf_location_"+settings.id).length?$("#mec_sf_location_"+settings.id).val():'';var organizer=$("#mec_sf_organizer_"+settings.id).length?$("#mec_sf_organizer_"+settings.id).val():'';var speaker=$("#mec_sf_speaker_"+settings.id).length?$("#mec_sf_speaker_"+settings.id).val():'';var tag=$("#mec_sf_tag_"+settings.id).length?$("#mec_sf_tag_"+settings.id).val():'';var label=$("#mec_sf_label_"+settings.id).length?$("#mec_sf_label_"+settings.id).val():'';var month=$("#mec_sf_month_"+settings.id).length?$("#mec_sf_month_"+settings.id).val():'';var year=$("#mec_sf_year_"+settings.id).length?$("#mec_sf_year_"+settings.id).val():'';var event_type=$("#mec_sf_event_type_"+settings.id).length?$("#mec_sf_event_type_"+settings.id).val():'';var event_type_2=$("#mec_sf_event_type_2_"+settings.id).length?$("#mec_sf_event_type_2_"+settings.id).val():'';var attribute=$("#mec_sf_attribute_"+settings.id).length?$("#mec_sf_attribute_"+settings.id).val():'';if(year==='none'&&month==='none'){year='';month='';}
var addation_attr='';if(settings.fields&&settings.fields!=null&&settings.fields.length>0){for(var k in settings.fields){var field='#mec_sf_'+settings.fields[k]+'_'+settings.id;var val=$(field).length?$(field).val():'';addation_attr+='&sf['+settings.fields[k]+']='+val;}}
var atts=settings.atts+'&sf[s]='+s+'&sf[address]='+address+'&sf[month]='+month+'&sf[year]='+year+'&sf[category]='+category+'&sf[location]='+location+'&sf[organizer]='+organizer+'&sf[speaker]='+speaker+'&sf[tag]='+tag+'&sf[label]='+label+'&sf[event_type]='+event_type+'&sf[event_type_2]='+event_type_2+'&sf[attribute]='+attribute+addation_attr;settings.callback(atts);}};}(jQuery));(function($){$.fn.mecFullCalendar=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},skin:'',},options);setListeners();mecFluentCurrentTimePosition();mecFluentCustomScrollbar();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-totalcal-box .mec-totalcal-view span:not(.mec-fluent-more-views-icon)").on('click',function(e){e.preventDefault();var skin=$(this).data('skin');var mec_month_select=$('#mec_sf_month_'+settings.id);var mec_year_select=$('#mec_sf_year_'+settings.id);if(mec_year_select.val()=='none')
{mec_year_select.find('option').each(function()
{var option_val=$(this).val();if(option_val==mecdata.current_year)mec_year_select.val(option_val);});}
if(skin=='list')
{var mec_filter_none='<option class="mec-none-item" value="none">'+$('#mec-filter-none').val()+'</option>';if(mec_month_select.find('.mec-none-item').length==0)mec_month_select.prepend(mec_filter_none);if(mec_year_select.find('.mec-none-item').length==0)mec_year_select.prepend(mec_filter_none);}
else
{if(mec_month_select.find('.mec-none-item').length!=0)mec_month_select.find('.mec-none-item').remove();if(mec_year_select.find('.mec-none-item').length!=0)mec_year_select.find('.mec-none-item').remove();}
$("#mec_skin_"+settings.id+" .mec-totalcal-box .mec-totalcal-view span").removeClass('mec-totalcalview-selected')
$(this).addClass('mec-totalcalview-selected');if($(this).closest('.mec-fluent-more-views-content').length>0){$('.mec-fluent-more-views-icon').addClass('active');$('.mec-fluent-more-views-content').removeClass('active');}else{$('.mec-fluent-more-views-icon').removeClass('active');}
loadSkin(skin);});}
function loadSkin(skin){settings.skin=skin;if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_full_calendar_switch_skin&skin="+skin+"&"+settings.atts+"&apply_sf_date=1&sed="+settings.sed_method,dataType:"json",type:"post",success:function(response){$("#mec_full_calendar_container_"+settings.id).html(response);$('.mec-modal-result').removeClass("mec-month-navigator-loading");mecFocusDay(settings);mecFluentCurrentTimePosition();mecFluentCustomScrollbar();},error:function(){}});}
function search(){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_full_calendar_switch_skin&skin="+settings.skin+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){$("#mec_full_calendar_container_"+settings.id).html(response);$('.mec-modal-result').removeClass("mec-month-navigator-loading");mecFocusDay(settings);mec_focus_week(settings.id);mecFluentCurrentTimePosition();mecFluentCustomScrollbar();},error:function(){}});}};}(jQuery));(function($){$.fn.mecYearlyView=function(options){var active_year;var settings=$.extend({today:null,id:0,events_label:'Events',event_label:'Event',year_navigator:0,atts:'',next_year:{},sf:{},ajax_url:'',},options);mecFluentYearlyUI(settings.id,settings.year_id);if(settings.year_navigator)initYearNavigator();setListeners();$(document).on("click","#mec_skin_events_"+settings.id+" .mec-load-more-button",function(){var year=$(this).parent().parent().parent().data('year-id');loadMoreButton(year);});if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;active_year=$('.mec-yearly-view-wrap .mec-year-navigator').filter(function(){return $(this).css('display')=="block";});active_year=parseInt(active_year.find('h2').text());search(active_year);}});}
function initYearNavigator(){$("#mec_skin_"+settings.id+" .mec-load-year").off("click");$("#mec_skin_"+settings.id+" .mec-load-year").on("click",function(){var year=$(this).data("mec-year");setYear(year);});}
function search(year){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_yearly_view_load_year&mec_year="+year+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){active_year=response.current_year.year;$("#mec_skin_events_"+settings.id).html('<div class="mec-year-container" id="mec_yearly_view_year_'+settings.id+'_'+response.current_year.id+'" data-year-id="'+response.current_year.id+'">'+response.year+'</div>');$("#mec_skin_"+settings.id+" .mec-yearly-title-sec").append('<div class="mec-year-navigator" id="mec_year_navigator_'+settings.id+'_'+response.current_year.id+'">'+response.navigator+'</div>');initYearNavigator();setListeners();toggleYear(response.current_year.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");mecFluentYearlyUI(settings.id,active_year);mecFluentCustomScrollbar();},error:function(){}});}
function setYear(year,do_in_background){if(typeof do_in_background==="undefined")do_in_background=false;var year_id=year;active_year=year;if($("#mec_yearly_view_year_"+settings.id+"_"+year_id).length){toggleYear(year_id);mecFluentCustomScrollbar();}else{if(!do_in_background){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');}
$.ajax({url:settings.ajax_url,data:"action=mec_yearly_view_load_year&mec_year="+year+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){$("#mec_skin_events_"+settings.id).append('<div class="mec-year-container" id="mec_yearly_view_year_'+settings.id+'_'+response.current_year.id+'" data-year-id="'+response.current_year.id+'">'+response.year+'</div>');$("#mec_skin_"+settings.id+" .mec-yearly-title-sec").append('<div class="mec-year-navigator" id="mec_year_navigator_'+settings.id+'_'+response.current_year.id+'">'+response.navigator+'</div>');initYearNavigator();setListeners();if(!do_in_background){toggleYear(response.current_year.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_sf_year_"+settings.id).val(year);}else{$("#mec_yearly_view_year_"+settings.id+"_"+response.current_year.id).hide();$("#mec_year_navigator_"+settings.id+"_"+response.current_year.id).hide();}
mecFluentYearlyUI(settings.id,year);if(!do_in_background){mecFluentCustomScrollbar();}},error:function(){}});}}
function toggleYear(year_id){$("#mec_skin_"+settings.id+" .mec-year-navigator").hide();$("#mec_year_navigator_"+settings.id+"_"+year_id).show();$("#mec_skin_"+settings.id+" .mec-year-container").hide();$("#mec_yearly_view_year_"+settings.id+"_"+year_id).show();}
var sf;function setListeners(){if(settings.sed_method!='0'){sed();}}
function sed(){$("#mec_skin_"+settings.id+" .mec-agenda-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMoreButton(year){var $max_count,$current_count=0;$max_count=$("#mec_yearly_view_year_"+settings.id+"_"+year+" .mec-yearly-max").data('count');$current_count=$("#mec_yearly_view_year_"+settings.id+"_"+year+" .mec-util-hidden").length;if($current_count>10){for(var i=0;i<10;i++){$("#mec_yearly_view_year_"+settings.id+"_"+year+" .mec-util-hidden").slice(0,2).each(function(){$(this).removeClass('mec-util-hidden');});}}
if($current_count<10&&$current_count!=0){for(var j=0;j<$current_count;j++){$("#mec_yearly_view_year_"+settings.id+"_"+year+" .mec-util-hidden").slice(0,2).each(function(){$(this).removeClass('mec-util-hidden');$("#mec_yearly_view_year_"+settings.id+"_"+year+" .mec-load-more-wrap").css('display','none');});}}}};}(jQuery));(function($){$.fn.mecMonthlyView=function(options){var active_month;var active_year;var settings=$.extend({today:null,id:0,events_label:'Events',event_label:'Event',month_navigator:0,atts:'',active_month:{},next_month:{},sf:{},ajax_url:'',},options);if(settings.month_navigator)initMonthNavigator();active_month=settings.active_month.month;active_year=settings.active_month.year;setListeners();if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month);}});}
function initMonthNavigator(){$("#mec_skin_"+settings.id+" .mec-load-month").off("click");$("#mec_skin_"+settings.id+" .mec-load-month").on("click",function(){var year=$(this).data("mec-year");var month=$(this).data("mec-month");setMonth(year,month,false,true);});}
function search(year,month){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_monthly_view_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){active_month=response.current_month.month;active_year=response.current_month.year;$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_monthly_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-monthly-view-month-navigator-container").html('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');$("#mec_skin_"+settings.id+" .mec-calendar-events-side").html('<div class="mec-month-side" id="mec_month_side_'+settings.id+'_'+response.current_month.id+'">'+response.events_side+'</div>');initMonthNavigator();setListeners();toggleMonth(response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");},error:function(){}});}
function setMonth(year,month,do_in_background,navigator_click){if(typeof do_in_background==="undefined")do_in_background=false;navigator_click=navigator_click||false;var month_id=year+""+month;if(!do_in_background){active_month=month;active_year=year;}
if($("#mec_monthly_view_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);}else{if(!do_in_background){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');}
$.ajax({url:settings.ajax_url,data:"action=mec_monthly_view_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigator_click,dataType:"json",type:"post",success:function(response){$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_monthly_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-monthly-view-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');$("#mec_skin_"+settings.id+" .mec-calendar-events-side").append('<div class="mec-month-side" id="mec_month_side_'+settings.id+'_'+response.current_month.id+'">'+response.events_side+'</div>');initMonthNavigator();setListeners();if(!do_in_background){toggleMonth(response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);}else{$("#mec_monthly_view_month_"+settings.id+"_"+response.current_month.id).hide();$("#mec_month_navigator_"+settings.id+"_"+response.current_month.id).hide();$("#mec_month_side_"+settings.id+"_"+response.current_month.id).hide();}
if(typeof custom_month!==undefined)var custom_month;if(typeof custom_month!=undefined){if(custom_month=='true'){$(".mec-month-container .mec-calendar-day").removeClass('mec-has-event');$(".mec-month-container .mec-calendar-day").removeClass('mec-selected-day');$('.mec-calendar-day').unbind('click');}}},error:function(){}});}}
function toggleMonth(month_id){var active_month=$("#mec_skin_"+settings.id+" .mec-month-container-selected").data("month-id");var active_day=$("#mec_monthly_view_month_"+settings.id+"_"+active_month+" .mec-selected-day").data("day");if(active_day<=9)active_day="0"+active_day;$("#mec_skin_"+settings.id+" .mec-month-navigator").hide();$("#mec_month_navigator_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").hide();$("#mec_monthly_view_month_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").removeClass("mec-month-container-selected");$("#mec_monthly_view_month_"+settings.id+"_"+month_id).addClass("mec-month-container-selected");$("#mec_skin_"+settings.id+" .mec-month-side").hide();$("#mec_month_side_"+settings.id+"_"+month_id).show();}
var sf;function setListeners(){$("#mec_skin_"+settings.id+" .mec-has-event").off("click");$("#mec_skin_"+settings.id+" .mec-has-event").on('click',function(e){e.preventDefault();var $this=$(this),data_mec_cell=$this.data('mec-cell'),month_id=$this.data('month');$("#mec_monthly_view_month_"+settings.id+"_"+month_id+" .mec-calendar-day").removeClass('mec-selected-day');$this.addClass('mec-selected-day');$('#mec_month_side_'+settings.id+'_'+month_id+' .mec-calendar-events-sec:not([data-mec-cell='+data_mec_cell+'])').slideUp();$('#mec_month_side_'+settings.id+'_'+month_id+' .mec-calendar-events-sec[data-mec-cell='+data_mec_cell+']').slideDown();$('#mec_monthly_view_month_'+settings.id+'_'+month_id+' .mec-calendar-events-sec:not([data-mec-cell='+data_mec_cell+'])').slideUp();$('#mec_monthly_view_month_'+settings.id+'_'+month_id+' .mec-calendar-events-sec[data-mec-cell='+data_mec_cell+']').slideDown();});mec_tooltip();if(settings.sed_method!='0'){sed();}
if(settings.style=='novel'){if($('.mec-single-event-novel').length>0){$('.mec-single-event-novel').colourBrightness();$('.mec-single-event-novel').each(function(){$(this).colourBrightness()});}}}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a,#mec_skin_"+settings.id+" .event-single-link-novel,#mec_skin_"+settings.id+" .mec-monthly-tooltip").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function mec_tooltip(){if($('.mec-monthly-tooltip').length>1){if(Math.max(document.documentElement.clientWidth,window.innerWidth||0)>768){$('.mec-monthly-tooltip').tooltipster({theme:'tooltipster-shadow',interactive:true,delay:100,minWidth:350,maxWidth:350});if(settings.sed_method!='0'){sed();}}else{var touchtime=0;$(".mec-monthly-tooltip").on("click",function(event){event.preventDefault();if(touchtime==0){$('.mec-monthly-tooltip').tooltipster({theme:'tooltipster-shadow',interactive:true,delay:100,minWidth:350,maxWidth:350,trigger:"custom",triggerOpen:{click:true,tap:true},triggerClose:{click:true,tap:true}});touchtime=new Date().getTime();}else{if(((new Date().getTime())-touchtime)<200){var el=$(this);var link=el.attr("href");window.location=link;touchtime=0;}else{touchtime=new Date().getTime();}}});}}}};}(jQuery));(function($){$.fn.mecWeeklyView=function(options){var active_year;var active_month;var active_week;var active_week_number;var settings=$.extend({today:null,week:1,id:0,current_year:null,current_month:null,changeWeekElement:'.mec-load-week',month_navigator:0,atts:'',ajax_url:'',sf:{}},options);active_year=settings.current_year;active_month=settings.current_month;if(settings.sf.container!==''){$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month,active_week);}});}
setThisWeek(settings.month_id+settings.week);setListeners();if(settings.month_navigator)initMonthNavigator(settings.month_id);function setListeners(){$(settings.changeWeekElement).off('click').on('click',function(e){var week=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('week-id');var max_weeks=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('max-weeks');var new_week_number=active_week_number;if($(this).hasClass('mec-previous-month')){week=parseInt(week)-1;new_week_number--;}else{week=parseInt(week)+1;new_week_number++;}
if(new_week_number<=1||new_week_number>=max_weeks){$(this).css({'opacity':.6,'cursor':'default'});$(this).find('i').css({'opacity':.6,'cursor':'default'});}else{$('#mec_skin_'+settings.id+' .mec-load-week, #mec_skin_'+settings.id+' .mec-load-week i').css({'opacity':1,'cursor':'pointer'});}
if(new_week_number===0||new_week_number>max_weeks){}else{setThisWeek(week);}});if(settings.sed_method!='0'){sed();}}
function setThisWeek(week,auto_focus){if(typeof auto_focus==='undefined')auto_focus=false;if(!$('#mec_weekly_view_week_'+settings.id+'_'+week).length){return setThisWeek((parseInt(week)-1));}
$('#mec_skin_'+settings.id+' .mec-weekly-view-week').removeClass('mec-weekly-view-week-active');$('#mec_weekly_view_week_'+settings.id+'_'+week).addClass('mec-weekly-view-week-active');$('#mec_weekly_view_top_week_'+settings.id+'_'+week).addClass('mec-weekly-view-week-active');$('#mec_skin_'+settings.id+' .mec-weekly-view-date-events').addClass('mec-util-hidden');$('.mec-weekly-view-week-'+settings.id+'-'+week).removeClass('mec-util-hidden');$('#mec_skin_'+settings.id+' .mec-calendar-row').addClass('mec-util-hidden');$('#mec_skin_'+settings.id+' .mec-calendar-row[data-week='+week%10+']').removeClass('mec-util-hidden');active_week=week;active_week_number=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('week-number');$('#mec_skin_'+settings.id+' .mec-calendar-d-top').find('.mec-current-week').find('span').remove();$('#mec_skin_'+settings.id+' .mec-calendar-d-top').find('.mec-current-week').append('<span>'+active_week_number+'</span>');if(active_week_number===1){$('#mec_skin_'+settings.id+' .mec-previous-month.mec-load-week').css({'opacity':.6,'cursor':'default'});$('#mec_skin_'+settings.id+' .mec-previous-month.mec-load-week').find('i').css({'opacity':.6,'cursor':'default'});}
if(auto_focus)mec_focus_week(settings.id);mecFluentCustomScrollbar();}
function initMonthNavigator(month_id){$('#mec_month_navigator'+settings.id+'_'+month_id+' .mec-load-month').off('click');$('#mec_month_navigator'+settings.id+'_'+month_id+' .mec-load-month').on('click',function(){var year=$(this).data('mec-year');var month=$(this).data('mec-month');setMonth(year,month,active_week,true);});}
function search(year,month,week,navigation_click){var week_number=(String(week).slice(-1));if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_weekly_view_load_month&mec_year="+year+"&mec_month="+month+"&mec_week="+week_number+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_weekly_view_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-weekly-view-month-navigator-container").html('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();toggleMonth(response.current_month.id);setThisWeek(response.week_id,true);mecFluentCustomScrollbar();},error:function(){}});}
function setMonth(year,month,week,navigation_click){var month_id=''+year+month;var week_number=(String(week).slice(-1));active_month=month;active_year=year;navigation_click=navigation_click||false;if($("#mec_weekly_view_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);setThisWeek(''+month_id+week_number);mecFluentCustomScrollbar();}else{if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_weekly_view_load_month&mec_year="+year+"&mec_month="+month+"&mec_week="+week_number+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigation_click,dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('#mec_skin_'+settings.id+' .mec-calendar-d-top h3').after(response.topWeeks);$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_weekly_view_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-weekly-view-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();toggleMonth(response.current_month.id);setThisWeek(response.week_id,true);$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);mecFluentCustomScrollbar();},error:function(){}});}}
function toggleMonth(month_id){$('#mec_skin_'+settings.id+' .mec-month-container').addClass('mec-util-hidden');$('#mec_weekly_view_month_'+settings.id+'_'+month_id).removeClass('mec-util-hidden');$('#mec_skin_'+settings.id+' .mec-month-navigator').addClass('mec-util-hidden');$('#mec_month_navigator'+settings.id+'_'+month_id).removeClass('mec-util-hidden');if(settings.month_navigator)initMonthNavigator(month_id);}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));(function($){$.fn.mecDailyView=function(options){var active_month;var active_year;var active_day;var settings=$.extend({today:null,id:0,changeDayElement:'.mec-daily-view-day',events_label:'Events',event_label:'Event',month_navigator:0,atts:'',ajax_url:'',sf:{},},options);active_month=settings.month;active_year=settings.year;active_day=settings.day;mecFluentCustomScrollbar();setToday(settings.today);setListeners();if(settings.month_navigator)initMonthNavigator(settings.month_id);initDaysSlider(settings.month_id);mecFocusDay(settings);if(settings.sf.container!==''){$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month,active_day);}});}
function setListeners(){$(settings.changeDayElement).on('click',function(){var today=$(this).data('day-id');setToday(today);mecFluentCustomScrollbar();});if(settings.sed_method!='0'){sed();}}
var current_monthday;function setToday(today){if(!$('#mec_daily_view_day'+settings.id+'_'+today).length){setToday(parseInt(today)-1);return false;}
$('.mec-daily-view-day').removeClass('mec-daily-view-day-active mec-color');$('#mec_daily_view_day'+settings.id+'_'+today).addClass('mec-daily-view-day-active mec-color');$('.mec-daily-view-date-events').addClass('mec-util-hidden');$('#mec_daily_view_date_events'+settings.id+'_'+today).removeClass('mec-util-hidden');$('.mec-daily-view-events').addClass('mec-util-hidden');$('#mec-daily-view-events'+settings.id+'_'+today).removeClass('mec-util-hidden');var weekday=$('#mec_daily_view_day'+settings.id+'_'+today).data('day-weekday');var monthday=$('#mec_daily_view_day'+settings.id+'_'+today).data('day-monthday');var count=$('#mec_daily_view_day'+settings.id+'_'+today).data('events-count');var month_id=$('#mec_daily_view_day'+settings.id+'_'+today).data('month-id');$('#mec_today_container'+settings.id+'_'+month_id).html('<h2>'+monthday+'</h2><h3>'+weekday+'</h3><div class="mec-today-count">'+count+' '+(count>1?settings.events_label:settings.event_label)+'</div>');if(monthday<=9)current_monthday='0'+monthday;else current_monthday=monthday;}
function initMonthNavigator(month_id){$('#mec_month_navigator'+settings.id+'_'+month_id+' .mec-load-month').off('click');$('#mec_month_navigator'+settings.id+'_'+month_id+' .mec-load-month').on('click',function(){var year=$(this).data('mec-year');var month=$(this).data('mec-month');setMonth(year,month,current_monthday,true);});}
function initDaysSlider(month_id,day_id){mec_g_month_id=month_id;var owl_rtl=$('body').hasClass('rtl')?true:false;var owl=$("#mec-owl-calendar-d-table-"+settings.id+"-"+month_id);owl.owlCarousel({responsiveClass:true,responsive:{0:{items:owl.closest('.mec-fluent-wrap').length>0?3:2,},479:{items:4,},767:{items:7,},960:{items:14,},1000:{items:19,},1200:{items:22,}},dots:false,loop:false,rtl:owl_rtl,});$("#mec_daily_view_month_"+settings.id+"_"+month_id+" .mec-table-d-next").click(function(e){e.preventDefault();owl.trigger('next.owl.carousel');});$("#mec_daily_view_month_"+settings.id+"_"+month_id+" .mec-table-d-prev").click(function(e){e.preventDefault();owl.trigger('prev.owl.carousel');});if(typeof day_id==='undefined')day_id=$('.mec-daily-view-day-active').data('day-id');var today_str=day_id.toString().substring(6,8);var today_int=parseInt(today_str);owl.trigger('owl.goTo',[today_int]);}
function search(year,month,day){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_daily_view_load_month&mec_year="+year+"&mec_month="+month+"&mec_day="+day+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_daily_view_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-calendar-a-month.mec-clear").html('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();active_year=response.current_month.year;active_month=response.current_month.month;toggleMonth(response.current_month.id,''+active_year+active_month+active_day);setToday(''+active_year+active_month+active_day);mecFocusDay(settings);mecFluentCustomScrollbar();},error:function(){}});}
function setMonth(year,month,day,navigation_click){var month_id=''+year+month;active_month=month;active_year=year;active_day=day;navigation_click=navigation_click||false;if($("#mec_daily_view_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);setToday(''+month_id+day);}else{if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_daily_view_load_month&mec_year="+year+"&mec_month="+month+"&mec_day="+day+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigation_click,dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_daily_view_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-calendar-a-month.mec-clear").append('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();toggleMonth(response.current_month.id,''+year+month+'01');setToday(''+year+month+'01');$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);mecFluentCustomScrollbar();},error:function(){}});}}
function toggleMonth(month_id,day_id){$('#mec_skin_'+settings.id+' .mec-month-container').addClass('mec-util-hidden');$('#mec_daily_view_month_'+settings.id+'_'+month_id).removeClass('mec-util-hidden');$('#mec_skin_'+settings.id+' .mec-month-navigator').addClass('mec-util-hidden');$('#mec_month_navigator'+settings.id+'_'+month_id).removeClass('mec-util-hidden');if(settings.month_navigator)initMonthNavigator(month_id);initDaysSlider(month_id,day_id);mecFocusDay(settings);}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));(function($){$.fn.mecTimeTable=function(options){var active_year;var active_month;var active_week;var active_week_number;var active_day;var settings=$.extend({today:null,week:1,active_day:1,id:0,changeWeekElement:'.mec-load-week',month_navigator:0,atts:'',ajax_url:'',sf:{}},options);if(settings.sf.container!==''){$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month,active_week,active_day);}});}
setThisWeek(settings.month_id+settings.week,settings.active_day);setListeners();if(settings.month_navigator)initMonthNavigator(settings.month_id);function setListeners(){$(settings.changeWeekElement).off('click').on('click',function(){var week=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('week-id');var max_weeks=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('max-weeks');var new_week_number=active_week_number;if($(this).hasClass('mec-previous-month')){week=parseInt(week)-1;new_week_number--;}else{week=parseInt(week)+1;new_week_number++;}
if(new_week_number<=1||new_week_number>=max_weeks){$(this).css({'opacity':.6,'cursor':'default'});$(this).find('i').css({'opacity':.6,'cursor':'default'});}else{$('#mec_skin_'+settings.id+' .mec-load-week, #mec_skin_'+settings.id+' .mec-load-week i').css({'opacity':1,'cursor':'pointer'});}
if(new_week_number===0||new_week_number>max_weeks){}else{setThisWeek(week);}});$('#mec_skin_'+settings.id+' .mec-weekly-view-week dt').not('.mec-timetable-has-no-event').off('click').on('click',function(){var day=$(this).data('date-id');setDay(day);});if(settings.sed_method!='0'){sed();}}
function setThisWeek(week,day){if(!$('#mec_weekly_view_week_'+settings.id+'_'+week).length){return setThisWeek((parseInt(week)-1),day);}
$('#mec_skin_'+settings.id+' .mec-weekly-view-week').removeClass('mec-weekly-view-week-active');$('#mec_weekly_view_week_'+settings.id+'_'+week).addClass('mec-weekly-view-week-active');setDay(day);active_week=week;active_week_number=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active').data('week-number');$('#mec_skin_'+settings.id+' .mec-calendar-d-top').find('.mec-current-week').find('span').remove();$('#mec_skin_'+settings.id+' .mec-calendar-d-top').find('.mec-current-week').append('<span>'+active_week_number+'</span>');if(active_week_number===1){$('#mec_skin_'+settings.id+' .mec-previous-month.mec-load-week').css({'opacity':.6,'cursor':'default'});$('#mec_skin_'+settings.id+' .mec-previous-month.mec-load-week').find('i').css({'opacity':.6,'cursor':'default'});}}
function setDay(day){if(typeof day==='undefined'){day=$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active dt').not('.mec-timetable-has-no-event').first().data('date-id');}
$('#mec_skin_'+settings.id+' dt').removeClass('mec-timetable-day-active');$('#mec_skin_'+settings.id+' .mec-weekly-view-week-active dt[data-date-id="'+day+'"]').addClass('mec-timetable-day-active');$('#mec_skin_'+settings.id+' .mec-weekly-view-date-events').addClass('mec-util-hidden');$('#mec_weekly_view_date_events'+settings.id+'_'+day).removeClass('mec-util-hidden');}
function initMonthNavigator(month_id){$('#mec_month_navigator'+settings.id+'_'+month_id+' .mec-load-month').off('click').on('click',function(){var year=$(this).data('mec-year');var month=$(this).data('mec-month');setMonth(year,month,active_week);});}
function search(year,month,week){var week_number=(String(week).slice(-1));if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');year=typeof year=='undefined'?'':year;month=typeof month=='undefined'?'':month;$('body').data('currentweek',$("#mec_skin_events_"+settings.id).find('.mec-current-week > span').html());$.ajax({url:settings.ajax_url,data:"action=mec_timetable_load_month&mec_year="+year+"&mec_month="+month+"&mec_week="+week_number+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_timetable_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-weekly-view-month-navigator-container").html('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();toggleMonth(response.current_month.id);setThisWeek(response.week_id);mec_focus_week(settings.id,'timetable');mecFluentCustomScrollbar();},error:function(){}});}
function setMonth(year,month,week){var month_id=''+year+month;var week_number=(String(week).slice(-1));active_month=month;active_year=year;if($("#mec_timetable_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);setThisWeek(''+month_id+week_number);}else{if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_timetable_load_month&mec_year="+year+"&mec_month="+month+"&mec_week="+week_number+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_timetable_month_'+settings.id+'_'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-weekly-view-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');setListeners();toggleMonth(response.current_month.id);setThisWeek(response.week_id);$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);},error:function(){}});}}
function toggleMonth(month_id){$('#mec_skin_'+settings.id+' .mec-month-container').addClass('mec-util-hidden');$('#mec_timetable_month_'+settings.id+'_'+month_id).removeClass('mec-util-hidden');$('#mec_skin_'+settings.id+' .mec-month-navigator').addClass('mec-util-hidden');$('#mec_month_navigator'+settings.id+'_'+month_id).removeClass('mec-util-hidden');if(settings.month_navigator)initMonthNavigator(month_id);}
function sed(){$("#mec_skin_"+settings.id+" .mec-timetable-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));(function($){$.fn.mecWeeklyProgram=function(options){var settings=$.extend({id:0,atts:'',sf:{}},options);if(settings.sf.container!==''){$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
setListeners();function setListeners(){if(settings.sed_method!='0'){sed();}}
function search(){var $modal=$('.mec-modal-result');if($modal.length===0)$('.mec-wrap').append('<div class="mec-modal-result"></div>');$modal.addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_weeklyprogram_load&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){$modal.removeClass("mec-month-navigator-loading");$("#mec_skin_events_"+settings.id).html(response.date_events);setListeners();},error:function(){}});}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));(function($){$.fn.mecMasonryView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},end_date:'',offset:0,start_date:'',},options);setListeners();jQuery(window).load(function(){initMasonry();if(typeof custom_dev!==undefined)var custom_dev;if(custom_dev=='yes'){$(".mec-wrap").css("height","1550");if(Math.max(document.documentElement.clientWidth,window.innerWidth||0)<768){$(".mec-wrap").css("height","5500");}
if(Math.max(document.documentElement.clientWidth,window.innerWidth||0)<480){$(".mec-wrap").css("height","5000");}
$(".mec-event-masonry .mec-masonry-item-wrap:nth-child(n+20)").css("display","none");$(".mec-load-more-button").on("click",function(){$(".mec-event-masonry .mec-masonry-item-wrap:nth-child(n+20)").css("display","block");$(".mec-wrap").css("height","auto");initMasonry();$(".mec-load-more-button").hide();})
$(".mec-events-masonry-cats a:first-child").on("click",function(){$(".mec-wrap").css("height","auto");$(".mec-event-masonry .mec-masonry-item-wrap:nth-child(n+20)").css("display","block");$(".mec-load-more-button").hide();initMasonry();})
$(".mec-events-masonry-cats a:not(:first-child)").on("click",function(){$(".mec-load-more-button").hide();$(".mec-wrap").css("height","auto");$(".mec-wrap").css("min-height","400");$(".mec-event-masonry .mec-masonry-item-wrap").css("display","block");var element=document.querySelector("#mec_skin_"+settings.id+" .mec-event-masonry");var selector=$(this).attr('data-group');var CustomShuffle=new Shuffle(element,{itemSelector:'.mec-masonry-item-wrap',});CustomShuffle.sort({by:element.getAttribute('data-created'),});CustomShuffle.filter(selector!='*'?selector:Shuffle.ALL_ITEMS);$(".mec-event-masonry .mec-masonry-item-wrap").css("visibility","visible");})}});if(mecdata.elementor_edit_mode!='no')elementorFrontend.hooks.addAction('frontend/element_ready/global',initMasonry());function initMasonry(){var $container=$("#mec_skin_"+settings.id+" .mec-event-masonry");var data_sortAscending=$("#mec_skin_"+settings.id).data('sortascending');var $grid=$container.isotope({filter:'*',itemSelector:'.mec-masonry-item-wrap',getSortData:{date:'[data-sort-masonry]',},sortBy:'date',sortAscending:data_sortAscending,animationOptions:{duration:750,easing:'linear',queue:false},});if(settings.fit_to_row==1)$grid.isotope({layoutMode:'fitRows',sortAscending:data_sortAscending,});$('.elementor-tabs').find('.elementor-tab-title').click(function(){$grid.isotope({sortBy:'date',sortAscending:data_sortAscending,});});$("#mec_skin_"+settings.id+" .mec-events-masonry-cats a").click(function(){var selector=$(this).attr('data-filter');var $grid_cat=$container.isotope({filter:selector,itemSelector:'.mec-masonry-item-wrap',getSortData:{date:'[data-sort-masonry]',},sortBy:'date',sortAscending:data_sortAscending,animationOptions:{duration:750,easing:'linear',queue:false},});if(settings.masonry_like_grid==1)$grid_cat.isotope({sortBy:'date',sortAscending:data_sortAscending,});return false;});var $optionSets=$("#mec_skin_"+settings.id+" .mec-events-masonry-cats"),$optionLinks=$optionSets.find('a');$optionLinks.click(function(){var $this=$(this);if($this.hasClass('selected'))return false;var $optionSet=$this.parents('.mec-events-masonry-cats');$optionSet.find('.mec-masonry-cat-selected').removeClass('mec-masonry-cat-selected');$this.addClass('mec-masonry-cat-selected');});}
function setListeners(){if(settings.sed_method!='0'){sed();}}
$("#mec_skin_"+settings.id+" .mec-events-masonry-cats > a").click(function()
{var mec_load_more_btn=$("#mec_skin_"+settings.id+" .mec-load-more-button");var mec_filter_value=$(this).data('filter').replace('.mec-t','');if(mec_load_more_btn.hasClass('mec-load-more-loading'))mec_load_more_btn.removeClass('mec-load-more-loading');if(mec_load_more_btn.hasClass("mec-hidden-"+mec_filter_value))mec_load_more_btn.addClass("mec-util-hidden");else mec_load_more_btn.removeClass("mec-util-hidden");});$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});function sed(){$("#mec_skin_"+settings.id+" .mec-masonry-img a, #mec_skin_"+settings.id+" .mec-event-title a, #mec_skin_"+settings.id+" .mec-booking-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");var mec_cat_elem=$('#mec_skin_'+settings.id).find('.mec-masonry-cat-selected');var mec_filter_value=(mec_cat_elem&&mec_cat_elem.data('filter')!=undefined)?mec_cat_elem.data('filter').replace('.mec-t',''):'';var mec_filter_by=$('#mec_skin_'+settings.id).data('filterby');$.ajax({url:settings.ajax_url,data:"action=mec_masonry_load_more&mec_filter_by="+mec_filter_by+"&mec_filter_value="+mec_filter_value+"&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden mec-hidden-"+mec_filter_value);}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");var node=$("#mec_skin_"+settings.id+" .mec-event-masonry");var markup='',newItems=$(response.html).find('.mec-masonry-item-wrap');newItems.each(function(index){node.isotope().append(newItems[index]).isotope('appended',newItems[index]);});$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}};}(jQuery));(function($){$.fn.mecListView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},current_month_divider:'',end_date:'',offset:0,limit:0},options);setListeners();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});if(settings.style==='accordion'){if(settings.toggle_month_divider){$('#mec_skin_'+settings.id+' .mec-month-divider:first-of-type').addClass('active');$('#mec_skin_'+settings.id+' .mec-month-divider:first-of-type').find('i').removeClass('mec-sl-arrow-down').addClass('mec-sl-arrow-up');toggle();}
accordion();}
if(settings.sed_method!='0'){sed();}}
function toggle(){$('#mec_skin_'+settings.id+' .mec-month-divider').off("click").on("click",function(event){event.preventDefault();var status=$(this).hasClass('active');$('#mec_skin_'+settings.id+' .mec-month-divider').removeClass('active');$('#mec_skin_'+settings.id+' .mec-divider-toggle').slideUp('fast');if(status){$(this).removeClass('active');$('.mec-month-divider').find('i').removeClass('mec-sl-arrow-up').addClass('mec-sl-arrow-down');}else{$(this).addClass('active');$('.mec-month-divider').find('i').removeClass('mec-sl-arrow-up').addClass('mec-sl-arrow-down')
$(this).find('i').removeClass('mec-sl-arrow-down').addClass('mec-sl-arrow-up');var month=$(this).data('toggle-divider');$('#mec_skin_'+settings.id+' .'+month).slideDown('fast');}});}
function toggleLoadmore()
{$('#mec_skin_'+settings.id+' .mec-month-divider:not(:last)').each(function()
{if($(this).hasClass('active'))$(this).removeClass('active');var month=$(this).data('toggle-divider');$('#mec_skin_'+settings.id+' .'+month).slideUp('fast');});$('#mec_skin_'+settings.id+' .mec-month-divider:last').addClass('active');toggle();}
function accordion(){$("#mec_skin_"+settings.id+" .mec-toggle-item-inner").off("click").on("click",function(event){event.preventDefault();var $this=$(this);$(this).parent().find(".mec-content-toggle").slideToggle("fast",function(){$this.children("i").toggleClass("mec-sl-arrow-down mec-sl-arrow-up");});var unique_id=$(this).parent().find(".mec-modal-wrap").data('unique-id');window['mec_init_gmap'+unique_id]();});}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a, #mec_skin_"+settings.id+" .mec-booking-button, #mec_skin_"+settings.id+" .mec-detail-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});$("#mec_skin_"+settings.id+" .mec-event-image a img").off('click').on('click',function(e){e.preventDefault();var href=$(this).parent().attr('href');var id=$(this).parent().data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_list_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&current_month_divider="+settings.current_month_divider+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=='0'){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id).append(response.html);$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;settings.current_month_divider=response.current_month_divider;if(settings.sed_method!='0'){sed();}
if(settings.style==='accordion'){if(settings.toggle_month_divider)toggleLoadmore();accordion();}}},error:function(){}});}
function search(){$("#mec_skin_no_events_"+settings.id).addClass("mec-util-hidden");if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');jQuery("#gmap-data").val("");$.ajax({url:settings.ajax_url,data:"action=mec_list_load_more&mec_start_date="+settings.start_date+"&"+settings.atts+"&current_month_divider=0&apply_sf_date=1",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_events_"+settings.id).html('');$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').addClass("mec-util-hidden");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");$("#mec_skin_no_events_"+settings.id).removeClass("mec-util-hidden");}else{$("#mec_skin_events_"+settings.id).html(response.html);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').removeClass("mec-util-hidden");if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;settings.current_month_divider=response.current_month_divider;if(settings.sed_method!='0'){sed();}
if(settings.style==='accordion'){if(settings.toggle_month_divider)toggle();accordion();}}},error:function(){}});}};}(jQuery));(function($){$.fn.mecGridView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},end_date:'',offset:0,start_date:'',},options);setListeners();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});if(settings.sed_method!='0'){sed();}}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a, #mec_skin_"+settings.id+" .mec-booking-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});$("#mec_skin_"+settings.id+" .mec-event-image a img").off('click').on('click',function(e){e.preventDefault();var href=$(this).parent().attr('href');var id=$(this).parent().data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_grid_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id).append(response.html);$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}
function search(){$("#mec_skin_no_events_"+settings.id).addClass("mec-util-hidden");if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');jQuery("#gmap-data").val("");$.ajax({url:settings.ajax_url,data:"action=mec_grid_load_more&mec_start_date="+settings.start_date+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_events_"+settings.id).html('');$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').addClass("mec-util-hidden");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");$("#mec_skin_no_events_"+settings.id).removeClass("mec-util-hidden");}else{$("#mec_skin_events_"+settings.id).html(response.html);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').removeClass("mec-util-hidden");if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}};}(jQuery));(function($){$.fn.mecCustomView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},end_date:'',offset:0,start_date:'',},options);setListeners();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});if(settings.sed_method!='0'){sed();}}
function sed(){$("#mec_skin_"+settings.id+" .mec-event-title a, #mec_skin_"+settings.id+" .mec-booking-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});$("#mec_skin_"+settings.id+" .mec-event-image a img").off('click').on('click',function(e){e.preventDefault();var href=$(this).parent().attr('href');var id=$(this).parent().data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_custom_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id).append(response.html);$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;if($('.mec-event-sd-countdown').length>0)
{$('.mec-event-sd-countdown').each(function(event){var dc=$(this).attr('data-date-custom');$(this).mecCountDown({date:dc,format:"off"},function(){});})}
if(settings.sed_method!='0'){sed();}}},error:function(){}});}
function search(){$("#mec_skin_no_events_"+settings.id).addClass("mec-util-hidden");if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');jQuery("#gmap-data").val("");$.ajax({url:settings.ajax_url,data:"action=mec_custom_load_more&mec_start_date="+settings.start_date+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_events_"+settings.id).html('');$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').addClass("mec-util-hidden");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");$("#mec_skin_no_events_"+settings.id).removeClass("mec-util-hidden");}else{$("#mec_skin_events_"+settings.id).html(response.html);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').removeClass("mec-util-hidden");if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}};}(jQuery));(function($){$.fn.mecTimelineView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},end_date:'',offset:0,start_date:'',},options);setListeners();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});if(settings.sed_method!='0'){sed();}}
function sed(){$("#mec_skin_"+settings.id+" .mec-timeline-event-image a, #mec_skin_"+settings.id+" .mec-event-title a, #mec_skin_"+settings.id+" .mec-booking-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});$("#mec_skin_"+settings.id+" .mec-event-image a img").off('click').on('click',function(e){e.preventDefault();var href=$(this).parent().attr('href');var id=$(this).parent().data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_timeline_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id).append(response.html);$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}
function search(){$("#mec_skin_no_events_"+settings.id).addClass("mec-util-hidden");if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_timeline_load_more&mec_start_date="+settings.start_date+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_events_"+settings.id).html('');$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').addClass("mec-util-hidden");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");$("#mec_skin_no_events_"+settings.id).removeClass("mec-util-hidden");}else{$("#mec_skin_events_"+settings.id).html(response.html);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$('.mec-skin-map-container').removeClass("mec-util-hidden");if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;if(settings.sed_method!='0'){sed();}}},error:function(){}});}};}(jQuery));(function($){$.fn.mecAgendaView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},current_month_divider:'',end_date:'',offset:0,},options);setListeners();var sf;function setListeners(){if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search();}});}
$("#mec_skin_"+settings.id+" .mec-load-more-button").on("click",function(){loadMore();});if(settings.sed_method!='0'){sed();}}
function sed(){$("#mec_skin_"+settings.id+" .mec-agenda-event-title a").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore(){$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_agenda_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&current_month_divider="+settings.current_month_divider+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");}else{$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id+" .mec-events-agenda-container").append(response.html);$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;settings.current_month_divider=response.current_month_divider;if(settings.sed_method!='0'){sed();}
mecFluentCustomScrollbar();}},error:function(){}});}
function search(){$("#mec_skin_no_events_"+settings.id).addClass("mec-util-hidden");if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');mecFluentCustomScrollbar();$.ajax({url:settings.ajax_url,data:"action=mec_agenda_load_more&mec_start_date="+settings.start_date+"&"+settings.atts+"&current_month_divider=0&apply_sf_date=1",dataType:"json",type:"post",success:function(response){if(response.count=="0"){$("#mec_skin_events_"+settings.id+" .mec-events-agenda-container").html('');$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");$("#mec_skin_no_events_"+settings.id).removeClass("mec-util-hidden");}else{$("#mec_skin_events_"+settings.id+" .mec-events-agenda-container").html(response.html);$('.mec-modal-result').removeClass("mec-month-navigator-loading");if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;settings.current_month_divider=response.current_month_divider;if(settings.sed_method!='0'){sed();}}
mecFluentCustomScrollbar();},error:function(){}});}};}(jQuery));(function($){$.fn.mecCarouselView=function(options){var settings=$.extend({id:0,atts:'',ajax_url:'',sf:{},items:3,autoplay:'',style:'type1',start_date:''},options);initSlider(settings);if(settings.sed_method!='0'){sed(settings);}
function initSlider(settings){if($('body').hasClass('rtl')){var owl_rtl=true;}else{var owl_rtl=false;}
if(settings.style==='type1'){var owl=$("#mec_skin_"+settings.id+" .mec-event-carousel-type1 .mec-owl-carousel");owl.owlCarousel({autoplay:true,autoplayTimeout:settings.autoplay,loop:true,items:settings.items,responsiveClass:true,responsive:{0:{items:1,},979:{items:2,},1199:{items:settings.count,}},dots:true,nav:false,autoplayHoverPause:true,rtl:owl_rtl,});owl.bind("mouseleave",function(event){$("#mec_skin_"+settings.id+" .mec-owl-carousel").trigger('play.owl.autoplay');});}else if(settings.style==='type4'){$("#mec_skin_"+settings.id+" .mec-owl-carousel").owlCarousel({autoplay:true,loop:true,autoplayTimeout:settings.autoplay,items:settings.items,dots:false,nav:true,responsiveClass:true,responsive:{0:{items:1,stagePadding:50,},979:{items:2,},1199:{items:settings.count,}},autoplayHoverPause:true,navText:["<i class='mec-sl-arrow-left'></i>"," <i class='mec-sl-arrow-right'></i>"],rtl:owl_rtl,});$("#mec_skin_"+settings.id+" .mec-owl-carousel").bind("mouseleave",function(event){$("#mec_skin_"+settings.id+" .mec-owl-carousel").trigger('play.owl.autoplay');});}else{$("#mec_skin_"+settings.id+" .mec-owl-carousel").owlCarousel({autoplay:true,loop:true,autoplayTimeout:settings.autoplay,items:settings.items,dots:typeof settings.dots_navigation!='undefined'?settings.dots_navigation:false,nav:typeof settings.navigation!='undefined'?settings.navigation:true,responsiveClass:true,responsive:{0:{items:1,},979:{items:2,},1199:{items:settings.count,}},autoplayHoverPause:true,navText:typeof settings.navText!='undefined'?settings.navText:["<i class='mec-sl-arrow-left'></i>"," <i class='mec-sl-arrow-right'></i>"],rtl:owl_rtl,});$("#mec_skin_"+settings.id+" .mec-owl-carousel").bind("mouseleave",function(event){$("#mec_skin_"+settings.id+" .mec-owl-carousel").trigger('play.owl.autoplay');});}}};function sed(settings){$("#mec_skin_"+settings.id+" .mec-event-carousel-title a, #mec_skin_"+settings.id+" .mec-booking-button, #mec_skin_"+settings.id+" .mec-event-button").off('click').on('click',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}}(jQuery));(function($){$.fn.mecSliderView=function(options){var settings=$.extend({id:0,atts:'',autoplay:false,ajax_url:'',sf:{},start_date:''},options);initSlider();function initSlider(){if($('body').hasClass('rtl')){var owl_rtl=true;}else{var owl_rtl=false;}
$("#mec_skin_"+settings.id+" .mec-owl-carousel").owlCarousel({autoplay:true,autoplayTimeout:settings.autoplay,loop:true,items:1,responsiveClass:true,responsive:{0:{items:1,},960:{items:1,},1200:{items:1,}},dots:false,nav:true,autoplayHoverPause:true,navText:typeof settings.navText!='undefined'?settings.navText:["<i class='mec-sl-arrow-left'></i>"," <i class='mec-sl-arrow-right'></i>"],rtl:owl_rtl,});}};}(jQuery));(function($){$.fn.mecCountDown=function(options,callBack){var settings=$.extend({date:null,format:null},options);var callback=callBack;var selector=$(this);startCountdown();var interval=setInterval(startCountdown,1000);function startCountdown(){var eventDate=Date.parse(settings.date)/1000;var currentDate=Math.floor($.now()/1000);if(eventDate<=currentDate){callback.call(this);clearInterval(interval);}
var seconds=eventDate-currentDate;var days=Math.floor(seconds/(60*60*24));seconds-=days*60*60*24;var hours=Math.floor(seconds/(60*60));seconds-=hours*60*60;var minutes=Math.floor(seconds/60);seconds-=minutes*60;if(days==1)selector.find(".mec-timeRefDays").text(mecdata.day);else selector.find(".mec-timeRefDays").text(mecdata.days);if(hours==1)selector.find(".mec-timeRefHours").text(mecdata.hour);else selector.find(".mec-timeRefHours").text(mecdata.hours);if(minutes==1)selector.find(".mec-timeRefMinutes").text(mecdata.minute);else selector.find(".mec-timeRefMinutes").text(mecdata.minutes);if(seconds==1)selector.find(".mec-timeRefSeconds").text(mecdata.second);else selector.find(".mec-timeRefSeconds").text(mecdata.seconds);if(settings.format==="on"){days=(String(days).length>=2)?days:"0"+days;hours=(String(hours).length>=2)?hours:"0"+hours;minutes=(String(minutes).length>=2)?minutes:"0"+minutes;seconds=(String(seconds).length>=2)?seconds:"0"+seconds;}
if(!isNaN(eventDate)){selector.find(".mec-days").text(days);selector.find(".mec-hours").text(hours);selector.find(".mec-minutes").text(minutes);selector.find(".mec-seconds").text(seconds);}else{clearInterval(interval);}}};}(jQuery));(function($)
{$.fn.mecTileView=function(options)
{var active_month;var active_year;var settings=$.extend({today:null,id:0,events_label:'Events',event_label:'Event',month_navigator:0,atts:'',active_month:{},next_month:{},sf:{},ajax_url:''},options);if(settings.month_navigator)initMonthNavigator();if(settings.load_method==='month')setMonth(settings.next_month.year,settings.next_month.month,true);active_month=settings.active_month.month;active_year=settings.active_month.year;setListeners();if(settings.sf.container!=='')
{sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts)
{settings.atts=atts;search(active_year,active_month);}});}
function initMonthNavigator()
{$("#mec_skin_"+settings.id+" .mec-load-month").off("click").on("click",function()
{var year=$(this).data("mec-year");var month=$(this).data("mec-month");setMonth(year,month,false,true);});}
function search(year,month)
{if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');$.ajax({url:settings.ajax_url,data:"action=mec_tile_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response)
{if(settings.load_method==='month')
{active_month=response.current_month.month;active_year=response.current_month.year;$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_tile_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-tile-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();setListeners();toggleMonth(response.current_month.id);}
else
{$("#mec_skin_events_"+settings.id).html(response.html);if(response.count>=settings.limit)$("#mec_skin_"+settings.id+" .mec-load-more-button").removeClass("mec-util-hidden");else $("#mec_skin_"+settings.id+" .mec-load-more-button").addClass("mec-util-hidden");settings.end_date=response.end_date;settings.offset=response.offset;setListeners();}
$('.mec-modal-result').removeClass("mec-month-navigator-loading");},error:function(){}});}
function setMonth(year,month,do_in_background,navigator_click)
{if(typeof do_in_background==="undefined")do_in_background=false;navigator_click=navigator_click||false;var month_id=year+""+month;if(!do_in_background)
{active_month=month;active_year=year;}
if($("#mec_tile_month_"+settings.id+"_"+month_id).length)
{toggleMonth(month_id);}
else
{if(!do_in_background)
{if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');}
$.ajax({url:settings.ajax_url,data:"action=mec_tile_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigator_click,dataType:"json",type:"post",success:function(response)
{$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_tile_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-tile-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();setListeners();if(!do_in_background)
{toggleMonth(response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);}
else
{$("#mec_tile_month_"+settings.id+"_"+response.current_month.id).hide();$("#mec_month_navigator_"+settings.id+"_"+response.current_month.id).hide();}},error:function(){}});}}
function toggleMonth(month_id)
{var active_month=$("#mec_skin_"+settings.id+" .mec-month-container-selected").data("month-id");var active_day=$("#mec_tile_month_"+settings.id+"_"+active_month+" .mec-selected-day").data("day");if(active_day<=9)active_day="0"+active_day;$("#mec_skin_"+settings.id+" .mec-month-navigator").hide();$("#mec_month_navigator_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").hide().removeClass("mec-month-container-selected");$("#mec_tile_month_"+settings.id+"_"+month_id).show().addClass("mec-month-container-selected");}
var sf;function setListeners()
{$("#mec_skin_"+settings.id+" .mec-load-more-button").off("click").on("click",function()
{loadMore();});$("#mec_skin_"+settings.id+" .mec-has-event").off("click").on('click',function(e)
{e.preventDefault();var $this=$(this),data_mec_cell=$this.data('mec-cell'),month_id=$this.data('month');$("#mec_monthly_view_month_"+settings.id+"_"+month_id+" .mec-calendar-day").removeClass('mec-selected-day');$this.addClass('mec-selected-day');$('#mec_month_side_'+settings.id+'_'+month_id+' .mec-calendar-events-sec:not([data-mec-cell='+data_mec_cell+'])').slideUp();$('#mec_month_side_'+settings.id+'_'+month_id+' .mec-calendar-events-sec[data-mec-cell='+data_mec_cell+']').slideDown();$('#mec_monthly_view_month_'+settings.id+'_'+month_id+' .mec-calendar-events-sec:not([data-mec-cell='+data_mec_cell+'])').slideUp();$('#mec_monthly_view_month_'+settings.id+'_'+month_id+' .mec-calendar-events-sec[data-mec-cell='+data_mec_cell+']').slideDown();});if(settings.sed_method!='0')
{sed();}}
function sed()
{$("#mec_skin_"+settings.id+" .mec-event-title a").off('click').on('click',function(e)
{e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}
function loadMore()
{var $load_more_button=$("#mec_skin_"+settings.id+" .mec-load-more-button");$load_more_button.addClass("mec-load-more-loading");$.ajax({url:settings.ajax_url,data:"action=mec_tile_load_more&mec_start_date="+settings.end_date+"&mec_offset="+settings.offset+"&"+settings.atts+"&current_month_divider="+settings.current_month_divider+"&apply_sf_date=0",dataType:"json",type:"post",success:function(response)
{if(response.count=='0')
{$load_more_button.removeClass("mec-load-more-loading");$load_more_button.addClass("mec-util-hidden");}
else
{$load_more_button.removeClass("mec-util-hidden");$("#mec_skin_events_"+settings.id).append(response.html);$load_more_button.removeClass("mec-load-more-loading");settings.end_date=response.end_date;settings.offset=response.offset;settings.current_month_divider=response.current_month_divider;if(settings.sed_method!='0')
{sed();}}},error:function(){}});}};}(jQuery));function mec_gateway_selected(gateway_id){jQuery('.mec-book-form-gateway-checkout').addClass('mec-util-hidden');jQuery('#mec_book_form_gateway_checkout'+gateway_id).removeClass('mec-util-hidden');}
function mec_wrap_resize(){var $mec_wrap=jQuery('.mec-wrap'),mec_width=$mec_wrap.width();if(mec_width<959){$mec_wrap.addClass('mec-sm959');}else{$mec_wrap.removeClass('mec-sm959');}}
function get_parameter_by_name(name,url){if(!url){url=window.location.href;}
name=name.replace(/[\[\]]/g,"\\$&");var regex=new RegExp("[?&]"+name+"(=([^&#]*)|&|#|$)"),results=regex.exec(url);if(!results)return null;if(!results[2])return'';return decodeURIComponent(results[2].replace(/\+/g," "));}
var mec_g_month_id=null;function mecFocusDay(settings)
{if(mec_g_month_id!=null)
{setTimeout(function()
{var id=settings.id,date=new Date(),mec_owl_year=mec_g_month_id.substr(0,4),mec_current_year=date.getFullYear(),mec_owl_month=mec_g_month_id.substr(4,6),mec_current_month=date.getMonth()+1,mec_current_day=date.getDate(),mec_owl_go=jQuery("#mec-owl-calendar-d-table-"+id+"-"+mec_g_month_id),mec_day_exist=false;mec_owl_go.find('.owl-stage > div').each(function(index)
{if(parseInt(jQuery(this).children('div').data("events-count"))>0)
{if((((mec_owl_year!=mec_current_year)&&(mec_owl_month!=mec_current_month))||(mec_owl_year==mec_current_year)&&(mec_owl_month!=mec_current_month))||parseInt(jQuery(this).children('div').text())>mec_current_day)
{var index_plus=index+1;jQuery('#mec_daily_view_day'+id+'_'+mec_g_month_id+(index<10?'0'+index_plus:index_plus)).trigger('click');mec_owl_go.trigger('to.owl.carousel',index_plus);mec_day_exist=true;return false;}
else
{jQuery('#mec_daily_view_day'+id+'_'+mec_g_month_id+mec_current_day).trigger('click');mec_owl_go.trigger('to.owl.carousel',mec_current_day);mec_day_exist=true;return false;}}});if(!mec_day_exist&&((mec_owl_year==mec_current_year)&&(mec_owl_month==mec_current_month)))
{jQuery('#mec_daily_view_day'+id+'_'+mec_g_month_id+mec_current_day).trigger('click');mec_owl_go.trigger('to.owl.carousel',mec_current_day);}},1000);}}
function mec_focus_week(id,skin){skin=skin||'weekly';var wrap_elem=jQuery('.mec-weeks-container .mec-weekly-view-week-active').parent();var days=wrap_elem.find('dt');var week=wrap_elem.find('dl').length;var focus_week=false;var i=j=1;for(i=1;i<week;i++){setTimeout(function(){var event=new Event('click');jQuery('#mec_skin_'+id+' .mec-previous-month.mec-load-week')[0].dispatchEvent(event);},33);}
days.each(function(i){if(jQuery(this).data('events-count')>0){if(focus_week===false){focus_week=parseInt(jQuery(this).parent().data('week-number'));}
if(skin=='timetable'){if(parseInt(jQuery(this).parent().data('week-number'))==parseInt(jQuery('body').data('currentweek'))){focus_week=parseInt(jQuery(this).parent().data('week-number'));return false;}}
else{return false;}}});if(focus_week!==false){for(j=1;j<focus_week;j++){setTimeout(function(){var event=new Event('click');jQuery('#mec_skin_'+id+' .mec-next-month.mec-load-week')[0].dispatchEvent(event);},33);}}}
(function($){$(document).ready(function(){if($('body').hasClass('rtl')){var owl_rtl=true;}else{var owl_rtl=false;}
$(".mec-widget .mec-event-grid-classic").addClass('mec-owl-carousel mec-owl-theme');$(".mec-widget .mec-event-grid-classic").owlCarousel({autoplay:true,autoplayTimeout:3000,autoplayHoverPause:true,loop:true,dots:false,nav:true,navText:["<i class='mec-sl-arrow-left'></i>"," <i class='mec-sl-arrow-right'></i>"],items:1,autoHeight:true,responsiveClass:true,rtl:owl_rtl,});mec_wrap_resize();jQuery(window).bind('resize',function(){mec_wrap_resize();});$('.mec-event-sharing-wrap').hover(function(){$(this).find('.mec-event-sharing').show(0);},function(){$(this).find('.mec-event-sharing').hide(0);});$('a.simple-booking[href^="#mec-events-meta-group-booking"]').click(function(){if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')&&location.hostname==this.hostname){var target=$(this.hash);target=target.length?target:$('[name='+this.hash.slice(1)+']');if(target.length){var scrollTopVal=target.offset().top-30;$('html, body').animate({scrollTop:scrollTopVal},600);return false;}}});if($('.single-mec-events .mec-single-event:not(".mec-single-modern")').length>0){if($('.single-mec-events .mec-event-info-desktop.mec-event-meta.mec-color-before.mec-frontbox').length>0){var html=$('.single-mec-events .mec-event-info-desktop.mec-event-meta.mec-color-before.mec-frontbox')[0].outerHTML;if(Math.max(document.documentElement.clientWidth,window.innerWidth||0)<960){$('.single-mec-events .col-md-4 .mec-event-info-desktop.mec-event-meta.mec-color-before.mec-frontbox').remove();$('.single-mec-events .mec-event-info-mobile').html(html)}}}
$('.mec-yearly-calendar .mec-has-event a').on('click',function(e){e.preventDefault();var des=$(this).attr('href');$('.mec-events-agenda').removeClass('mec-selected');$(des).closest('.mec-events-agenda').addClass('mec-selected');var scrollTopVal=$(des).closest('.mec-events-agenda').offset().top-35;if($(this).closest('.mec-fluent-wrap').length>0){var parent=jQuery(this).closest('.mec-fluent-wrap').find('.mec-yearly-agenda-sec');scrollTopVal=parent.scrollTop()+($(des).closest('.mec-events-agenda').offset().top-parent.offset().top);jQuery(this).closest('.mec-fluent-wrap').find('.mec-yearly-agenda-sec').getNiceScroll(0).doScrollTop(scrollTopVal-15,120);}else{$('html, body').animate({scrollTop:scrollTopVal},300);}});});})(jQuery);(function($){function convertToC(value){return Math.round(((parseFloat(value)-32)*5/9));}
function convertToF(value){return Math.round(((1.8*parseFloat(value))+32));}
function MPHToKPH(value){return Math.round(1.609344*parseFloat(value));}
function KPHToMPH(value){return Math.round((0.6214*parseFloat(value)));}
$(document).ready(function($)
{var degree=$('.mec-weather-summary-temp');var weather_extra=$('.mec-weather-extras');var wind=weather_extra.children('.mec-weather-wind');var visibility=weather_extra.children('.mec-weather-visibility');var feelslike=weather_extra.children('.mec-weather-feels-like');$('.degrees-mode').on('click',function()
{var degree_mode=degree.children('var').text().trim();var wind_text=wind.text().substring(5);var visibility_text=visibility.text().substring(11);var feelslike_text=feelslike.text().substring(12);if(degree_mode==degree.data('c').trim())
{degree.html(convertToF(parseInt(degree.text()))+' <var>'+degree.data('f')+'</var>');feelslike.html('<span>Feels Like:</span> '+convertToF(parseInt(feelslike_text))+' <var>'+feelslike.data('f')+'</var>');wind.html('<span>Wind:</span> '+KPHToMPH(parseInt(wind_text))+'<var>'+wind.data('mph')+'</var>');visibility.html('<span>Visibility:</span> '+KPHToMPH(parseInt(visibility_text))+'<var>'+visibility.data('mph')+'</var>');$(this).text($(this).data('metric'));}
else if(degree_mode==degree.data('f').trim())
{degree.html(convertToC(parseInt(degree.text()))+' <var>'+degree.data('c')+'</var>');feelslike.html('<span>Feels Like:</span> '+convertToC(parseInt(feelslike_text))+' <var>'+feelslike.data('c')+'</var>');wind.html('<span>Wind:</span> '+MPHToKPH(parseInt(wind_text))+'<var>'+wind.data('kph')+'</var>');visibility.html('<span>Visibility:</span> '+MPHToKPH(parseInt(visibility_text))+'<var>'+visibility.data('kph')+'</var>');$(this).text($(this).data('imperial'));}});$('a').on('click',function(){});$('#mec_add_speaker_button').on('click',function(){var $this=this;var content=$($this).parent().find('input');var list=$('#mec-fes-speakers-list');var key=list.find('.mec-error').length;$($this).prop("disabled",true).css('cursor','wait');$.post(ajaxurl,{action:"speaker_adding",content:content.val(),key:key}).done(function(data){if($(data).hasClass('mec-error')){list.prepend(data);setTimeout(function(){$('#mec-speaker-error-${key}').remove();},1500);}else{list.html(data);content.val('');}
$($this).prop("disabled",false).css('cursor','pointer');});});var owl_rtl=$('body').hasClass('rtl')?true:false;var fes_export_list=$('.mec-export-list-wrapper');fes_export_list.find('.mec-export-list-item').click(function()
{$('.mec-export-list-item').removeClass('fes-export-date-active');$(this).addClass('fes-export-date-active');});var mec_bd_attendees_modules=$('.mec-attendees-list-details > ul > li');mec_bd_attendees_modules.click(function()
{$(this).find('.mec-attendees-toggle').toggle();});$('.mec-event-export-csv, .mec-event-export-excel').click(function()
{var mec_event_id=$(this).parent().parent().data('event-id');var time=$(this).parent().parent().find($('.fes-export-date-active')).data('time');if(typeof time==='undefined')time=0;$.ajax({url:mecdata.ajax_url,data:"action=mec_fes_csv_export&fes_nonce="+mecdata.fes_nonce+"&mec_event_id="+mec_event_id+"&timestamp="+time,dataType:'json',type:"post",success:function(res){if(res.ex!='error')
{var $csv=$('<a>');$csv.attr('href',res.ex);$('body').append($csv);$csv.attr('download','bookings-'+res.name+'.csv');$csv[0].click();$csv.remove();}},error:function(){}});});});})(jQuery);function mec_book_form_submit(event,unique_id)
{event.preventDefault();window["mec_book_form_submit"+unique_id]();}
function mec_book_form_back_btn_cache(context,unique_id)
{var id=jQuery(context).attr('id');var mec_form_data=jQuery('#mec_book_form'+unique_id).serializeArray();if(id=="mec-book-form-btn-step-1")jQuery('body').data('mec-book-form-step-1',jQuery('#mec_booking'+unique_id).html()).data('unique-id',unique_id).data('mec-book-form-data-step-1',mec_form_data);else if(id=="mec-book-form-btn-step-2")jQuery('body').data('mec-book-form-step-2',jQuery('#mec_booking'+unique_id).html()).data('mec-book-form-data-step-2',mec_form_data);}
function mec_agreement_change(context)
{var status=jQuery(context).is(":checked")?true:false;if(status)jQuery(context).attr("checked","checked");else jQuery(context).removeAttr("checked");}
function mec_book_form_back_btn_click(context,unique_id)
{var id=jQuery(context).attr('id');unique_id=jQuery('body').data('unique-id');jQuery('#mec_booking_message'+unique_id).hide();if(id=="mec-book-form-back-btn-step-2")
{var mec_form_data_step_1=jQuery('body').data('mec-book-form-data-step-1');jQuery('#mec_booking'+unique_id).html(jQuery('body').data('mec-book-form-step-1'));jQuery.each(mec_form_data_step_1,function(index,object_item)
{jQuery('[name="'+object_item.name+'"]').val(object_item.value);});var recaptcha_check=jQuery('#mec_booking'+unique_id).find('#g-recaptcha').length;if(recaptcha_check!=0)
{jQuery('#g-recaptcha').html('');grecaptcha.render("g-recaptcha",{sitekey:mecdata.recapcha_key});}}
else if(id=="mec-book-form-back-btn-step-3")
{var mec_form_data_step_2=jQuery('body').data('mec-book-form-data-step-2');jQuery('#mec_booking'+unique_id).html(jQuery('body').data('mec-book-form-step-2'));jQuery.each(mec_form_data_step_2,function(index,object_item)
{var mec_elem=jQuery('[name="'+object_item.name+'"]');var mec_type=mec_elem.attr('type');if((mec_type=='checkbox'||mec_type=='radio'))
{var mec_elem_len=jQuery('[name="'+object_item.name+'"]').length;if(mec_elem_len>1)
{var id='#'+mec_elem.attr('id').match(/mec_book_reg_field_reg.*_/g)+object_item.value.toLowerCase();jQuery(id).prop('checked',true);}
else
{mec_elem.prop('checked',true);}}
mec_elem.val(object_item.value);});}}
function gmapSkin(NewJson){var gmap_temp=jQuery("#gmap-data");var beforeJson=gmap_temp.val();if(typeof beforeJson==='undefined')beforeJson='';var newJson=NewJson;var jsonPush=(typeof beforeJson!='undefined'&&beforeJson.trim()=="")?[]:JSON.parse(beforeJson);var pushState=jsonPush.length<1?false:true;for(var key in newJson){if(pushState){jsonPush.forEach(function(Item,Index){var render_location=jsonPush[Index].latitude+","+jsonPush[Index].longitude;if(key.trim()==render_location.trim()){newJson[key].count=newJson[key].count+jsonPush[Index].count;newJson[key].event_ids=newJson[key].event_ids.concat(jsonPush[Index].event_ids);var dom=jQuery(newJson[key].lightbox).find("div:nth-child(2)");var main_items=dom.html();var new_items=jQuery(jsonPush[Index].lightbox).find("div:nth-child(2)").html();var render_items=dom.html(main_items+new_items).html();var new_info_lightbox='<div><div class="mec-event-detail mec-map-view-event-detail"><i class="mec-sl-map-marker"></i> '+newJson[key].name+'</div><div>'+render_items+'</div></div>';newJson[key].lightbox=new_info_lightbox;var new_info_window='<div class="mec-marker-infowindow-wp"><div class="mec-marker-infowindow-count">'+newJson[key].count+'</div><div class="mec-marker-infowindow-content"><span>Event at this location</span><span>'+newJson[key].name+'</span></div></div>';newJson[key].infowindow=new_info_window;jsonPush.splice(Index,1);}});}
jsonPush.push(newJson[key]);}
gmap_temp.val(JSON.stringify(jsonPush));return jsonPush;}
jQuery(document).ready(function(){if(jQuery('.mec-fluent-wrap').length<0){return;}
jQuery(window).on('resize',mecFluentToggoleDisplayValueFilterContent);jQuery(document).on('click','.mec-fluent-wrap .mec-filter-icon',mecFluentToggleFilterContent);jQuery(document).on('click','.mec-fluent-wrap .mec-more-events-icon',mecFluentToggleMoreEvents);jQuery(document).on('click','.mec-fluent-wrap .mec-yearly-calendar',mecFluentYearlyCalendar);jQuery(document).on('click',mecFluentOutsideEvent);jQuery(document).on('click','.mec-fluent-more-views-icon',mecFluentMoreViewsContent);jQuery(document).on('change','.mec-fluent-wrap .mec-filter-content select, .mec-fluent-wrap .mec-filter-content input',mecFluentSmartFilterIcon);mecFluentTimeTableUI();mecFluentUI();mecFluentNiceSelect();mecFluentWrapperFullScreenWidth();jQuery(window).on('load',mecFluentWrapperFullScreenWidth);jQuery(window).on('load',mecFluentCurrentTimePosition);jQuery(window).on('resize',mecFluentWrapperFullScreenWidth);jQuery(window).on('resize',mecFluentTimeTableUI);mecFluentSliderUI();mecFluentFullCalendar();jQuery(window).on('resize',mecFluentFullCalendar);mecFluentCustomScrollbar();});function mecFluentSinglePage(){if(jQuery().niceScroll){jQuery('.mec-single-fluent-body .featherlight .mec-single-fluent-wrap').niceScroll({horizrailenabled:false,cursorcolor:'#C1C5C9',cursorwidth:'4px',cursorborderradius:'4px',cursorborder:'none',railoffset:{left:10,}});}}
function mecFluentFullCalendar(){if(jQuery('.mec-fluent-wrap.mec-skin-full-calendar-container').length>0){var widowWidth=jQuery(window).innerWidth();if(widowWidth<=767){jQuery('.mec-fluent-wrap.mec-skin-full-calendar-container .mec-skin-monthly-view-month-navigator-container, .mec-fluent-wrap.mec-skin-full-calendar-container .mec-calendar-a-month, .mec-fluent-wrap.mec-skin-full-calendar-container .mec-yearly-title-sec').css({paddingTop:jQuery('.mec-fluent-wrap.mec-skin-full-calendar-container').children('.mec-totalcal-box').height()+40,});}else{jQuery('.mec-fluent-wrap.mec-skin-full-calendar-container .mec-skin-monthly-view-month-navigator-container, .mec-fluent-wrap.mec-skin-full-calendar-container .mec-calendar-a-month, .mec-fluent-wrap.mec-skin-full-calendar-container .mec-yearly-title-sec').css({paddingTop:32,});}}}
function mecFluentSmartFilterIcon(){var filterContent=jQuery(this).closest('.mec-filter-content');var hasValue=false;if(jQuery(this).closest('.mec-date-search').length>0){var yearValue=jQuery(this).closest('.mec-date-search').find('select[id*="mec_sf_year"]').val();var monthValue=jQuery(this).closest('.mec-date-search').find('select[id*="mec_sf_month"]').val();if((yearValue=='none'&&monthValue=='none')||(yearValue!='none'&&monthValue!='none')){filterContent.hide();if((yearValue!='none'&&monthValue!='none')){hasValue=true;}else{hasValue=false;}}else{return false;}}else{filterContent.hide();}
if(!hasValue){filterContent.find(':not(.mec-date-search)').find('select, input:not([type="hidden"])').each(function(){if(jQuery(this).val()){hasValue=true;return false;}});}
if(hasValue){jQuery(this).closest('.mec-search-form').find('.mec-filter-icon').addClass('active');}else{jQuery(this).closest('.mec-search-form').find('.mec-filter-icon').removeClass('active');}}
function mecFluentMoreViewsContent(){jQuery(this).find('.mec-fluent-more-views-content').toggleClass('active');}
function mecFluentWrapperFullScreenWidth(){if(jQuery('.mec-fluent-bg-wrap').length>0){jQuery('.mec-fluent-bg-wrap').css({maxWidth:jQuery('body').width()+8,});}}
function mecFluentUI(){if(typeof mecdata.enableSingleFluent!='undefined'&&mecdata.enableSingleFluent){jQuery('body').addClass('mec-single-fluent-body');}
jQuery(window).on('load resize',function(){if(jQuery('.mec-filter-content').length>0){jQuery('.mec-filter-content').css({right:-(jQuery('.mec-calendar').width()-jQuery('.mec-search-form.mec-totalcal-box').position().left-jQuery('.mec-search-form.mec-totalcal-box').width()+40),left:-jQuery('.mec-search-form.mec-totalcal-box').position().left+40,});}
if(jQuery('.mec-filter-icon').is(':visible')){var filterIconLeftPosition=parseInt(jQuery('.mec-search-form.mec-totalcal-box').position().left)+parseInt(jQuery('.mec-filter-icon').position().left)-25;jQuery('head').find('style[title="mecFluentFilterContentStyle"]').remove().end().append('<style title="mecFluentFilterContentStyle">.mec-fluent-wrap .mec-filter-content:before{left: '+filterIconLeftPosition+'px;}.mec-fluent-wrap .mec-filter-content:after{left: '+(filterIconLeftPosition+1)+'px;}</style>');}});if(jQuery('.mec-filter-content').is(':empty')){jQuery('.mec-filter-icon').hide();}
jQuery(document).on('click','.mec-event-share-icon',function(e){e.preventDefault();});}
function mecFluentCurrentTimePosition(){if(jQuery('.mec-fluent-wrap').length>0){jQuery('.mec-fluent-current-time').each(function(){var currentTimeMinutes=jQuery(this).data('time');var height=jQuery(this).closest('.mec-fluent-current-time-cell').height();jQuery(this).css({top:(currentTimeMinutes/60)*height,});});}}
function mecFluentNiceSelect(){if(jQuery('.mec-fluent-wrap').length<0){return;}
if(jQuery().niceSelect){jQuery('.mec-fluent-wrap').find('.mec-filter-content').find('select').niceSelect();}}
function mecFluentCustomScrollbar(y){if(jQuery('.mec-fluent-wrap').length<0){return;}
if(jQuery().niceScroll){jQuery('.mec-custom-scrollbar').niceScroll({cursorcolor:'#C7EBFB',cursorwidth:'4px',cursorborderradius:'4px',cursorborder:'none',railoffset:{left:-2,}});jQuery('.mec-custom-scrollbar').getNiceScroll().resize();jQuery('.mec-custom-scrollbar').each(function(){if(jQuery(this).find('.mec-fluent-current-time-cell').length>0){var parentTopOffset=jQuery(this).offset().top;var currentTimeCellOffset=jQuery(this).find('.mec-fluent-current-time-cell').offset().top;jQuery(this).getNiceScroll(0).doScrollTop(currentTimeCellOffset-parentTopOffset-16,120);jQuery(this).on('scroll',function(){if(jQuery(this).getNiceScroll(0).scroll.y!=0){jQuery(this).addClass('mec-scrolling');}else{jQuery(this).removeClass('mec-scrolling');}});}
if(typeof y!='undefined'){if(jQuery(this).closest('.mec-skin-list-wrap').length>0||jQuery(this).closest('.mec-skin-grid-wrap').length>0){jQuery(this).getNiceScroll(0).doScrollTop(0,120);}}});}}
function mecFluentTimeTableUI(){jQuery('.mec-fluent-wrap.mec-timetable-wrap .mec-cell').css('min-height',0);var maxHeight=Math.max.apply(null,jQuery('.mec-fluent-wrap.mec-timetable-wrap .mec-cell').map(function(){return jQuery(this).height();}).get());maxHeight=maxHeight>87?maxHeight:87;jQuery('.mec-fluent-wrap.mec-timetable-wrap .mec-cell').css('min-height',maxHeight+2);}
function mecFluentSliderUI(){jQuery(window).on('load',function(){jQuery('.mec-fluent-wrap.mec-skin-slider-container .owl-next').prepend('<span>Next</span>');jQuery('.mec-fluent-wrap.mec-skin-slider-container .owl-prev').append('<span>Prev</span>');});}
function mecFluentToggleFilterContent(e){e.preventDefault();if(jQuery('.mec-filter-content').is(':visible')){jQuery('.mec-filter-content').css({display:'none',});}else{const displayValue=jQuery(window).width()<=790?'block':'flex';jQuery('.mec-filter-content').css({display:displayValue,});}}
function mecFluentToggoleDisplayValueFilterContent(){const displayValue=jQuery(window).width()<=767?'block':'flex';if(jQuery('.mec-filter-content').is(':visible')){jQuery('.mec-filter-content').css({display:displayValue,});}}
function mecFluentToggleMoreEvents(e){e.preventDefault();const moreEventsWrap=jQuery(this).siblings('.mec-more-events-wrap');const moreEvents=moreEventsWrap.children('.mec-more-events');jQuery('.mec-more-events-wrap').removeClass('active');moreEventsWrap.addClass('active');jQuery('.mec-more-events-wrap:not(.active)').hide();if(moreEventsWrap.is(':visible')){moreEventsWrap.hide();}else{topElement=moreEventsWrap.closest('.mec-more-events-inner-controller').length>0?moreEventsWrap.closest('.mec-more-events-inner-controller'):moreEventsWrap.closest('.mec-more-events-controller');moreEventsWrap.show().css({top:topElement.offset().top-window.scrollY,left:moreEventsWrap.closest('.mec-more-events-controller').offset().left,width:moreEventsWrap.closest('.mec-more-events-controller').width(),});if(moreEventsWrap.width()>400){moreEvents.css({left:(moreEventsWrap.width()/2)-(moreEvents.width()/2),width:400,});}else{moreEvents.css({width:moreEventsWrap.width(),left:0,});}}}
function mecFluentOutsideEvent(e){if(!jQuery(e.target).is('.mec-more-events-icon')&&!jQuery(e.target).closest('.mec-more-events-wrap').length){jQuery('.mec-more-events-wrap').hide();}
if(!jQuery(e.target).is('.mec-filter-icon')&&!jQuery(e.target).closest('.mec-filter-content').length){jQuery('.mec-filter-content').hide();}
if(!jQuery(e.target).is('.mec-fluent-more-views-icon')&&!jQuery(e.target).closest('.mec-fluent-more-views-content').length){jQuery('.mec-fluent-more-views-content').removeClass('active');}}
function mecFluentYearlyCalendar(){const monthNum=jQuery(this).data('month');const monthName=jQuery(this).find('.mec-calendar-table-title').text();jQuery('.mec-fluent-wrap').find('.mec-yearly-calendar').removeClass('active');jQuery(this).addClass('active').closest('.mec-year-container').find('.mec-yearly-agenda-sec-title span').text(monthName).end().find('.mec-events-agenda').addClass('mec-util-hidden').end().find('.mec-events-agenda[data-month='+monthNum+']').removeClass('mec-util-hidden');mecFluentCustomScrollbar();}
function mecFluentYearlyUI(eventID,yearID){var fluentWrap=jQuery('#mec_skin_'+eventID+'.mec-fluent-wrap');if(fluentWrap.length<0){return;}
var monthNum=fluentWrap.find('.mec-year-container[data-year-id='+yearID+']').find('.mec-events-agenda:not(.mec-util-hidden)').data('month');var activeMonth=fluentWrap.find('.mec-year-container[data-year-id='+yearID+']').find('.mec-yearly-calendar[data-month='+monthNum+']');var activeMonthName=activeMonth.find('.mec-calendar-table-title').text();activeMonth.addClass('active');}
(function($){$.fn.mecListViewFluent=function(options){var active_month;var active_year;var settings=$.extend({today:null,id:0,events_label:'Events',event_label:'Event',month_navigator:0,atts:'',active_month:{},next_month:{},sf:{},ajax_url:'',},options);mecFluentCustomScrollbar();initLoadMore('#mec_list_view_month_'+settings.id+'_'+settings.month_id);function initLoadMore(monthID){$(monthID).off().on('click','.mec-load-more-button',function(){loadMore(this);});}
function loadMore(This){var currentLoadMore=$(This);currentLoadMore.addClass("mec-load-more-loading");var endDate=currentLoadMore.data('end-date');var maximumDate=currentLoadMore.data('maximum-date');var nextOffset=currentLoadMore.data('next-offset');var year=currentLoadMore.data('year');var month=currentLoadMore.data('month');$.ajax({url:settings.ajax_url,data:"action=mec_list_load_more&mec_year="+year+"&mec_month="+month+"&mec_maximum_date="+maximumDate+"&mec_start_date="+endDate+"&mec_offset="+nextOffset+"&"+settings.atts+"&current_month_divider=0&apply_sf_date=0",dataType:"json",type:"post",success:function(response){currentLoadMore.parent().remove();if(response.count!='0'){$('#mec_list_view_month_'+settings.id+'_'+response.current_month.id).append(response.month);if(settings.sed_method!='0'){sed();}
mecFluentCustomScrollbar();initLoadMore('#mec_list_view_month_'+settings.id+'_'+response.current_month.id);}},error:function(){}});}
if(settings.month_navigator)initMonthNavigator();setMonth(settings.next_month.year,settings.next_month.month,true);var initMonth;var initYear;active_month=initMonth=settings.active_month.month;active_year=initYear=settings.active_month.year;if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month);}});}
if(settings.sed_method!='0'){sed();}
function initMonthNavigator(){$("#mec_skin_"+settings.id+" .mec-load-month").off().on("click",function(){var year=$(this).data("mec-year");var month=$(this).data("mec-month");setMonth(year,month,false,true);});}
function parseQuery(queryString){var query={};var pairs=(queryString[0]==='?'?queryString.substr(1):queryString).split('&');for(var i=0;i<pairs.length;i++){var pair=pairs[i].split('=');query[decodeURIComponent(pair[0])]=decodeURIComponent(pair[1]||'');}
return query;}
function updateQueryStringParameter(uri,key,val){return uri.replace(RegExp("([?&]"+key+"(?=[=&#]|$)[^#&]*|(?=#|$))"),"&"+key+"="+encodeURIComponent(val)).replace(/^([^?&]+)&/,"$1?");}
function search(year,month){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');var ObjAtts=parseQuery(settings.atts);if(!(ObjAtts['sf[month']||ObjAtts['sf[year]'])){settings.atts=updateQueryStringParameter(settings.atts.trim(),'sf[year]',initYear);settings.atts=updateQueryStringParameter(settings.atts.trim(),'sf[month]',initMonth);}
$.ajax({url:settings.ajax_url,data:"action=mec_list_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){active_month=response.current_month.month;active_year=response.current_month.year;$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_list_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-list-view-month-navigator-container").html('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();toggleMonth(response.current_month.id);initLoadMore('#mec_list_view_month_'+settings.id+'_'+response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");mecFluentCustomScrollbar();},error:function(){}});}
function setMonth(year,month,do_in_background,navigator_click){if(typeof do_in_background==="undefined")do_in_background=false;navigator_click=navigator_click||false;var month_id=year+""+month;if(!do_in_background){active_month=month;active_year=year;}
if($("#mec_list_view_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);mecFluentCustomScrollbar(0);}else{if(!do_in_background){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');}
$.ajax({url:settings.ajax_url,data:"action=mec_list_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigator_click,dataType:"json",type:"post",success:function(response){$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_list_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-list-view-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();initLoadMore('#mec_list_view_month_'+settings.id+'_'+response.current_month.id);if(!do_in_background){toggleMonth(response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);}else{$("#mec_list_view_month_"+settings.id+"_"+response.current_month.id).hide();$("#mec_month_navigator_"+settings.id+"_"+response.current_month.id).hide();}
if(typeof custom_month!==undefined)var custom_month;if(typeof custom_month!=undefined){if(custom_month=='true'){$(".mec-month-container .mec-calendar-day").removeClass('mec-has-event');$(".mec-month-container .mec-calendar-day").removeClass('mec-selected-day');$('.mec-calendar-day').unbind('click');}}
if(!do_in_background){mecFluentCustomScrollbar(0);}},error:function(){}});}}
function toggleMonth(month_id){var active_month=$("#mec_skin_"+settings.id+" .mec-month-container-selected").data("month-id");var active_day=$("#mec_list_view_month_"+settings.id+"_"+active_month+" .mec-selected-day").data("day");if(active_day<=9)active_day="0"+active_day;$("#mec_skin_"+settings.id+" .mec-month-navigator").hide();$("#mec_month_navigator_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").hide();$("#mec_list_view_month_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").removeClass("mec-month-container-selected");$("#mec_list_view_month_"+settings.id+"_"+month_id).addClass("mec-month-container-selected");}
var sf;function sed(){$(".mec-skin-list-wrap#mec_skin_"+settings.id).off('click').on('click','[data-event-id]',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));(function($){$.fn.mecGridViewFluent=function(options){var active_month;var active_year;var settings=$.extend({today:null,id:0,events_label:'Events',event_label:'Event',month_navigator:0,atts:'',active_month:{},next_month:{},sf:{},ajax_url:'',},options);initLoadMore('#mec_grid_view_month_'+settings.id+'_'+settings.month_id);function initLoadMore(monthID){$(monthID).off().on('click','.mec-load-more-button',function(){loadMore(this);});}
function loadMore(This){var currentLoadMore=$(This);currentLoadMore.addClass("mec-load-more-loading");var endDate=currentLoadMore.data('end-date');var maximumDate=currentLoadMore.data('maximum-date');var nextOffset=currentLoadMore.data('next-offset');var year=currentLoadMore.data('year');var month=currentLoadMore.data('month');$.ajax({url:settings.ajax_url,data:"action=mec_grid_load_more&mec_year="+year+"&mec_month="+month+"&mec_maximum_date="+maximumDate+"&mec_start_date="+endDate+"&mec_offset="+nextOffset+"&"+settings.atts+"&current_month_divider=0&apply_sf_date=0",dataType:"json",type:"post",success:function(response){currentLoadMore.parent().remove();if(response.count!='0'){$('#mec_grid_view_month_'+settings.id+'_'+response.current_month.id).append(response.month);if(settings.sed_method!='0'){sed();}
mecFluentCustomScrollbar();initLoadMore('#mec_grid_view_month_'+settings.id+'_'+response.current_month.id);}},error:function(){}});}
if(settings.month_navigator)initMonthNavigator();setMonth(settings.next_month.year,settings.next_month.month,true);var initMonth;var initYear;active_month=initMonth=settings.active_month.month;active_year=initYear=settings.active_month.year;if(settings.sf.container!==''){sf=$(settings.sf.container).mecSearchForm({id:settings.id,atts:settings.atts,callback:function(atts){settings.atts=atts;search(active_year,active_month);}});}
if(settings.sed_method!='0'){sed();}
function initMonthNavigator(){$("#mec_skin_"+settings.id+" .mec-load-month").off().on("click",function(){var year=$(this).data("mec-year");var month=$(this).data("mec-month");setMonth(year,month,false,true);});}
function parseQuery(queryString){var query={};var pairs=(queryString[0]==='?'?queryString.substr(1):queryString).split('&');for(var i=0;i<pairs.length;i++){var pair=pairs[i].split('=');query[decodeURIComponent(pair[0])]=decodeURIComponent(pair[1]||'');}
return query;}
function updateQueryStringParameter(uri,key,val){return uri.replace(RegExp("([?&]"+key+"(?=[=&#]|$)[^#&]*|(?=#|$))"),"&"+key+"="+encodeURIComponent(val)).replace(/^([^?&]+)&/,"$1?");}
function search(year,month){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');var ObjAtts=parseQuery(settings.atts);if(!(ObjAtts['sf[month']||ObjAtts['sf[year]'])){settings.atts=updateQueryStringParameter(settings.atts.trim(),'sf[year]',initYear);settings.atts=updateQueryStringParameter(settings.atts.trim(),'sf[month]',initMonth);}
$.ajax({url:settings.ajax_url,data:"action=mec_grid_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=1",dataType:"json",type:"post",success:function(response){active_month=response.current_month.month;active_year=response.current_month.year;$("#mec_skin_events_"+settings.id).html('<div class="mec-month-container" id="mec_grid_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-grid-view-month-navigator-container").html('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();toggleMonth(response.current_month.id);initLoadMore('#mec_grid_view_month_'+settings.id+'_'+response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");mecFluentCustomScrollbar();},error:function(){}});}
function setMonth(year,month,do_in_background,navigator_click){if(typeof do_in_background==="undefined")do_in_background=false;navigator_click=navigator_click||false;var month_id=year+""+month;if(!do_in_background){active_month=month;active_year=year;}
if($("#mec_grid_view_month_"+settings.id+"_"+month_id).length){toggleMonth(month_id);mecFluentCustomScrollbar();}else{if(!do_in_background){if(jQuery('.mec-modal-result').length===0)jQuery('.mec-wrap').append('<div class="mec-modal-result"></div>');jQuery('.mec-modal-result').addClass('mec-month-navigator-loading');}
$.ajax({url:settings.ajax_url,data:"action=mec_grid_load_month&mec_year="+year+"&mec_month="+month+"&"+settings.atts+"&apply_sf_date=0"+"&navigator_click="+navigator_click,dataType:"json",type:"post",success:function(response){$("#mec_skin_events_"+settings.id).append('<div class="mec-month-container" id="mec_grid_view_month_'+settings.id+'_'+response.current_month.id+'" data-month-id="'+response.current_month.id+'">'+response.month+'</div>');$("#mec_skin_"+settings.id+" .mec-skin-grid-view-month-navigator-container").append('<div class="mec-month-navigator" id="mec_month_navigator_'+settings.id+'_'+response.current_month.id+'">'+response.navigator+'</div>');initMonthNavigator();initLoadMore('#mec_grid_view_month_'+settings.id+'_'+response.current_month.id);if(!do_in_background){toggleMonth(response.current_month.id);$('.mec-modal-result').removeClass("mec-month-navigator-loading");$("#mec_sf_month_"+settings.id).val(month);$("#mec_sf_year_"+settings.id).val(year);}else{$("#mec_grid_view_month_"+settings.id+"_"+response.current_month.id).hide();$("#mec_month_navigator_"+settings.id+"_"+response.current_month.id).hide();}
if(typeof custom_month!==undefined)var custom_month;if(typeof custom_month!=undefined){if(custom_month=='true'){$(".mec-month-container .mec-calendar-day").removeClass('mec-has-event');$(".mec-month-container .mec-calendar-day").removeClass('mec-selected-day');$('.mec-calendar-day').unbind('click');}}
if(!do_in_background){mecFluentCustomScrollbar();}},error:function(){}});}}
function toggleMonth(month_id){var active_month=$("#mec_skin_"+settings.id+" .mec-month-container-selected").data("month-id");var active_day=$("#mec_grid_view_month_"+settings.id+"_"+active_month+" .mec-selected-day").data("day");if(active_day<=9)active_day="0"+active_day;$("#mec_skin_"+settings.id+" .mec-month-navigator").hide();$("#mec_month_navigator_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").hide();$("#mec_grid_view_month_"+settings.id+"_"+month_id).show();$("#mec_skin_"+settings.id+" .mec-month-container").removeClass("mec-month-container-selected");$("#mec_grid_view_month_"+settings.id+"_"+month_id).addClass("mec-month-container-selected");}
var sf;function sed(){$(".mec-skin-grid-wrap#mec_skin_"+settings.id).off('click').on('click','[data-event-id]',function(e){e.preventDefault();var href=$(this).attr('href');var id=$(this).data('event-id');var occurrence=get_parameter_by_name('occurrence',href);var time=get_parameter_by_name('time',href);mecSingleEventDisplayer.getSinglePage(id,occurrence,time,settings.ajax_url,settings.sed_method,settings.image_popup);});}};}(jQuery));jQuery(document).ready(function(){if(jQuery('.mec-booking-shortcode').length<0){return;}
if(jQuery().niceSelect){jQuery('.mec-booking-shortcode').find('.mec-book-first').find('select').niceSelect();}});;
/*! tooltipster v4.2.6 */
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){function b(a){this.$container,this.constraints=null,this.__$tooltip,this.__init(a)}function c(b,c){var d=!0;return a.each(b,function(a,e){return void 0===c[a]||b[a]!==c[a]?(d=!1,!1):void 0}),d}function d(b){var c=b.attr("id"),d=c?h.window.document.getElementById(c):null;return d?d===b[0]:a.contains(h.window.document.body,b[0])}function e(){if(!g)return!1;var a=g.document.body||g.document.documentElement,b=a.style,c="transition",d=["Moz","Webkit","Khtml","O","ms"];if("string"==typeof b[c])return!0;c=c.charAt(0).toUpperCase()+c.substr(1);for(var e=0;e<d.length;e++)if("string"==typeof b[d[e]+c])return!0;return!1}var f={animation:"fade",animationDuration:350,content:null,contentAsHTML:!1,contentCloning:!1,debug:!0,delay:300,delayTouch:[300,500],functionInit:null,functionBefore:null,functionReady:null,functionAfter:null,functionFormat:null,IEmin:6,interactive:!1,multiple:!1,parent:null,plugins:["sideTip"],repositionOnScroll:!1,restoration:"none",selfDestruction:!0,theme:[],timer:0,trackerInterval:500,trackOrigin:!1,trackTooltip:!1,trigger:"hover",triggerClose:{click:!1,mouseleave:!1,originClick:!1,scroll:!1,tap:!1,touchleave:!1},triggerOpen:{click:!1,mouseenter:!1,tap:!1,touchstart:!1},updateAnimation:"rotate",zIndex:9999999},g="undefined"!=typeof window?window:null,h={hasTouchCapability:!(!g||!("ontouchstart"in g||g.DocumentTouch&&g.document instanceof g.DocumentTouch||g.navigator.maxTouchPoints)),hasTransitions:e(),IE:!1,semVer:"4.2.6",window:g},i=function(){this.__$emitterPrivate=a({}),this.__$emitterPublic=a({}),this.__instancesLatestArr=[],this.__plugins={},this._env=h};i.prototype={__bridge:function(b,c,d){if(!c[d]){var e=function(){};e.prototype=b;var g=new e;g.__init&&g.__init(c),a.each(b,function(a,b){0!=a.indexOf("__")&&(c[a]?f.debug&&console.log("The "+a+" method of the "+d+" plugin conflicts with another plugin or native methods"):(c[a]=function(){return g[a].apply(g,Array.prototype.slice.apply(arguments))},c[a].bridged=g))}),c[d]=g}return this},__setWindow:function(a){return h.window=a,this},_getRuler:function(a){return new b(a)},_off:function(){return this.__$emitterPrivate.off.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_on:function(){return this.__$emitterPrivate.on.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_one:function(){return this.__$emitterPrivate.one.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_plugin:function(b){var c=this;if("string"==typeof b){var d=b,e=null;return d.indexOf(".")>0?e=c.__plugins[d]:a.each(c.__plugins,function(a,b){return b.name.substring(b.name.length-d.length-1)=="."+d?(e=b,!1):void 0}),e}if(b.name.indexOf(".")<0)throw new Error("Plugins must be namespaced");return c.__plugins[b.name]=b,b.core&&c.__bridge(b.core,c,b.name),this},_trigger:function(){var a=Array.prototype.slice.apply(arguments);return"string"==typeof a[0]&&(a[0]={type:a[0]}),this.__$emitterPrivate.trigger.apply(this.__$emitterPrivate,a),this.__$emitterPublic.trigger.apply(this.__$emitterPublic,a),this},instances:function(b){var c=[],d=b||".tooltipstered";return a(d).each(function(){var b=a(this),d=b.data("tooltipster-ns");d&&a.each(d,function(a,d){c.push(b.data(d))})}),c},instancesLatest:function(){return this.__instancesLatestArr},off:function(){return this.__$emitterPublic.off.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},on:function(){return this.__$emitterPublic.on.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},one:function(){return this.__$emitterPublic.one.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},origins:function(b){var c=b?b+" ":"";return a(c+".tooltipstered").toArray()},setDefaults:function(b){return a.extend(f,b),this},triggerHandler:function(){return this.__$emitterPublic.triggerHandler.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this}},a.tooltipster=new i,a.Tooltipster=function(b,c){this.__callbacks={close:[],open:[]},this.__closingTime,this.__Content,this.__contentBcr,this.__destroyed=!1,this.__$emitterPrivate=a({}),this.__$emitterPublic=a({}),this.__enabled=!0,this.__garbageCollector,this.__Geometry,this.__lastPosition,this.__namespace="tooltipster-"+Math.round(1e6*Math.random()),this.__options,this.__$originParents,this.__pointerIsOverOrigin=!1,this.__previousThemes=[],this.__state="closed",this.__timeouts={close:[],open:null},this.__touchEvents=[],this.__tracker=null,this._$origin,this._$tooltip,this.__init(b,c)},a.Tooltipster.prototype={__init:function(b,c){var d=this;if(d._$origin=a(b),d.__options=a.extend(!0,{},f,c),d.__optionsFormat(),!h.IE||h.IE>=d.__options.IEmin){var e=null;if(void 0===d._$origin.data("tooltipster-initialTitle")&&(e=d._$origin.attr("title"),void 0===e&&(e=null),d._$origin.data("tooltipster-initialTitle",e)),null!==d.__options.content)d.__contentSet(d.__options.content);else{var g,i=d._$origin.attr("data-tooltip-content");i&&(g=a(i)),g&&g[0]?d.__contentSet(g.first()):d.__contentSet(e)}d._$origin.removeAttr("title").addClass("tooltipstered"),d.__prepareOrigin(),d.__prepareGC(),a.each(d.__options.plugins,function(a,b){d._plug(b)}),h.hasTouchCapability&&a(h.window.document.body).on("touchmove."+d.__namespace+"-triggerOpen",function(a){d._touchRecordEvent(a)}),d._on("created",function(){d.__prepareTooltip()})._on("repositioned",function(a){d.__lastPosition=a.position})}else d.__options.disabled=!0},__contentInsert:function(){var a=this,b=a._$tooltip.find(".tooltipster-content"),c=a.__Content,d=function(a){c=a};return a._trigger({type:"format",content:a.__Content,format:d}),a.__options.functionFormat&&(c=a.__options.functionFormat.call(a,a,{origin:a._$origin[0]},a.__Content)),"string"!=typeof c||a.__options.contentAsHTML?b.empty().append(c):b.text(c),a},__contentSet:function(b){return b instanceof a&&this.__options.contentCloning&&(b=b.clone(!0)),this.__Content=b,this._trigger({type:"updated",content:b}),this},__destroyError:function(){throw new Error("This tooltip has been destroyed and cannot execute your method call.")},__geometry:function(){var b=this,c=b._$origin,d=b._$origin.is("area");if(d){var e=b._$origin.parent().attr("name");c=a('img[usemap="#'+e+'"]')}var f=c[0].getBoundingClientRect(),g=a(h.window.document),i=a(h.window),j=c,k={available:{document:null,window:null},document:{size:{height:g.height(),width:g.width()}},window:{scroll:{left:h.window.scrollX||h.window.document.documentElement.scrollLeft,top:h.window.scrollY||h.window.document.documentElement.scrollTop},size:{height:i.height(),width:i.width()}},origin:{fixedLineage:!1,offset:{},size:{height:f.bottom-f.top,width:f.right-f.left},usemapImage:d?c[0]:null,windowOffset:{bottom:f.bottom,left:f.left,right:f.right,top:f.top}}};if(d){var l=b._$origin.attr("shape"),m=b._$origin.attr("coords");if(m&&(m=m.split(","),a.map(m,function(a,b){m[b]=parseInt(a)})),"default"!=l)switch(l){case"circle":var n=m[0],o=m[1],p=m[2],q=o-p,r=n-p;k.origin.size.height=2*p,k.origin.size.width=k.origin.size.height,k.origin.windowOffset.left+=r,k.origin.windowOffset.top+=q;break;case"rect":var s=m[0],t=m[1],u=m[2],v=m[3];k.origin.size.height=v-t,k.origin.size.width=u-s,k.origin.windowOffset.left+=s,k.origin.windowOffset.top+=t;break;case"poly":for(var w=0,x=0,y=0,z=0,A="even",B=0;B<m.length;B++){var C=m[B];"even"==A?(C>y&&(y=C,0===B&&(w=y)),w>C&&(w=C),A="odd"):(C>z&&(z=C,1==B&&(x=z)),x>C&&(x=C),A="even")}k.origin.size.height=z-x,k.origin.size.width=y-w,k.origin.windowOffset.left+=w,k.origin.windowOffset.top+=x}}var D=function(a){k.origin.size.height=a.height,k.origin.windowOffset.left=a.left,k.origin.windowOffset.top=a.top,k.origin.size.width=a.width};for(b._trigger({type:"geometry",edit:D,geometry:{height:k.origin.size.height,left:k.origin.windowOffset.left,top:k.origin.windowOffset.top,width:k.origin.size.width}}),k.origin.windowOffset.right=k.origin.windowOffset.left+k.origin.size.width,k.origin.windowOffset.bottom=k.origin.windowOffset.top+k.origin.size.height,k.origin.offset.left=k.origin.windowOffset.left+k.window.scroll.left,k.origin.offset.top=k.origin.windowOffset.top+k.window.scroll.top,k.origin.offset.bottom=k.origin.offset.top+k.origin.size.height,k.origin.offset.right=k.origin.offset.left+k.origin.size.width,k.available.document={bottom:{height:k.document.size.height-k.origin.offset.bottom,width:k.document.size.width},left:{height:k.document.size.height,width:k.origin.offset.left},right:{height:k.document.size.height,width:k.document.size.width-k.origin.offset.right},top:{height:k.origin.offset.top,width:k.document.size.width}},k.available.window={bottom:{height:Math.max(k.window.size.height-Math.max(k.origin.windowOffset.bottom,0),0),width:k.window.size.width},left:{height:k.window.size.height,width:Math.max(k.origin.windowOffset.left,0)},right:{height:k.window.size.height,width:Math.max(k.window.size.width-Math.max(k.origin.windowOffset.right,0),0)},top:{height:Math.max(k.origin.windowOffset.top,0),width:k.window.size.width}};"html"!=j[0].tagName.toLowerCase();){if("fixed"==j.css("position")){k.origin.fixedLineage=!0;break}j=j.parent()}return k},__optionsFormat:function(){return"number"==typeof this.__options.animationDuration&&(this.__options.animationDuration=[this.__options.animationDuration,this.__options.animationDuration]),"number"==typeof this.__options.delay&&(this.__options.delay=[this.__options.delay,this.__options.delay]),"number"==typeof this.__options.delayTouch&&(this.__options.delayTouch=[this.__options.delayTouch,this.__options.delayTouch]),"string"==typeof this.__options.theme&&(this.__options.theme=[this.__options.theme]),null===this.__options.parent?this.__options.parent=a(h.window.document.body):"string"==typeof this.__options.parent&&(this.__options.parent=a(this.__options.parent)),"hover"==this.__options.trigger?(this.__options.triggerOpen={mouseenter:!0,touchstart:!0},this.__options.triggerClose={mouseleave:!0,originClick:!0,touchleave:!0}):"click"==this.__options.trigger&&(this.__options.triggerOpen={click:!0,tap:!0},this.__options.triggerClose={click:!0,tap:!0}),this._trigger("options"),this},__prepareGC:function(){var b=this;return b.__options.selfDestruction?b.__garbageCollector=setInterval(function(){var c=(new Date).getTime();b.__touchEvents=a.grep(b.__touchEvents,function(a,b){return c-a.time>6e4}),d(b._$origin)||b.close(function(){b.destroy()})},2e4):clearInterval(b.__garbageCollector),b},__prepareOrigin:function(){var a=this;if(a._$origin.off("."+a.__namespace+"-triggerOpen"),h.hasTouchCapability&&a._$origin.on("touchstart."+a.__namespace+"-triggerOpen touchend."+a.__namespace+"-triggerOpen touchcancel."+a.__namespace+"-triggerOpen",function(b){a._touchRecordEvent(b)}),a.__options.triggerOpen.click||a.__options.triggerOpen.tap&&h.hasTouchCapability){var b="";a.__options.triggerOpen.click&&(b+="click."+a.__namespace+"-triggerOpen "),a.__options.triggerOpen.tap&&h.hasTouchCapability&&(b+="touchend."+a.__namespace+"-triggerOpen"),a._$origin.on(b,function(b){a._touchIsMeaningfulEvent(b)&&a._open(b)})}if(a.__options.triggerOpen.mouseenter||a.__options.triggerOpen.touchstart&&h.hasTouchCapability){var b="";a.__options.triggerOpen.mouseenter&&(b+="mouseenter."+a.__namespace+"-triggerOpen "),a.__options.triggerOpen.touchstart&&h.hasTouchCapability&&(b+="touchstart."+a.__namespace+"-triggerOpen"),a._$origin.on(b,function(b){!a._touchIsTouchEvent(b)&&a._touchIsEmulatedEvent(b)||(a.__pointerIsOverOrigin=!0,a._openShortly(b))})}if(a.__options.triggerClose.mouseleave||a.__options.triggerClose.touchleave&&h.hasTouchCapability){var b="";a.__options.triggerClose.mouseleave&&(b+="mouseleave."+a.__namespace+"-triggerOpen "),a.__options.triggerClose.touchleave&&h.hasTouchCapability&&(b+="touchend."+a.__namespace+"-triggerOpen touchcancel."+a.__namespace+"-triggerOpen"),a._$origin.on(b,function(b){a._touchIsMeaningfulEvent(b)&&(a.__pointerIsOverOrigin=!1)})}return a},__prepareTooltip:function(){var b=this,c=b.__options.interactive?"auto":"";return b._$tooltip.attr("id",b.__namespace).css({"pointer-events":c,zIndex:b.__options.zIndex}),a.each(b.__previousThemes,function(a,c){b._$tooltip.removeClass(c)}),a.each(b.__options.theme,function(a,c){b._$tooltip.addClass(c)}),b.__previousThemes=a.merge([],b.__options.theme),b},__scrollHandler:function(b){var c=this;if(c.__options.triggerClose.scroll)c._close(b);else if(d(c._$origin)&&d(c._$tooltip)){var e=null;if(b.target===h.window.document)c.__Geometry.origin.fixedLineage||c.__options.repositionOnScroll&&c.reposition(b);else{e=c.__geometry();var f=!1;if("fixed"!=c._$origin.css("position")&&c.__$originParents.each(function(b,c){var d=a(c),g=d.css("overflow-x"),h=d.css("overflow-y");if("visible"!=g||"visible"!=h){var i=c.getBoundingClientRect();if("visible"!=g&&(e.origin.windowOffset.left<i.left||e.origin.windowOffset.right>i.right))return f=!0,!1;if("visible"!=h&&(e.origin.windowOffset.top<i.top||e.origin.windowOffset.bottom>i.bottom))return f=!0,!1}return"fixed"==d.css("position")?!1:void 0}),f)c._$tooltip.css("visibility","hidden");else if(c._$tooltip.css("visibility","visible"),c.__options.repositionOnScroll)c.reposition(b);else{var g=e.origin.offset.left-c.__Geometry.origin.offset.left,i=e.origin.offset.top-c.__Geometry.origin.offset.top;c._$tooltip.css({left:c.__lastPosition.coord.left+g,top:c.__lastPosition.coord.top+i})}}c._trigger({type:"scroll",event:b,geo:e})}return c},__stateSet:function(a){return this.__state=a,this._trigger({type:"state",state:a}),this},__timeoutsClear:function(){return clearTimeout(this.__timeouts.open),this.__timeouts.open=null,a.each(this.__timeouts.close,function(a,b){clearTimeout(b)}),this.__timeouts.close=[],this},__trackerStart:function(){var a=this,b=a._$tooltip.find(".tooltipster-content");return a.__options.trackTooltip&&(a.__contentBcr=b[0].getBoundingClientRect()),a.__tracker=setInterval(function(){if(d(a._$origin)&&d(a._$tooltip)){if(a.__options.trackOrigin){var e=a.__geometry(),f=!1;c(e.origin.size,a.__Geometry.origin.size)&&(a.__Geometry.origin.fixedLineage?c(e.origin.windowOffset,a.__Geometry.origin.windowOffset)&&(f=!0):c(e.origin.offset,a.__Geometry.origin.offset)&&(f=!0)),f||(a.__options.triggerClose.mouseleave?a._close():a.reposition())}if(a.__options.trackTooltip){var g=b[0].getBoundingClientRect();g.height===a.__contentBcr.height&&g.width===a.__contentBcr.width||(a.reposition(),a.__contentBcr=g)}}else a._close()},a.__options.trackerInterval),a},_close:function(b,c,d){var e=this,f=!0;if(e._trigger({type:"close",event:b,stop:function(){f=!1}}),f||d){c&&e.__callbacks.close.push(c),e.__callbacks.open=[],e.__timeoutsClear();var g=function(){a.each(e.__callbacks.close,function(a,c){c.call(e,e,{event:b,origin:e._$origin[0]})}),e.__callbacks.close=[]};if("closed"!=e.__state){var i=!0,j=new Date,k=j.getTime(),l=k+e.__options.animationDuration[1];if("disappearing"==e.__state&&l>e.__closingTime&&e.__options.animationDuration[1]>0&&(i=!1),i){e.__closingTime=l,"disappearing"!=e.__state&&e.__stateSet("disappearing");var m=function(){clearInterval(e.__tracker),e._trigger({type:"closing",event:b}),e._$tooltip.off("."+e.__namespace+"-triggerClose").removeClass("tooltipster-dying"),a(h.window).off("."+e.__namespace+"-triggerClose"),e.__$originParents.each(function(b,c){a(c).off("scroll."+e.__namespace+"-triggerClose")}),e.__$originParents=null,a(h.window.document.body).off("."+e.__namespace+"-triggerClose"),e._$origin.off("."+e.__namespace+"-triggerClose"),e._off("dismissable"),e.__stateSet("closed"),e._trigger({type:"after",event:b}),e.__options.functionAfter&&e.__options.functionAfter.call(e,e,{event:b,origin:e._$origin[0]}),g()};h.hasTransitions?(e._$tooltip.css({"-moz-animation-duration":e.__options.animationDuration[1]+"ms","-ms-animation-duration":e.__options.animationDuration[1]+"ms","-o-animation-duration":e.__options.animationDuration[1]+"ms","-webkit-animation-duration":e.__options.animationDuration[1]+"ms","animation-duration":e.__options.animationDuration[1]+"ms","transition-duration":e.__options.animationDuration[1]+"ms"}),e._$tooltip.clearQueue().removeClass("tooltipster-show").addClass("tooltipster-dying"),e.__options.animationDuration[1]>0&&e._$tooltip.delay(e.__options.animationDuration[1]),e._$tooltip.queue(m)):e._$tooltip.stop().fadeOut(e.__options.animationDuration[1],m)}}else g()}return e},_off:function(){return this.__$emitterPrivate.off.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_on:function(){return this.__$emitterPrivate.on.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_one:function(){return this.__$emitterPrivate.one.apply(this.__$emitterPrivate,Array.prototype.slice.apply(arguments)),this},_open:function(b,c){var e=this;if(!e.__destroying&&d(e._$origin)&&e.__enabled){var f=!0;if("closed"==e.__state&&(e._trigger({type:"before",event:b,stop:function(){f=!1}}),f&&e.__options.functionBefore&&(f=e.__options.functionBefore.call(e,e,{event:b,origin:e._$origin[0]}))),f!==!1&&null!==e.__Content){c&&e.__callbacks.open.push(c),e.__callbacks.close=[],e.__timeoutsClear();var g,i=function(){"stable"!=e.__state&&e.__stateSet("stable"),a.each(e.__callbacks.open,function(a,b){b.call(e,e,{origin:e._$origin[0],tooltip:e._$tooltip[0]})}),e.__callbacks.open=[]};if("closed"!==e.__state)g=0,"disappearing"===e.__state?(e.__stateSet("appearing"),h.hasTransitions?(e._$tooltip.clearQueue().removeClass("tooltipster-dying").addClass("tooltipster-show"),e.__options.animationDuration[0]>0&&e._$tooltip.delay(e.__options.animationDuration[0]),e._$tooltip.queue(i)):e._$tooltip.stop().fadeIn(i)):"stable"==e.__state&&i();else{if(e.__stateSet("appearing"),g=e.__options.animationDuration[0],e.__contentInsert(),e.reposition(b,!0),h.hasTransitions?(e._$tooltip.addClass("tooltipster-"+e.__options.animation).addClass("tooltipster-initial").css({"-moz-animation-duration":e.__options.animationDuration[0]+"ms","-ms-animation-duration":e.__options.animationDuration[0]+"ms","-o-animation-duration":e.__options.animationDuration[0]+"ms","-webkit-animation-duration":e.__options.animationDuration[0]+"ms","animation-duration":e.__options.animationDuration[0]+"ms","transition-duration":e.__options.animationDuration[0]+"ms"}),setTimeout(function(){"closed"!=e.__state&&(e._$tooltip.addClass("tooltipster-show").removeClass("tooltipster-initial"),e.__options.animationDuration[0]>0&&e._$tooltip.delay(e.__options.animationDuration[0]),e._$tooltip.queue(i))},0)):e._$tooltip.css("display","none").fadeIn(e.__options.animationDuration[0],i),e.__trackerStart(),a(h.window).on("resize."+e.__namespace+"-triggerClose",function(b){var c=a(document.activeElement);(c.is("input")||c.is("textarea"))&&a.contains(e._$tooltip[0],c[0])||e.reposition(b)}).on("scroll."+e.__namespace+"-triggerClose",function(a){e.__scrollHandler(a)}),e.__$originParents=e._$origin.parents(),e.__$originParents.each(function(b,c){a(c).on("scroll."+e.__namespace+"-triggerClose",function(a){e.__scrollHandler(a)})}),e.__options.triggerClose.mouseleave||e.__options.triggerClose.touchleave&&h.hasTouchCapability){e._on("dismissable",function(a){a.dismissable?a.delay?(m=setTimeout(function(){e._close(a.event)},a.delay),e.__timeouts.close.push(m)):e._close(a):clearTimeout(m)});var j=e._$origin,k="",l="",m=null;e.__options.interactive&&(j=j.add(e._$tooltip)),e.__options.triggerClose.mouseleave&&(k+="mouseenter."+e.__namespace+"-triggerClose ",l+="mouseleave."+e.__namespace+"-triggerClose "),e.__options.triggerClose.touchleave&&h.hasTouchCapability&&(k+="touchstart."+e.__namespace+"-triggerClose",l+="touchend."+e.__namespace+"-triggerClose touchcancel."+e.__namespace+"-triggerClose"),j.on(l,function(a){if(e._touchIsTouchEvent(a)||!e._touchIsEmulatedEvent(a)){var b="mouseleave"==a.type?e.__options.delay:e.__options.delayTouch;e._trigger({delay:b[1],dismissable:!0,event:a,type:"dismissable"})}}).on(k,function(a){!e._touchIsTouchEvent(a)&&e._touchIsEmulatedEvent(a)||e._trigger({dismissable:!1,event:a,type:"dismissable"})})}e.__options.triggerClose.originClick&&e._$origin.on("click."+e.__namespace+"-triggerClose",function(a){e._touchIsTouchEvent(a)||e._touchIsEmulatedEvent(a)||e._close(a)}),(e.__options.triggerClose.click||e.__options.triggerClose.tap&&h.hasTouchCapability)&&setTimeout(function(){if("closed"!=e.__state){var b="",c=a(h.window.document.body);e.__options.triggerClose.click&&(b+="click."+e.__namespace+"-triggerClose "),e.__options.triggerClose.tap&&h.hasTouchCapability&&(b+="touchend."+e.__namespace+"-triggerClose"),c.on(b,function(b){e._touchIsMeaningfulEvent(b)&&(e._touchRecordEvent(b),e.__options.interactive&&a.contains(e._$tooltip[0],b.target)||e._close(b))}),e.__options.triggerClose.tap&&h.hasTouchCapability&&c.on("touchstart."+e.__namespace+"-triggerClose",function(a){e._touchRecordEvent(a)})}},0),e._trigger("ready"),e.__options.functionReady&&e.__options.functionReady.call(e,e,{origin:e._$origin[0],tooltip:e._$tooltip[0]})}if(e.__options.timer>0){var m=setTimeout(function(){e._close()},e.__options.timer+g);e.__timeouts.close.push(m)}}}return e},_openShortly:function(a){var b=this,c=!0;if("stable"!=b.__state&&"appearing"!=b.__state&&!b.__timeouts.open&&(b._trigger({type:"start",event:a,stop:function(){c=!1}}),c)){var d=0==a.type.indexOf("touch")?b.__options.delayTouch:b.__options.delay;d[0]?b.__timeouts.open=setTimeout(function(){b.__timeouts.open=null,b.__pointerIsOverOrigin&&b._touchIsMeaningfulEvent(a)?(b._trigger("startend"),b._open(a)):b._trigger("startcancel")},d[0]):(b._trigger("startend"),b._open(a))}return b},_optionsExtract:function(b,c){var d=this,e=a.extend(!0,{},c),f=d.__options[b];return f||(f={},a.each(c,function(a,b){var c=d.__options[a];void 0!==c&&(f[a]=c)})),a.each(e,function(b,c){void 0!==f[b]&&("object"!=typeof c||c instanceof Array||null==c||"object"!=typeof f[b]||f[b]instanceof Array||null==f[b]?e[b]=f[b]:a.extend(e[b],f[b]))}),e},_plug:function(b){var c=a.tooltipster._plugin(b);if(!c)throw new Error('The "'+b+'" plugin is not defined');return c.instance&&a.tooltipster.__bridge(c.instance,this,c.name),this},_touchIsEmulatedEvent:function(a){for(var b=!1,c=(new Date).getTime(),d=this.__touchEvents.length-1;d>=0;d--){var e=this.__touchEvents[d];if(!(c-e.time<500))break;e.target===a.target&&(b=!0)}return b},_touchIsMeaningfulEvent:function(a){return this._touchIsTouchEvent(a)&&!this._touchSwiped(a.target)||!this._touchIsTouchEvent(a)&&!this._touchIsEmulatedEvent(a)},_touchIsTouchEvent:function(a){return 0==a.type.indexOf("touch")},_touchRecordEvent:function(a){return this._touchIsTouchEvent(a)&&(a.time=(new Date).getTime(),this.__touchEvents.push(a)),this},_touchSwiped:function(a){for(var b=!1,c=this.__touchEvents.length-1;c>=0;c--){var d=this.__touchEvents[c];if("touchmove"==d.type){b=!0;break}if("touchstart"==d.type&&a===d.target)break}return b},_trigger:function(){var b=Array.prototype.slice.apply(arguments);return"string"==typeof b[0]&&(b[0]={type:b[0]}),b[0].instance=this,b[0].origin=this._$origin?this._$origin[0]:null,b[0].tooltip=this._$tooltip?this._$tooltip[0]:null,this.__$emitterPrivate.trigger.apply(this.__$emitterPrivate,b),a.tooltipster._trigger.apply(a.tooltipster,b),this.__$emitterPublic.trigger.apply(this.__$emitterPublic,b),this},_unplug:function(b){var c=this;if(c[b]){var d=a.tooltipster._plugin(b);d.instance&&a.each(d.instance,function(a,d){c[a]&&c[a].bridged===c[b]&&delete c[a]}),c[b].__destroy&&c[b].__destroy(),delete c[b]}return c},close:function(a){return this.__destroyed?this.__destroyError():this._close(null,a),this},content:function(a){var b=this;if(void 0===a)return b.__Content;if(b.__destroyed)b.__destroyError();else if(b.__contentSet(a),null!==b.__Content){if("closed"!==b.__state&&(b.__contentInsert(),b.reposition(),b.__options.updateAnimation))if(h.hasTransitions){var c=b.__options.updateAnimation;b._$tooltip.addClass("tooltipster-update-"+c),setTimeout(function(){"closed"!=b.__state&&b._$tooltip.removeClass("tooltipster-update-"+c)},1e3)}else b._$tooltip.fadeTo(200,.5,function(){"closed"!=b.__state&&b._$tooltip.fadeTo(200,1)})}else b._close();return b},destroy:function(){var b=this;if(b.__destroyed)b.__destroyError();else{"closed"!=b.__state?b.option("animationDuration",0)._close(null,null,!0):b.__timeoutsClear(),b._trigger("destroy"),b.__destroyed=!0,b._$origin.removeData(b.__namespace).off("."+b.__namespace+"-triggerOpen"),a(h.window.document.body).off("."+b.__namespace+"-triggerOpen");var c=b._$origin.data("tooltipster-ns");if(c)if(1===c.length){var d=null;"previous"==b.__options.restoration?d=b._$origin.data("tooltipster-initialTitle"):"current"==b.__options.restoration&&(d="string"==typeof b.__Content?b.__Content:a("<div></div>").append(b.__Content).html()),d&&b._$origin.attr("title",d),b._$origin.removeClass("tooltipstered"),b._$origin.removeData("tooltipster-ns").removeData("tooltipster-initialTitle")}else c=a.grep(c,function(a,c){return a!==b.__namespace}),b._$origin.data("tooltipster-ns",c);b._trigger("destroyed"),b._off(),b.off(),b.__Content=null,b.__$emitterPrivate=null,b.__$emitterPublic=null,b.__options.parent=null,b._$origin=null,b._$tooltip=null,a.tooltipster.__instancesLatestArr=a.grep(a.tooltipster.__instancesLatestArr,function(a,c){return b!==a}),clearInterval(b.__garbageCollector)}return b},disable:function(){return this.__destroyed?(this.__destroyError(),this):(this._close(),this.__enabled=!1,this)},elementOrigin:function(){return this.__destroyed?void this.__destroyError():this._$origin[0]},elementTooltip:function(){return this._$tooltip?this._$tooltip[0]:null},enable:function(){return this.__enabled=!0,this},hide:function(a){return this.close(a)},instance:function(){return this},off:function(){return this.__destroyed||this.__$emitterPublic.off.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},on:function(){return this.__destroyed?this.__destroyError():this.__$emitterPublic.on.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},one:function(){return this.__destroyed?this.__destroyError():this.__$emitterPublic.one.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this},open:function(a){return this.__destroyed?this.__destroyError():this._open(null,a),this},option:function(b,c){return void 0===c?this.__options[b]:(this.__destroyed?this.__destroyError():(this.__options[b]=c,this.__optionsFormat(),a.inArray(b,["trigger","triggerClose","triggerOpen"])>=0&&this.__prepareOrigin(),"selfDestruction"===b&&this.__prepareGC()),this)},reposition:function(a,b){var c=this;return c.__destroyed?c.__destroyError():"closed"!=c.__state&&d(c._$origin)&&(b||d(c._$tooltip))&&(b||c._$tooltip.detach(),c.__Geometry=c.__geometry(),c._trigger({type:"reposition",event:a,helper:{geo:c.__Geometry}})),c},show:function(a){return this.open(a)},status:function(){return{destroyed:this.__destroyed,enabled:this.__enabled,open:"closed"!==this.__state,state:this.__state}},triggerHandler:function(){return this.__destroyed?this.__destroyError():this.__$emitterPublic.triggerHandler.apply(this.__$emitterPublic,Array.prototype.slice.apply(arguments)),this}},a.fn.tooltipster=function(){var b=Array.prototype.slice.apply(arguments),c="You are using a single HTML element as content for several tooltips. You probably want to set the contentCloning option to TRUE.";if(0===this.length)return this;if("string"==typeof b[0]){var d="#*$~&";return this.each(function(){var e=a(this).data("tooltipster-ns"),f=e?a(this).data(e[0]):null;if(!f)throw new Error("You called Tooltipster's \""+b[0]+'" method on an uninitialized element');if("function"!=typeof f[b[0]])throw new Error('Unknown method "'+b[0]+'"');this.length>1&&"content"==b[0]&&(b[1]instanceof a||"object"==typeof b[1]&&null!=b[1]&&b[1].tagName)&&!f.__options.contentCloning&&f.__options.debug&&console.log(c);var g=f[b[0]](b[1],b[2]);return g!==f||"instance"===b[0]?(d=g,!1):void 0}),"#*$~&"!==d?d:this}a.tooltipster.__instancesLatestArr=[];var e=b[0]&&void 0!==b[0].multiple,g=e&&b[0].multiple||!e&&f.multiple,h=b[0]&&void 0!==b[0].content,i=h&&b[0].content||!h&&f.content,j=b[0]&&void 0!==b[0].contentCloning,k=j&&b[0].contentCloning||!j&&f.contentCloning,l=b[0]&&void 0!==b[0].debug,m=l&&b[0].debug||!l&&f.debug;return this.length>1&&(i instanceof a||"object"==typeof i&&null!=i&&i.tagName)&&!k&&m&&console.log(c),this.each(function(){var c=!1,d=a(this),e=d.data("tooltipster-ns"),f=null;e?g?c=!0:m&&(console.log("Tooltipster: one or more tooltips are already attached to the element below. Ignoring."),console.log(this)):c=!0,c&&(f=new a.Tooltipster(this,b[0]),e||(e=[]),e.push(f.__namespace),d.data("tooltipster-ns",e),d.data(f.__namespace,f),f.__options.functionInit&&f.__options.functionInit.call(f,f,{origin:this}),f._trigger("init")),a.tooltipster.__instancesLatestArr.push(f)}),this},b.prototype={__init:function(b){this.__$tooltip=b,this.__$tooltip.css({left:0,overflow:"hidden",position:"absolute",top:0}).find(".tooltipster-content").css("overflow","auto"),this.$container=a('<div class="tooltipster-ruler"></div>').append(this.__$tooltip).appendTo(h.window.document.body)},__forceRedraw:function(){var a=this.__$tooltip.parent();this.__$tooltip.detach(),this.__$tooltip.appendTo(a)},constrain:function(a,b){return this.constraints={width:a,height:b},this.__$tooltip.css({display:"block",height:"",overflow:"auto",width:a}),this},destroy:function(){this.__$tooltip.detach().find(".tooltipster-content").css({display:"",overflow:""}),this.$container.remove()},free:function(){return this.constraints=null,this.__$tooltip.css({display:"",height:"",overflow:"visible",width:""}),this},measure:function(){this.__forceRedraw();var a=this.__$tooltip[0].getBoundingClientRect(),b={size:{height:a.height||a.bottom-a.top,width:a.width||a.right-a.left}};if(this.constraints){var c=this.__$tooltip.find(".tooltipster-content"),d=this.__$tooltip.outerHeight(),e=c[0].getBoundingClientRect(),f={height:d<=this.constraints.height,width:a.width<=this.constraints.width&&e.width>=c[0].scrollWidth-1};b.fits=f.height&&f.width}return h.IE&&h.IE<=11&&b.size.width!==h.window.document.documentElement.clientWidth&&(b.size.width=Math.ceil(b.size.width)+1),b}};var j=navigator.userAgent.toLowerCase();-1!=j.indexOf("msie")?h.IE=parseInt(j.split("msie")[1]):-1!==j.toLowerCase().indexOf("trident")&&-1!==j.indexOf(" rv:11")?h.IE=11:-1!=j.toLowerCase().indexOf("edge/")&&(h.IE=parseInt(j.toLowerCase().split("edge/")[1]));var k="tooltipster.sideTip";return a.tooltipster._plugin({name:k,instance:{__defaults:function(){return{arrow:!0,distance:6,functionPosition:null,maxWidth:null,minIntersection:16,minWidth:0,position:null,side:"top",viewportAware:!0}},__init:function(a){var b=this;b.__instance=a,b.__namespace="tooltipster-sideTip-"+Math.round(1e6*Math.random()),b.__previousState="closed",b.__options,b.__optionsFormat(),b.__instance._on("state."+b.__namespace,function(a){"closed"==a.state?b.__close():"appearing"==a.state&&"closed"==b.__previousState&&b.__create(),b.__previousState=a.state}),b.__instance._on("options."+b.__namespace,function(){b.__optionsFormat()}),b.__instance._on("reposition."+b.__namespace,function(a){b.__reposition(a.event,a.helper)})},__close:function(){this.__instance.content()instanceof a&&this.__instance.content().detach(),this.__instance._$tooltip.remove(),this.__instance._$tooltip=null},__create:function(){var b=a('<div class="tooltipster-base tooltipster-sidetip"><div class="tooltipster-box"><div class="tooltipster-content"></div></div><div class="tooltipster-arrow"><div class="tooltipster-arrow-uncropped"><div class="tooltipster-arrow-border"></div><div class="tooltipster-arrow-background"></div></div></div></div>');this.__options.arrow||b.find(".tooltipster-box").css("margin",0).end().find(".tooltipster-arrow").hide(),this.__options.minWidth&&b.css("min-width",this.__options.minWidth+"px"),this.__options.maxWidth&&b.css("max-width",this.__options.maxWidth+"px"),this.__instance._$tooltip=b,this.__instance._trigger("created")},__destroy:function(){this.__instance._off("."+self.__namespace)},__optionsFormat:function(){var b=this;if(b.__options=b.__instance._optionsExtract(k,b.__defaults()),b.__options.position&&(b.__options.side=b.__options.position),"object"!=typeof b.__options.distance&&(b.__options.distance=[b.__options.distance]),b.__options.distance.length<4&&(void 0===b.__options.distance[1]&&(b.__options.distance[1]=b.__options.distance[0]),void 0===b.__options.distance[2]&&(b.__options.distance[2]=b.__options.distance[0]),void 0===b.__options.distance[3]&&(b.__options.distance[3]=b.__options.distance[1]),b.__options.distance={top:b.__options.distance[0],right:b.__options.distance[1],bottom:b.__options.distance[2],left:b.__options.distance[3]}),"string"==typeof b.__options.side){var c={top:"bottom",right:"left",bottom:"top",left:"right"};b.__options.side=[b.__options.side,c[b.__options.side]],"left"==b.__options.side[0]||"right"==b.__options.side[0]?b.__options.side.push("top","bottom"):b.__options.side.push("right","left")}6===a.tooltipster._env.IE&&b.__options.arrow!==!0&&(b.__options.arrow=!1)},__reposition:function(b,c){var d,e=this,f=e.__targetFind(c),g=[];e.__instance._$tooltip.detach();var h=e.__instance._$tooltip.clone(),i=a.tooltipster._getRuler(h),j=!1,k=e.__instance.option("animation");switch(k&&h.removeClass("tooltipster-"+k),a.each(["window","document"],function(d,k){var l=null;if(e.__instance._trigger({container:k,helper:c,satisfied:j,takeTest:function(a){l=a},results:g,type:"positionTest"}),1==l||0!=l&&0==j&&("window"!=k||e.__options.viewportAware))for(var d=0;d<e.__options.side.length;d++){var m={horizontal:0,vertical:0},n=e.__options.side[d];"top"==n||"bottom"==n?m.vertical=e.__options.distance[n]:m.horizontal=e.__options.distance[n],e.__sideChange(h,n),a.each(["natural","constrained"],function(a,d){if(l=null,e.__instance._trigger({container:k,event:b,helper:c,mode:d,results:g,satisfied:j,side:n,takeTest:function(a){l=a},type:"positionTest"}),1==l||0!=l&&0==j){var h={container:k,distance:m,fits:null,mode:d,outerSize:null,side:n,size:null,target:f[n],whole:null},o="natural"==d?i.free():i.constrain(c.geo.available[k][n].width-m.horizontal,c.geo.available[k][n].height-m.vertical),p=o.measure();if(h.size=p.size,h.outerSize={height:p.size.height+m.vertical,width:p.size.width+m.horizontal},"natural"==d?c.geo.available[k][n].width>=h.outerSize.width&&c.geo.available[k][n].height>=h.outerSize.height?h.fits=!0:h.fits=!1:h.fits=p.fits,"window"==k&&(h.fits?"top"==n||"bottom"==n?h.whole=c.geo.origin.windowOffset.right>=e.__options.minIntersection&&c.geo.window.size.width-c.geo.origin.windowOffset.left>=e.__options.minIntersection:h.whole=c.geo.origin.windowOffset.bottom>=e.__options.minIntersection&&c.geo.window.size.height-c.geo.origin.windowOffset.top>=e.__options.minIntersection:h.whole=!1),g.push(h),h.whole)j=!0;else if("natural"==h.mode&&(h.fits||h.size.width<=c.geo.available[k][n].width))return!1}})}}),e.__instance._trigger({edit:function(a){g=a},event:b,helper:c,results:g,type:"positionTested"}),g.sort(function(a,b){if(a.whole&&!b.whole)return-1;if(!a.whole&&b.whole)return 1;if(a.whole&&b.whole){var c=e.__options.side.indexOf(a.side),d=e.__options.side.indexOf(b.side);return d>c?-1:c>d?1:"natural"==a.mode?-1:1}if(a.fits&&!b.fits)return-1;if(!a.fits&&b.fits)return 1;if(a.fits&&b.fits){var c=e.__options.side.indexOf(a.side),d=e.__options.side.indexOf(b.side);return d>c?-1:c>d?1:"natural"==a.mode?-1:1}return"document"==a.container&&"bottom"==a.side&&"natural"==a.mode?-1:1}),d=g[0],d.coord={},d.side){case"left":case"right":d.coord.top=Math.floor(d.target-d.size.height/2);break;case"bottom":case"top":d.coord.left=Math.floor(d.target-d.size.width/2)}switch(d.side){case"left":d.coord.left=c.geo.origin.windowOffset.left-d.outerSize.width;break;case"right":d.coord.left=c.geo.origin.windowOffset.right+d.distance.horizontal;break;case"top":d.coord.top=c.geo.origin.windowOffset.top-d.outerSize.height;break;case"bottom":d.coord.top=c.geo.origin.windowOffset.bottom+d.distance.vertical}"window"==d.container?"top"==d.side||"bottom"==d.side?d.coord.left<0?c.geo.origin.windowOffset.right-this.__options.minIntersection>=0?d.coord.left=0:d.coord.left=c.geo.origin.windowOffset.right-this.__options.minIntersection-1:d.coord.left>c.geo.window.size.width-d.size.width&&(c.geo.origin.windowOffset.left+this.__options.minIntersection<=c.geo.window.size.width?d.coord.left=c.geo.window.size.width-d.size.width:d.coord.left=c.geo.origin.windowOffset.left+this.__options.minIntersection+1-d.size.width):d.coord.top<0?c.geo.origin.windowOffset.bottom-this.__options.minIntersection>=0?d.coord.top=0:d.coord.top=c.geo.origin.windowOffset.bottom-this.__options.minIntersection-1:d.coord.top>c.geo.window.size.height-d.size.height&&(c.geo.origin.windowOffset.top+this.__options.minIntersection<=c.geo.window.size.height?d.coord.top=c.geo.window.size.height-d.size.height:d.coord.top=c.geo.origin.windowOffset.top+this.__options.minIntersection+1-d.size.height):(d.coord.left>c.geo.window.size.width-d.size.width&&(d.coord.left=c.geo.window.size.width-d.size.width),d.coord.left<0&&(d.coord.left=0)),e.__sideChange(h,d.side),c.tooltipClone=h[0],c.tooltipParent=e.__instance.option("parent").parent[0],c.mode=d.mode,c.whole=d.whole,c.origin=e.__instance._$origin[0],c.tooltip=e.__instance._$tooltip[0],delete d.container,delete d.fits,delete d.mode,delete d.outerSize,delete d.whole,d.distance=d.distance.horizontal||d.distance.vertical;var l=a.extend(!0,{},d);if(e.__instance._trigger({edit:function(a){d=a},event:b,helper:c,position:l,type:"position"}),e.__options.functionPosition){var m=e.__options.functionPosition.call(e,e.__instance,c,l);m&&(d=m)}i.destroy();var n,o;"top"==d.side||"bottom"==d.side?(n={prop:"left",val:d.target-d.coord.left},o=d.size.width-this.__options.minIntersection):(n={prop:"top",val:d.target-d.coord.top},o=d.size.height-this.__options.minIntersection),n.val<this.__options.minIntersection?n.val=this.__options.minIntersection:n.val>o&&(n.val=o);var p;p=c.geo.origin.fixedLineage?c.geo.origin.windowOffset:{left:c.geo.origin.windowOffset.left+c.geo.window.scroll.left,top:c.geo.origin.windowOffset.top+c.geo.window.scroll.top},d.coord={left:p.left+(d.coord.left-c.geo.origin.windowOffset.left),top:p.top+(d.coord.top-c.geo.origin.windowOffset.top)},e.__sideChange(e.__instance._$tooltip,d.side),c.geo.origin.fixedLineage?e.__instance._$tooltip.css("position","fixed"):e.__instance._$tooltip.css("position",""),e.__instance._$tooltip.css({left:d.coord.left,top:d.coord.top,height:d.size.height,width:d.size.width}).find(".tooltipster-arrow").css({left:"",top:""}).css(n.prop,n.val),e.__instance._$tooltip.appendTo(e.__instance.option("parent")),e.__instance._trigger({type:"repositioned",event:b,position:d})},__sideChange:function(a,b){a.removeClass("tooltipster-bottom").removeClass("tooltipster-left").removeClass("tooltipster-right").removeClass("tooltipster-top").addClass("tooltipster-"+b)},__targetFind:function(a){var b={},c=this.__instance._$origin[0].getClientRects();if(c.length>1){var d=this.__instance._$origin.css("opacity");1==d&&(this.__instance._$origin.css("opacity",.99),c=this.__instance._$origin[0].getClientRects(),this.__instance._$origin.css("opacity",1))}if(c.length<2)b.top=Math.floor(a.geo.origin.windowOffset.left+a.geo.origin.size.width/2),b.bottom=b.top,b.left=Math.floor(a.geo.origin.windowOffset.top+a.geo.origin.size.height/2),b.right=b.left;else{var e=c[0];b.top=Math.floor(e.left+(e.right-e.left)/2),e=c.length>2?c[Math.ceil(c.length/2)-1]:c[0],b.right=Math.floor(e.top+(e.bottom-e.top)/2),e=c[c.length-1],b.bottom=Math.floor(e.left+(e.right-e.left)/2),e=c.length>2?c[Math.ceil((c.length+1)/2)-1]:c[c.length-1],b.left=Math.floor(e.top+(e.bottom-e.top)/2)}return b}}}),a});;var datepicker_format='yy-mm-dd';jQuery(document).ready(function($)
{$('.mec_upload_image_button').click(function(event)
{event.preventDefault();var frame;if(frame)
{frame.open();return;}
frame=wp.media();frame.on('select',function()
{var attachment=frame.state().get('selection').first();$('#mec_thumbnail_img').html('<img src="'+attachment.attributes.url+'" />');$('#mec_thumbnail').val(attachment.attributes.url);$('.mec_remove_image_button').toggleClass('mec-util-hidden');frame.close();});frame.open();});$('.mec_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_thumbnail_img').html('');$('#mec_thumbnail').val('');$('.mec_remove_image_button').toggleClass('mec-util-hidden');});$('.mec_location_upload_image_button').click(function(event)
{event.preventDefault();var frame;if(frame)
{frame.open();return;}
frame=wp.media();frame.on('select',function()
{var attachment=frame.state().get('selection').first();$('#mec_location_thumbnail_img').html('<img src="'+attachment.attributes.url+'" />');$('#mec_location_thumbnail').val(attachment.attributes.url);$('.mec_location_remove_image_button').toggleClass('mec-util-hidden');frame.close();});frame.open();});$('.mec_location_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_location_thumbnail_img').html('');$('#mec_location_thumbnail').val('');$('.mec_location_remove_image_button').toggleClass('mec-util-hidden');});$('.mec_organizer_upload_image_button').click(function(event)
{event.preventDefault();var frame;if(frame)
{frame.open();return;}
frame=wp.media();frame.on('select',function()
{var attachment=frame.state().get('selection').first();$('#mec_organizer_thumbnail_img').html('<img src="'+attachment.attributes.url+'" />');$('#mec_organizer_thumbnail').val(attachment.attributes.url);$('.mec_organizer_remove_image_button').toggleClass('mec-util-hidden');frame.close();});frame.open();});$('.mec_organizer_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_organizer_thumbnail_img').html('');$('#mec_organizer_thumbnail').val('');$('.mec_organizer_remove_image_button').toggleClass('mec-util-hidden');});$('#mec_fes_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_fes_thumbnail_img').html('');$('#mec_fes_thumbnail').val('');$('#mec_featured_image_file').val('');$('#mec_fes_remove_image_button').addClass('mec-util-hidden');});$('#mec_fes_location_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_fes_location_thumbnail_img').html('');$('#mec_fes_location_thumbnail').val('');$('#mec_fes_location_thumbnail_file').val('');$('#mec_fes_location_remove_image_button').addClass('mec-util-hidden');});$('#mec_fes_organizer_remove_image_button').click(function(event)
{event.preventDefault();$('#mec_fes_organizer_thumbnail_img').html('');$('#mec_fes_organizer_thumbnail').val('');$('#mec_fes_organizer_thumbnail_file').val('');$('#mec_fes_organizer_remove_image_button').addClass('mec-util-hidden');});if(typeof mec_admin_localize!=='undefined'){var date_splite=mec_admin_localize.datepicker_format.split('&');if(date_splite[0]!==undefined&&date_splite.length==2){datepicker_format=date_splite[0];}}else if(typeof mecdata!=='undefined'){var date_splite=mecdata.datepicker_format.split('&');if(date_splite[0]!==undefined&&date_splite.length==2){datepicker_format=date_splite[0];}}
if($.fn.datepicker){$('#mec_start_date').datepicker({changeYear:true,changeMonth:true,dateFormat:datepicker_format,gotoCurrent:true,yearRange:'c-3:c+5',});$('#mec_end_date').datepicker({changeYear:true,changeMonth:true,dateFormat:datepicker_format,gotoCurrent:true,yearRange:'c-3:c+5',});$('#mec_date_repeat_end_at_date').datepicker({changeYear:true,changeMonth:true,dateFormat:datepicker_format,gotoCurrent:true,yearRange:'c-3:c+5',});$('.mec_date_picker_dynamic_format').datepicker({changeYear:true,changeMonth:true,dateFormat:datepicker_format,gotoCurrent:true,yearRange:'c-3:c+5',});$('.mec_date_picker').datepicker({changeYear:true,changeMonth:true,dateFormat:'yy-mm-dd',gotoCurrent:true,yearRange:'c-3:c+5',});}
$('#mec_location_id').on('change',function()
{mec_location_toggle();});$('#mec_organizer_id').on('change',function()
{mec_organizer_toggle();var mec_organizer_val=parseInt($(this).val());var mec_additional_organizer=$(this).parent().parent().find('#mec-additional-organizer-wrap');if(mec_organizer_val!=1)mec_additional_organizer.show();else mec_additional_organizer.hide();});mec_location_toggle();mec_organizer_toggle();$('#mec_repeat').on('change',function()
{mec_repeat_toggle();});mec_repeat_toggle();$('#mec_repeat_type').on('change',function()
{mec_repeat_type_toggle();});mec_repeat_type_toggle();$('#mec_bookings_limit_unlimited').on('change',function()
{mec_bookings_unlimited_toggle();});$('#mec_add_in_days').on('click',function()
{var start=$('#mec_exceptions_in_days_start_date').val();if(start==='')return false;var end=$('#mec_exceptions_in_days_end_date').val();if(end==='')return false;var start_hour=$('#mec_exceptions_in_days_start_hour').val();if(start_hour.length===1)start_hour='0'+start_hour;var start_minutes=$('#mec_exceptions_in_days_start_minutes').val();if(start_minutes.length===1)start_minutes='0'+start_minutes;var start_ampm=$('#mec_exceptions_in_days_start_ampm').val();if(typeof start_ampm==='undefined')start_ampm='';var end_hour=$('#mec_exceptions_in_days_end_hour').val();if(end_hour.length===1)end_hour='0'+end_hour;var end_minutes=$('#mec_exceptions_in_days_end_minutes').val();if(end_minutes.length===1)end_minutes='0'+end_minutes;var end_ampm=$('#mec_exceptions_in_days_end_ampm').val();if(typeof end_ampm==='undefined')end_ampm='';var value=start+':'+end+':'+start_hour+'-'+start_minutes+'-'+start_ampm+':'+end_hour+'-'+end_minutes+'-'+end_ampm;var label=start+' '+start_hour+':'+start_minutes+' '+start_ampm+' - '+end+' '+end_hour+':'+end_minutes+' '+end_ampm;if($('#mec_in_days input[value="'+value+'"]').length>0)return false;var $key=$('#mec_new_in_days_key');var key=$key.val();var html=$('#mec_new_in_days_raw').html().replace(/:i:/g,key).replace(/:val:/g,value).replace(/:label:/g,label);$('#mec_in_days').append(html);$key.val(parseInt(key)+1);});$('#mec_add_not_in_days').on('click',function()
{var date=$('#mec_exceptions_not_in_days_date').val();if(date==='')return false;var key=$('#mec_new_not_in_days_key').val();var html=$('#mec_new_not_in_days_raw').html().replace(/:i:/g,key).replace(/:val:/g,date);$('#mec_not_in_days').append(html);$('#mec_new_not_in_days_key').val(parseInt(key)+1);});$('#mec_add_ticket_button').on('click',function()
{var key=$('#mec_new_ticket_key').val();var html=$('#mec_new_ticket_raw').html().replace(/:i:/g,key);$('#mec_tickets').append(html);$('#mec_new_ticket_key').val(parseInt(key)+1);$('.mec_add_price_date_button').off('click').on('click',function()
{mec_handle_add_price_date_button(this);});});$('.mec_add_price_date_button').off('click').on('click',function()
{mec_handle_add_price_date_button(this);});$('#mec_add_hourly_schedule_day_button').on('click',function()
{var key=$('#mec_new_hourly_schedule_day_key').val();var html=$('#mec_new_hourly_schedule_day_raw').html().replace(/:d:/g,key).replace(/:dd:/g,parseInt(key)+1);$('#mec_meta_box_hourly_schedule_days').append(html);$('#mec_new_hourly_schedule_day_key').val(parseInt(key)+1);mec_hourly_schedule_listeners();});mec_hourly_schedule_listeners();$('#mec_add_fee_button').on('click',function()
{var key=$('#mec_new_fee_key').val();var html=$('#mec_new_fee_raw').html().replace(/:i:/g,key);$('#mec_fees_list').append(html);$('#mec_new_fee_key').val(parseInt(key)+1);});$('#mec_add_ticket_variation_button').on('click',function()
{var key=$('#mec_new_ticket_variation_key').val();var html=$('#mec_new_ticket_variation_raw').html().replace(/:i:/g,key);$('#mec_ticket_variations_list').append(html);$('#mec_new_ticket_variation_key').val(parseInt(key)+1);});$('.mec-form-row.mec-available-color-row span').on('click',function()
{$('.mec-form-row.mec-available-color-row span').removeClass('color-selected');$(this).addClass('color-selected');});$('#mec_reg_form_field_types button').on('click',function()
{var type=$(this).data('type');if(type=='mec_email'){if($('#mec_reg_form_fields').find('input[value="mec_email"][type="hidden"]').length){return false;}}
if(type=='name'){if($('#mec_reg_form_fields').find('input[value="name"][type="hidden"]').length){return false;}}
var key=$('#mec_new_reg_field_key').val();var html=$('#mec_reg_field_'+type).html().replace(/:i:/g,key);$('#mec_reg_form_fields').append(html);$('#mec_new_reg_field_key').val(parseInt(key)+1);mec_reg_fields_option_listeners();});mec_reg_fields_option_listeners();$('#mec-advanced-wraper ul > ul > li').click(function()
{if($(this).attr('class')=='')$(this).attr('class','mec-active');else $(this).attr('class','');$('#mec_date_repeat_advanced').val($('#mec-advanced-wraper div:first-child > ul').find('.mec-active').find('span').text().slice(0,-1));});$('#mec_event_form_field_types button').on('click',function()
{var type=$(this).data('type');var key=$('#mec_new_event_field_key').val();var html=$('#mec_event_field_'+type).html().replace(/:i:/g,key);$('#mec_event_form_fields').append(html);$('#mec_new_event_field_key').val(parseInt(key)+1);mec_event_fields_option_listeners();});mec_event_fields_option_listeners();$('#mec_bfixed_form_field_types button').on('click',function()
{var type=$(this).data('type');var key=$('#mec_new_bfixed_field_key').val();var html=$('#mec_bfixed_field_'+type).html().replace(/:i:/g,key);$('#mec_bfixed_form_fields').append(html);$('#mec_new_bfixed_field_key').val(parseInt(key)+1);mec_bfixed_fields_option_listeners();});mec_bfixed_fields_option_listeners();});function mec_location_toggle()
{if(jQuery('#mec_location_id').val()!='0')jQuery('#mec_location_new_container').hide();else jQuery('#mec_location_new_container').show();}
function mec_organizer_toggle()
{if(jQuery('#mec_organizer_id').val()!='0')jQuery('#mec_organizer_new_container').hide();else jQuery('#mec_organizer_new_container').show();}
function mec_repeat_toggle()
{if(jQuery('#mec_repeat').is(':checked'))jQuery('.mec-form-repeating-event-row').show();else jQuery('.mec-form-repeating-event-row').hide();}
function mec_repeat_type_toggle()
{var repeat_type=jQuery('#mec_repeat_type').val();if(repeat_type=='certain_weekdays')
{jQuery('#mec_repeat_interval_container').hide();jQuery('#mec_repeat_certain_weekdays_container').show();jQuery('#mec_exceptions_in_days_container').hide();jQuery('#mec_end_wrapper').show();jQuery('#mec-advanced-wraper').hide();}
else if(repeat_type=='custom_days')
{jQuery('#mec_repeat_interval_container').hide();jQuery('#mec_repeat_certain_weekdays_container').hide();jQuery('#mec_exceptions_in_days_container').show();jQuery('#mec_end_wrapper').hide();jQuery('#mec-advanced-wraper').hide();}
else if(repeat_type=='advanced')
{jQuery('#mec_repeat_interval_container').hide();jQuery('#mec_repeat_certain_weekdays_container').hide();jQuery('#mec_exceptions_in_days_container').hide();jQuery('#mec_end_wrapper').show();jQuery('#mec-advanced-wraper').show();}
else if(repeat_type!='daily'&&repeat_type!='weekly')
{jQuery('#mec_repeat_interval_container').hide();jQuery('#mec_repeat_certain_weekdays_container').hide();jQuery('#mec_exceptions_in_days_container').hide();jQuery('#mec_end_wrapper').show();jQuery('#mec-advanced-wraper').hide();}
else
{jQuery('#mec_repeat_interval_container').show();jQuery('#mec_repeat_certain_weekdays_container').hide();jQuery('#mec_exceptions_in_days_container').hide();jQuery('#mec_end_wrapper').show();jQuery('#mec-advanced-wraper').hide();}}
function mec_in_days_remove(i)
{jQuery('#mec_in_days_row'+i).remove();}
function mec_not_in_days_remove(i)
{jQuery('#mec_not_in_days_row'+i).remove();}
function mec_bookings_unlimited_toggle()
{jQuery('#mec_bookings_limit').toggleClass('mec-util-hidden');}
function mec_hourly_schedule_listeners()
{jQuery('.mec-add-hourly-schedule-button').off('click').on('click',function()
{var day=jQuery(this).data('day');var key=jQuery('#mec_new_hourly_schedule_key'+day).val();var html=jQuery('#mec_new_hourly_schedule_raw'+day).html().replace(/:i:/g,key).replace(/:d:/g,day);jQuery('#mec_hourly_schedules'+day).append(html);jQuery('#mec_new_hourly_schedule_key'+day).val(parseInt(key)+1);});}
function mec_hourly_schedule_remove(day,i)
{jQuery("#mec_hourly_schedule_row"+day+'_'+i).remove();}
function mec_hourly_schedule_day_remove(day)
{jQuery("#mec_meta_box_hourly_schedule_day_"+day).remove();}
function mec_ticket_remove(i)
{jQuery("#mec_ticket_row"+i).remove();}
function mec_set_event_color(color)
{try
{jQuery("#mec_event_color").wpColorPicker('color','#'+color);}
catch(e)
{jQuery("#mec_event_color").val(color);}}
function mec_remove_fee(key)
{jQuery("#mec_fee_row"+key).remove();}
function mec_remove_ticket_variation(key)
{jQuery("#mec_ticket_variation_row"+key).remove();}
function mec_reg_fields_option_listeners()
{jQuery('button.mec-reg-field-add-option').off('click').on('click',function()
{var field_id=jQuery(this).data('field-id');var key=jQuery('#mec_new_reg_field_option_key_'+field_id).val();var html=jQuery('#mec_reg_field_option').html().replace(/:i:/g,key).replace(/:fi:/g,field_id);jQuery('#mec_reg_fields_'+field_id+'_options_container').append(html);jQuery('#mec_new_reg_field_option_key_'+field_id).val(parseInt(key)+1);});if(typeof jQuery.fn.sortable!=='undefined')
{jQuery("#mec_reg_form_fields").sortable({handle:'.mec_reg_field_sort'});jQuery(".mec_reg_fields_options_container").sortable({handle:'.mec_reg_field_option_sort'});}}
function mec_reg_fields_option_remove(field_key,key)
{jQuery("#mec_reg_fields_option_"+field_key+"_"+key).remove();}
function mec_reg_fields_remove(key)
{jQuery("#mec_reg_fields_"+key).remove();}
function mec_handle_add_price_date_button(e)
{var key=jQuery(e).data('key');var p=jQuery('#mec_new_ticket_price_key_'+key).val();var html=jQuery('#mec_new_ticket_price_raw_'+key).html().replace(/:i:/g,key).replace(/:j:/g,p);jQuery('#mec-ticket-price-dates-'+key).append(html);jQuery('#mec_new_ticket_price_key_'+key).val(parseInt(p)+1);jQuery('#mec-ticket-price-dates-'+key+' .new_added').datepicker({changeYear:true,changeMonth:true,dateFormat:datepicker_format,gotoCurrent:true,yearRange:'c-3:c+5',});}
function mec_ticket_price_remove(ticket_key,price_key)
{jQuery("#mec_ticket_price_raw_"+ticket_key+"_"+price_key).remove();}
function mec_event_fields_option_listeners()
{jQuery('button.mec-event-field-add-option').off('click').on('click',function()
{var field_id=jQuery(this).data('field-id');var key=jQuery('#mec_new_event_field_option_key_'+field_id).val();var html=jQuery('#mec_event_field_option').html().replace(/:i:/g,key).replace(/:fi:/g,field_id);jQuery('#mec_event_fields_'+field_id+'_options_container').append(html);jQuery('#mec_new_event_field_option_key_'+field_id).val(parseInt(key)+1);});if(typeof jQuery.fn.sortable!=='undefined')
{jQuery("#mec_event_form_fields").sortable({handle:'.mec_event_field_sort'});jQuery(".mec_event_fields_options_container").sortable({handle:'.mec_event_field_option_sort'});}}
function mec_event_fields_option_remove(field_key,key)
{jQuery("#mec_event_fields_option_"+field_key+"_"+key).remove();}
function mec_event_fields_remove(key)
{jQuery("#mec_event_fields_"+key).remove();}
function mec_bfixed_fields_option_listeners()
{jQuery('button.mec-bfixed-field-add-option').off('click').on('click',function()
{var field_id=jQuery(this).data('field-id');var key=jQuery('#mec_new_bfixed_field_option_key_'+field_id).val();var html=jQuery('#mec_bfixed_field_option').html().replace(/:i:/g,key).replace(/:fi:/g,field_id);jQuery('#mec_bfixed_fields_'+field_id+'_options_container').append(html);jQuery('#mec_new_bfixed_field_option_key_'+field_id).val(parseInt(key)+1);});if(typeof jQuery.fn.sortable!=='undefined')
{jQuery("#mec_bfixed_form_fields").sortable({handle:'.mec_bfixed_field_sort'});jQuery(".mec_bfixed_fields_options_container").sortable({handle:'.mec_bfixed_field_option_sort'});}}
function mec_bfixed_fields_option_remove(field_key,key)
{jQuery("#mec_bfixed_fields_option_"+field_key+"_"+key).remove();}
function mec_bfixed_fields_remove(key)
{jQuery("#mec_bfixed_fields_"+key).remove();}
;/*! Lity - v2.1.0 - 2016-09-19
* http://sorgalla.com/lity/
* Copyright (c) 2015-2016 Jan Sorgalla; Licensed MIT */
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(c){return b(a,c)}):"object"==typeof module&&"object"==typeof module.exports?module.exports=b(a,require("jquery")):a.lity=b(a,a.jQuery||a.Zepto)}("undefined"!=typeof window?window:this,function(a,b){"use strict";function c(a){var b=A();return L&&a.length?(a.one(L,b.resolve),setTimeout(b.resolve,500)):b.resolve(),b.promise()}function d(a,c,d){if(1===arguments.length)return b.extend({},a);if("string"==typeof c){if("undefined"==typeof d)return"undefined"==typeof a[c]?null:a[c];a[c]=d}else b.extend(a,c);return this}function e(a){for(var b,c=decodeURI(a.split("#")[0]).split("&"),d={},e=0,f=c.length;e<f;e++)c[e]&&(b=c[e].split("="),d[b[0]]=b[1]);return d}function f(a,c){return a+(a.indexOf("?")>-1?"&":"?")+b.param(c)}function g(a,b){var c=a.indexOf("#");return-1===c?b:(c>0&&(a=a.substr(c)),b+a)}function h(a){return b('<span class="lity-error"/>').append(a)}function i(a,c){var d=c.opener()&&c.opener().data("lity-desc")||"Image with no description",e=b('<img src="'+a+'" alt="'+d+'"/>'),f=A(),g=function(){f.reject(h("Failed loading image"))};return e.on("load",function(){return 0===this.naturalWidth?g():void f.resolve(e)}).on("error",g),f.promise()}function j(a,c){var d,e,f;try{d=b(a)}catch(a){return!1}return!!d.length&&(e=b('<i style="display:none !important"/>'),f=d.hasClass("lity-hide"),c.element().one("lity:remove",function(){e.before(d).remove(),f&&!d.closest(".lity-content").length&&d.addClass("lity-hide")}),d.removeClass("lity-hide").after(e))}function k(a){var c=I.exec(a);return!!c&&n(g(a,f("https://www.youtube"+(c[2]||"")+".com/embed/"+c[4],b.extend({autoplay:1},e(c[5]||"")))))}function l(a){var c=J.exec(a);return!!c&&n(g(a,f("https://player.vimeo.com/video/"+c[3],b.extend({autoplay:1},e(c[4]||"")))))}function m(a){var b=K.exec(a);return!!b&&n(g(a,f("https://www.google."+b[3]+"/maps?"+b[6],{output:b[6].indexOf("layer=c")>0?"svembed":"embed"})))}function n(a){return'<div class="lity-iframe-container"><iframe frameborder="0" allowfullscreen src="'+a+'"/></div>'}function o(){return y.documentElement.clientHeight?y.documentElement.clientHeight:Math.round(z.height())}function p(a){var b=u();b&&(27===a.keyCode&&b.close(),9===a.keyCode&&q(a,b))}function q(a,b){var c=b.element().find(F),d=c.index(y.activeElement);a.shiftKey&&d<=0?(c.get(c.length-1).focus(),a.preventDefault()):a.shiftKey||d!==c.length-1||(c.get(0).focus(),a.preventDefault())}function r(){b.each(C,function(a,b){b.resize()})}function s(a){1===C.unshift(a)&&(B.addClass("lity-active"),z.on({resize:r,keydown:p})),b("body > *").not(a.element()).addClass("lity-hidden").each(function(){var a=b(this);void 0===a.data(E)&&a.data(E,a.attr(D)||null)}).attr(D,"true")}function t(a){var c;a.element().attr(D,"true"),1===C.length&&(B.removeClass("lity-active"),z.off({resize:r,keydown:p})),C=b.grep(C,function(b){return a!==b}),c=C.length?C[0].element():b(".lity-hidden"),c.removeClass("lity-hidden").each(function(){var a=b(this),c=a.data(E);c?a.attr(D,c):a.removeAttr(D),a.removeData(E)})}function u(){return 0===C.length?null:C[0]}function v(a,c,d,e){var f,g="inline",h=b.extend({},d);return e&&h[e]?(f=h[e](a,c),g=e):(b.each(["inline","iframe"],function(a,b){delete h[b],h[b]=d[b]}),b.each(h,function(b,d){return!d||(!(!d.test||d.test(a,c))||(f=d(a,c),!1!==f?(g=b,!1):void 0))})),{handler:g,content:f||""}}function w(a,e,f,g){function h(a){k=b(a).css("max-height",o()+"px"),j.find(".lity-loader").each(function(){var a=b(this);c(a).always(function(){a.remove()})}),j.removeClass("lity-loading").find(".lity-content").empty().append(k),m=!0,k.trigger("lity:ready",[l])}var i,j,k,l=this,m=!1,n=!1;e=b.extend({},G,e),j=b(e.template),l.element=function(){return j},l.opener=function(){return f},l.options=b.proxy(d,l,e),l.handlers=b.proxy(d,l,e.handlers),l.resize=function(){m&&!n&&k.css("max-height",o()+"px").trigger("lity:resize",[l])},l.close=function(){if(m&&!n){n=!0,t(l);var a=A();return g&&b.contains(j,y.activeElement)&&g.focus(),k.trigger("lity:close",[l]),j.removeClass("lity-opened").addClass("lity-closed"),c(k.add(j)).always(function(){k.trigger("lity:remove",[l]),j.remove(),j=void 0,a.resolve()}),a.promise()}},i=v(a,l,e.handlers,e.handler),j.attr(D,"false").addClass("lity-loading lity-opened lity-"+i.handler).appendTo("body").focus().on("click","[data-lity-close]",function(a){b(a.target).is("[data-lity-close]")&&l.close()}).trigger("lity:open",[l]),s(l),b.when(i.content).always(h)}function x(a,c,d){a.preventDefault?(a.preventDefault(),d=b(this),a=d.data("lity-target")||d.attr("href")||d.attr("src")):d=b(d);var e=new w(a,b.extend({},d.data("lity-options")||d.data("lity"),c),d,y.activeElement);if(!a.preventDefault)return e}var y=a.document,z=b(a),A=b.Deferred,B=b("html"),C=[],D="aria-hidden",E="lity-"+D,F='a[href],area[href],input:not([disabled]),select:not([disabled]),textarea:not([disabled]),button:not([disabled]),iframe,object,embed,[contenteditable],[tabindex]:not([tabindex^="-"])',G={handler:null,handlers:{image:i,inline:j,youtube:k,vimeo:l,iframe:n},template:'<div class="lity" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1"><div class="lity-wrap" data-lity-close role="document"><div class="lity-loader" aria-hidden="true">Loading...</div><div class="lity-container"><div class="lity-content"></div><button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button></div></div></div>'},H=/(^data:image\/)|(\.(png|jpe?g|gif|svg|webp|bmp|ico|tiff?)(\?\S*)?$)/i,I=/(youtube(-nocookie)?\.com|youtu\.be)\/(watch\?v=|v\/|u\/|embed\/?)?([\w-]{11})(.*)?/i,J=/(vimeo(pro)?.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/,K=/((maps|www)\.)?google\.([^\/\?]+)\/?((maps\/?)?\?)(.*)/i,L=function(){var a=y.createElement("div"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return b[c];return!1}();return i.test=function(a){return H.test(a)},x.version="2.1.0",x.options=b.proxy(d,x,G),x.handlers=b.proxy(d,x,G.handlers),x.current=u,b(y).on("click.lity","[data-lity]",x),x});
;/*
 *  colourBrightness.js
 *
 *  Copyright 2013-2016, Jamie Brittain - http://jamiebrittain.com
 *  Released under the WTFPL license
 *  http://sam.zoy.org/wtfpl/
 *
 *  Github:  http://github.com/jamiebrittain/colourBrightness.js
 *  Version: 1.2
 */
!function(r){r.fn.colourBrightness=function(){function r(r){for(var t="";"html"!=r[0].tagName.toLowerCase()&&(t=r.css("background-color"),"rgba(0, 0, 0, 0)"==t||"transparent"==t);)r=r.parent();return t}var t,a,s,e,n=r(this);return n.match(/^rgb/)?(n=n.match(/rgba?\(([^)]+)\)/)[1],n=n.split(/ *, */).map(Number),t=n[0],a=n[1],s=n[2]):"#"==n[0]&&7==n.length?(t=parseInt(n.slice(1,3),16),a=parseInt(n.slice(3,5),16),s=parseInt(n.slice(5,7),16)):"#"==n[0]&&4==n.length&&(t=parseInt(n[1]+n[1],16),a=parseInt(n[2]+n[2],16),s=parseInt(n[3]+n[3],16)),e=(299*t+587*a+114*s)/1e3,125>e?this.removeClass("light").addClass("dark"):this.removeClass("dark").addClass("light"),this}}(jQuery);

;/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
/**
 * Owl carousel
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates a carousel.
	 * @class The Owl Carousel.
	 * @public
	 * @param {HTMLElement|jQuery} element - The element to create the carousel for.
	 * @param {Object} [options] - The options
	 */
    function Owl(element, options) {

		/**
		 * Current settings for the carousel.
		 * @public
		 */
        this.settings = null;

		/**
		 * Current options set by the caller including defaults.
		 * @public
		 */
        this.options = $.extend({}, Owl.Defaults, options);

		/**
		 * Plugin element.
		 * @public
		 */
        this.$element = $(element);

		/**
		 * Proxied event handlers.
		 * @protected
		 */
        this._handlers = {};

		/**
		 * References to the running plugins of this carousel.
		 * @protected
		 */
        this._plugins = {};

		/**
		 * Currently suppressed events to prevent them from being retriggered.
		 * @protected
		 */
        this._supress = {};

		/**
		 * Absolute current position.
		 * @protected
		 */
        this._current = null;

		/**
		 * Animation speed in milliseconds.
		 * @protected
		 */
        this._speed = null;

		/**
		 * Coordinates of all items in pixel.
		 * @todo The name of this member is missleading.
		 * @protected
		 */
        this._coordinates = [];

		/**
		 * Current breakpoint.
		 * @todo Real media queries would be nice.
		 * @protected
		 */
        this._breakpoint = null;

		/**
		 * Current width of the plugin element.
		 */
        this._width = null;

		/**
		 * All real items.
		 * @protected
		 */
        this._items = [];

		/**
		 * All cloned items.
		 * @protected
		 */
        this._clones = [];

		/**
		 * Merge values of all items.
		 * @todo Maybe this could be part of a plugin.
		 * @protected
		 */
        this._mergers = [];

		/**
		 * Widths of all items.
		 */
        this._widths = [];

		/**
		 * Invalidated parts within the update process.
		 * @protected
		 */
        this._invalidated = {};

		/**
		 * Ordered list of workers for the update process.
		 * @protected
		 */
        this._pipe = [];

		/**
		 * Current state information for the drag operation.
		 * @todo #261
		 * @protected
		 */
        this._drag = {
            time: null,
            target: null,
            pointer: null,
            stage: {
                start: null,
                current: null
            },
            direction: null
        };

		/**
		 * Current state information and their tags.
		 * @type {Object}
		 * @protected
		 */
        this._states = {
            current: {},
            tags: {
                'initializing': ['busy'],
                'animating': ['busy'],
                'dragging': ['interacting']
            }
        };

        $.each(['onResize', 'onThrottledResize'], $.proxy(function (i, handler) {
            this._handlers[handler] = $.proxy(this[handler], this);
        }, this));

        $.each(Owl.Plugins, $.proxy(function (key, plugin) {
            this._plugins[key.charAt(0).toLowerCase() + key.slice(1)]
                = new plugin(this);
        }, this));

        $.each(Owl.Workers, $.proxy(function (priority, worker) {
            this._pipe.push({
                'filter': worker.filter,
                'run': $.proxy(worker.run, this)
            });
        }, this));

        this.setup();
        this.initialize();
    }

	/**
	 * Default options for the carousel.
	 * @public
	 */
    Owl.Defaults = {
        items: 3,
        loop: false,
        center: false,
        rewind: false,
        checkVisibility: true,

        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,

        margin: 0,
        stagePadding: 0,

        merge: false,
        mergeFit: true,
        autoWidth: false,

        startPosition: 0,
        rtl: false,

        smartSpeed: 250,
        fluidSpeed: false,
        dragEndSpeed: false,

        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,

        fallbackEasing: 'swing',
        slideTransition: '',

        info: false,

        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',

        refreshClass: 'owl-refresh',
        loadedClass: 'owl-loaded',
        loadingClass: 'owl-loading',
        rtlClass: 'owl-rtl',
        responsiveClass: 'owl-responsive',
        dragClass: 'owl-drag',
        itemClass: 'owl-item',
        stageClass: 'owl-stage',
        stageOuterClass: 'owl-stage-outer',
        grabClass: 'owl-grab'
    };

	/**
	 * Enumeration for width.
	 * @public
	 * @readonly
	 * @enum {String}
	 */
    Owl.Width = {
        Default: 'default',
        Inner: 'inner',
        Outer: 'outer'
    };

	/**
	 * Enumeration for types.
	 * @public
	 * @readonly
	 * @enum {String}
	 */
    Owl.Type = {
        Event: 'event',
        State: 'state'
    };

	/**
	 * Contains all registered plugins.
	 * @public
	 */
    Owl.Plugins = {};

	/**
	 * List of workers involved in the update process.
	 */
    Owl.Workers = [{
        filter: ['width', 'settings'],
        run: function () {
            this._width = this.$element.width();
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function (cache) {
            cache.current = this._items && this._items[this.relative(this._current)];
        }
    }, {
        filter: ['items', 'settings'],
        run: function () {
            this.$stage.children('.cloned').remove();
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function (cache) {
            var margin = this.settings.margin || '',
                grid = !this.settings.autoWidth,
                rtl = this.settings.rtl,
                css = {
                    'width': 'auto',
                    'margin-left': rtl ? margin : '',
                    'margin-right': rtl ? '' : margin
                };

            !grid && this.$stage.children().css(css);

            cache.css = css;
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function (cache) {
            var width = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                merge = null,
                iterator = this._items.length,
                grid = !this.settings.autoWidth,
                widths = [];

            cache.items = {
                merge: false,
                width: width
            };

            while (iterator--) {
                merge = this._mergers[iterator];
                merge = this.settings.mergeFit && Math.min(merge, this.settings.items) || merge;

                cache.items.merge = merge > 1 || cache.items.merge;

                widths[iterator] = !grid ? this._items[iterator].width() : width * merge;
            }

            this._widths = widths;
        }
    }, {
        filter: ['items', 'settings'],
        run: function () {
            var clones = [],
                items = this._items,
                settings = this.settings,
                // TODO: Should be computed from number of min width items in stage
                view = Math.max(settings.items * 2, 4),
                size = Math.ceil(items.length / 2) * 2,
                repeat = settings.loop && items.length ? settings.rewind ? view : Math.max(view, size) : 0,
                append = '',
                prepend = '';

            repeat /= 2;

            while (repeat > 0) {
                // Switch to only using appended clones
                clones.push(this.normalize(clones.length / 2, true));
                append = append + items[clones[clones.length - 1]][0].outerHTML;
                clones.push(this.normalize(items.length - 1 - (clones.length - 1) / 2, true));
                prepend = items[clones[clones.length - 1]][0].outerHTML + prepend;
                repeat -= 1;
            }

            this._clones = clones;

            $(append).addClass('cloned').appendTo(this.$stage);
            $(prepend).addClass('cloned').prependTo(this.$stage);
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function () {
            var rtl = this.settings.rtl ? 1 : -1,
                size = this._clones.length + this._items.length,
                iterator = -1,
                previous = 0,
                current = 0,
                coordinates = [];

            while (++iterator < size) {
                previous = coordinates[iterator - 1] || 0;
                current = this._widths[this.relative(iterator)] + this.settings.margin;
                coordinates.push(previous + current * rtl);
            }

            this._coordinates = coordinates;
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function () {
            var padding = this.settings.stagePadding,
                coordinates = this._coordinates,
                css = {
                    'width': Math.ceil(Math.abs(coordinates[coordinates.length - 1])) + padding * 2,
                    'padding-left': padding || '',
                    'padding-right': padding || ''
                };

            this.$stage.css(css);
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function (cache) {
            var iterator = this._coordinates.length,
                grid = !this.settings.autoWidth,
                items = this.$stage.children();

            if (grid && cache.items.merge) {
                while (iterator--) {
                    cache.css.width = this._widths[this.relative(iterator)];
                    items.eq(iterator).css(cache.css);
                }
            } else if (grid) {
                cache.css.width = cache.items.width;
                items.css(cache.css);
            }
        }
    }, {
        filter: ['items'],
        run: function () {
            this._coordinates.length < 1 && this.$stage.removeAttr('style');
        }
    }, {
        filter: ['width', 'items', 'settings'],
        run: function (cache) {
            cache.current = cache.current ? this.$stage.children().index(cache.current) : 0;
            cache.current = Math.max(this.minimum(), Math.min(this.maximum(), cache.current));
            this.reset(cache.current);
        }
    }, {
        filter: ['position'],
        run: function () {
            this.animate(this.coordinates(this._current));
        }
    }, {
        filter: ['width', 'position', 'items', 'settings'],
        run: function () {
            var rtl = this.settings.rtl ? 1 : -1,
                padding = this.settings.stagePadding * 2,
                begin = this.coordinates(this.current()) + padding,
                end = begin + this.width() * rtl,
                inner, outer, matches = [], i, n;

            for (i = 0, n = this._coordinates.length; i < n; i++) {
                inner = this._coordinates[i - 1] || 0;
                outer = Math.abs(this._coordinates[i]) + padding * rtl;

                if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end)))
                    || (this.op(outer, '<', begin) && this.op(outer, '>', end))) {
                    matches.push(i);
                }
            }

            this.$stage.children('.active').removeClass('active');
            this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass('active');

            this.$stage.children('.center').removeClass('center');
            if (this.settings.center) {
                this.$stage.children().eq(this.current()).addClass('center');
            }
        }
    }];

	/**
	 * Create the stage DOM element
	 */
    Owl.prototype.initializeStage = function () {
        this.$stage = this.$element.find('.' + this.settings.stageClass);

        // if the stage is already in the DOM, grab it and skip stage initialization
        if (this.$stage.length) {
            return;
        }

        this.$element.addClass(this.options.loadingClass);

        // create stage
        this.$stage = $('<' + this.settings.stageElement + '>', {
            "class": this.settings.stageClass
        }).wrap($('<div/>', {
            "class": this.settings.stageOuterClass
        }));

        // append stage
        this.$element.append(this.$stage.parent());
    };

	/**
	 * Create item DOM elements
	 */
    Owl.prototype.initializeItems = function () {
        var $items = this.$element.find('.owl-item');

        // if the items are already in the DOM, grab them and skip item initialization
        if ($items.length) {
            this._items = $items.get().map(function (item) {
                return $(item);
            });

            this._mergers = this._items.map(function () {
                return 1;
            });

            this.refresh();

            return;
        }

        // append content
        this.replace(this.$element.children().not(this.$stage.parent()));

        // check visibility
        if (this.isVisible()) {
            // update view
            this.refresh();
        } else {
            // invalidate width
            this.invalidate('width');
        }

        this.$element
            .removeClass(this.options.loadingClass)
            .addClass(this.options.loadedClass);
    };

	/**
	 * Initializes the carousel.
	 * @protected
	 */
    Owl.prototype.initialize = function () {
        this.enter('initializing');
        this.trigger('initialize');

        this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl);

        if (this.settings.autoWidth && !this.is('pre-loading')) {
            var imgs, nestedSelector, width;
            imgs = this.$element.find('img');
            nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
            width = this.$element.children(nestedSelector).width();

            if (imgs.length && width <= 0) {
                this.preloadAutoWidthImages(imgs);
            }
        }

        this.initializeStage();
        this.initializeItems();

        // register event handlers
        this.registerEventHandlers();

        this.leave('initializing');
        this.trigger('initialized');
    };

	/**
	 * @returns {Boolean} visibility of $element
	 *                    if you know the carousel will always be visible you can set `checkVisibility` to `false` to
	 *                    prevent the expensive browser layout forced reflow the $element.is(':visible') does
	 */
    Owl.prototype.isVisible = function () {
        return this.settings.checkVisibility
            ? this.$element.is(':visible')
            : true;
    };

	/**
	 * Setups the current settings.
	 * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
	 * @todo Support for media queries by using `matchMedia` would be nice.
	 * @public
	 */
    Owl.prototype.setup = function () {
        var viewport = this.viewport(),
            overwrites = this.options.responsive,
            match = -1,
            settings = null;

        if (!overwrites) {
            settings = $.extend({}, this.options);
        } else {
            $.each(overwrites, function (breakpoint) {
                if (breakpoint <= viewport && breakpoint > match) {
                    match = Number(breakpoint);
                }
            });

            settings = $.extend({}, this.options, overwrites[match]);
            if (typeof settings.stagePadding === 'function') {
                settings.stagePadding = settings.stagePadding();
            }
            delete settings.responsive;

            // responsive class
            if (settings.responsiveClass) {
                this.$element.attr('class',
                    this.$element.attr('class').replace(new RegExp('(' + this.options.responsiveClass + '-)\\S+\\s', 'g'), '$1' + match)
                );
            }
        }

        this.trigger('change', { property: { name: 'settings', value: settings } });
        this._breakpoint = match;
        this.settings = settings;
        this.invalidate('settings');
        this.trigger('changed', { property: { name: 'settings', value: this.settings } });
    };

	/**
	 * Updates option logic if necessery.
	 * @protected
	 */
    Owl.prototype.optionsLogic = function () {
        if (this.settings.autoWidth) {
            this.settings.stagePadding = false;
            this.settings.merge = false;
        }
    };

	/**
	 * Prepares an item before add.
	 * @todo Rename event parameter `content` to `item`.
	 * @protected
	 * @returns {jQuery|HTMLElement} - The item container.
	 */
    Owl.prototype.prepare = function (item) {
        var event = this.trigger('prepare', { content: item });

        if (!event.data) {
            event.data = $('<' + this.settings.itemElement + '/>')
                .addClass(this.options.itemClass).append(item)
        }

        this.trigger('prepared', { content: event.data });

        return event.data;
    };

	/**
	 * Updates the view.
	 * @public
	 */
    Owl.prototype.update = function () {
        var i = 0,
            n = this._pipe.length,
            filter = $.proxy(function (p) { return this[p] }, this._invalidated),
            cache = {};

        while (i < n) {
            if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
                this._pipe[i].run(cache);
            }
            i++;
        }

        this._invalidated = {};

        !this.is('valid') && this.enter('valid');
    };

	/**
	 * Gets the width of the view.
	 * @public
	 * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
	 * @returns {Number} - The width of the view in pixel.
	 */
    Owl.prototype.width = function (dimension) {
        dimension = dimension || Owl.Width.Default;
        switch (dimension) {
            case Owl.Width.Inner:
            case Owl.Width.Outer:
                return this._width;
            default:
                return this._width - this.settings.stagePadding * 2 + this.settings.margin;
        }
    };

	/**
	 * Refreshes the carousel primarily for adaptive purposes.
	 * @public
	 */
    Owl.prototype.refresh = function () {
        this.enter('refreshing');
        this.trigger('refresh');

        this.setup();

        this.optionsLogic();

        this.$element.addClass(this.options.refreshClass);

        this.update();

        this.$element.removeClass(this.options.refreshClass);

        this.leave('refreshing');
        this.trigger('refreshed');
    };

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
    Owl.prototype.onThrottledResize = function () {
        window.clearTimeout(this.resizeTimer);
        this.resizeTimer = window.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate);
    };

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
    Owl.prototype.onResize = function () {
        if (!this._items.length) {
            return false;
        }

        if (this._width === this.$element.width()) {
            return false;
        }

        if (!this.isVisible()) {
            return false;
        }

        this.enter('resizing');

        if (this.trigger('resize').isDefaultPrevented()) {
            this.leave('resizing');
            return false;
        }

        this.invalidate('width');

        this.refresh();

        this.leave('resizing');
        this.trigger('resized');
    };

	/**
	 * Registers event handlers.
	 * @todo Check `msPointerEnabled`
	 * @todo #261
	 * @protected
	 */
    Owl.prototype.registerEventHandlers = function () {
        if ($.support.transition) {
            this.$stage.on($.support.transition.end + '.owl.core', $.proxy(this.onTransitionEnd, this));
        }

        if (this.settings.responsive !== false) {
            this.on(window, 'resize', this._handlers.onThrottledResize);
        }

        if (this.settings.mouseDrag) {
            this.$element.addClass(this.options.dragClass);
            this.$stage.on('mousedown.owl.core', $.proxy(this.onDragStart, this));
            this.$stage.on('dragstart.owl.core selectstart.owl.core', function () { return false });
        }

        if (this.settings.touchDrag) {
            this.$stage.on('touchstart.owl.core', $.proxy(this.onDragStart, this));
            this.$stage.on('touchcancel.owl.core', $.proxy(this.onDragEnd, this));
        }
    };

	/**
	 * Handles `touchstart` and `mousedown` events.
	 * @todo Horizontal swipe threshold as option
	 * @todo #261
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
    Owl.prototype.onDragStart = function (event) {
        var stage = null;

        if (event.which === 3) {
            return;
        }

        if ($.support.transform) {
            stage = this.$stage.css('transform').replace(/.*\(|\)| /g, '').split(',');
            stage = {
                x: stage[stage.length === 16 ? 12 : 4],
                y: stage[stage.length === 16 ? 13 : 5]
            };
        } else {
            stage = this.$stage.position();
            stage = {
                x: this.settings.rtl ?
                    stage.left + this.$stage.width() - this.width() + this.settings.margin :
                    stage.left,
                y: stage.top
            };
        }

        if (this.is('animating')) {
            $.support.transform ? this.animate(stage.x) : this.$stage.stop()
            this.invalidate('position');
        }

        this.$element.toggleClass(this.options.grabClass, event.type === 'mousedown');

        this.speed(0);

        this._drag.time = new Date().getTime();
        this._drag.target = $(event.target);
        this._drag.stage.start = stage;
        this._drag.stage.current = stage;
        this._drag.pointer = this.pointer(event);

        $(document).on('mouseup.owl.core touchend.owl.core', $.proxy(this.onDragEnd, this));

        $(document).one('mousemove.owl.core touchmove.owl.core', $.proxy(function (event) {
            var delta = this.difference(this._drag.pointer, this.pointer(event));

            $(document).on('mousemove.owl.core touchmove.owl.core', $.proxy(this.onDragMove, this));

            if (Math.abs(delta.x) < Math.abs(delta.y) && this.is('valid')) {
                return;
            }

            event.preventDefault();

            this.enter('dragging');
            this.trigger('drag');
        }, this));
    };

	/**
	 * Handles the `touchmove` and `mousemove` events.
	 * @todo #261
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
    Owl.prototype.onDragMove = function (event) {
        var minimum = null,
            maximum = null,
            pull = null,
            delta = this.difference(this._drag.pointer, this.pointer(event)),
            stage = this.difference(this._drag.stage.start, delta);

        if (!this.is('dragging')) {
            return;
        }

        event.preventDefault();

        if (this.settings.loop) {
            minimum = this.coordinates(this.minimum());
            maximum = this.coordinates(this.maximum() + 1) - minimum;
            stage.x = (((stage.x - minimum) % maximum + maximum) % maximum) + minimum;
        } else {
            minimum = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
            maximum = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
            pull = this.settings.pullDrag ? -1 * delta.x / 5 : 0;
            stage.x = Math.max(Math.min(stage.x, minimum + pull), maximum + pull);
        }

        this._drag.stage.current = stage;

        this.animate(stage.x);
    };

	/**
	 * Handles the `touchend` and `mouseup` events.
	 * @todo #261
	 * @todo Threshold for click event
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
    Owl.prototype.onDragEnd = function (event) {
        var delta = this.difference(this._drag.pointer, this.pointer(event)),
            stage = this._drag.stage.current,
            direction = delta.x > 0 ^ this.settings.rtl ? 'left' : 'right';

        $(document).off('.owl.core');

        this.$element.removeClass(this.options.grabClass);

        if (delta.x !== 0 && this.is('dragging') || !this.is('valid')) {
            this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
            this.current(this.closest(stage.x, delta.x !== 0 ? direction : this._drag.direction));
            this.invalidate('position');
            this.update();

            this._drag.direction = direction;

            if (Math.abs(delta.x) > 3 || new Date().getTime() - this._drag.time > 300) {
                this._drag.target.one('click.owl.core', function () { return false; });
            }
        }

        if (!this.is('dragging')) {
            return;
        }

        this.leave('dragging');
        this.trigger('dragged');
    };

	/**
	 * Gets absolute position of the closest item for a coordinate.
	 * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
	 * @protected
	 * @param {Number} coordinate - The coordinate in pixel.
	 * @param {String} direction - The direction to check for the closest item. Ether `left` or `right`.
	 * @return {Number} - The absolute position of the closest item.
	 */
    Owl.prototype.closest = function (coordinate, direction) {
        var position = -1,
            pull = 30,
            width = this.width(),
            coordinates = this.coordinates();

        if (!this.settings.freeDrag) {
            // check closest item
            $.each(coordinates, $.proxy(function (index, value) {
                // on a left pull, check on current index
                if (direction === 'left' && coordinate > value - pull && coordinate < value + pull) {
                    position = index;
                    // on a right pull, check on previous index
                    // to do so, subtract width from value and set position = index + 1
                } else if (direction === 'right' && coordinate > value - width - pull && coordinate < value - width + pull) {
                    position = index + 1;
                } else if (this.op(coordinate, '<', value)
                    && this.op(coordinate, '>', coordinates[index + 1] !== undefined ? coordinates[index + 1] : value - width)) {
                    position = direction === 'left' ? index + 1 : index;
                }
                return position === -1;
            }, this));
        }

        if (!this.settings.loop) {
            // non loop boundries
            if (this.op(coordinate, '>', coordinates[this.minimum()])) {
                position = coordinate = this.minimum();
            } else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
                position = coordinate = this.maximum();
            }
        }

        return position;
    };

	/**
	 * Animates the stage.
	 * @todo #270
	 * @public
	 * @param {Number} coordinate - The coordinate in pixels.
	 */
    Owl.prototype.animate = function (coordinate) {
        var animate = this.speed() > 0;

        this.is('animating') && this.onTransitionEnd();

        if (animate) {
            this.enter('animating');
            this.trigger('translate');
        }

        if ($.support.transform3d && $.support.transition) {
            this.$stage.css({
                transform: 'translate3d(' + coordinate + 'px,0px,0px)',
                transition: (this.speed() / 1000) + 's' + (
                    this.settings.slideTransition ? ' ' + this.settings.slideTransition : ''
                )
            });
        } else if (animate) {
            this.$stage.animate({
                left: coordinate + 'px'
            }, this.speed(), this.settings.fallbackEasing, $.proxy(this.onTransitionEnd, this));
        } else {
            this.$stage.css({
                left: coordinate + 'px'
            });
        }
    };

	/**
	 * Checks whether the carousel is in a specific state or not.
	 * @param {String} state - The state to check.
	 * @returns {Boolean} - The flag which indicates if the carousel is busy.
	 */
    Owl.prototype.is = function (state) {
        return this._states.current[state] && this._states.current[state] > 0;
    };

	/**
	 * Sets the absolute position of the current item.
	 * @public
	 * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
	 * @returns {Number} - The absolute position of the current item.
	 */
    Owl.prototype.current = function (position) {
        if (position === undefined) {
            return this._current;
        }

        if (this._items.length === 0) {
            return undefined;
        }

        position = this.normalize(position);

        if (this._current !== position) {
            var event = this.trigger('change', { property: { name: 'position', value: position } });

            if (event.data !== undefined) {
                position = this.normalize(event.data);
            }

            this._current = position;

            this.invalidate('position');

            this.trigger('changed', { property: { name: 'position', value: this._current } });
        }

        return this._current;
    };

	/**
	 * Invalidates the given part of the update routine.
	 * @param {String} [part] - The part to invalidate.
	 * @returns {Array.<String>} - The invalidated parts.
	 */
    Owl.prototype.invalidate = function (part) {
        if ($.type(part) === 'string') {
            this._invalidated[part] = true;
            this.is('valid') && this.leave('valid');
        }
        return $.map(this._invalidated, function (v, i) { return i });
    };

	/**
	 * Resets the absolute position of the current item.
	 * @public
	 * @param {Number} position - The absolute position of the new item.
	 */
    Owl.prototype.reset = function (position) {
        position = this.normalize(position);

        if (position === undefined) {
            return;
        }

        this._speed = 0;
        this._current = position;

        this.suppress(['translate', 'translated']);

        this.animate(this.coordinates(position));

        this.release(['translate', 'translated']);
    };

	/**
	 * Normalizes an absolute or a relative position of an item.
	 * @public
	 * @param {Number} position - The absolute or relative position to normalize.
	 * @param {Boolean} [relative=false] - Whether the given position is relative or not.
	 * @returns {Number} - The normalized position.
	 */
    Owl.prototype.normalize = function (position, relative) {
        var n = this._items.length,
            m = relative ? 0 : this._clones.length;

        if (!this.isNumeric(position) || n < 1) {
            position = undefined;
        } else if (position < 0 || position >= n + m) {
            position = ((position - m / 2) % n + n) % n + m / 2;
        }

        return position;
    };

	/**
	 * Converts an absolute position of an item into a relative one.
	 * @public
	 * @param {Number} position - The absolute position to convert.
	 * @returns {Number} - The converted position.
	 */
    Owl.prototype.relative = function (position) {
        position -= this._clones.length / 2;
        return this.normalize(position, true);
    };

	/**
	 * Gets the maximum position for the current item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
    Owl.prototype.maximum = function (relative) {
        var settings = this.settings,
            maximum = this._coordinates.length,
            iterator,
            reciprocalItemsWidth,
            elementWidth;

        if (settings.loop) {
            maximum = this._clones.length / 2 + this._items.length - 1;
        } else if (settings.autoWidth || settings.merge) {
            iterator = this._items.length;
            if (iterator) {
                reciprocalItemsWidth = this._items[--iterator].width();
                elementWidth = this.$element.width();
                while (iterator--) {
                    reciprocalItemsWidth += this._items[iterator].width() + this.settings.margin;
                    if (reciprocalItemsWidth > elementWidth) {
                        break;
                    }
                }
            }
            maximum = iterator + 1;
        } else if (settings.center) {
            maximum = this._items.length - 1;
        } else {
            maximum = this._items.length - settings.items;
        }

        if (relative) {
            maximum -= this._clones.length / 2;
        }

        return Math.max(maximum, 0);
    };

	/**
	 * Gets the minimum position for the current item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
    Owl.prototype.minimum = function (relative) {
        return relative ? 0 : this._clones.length / 2;
    };

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
    Owl.prototype.items = function (position) {
        if (position === undefined) {
            return this._items.slice();
        }

        position = this.normalize(position, true);
        return this._items[position];
    };

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
    Owl.prototype.mergers = function (position) {
        if (position === undefined) {
            return this._mergers.slice();
        }

        position = this.normalize(position, true);
        return this._mergers[position];
    };

	/**
	 * Gets the absolute positions of clones for an item.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
	 */
    Owl.prototype.clones = function (position) {
        var odd = this._clones.length / 2,
            even = odd + this._items.length,
            map = function (index) { return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2 };

        if (position === undefined) {
            return $.map(this._clones, function (v, i) { return map(i) });
        }

        return $.map(this._clones, function (v, i) { return v === position ? map(i) : null });
    };

	/**
	 * Sets the current animation speed.
	 * @public
	 * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
	 * @returns {Number} - The current animation speed in milliseconds.
	 */
    Owl.prototype.speed = function (speed) {
        if (speed !== undefined) {
            this._speed = speed;
        }

        return this._speed;
    };

	/**
	 * Gets the coordinate of an item.
	 * @todo The name of this method is missleanding.
	 * @public
	 * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
	 * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
	 */
    Owl.prototype.coordinates = function (position) {
        var multiplier = 1,
            newPosition = position - 1,
            coordinate;

        if (position === undefined) {
            return $.map(this._coordinates, $.proxy(function (coordinate, index) {
                return this.coordinates(index);
            }, this));
        }

        if (this.settings.center) {
            if (this.settings.rtl) {
                multiplier = -1;
                newPosition = position + 1;
            }

            coordinate = this._coordinates[position];
            coordinate += (this.width() - coordinate + (this._coordinates[newPosition] || 0)) / 2 * multiplier;
        } else {
            coordinate = this._coordinates[newPosition] || 0;
        }

        coordinate = Math.ceil(coordinate);

        return coordinate;
    };

	/**
	 * Calculates the speed for a translation.
	 * @protected
	 * @param {Number} from - The absolute position of the start item.
	 * @param {Number} to - The absolute position of the target item.
	 * @param {Number} [factor=undefined] - The time factor in milliseconds.
	 * @returns {Number} - The time in milliseconds for the translation.
	 */
    Owl.prototype.duration = function (from, to, factor) {
        if (factor === 0) {
            return 0;
        }

        return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
    };

	/**
	 * Slides to the specified item.
	 * @public
	 * @param {Number} position - The position of the item.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
    Owl.prototype.to = function (position, speed) {
        var current = this.current(),
            revert = null,
            distance = position - this.relative(current),
            direction = (distance > 0) - (distance < 0),
            items = this._items.length,
            minimum = this.minimum(),
            maximum = this.maximum();

        if (this.settings.loop) {
            if (!this.settings.rewind && Math.abs(distance) > items / 2) {
                distance += direction * -1 * items;
            }

            position = current + distance;
            revert = ((position - minimum) % items + items) % items + minimum;

            if (revert !== position && revert - distance <= maximum && revert - distance > 0) {
                current = revert - distance;
                position = revert;
                this.reset(current);
            }
        } else if (this.settings.rewind) {
            maximum += 1;
            position = (position % maximum + maximum) % maximum;
        } else {
            position = Math.max(minimum, Math.min(maximum, position));
        }

        this.speed(this.duration(current, position, speed));
        this.current(position);

        if (this.isVisible()) {
            this.update();
        }
    };

	/**
	 * Slides to the next item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
    Owl.prototype.next = function (speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) + 1, speed);
    };

	/**
	 * Slides to the previous item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
    Owl.prototype.prev = function (speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) - 1, speed);
    };

	/**
	 * Handles the end of an animation.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
    Owl.prototype.onTransitionEnd = function (event) {

        // if css2 animation then event object is undefined
        if (event !== undefined) {
            event.stopPropagation();

            // Catch only owl-stage transitionEnd event
            if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
                return false;
            }
        }

        this.leave('animating');
        this.trigger('translated');
    };

	/**
	 * Gets viewport width.
	 * @protected
	 * @return {Number} - The width in pixel.
	 */
    Owl.prototype.viewport = function () {
        var width;
        if (this.options.responsiveBaseElement !== window) {
            width = $(this.options.responsiveBaseElement).width();
        } else if (window.innerWidth) {
            width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
        } else {
            console.warn('Can not detect viewport width.');
        }
        return width;
    };

	/**
	 * Replaces the current content.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The new content.
	 */
    Owl.prototype.replace = function (content) {
        this.$stage.empty();
        this._items = [];

        if (content) {
            content = (content instanceof jQuery) ? content : $(content);
        }

        if (this.settings.nestedItemSelector) {
            content = content.find('.' + this.settings.nestedItemSelector);
        }

        content.filter(function () {
            return this.nodeType === 1;
        }).each($.proxy(function (index, item) {
            item = this.prepare(item);
            this.$stage.append(item);
            this._items.push(item);
            this._mergers.push(item.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        }, this));

        this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

        this.invalidate('items');
    };

	/**
	 * Adds an item.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The item content to add.
	 * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
	 */
    Owl.prototype.add = function (content, position) {
        var current = this.relative(this._current);

        position = position === undefined ? this._items.length : this.normalize(position, true);
        content = content instanceof jQuery ? content : $(content);

        this.trigger('add', { content: content, position: position });

        content = this.prepare(content);

        if (this._items.length === 0 || position === this._items.length) {
            this._items.length === 0 && this.$stage.append(content);
            this._items.length !== 0 && this._items[position - 1].after(content);
            this._items.push(content);
            this._mergers.push(content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        } else {
            this._items[position].before(content);
            this._items.splice(position, 0, content);
            this._mergers.splice(position, 0, content.find('[data-merge]').addBack('[data-merge]').attr('data-merge') * 1 || 1);
        }

        this._items[current] && this.reset(this._items[current].index());

        this.invalidate('items');

        this.trigger('added', { content: content, position: position });
    };

	/**
	 * Removes an item by its position.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {Number} position - The relative position of the item to remove.
	 */
    Owl.prototype.remove = function (position) {
        position = this.normalize(position, true);

        if (position === undefined) {
            return;
        }

        this.trigger('remove', { content: this._items[position], position: position });

        this._items[position].remove();
        this._items.splice(position, 1);
        this._mergers.splice(position, 1);

        this.invalidate('items');

        this.trigger('removed', { content: null, position: position });
    };

	/**
	 * Preloads images with auto width.
	 * @todo Replace by a more generic approach
	 * @protected
	 */
    Owl.prototype.preloadAutoWidthImages = function (images) {
        images.each($.proxy(function (i, element) {
            this.enter('pre-loading');
            element = $(element);
            $(new Image()).one('load', $.proxy(function (e) {
                element.attr('src', e.target.src);
                element.css('opacity', 1);
                this.leave('pre-loading');
                !this.is('pre-loading') && !this.is('initializing') && this.refresh();
            }, this)).attr('src', element.attr('src') || element.attr('data-src') || element.attr('data-src-retina'));
        }, this));
    };

	/**
	 * Destroys the carousel.
	 * @public
	 */
    Owl.prototype.destroy = function () {

        this.$element.off('.owl.core');
        this.$stage.off('.owl.core');
        $(document).off('.owl.core');

        if (this.settings.responsive !== false) {
            window.clearTimeout(this.resizeTimer);
            this.off(window, 'resize', this._handlers.onThrottledResize);
        }

        for (var i in this._plugins) {
            this._plugins[i].destroy();
        }

        this.$stage.children('.cloned').remove();

        this.$stage.unwrap();
        this.$stage.children().contents().unwrap();
        this.$stage.children().unwrap();
        this.$stage.remove();
        this.$element
            .removeClass(this.options.refreshClass)
            .removeClass(this.options.loadingClass)
            .removeClass(this.options.loadedClass)
            .removeClass(this.options.rtlClass)
            .removeClass(this.options.dragClass)
            .removeClass(this.options.grabClass)
            .attr('class', this.$element.attr('class').replace(new RegExp(this.options.responsiveClass + '-\\S+\\s', 'g'), ''))
            .removeData('owl.carousel');
    };

	/**
	 * Operators to calculate right-to-left and left-to-right.
	 * @protected
	 * @param {Number} [a] - The left side operand.
	 * @param {String} [o] - The operator.
	 * @param {Number} [b] - The right side operand.
	 */
    Owl.prototype.op = function (a, o, b) {
        var rtl = this.settings.rtl;
        switch (o) {
            case '<':
                return rtl ? a > b : a < b;
            case '>':
                return rtl ? a < b : a > b;
            case '>=':
                return rtl ? a <= b : a >= b;
            case '<=':
                return rtl ? a >= b : a <= b;
            default:
                break;
        }
    };

	/**
	 * Attaches to an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The event handler to attach.
	 * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
	 */
    Owl.prototype.on = function (element, event, listener, capture) {
        if (element.addEventListener) {
            element.addEventListener(event, listener, capture);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, listener);
        }
    };

	/**
	 * Detaches from an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The attached event handler to detach.
	 * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
	 */
    Owl.prototype.off = function (element, event, listener, capture) {
        if (element.removeEventListener) {
            element.removeEventListener(event, listener, capture);
        } else if (element.detachEvent) {
            element.detachEvent('on' + event, listener);
        }
    };

	/**
	 * Triggers a public event.
	 * @todo Remove `status`, `relatedTarget` should be used instead.
	 * @protected
	 * @param {String} name - The event name.
	 * @param {*} [data=null] - The event data.
	 * @param {String} [namespace=carousel] - The event namespace.
	 * @param {String} [state] - The state which is associated with the event.
	 * @param {Boolean} [enter=false] - Indicates if the call enters the specified state or not.
	 * @returns {Event} - The event arguments.
	 */
    Owl.prototype.trigger = function (name, data, namespace, state, enter) {
        var status = {
            item: { count: this._items.length, index: this.current() }
        }, handler = $.camelCase(
            $.grep(['on', name, namespace], function (v) { return v })
                .join('-').toLowerCase()
        ), event = $.Event(
            [name, 'owl', namespace || 'carousel'].join('.').toLowerCase(),
            $.extend({ relatedTarget: this }, status, data)
        );

        if (!this._supress[name]) {
            $.each(this._plugins, function (name, plugin) {
                if (plugin.onTrigger) {
                    plugin.onTrigger(event);
                }
            });

            this.register({ type: Owl.Type.Event, name: name });
            this.$element.trigger(event);

            if (this.settings && typeof this.settings[handler] === 'function') {
                this.settings[handler].call(this, event);
            }
        }

        return event;
    };

	/**
	 * Enters a state.
	 * @param name - The state name.
	 */
    Owl.prototype.enter = function (name) {
        $.each([name].concat(this._states.tags[name] || []), $.proxy(function (i, name) {
            if (this._states.current[name] === undefined) {
                this._states.current[name] = 0;
            }

            this._states.current[name]++;
        }, this));
    };

	/**
	 * Leaves a state.
	 * @param name - The state name.
	 */
    Owl.prototype.leave = function (name) {
        $.each([name].concat(this._states.tags[name] || []), $.proxy(function (i, name) {
            this._states.current[name]--;
        }, this));
    };

	/**
	 * Registers an event or state.
	 * @public
	 * @param {Object} object - The event or state to register.
	 */
    Owl.prototype.register = function (object) {
        if (object.type === Owl.Type.Event) {
            if (!$.event.special[object.name]) {
                $.event.special[object.name] = {};
            }

            if (!$.event.special[object.name].owl) {
                var _default = $.event.special[object.name]._default;
                $.event.special[object.name]._default = function (e) {
                    if (_default && _default.apply && (!e.namespace || e.namespace.indexOf('owl') === -1)) {
                        return _default.apply(this, arguments);
                    }
                    return e.namespace && e.namespace.indexOf('owl') > -1;
                };
                $.event.special[object.name].owl = true;
            }
        } else if (object.type === Owl.Type.State) {
            if (!this._states.tags[object.name]) {
                this._states.tags[object.name] = object.tags;
            } else {
                this._states.tags[object.name] = this._states.tags[object.name].concat(object.tags);
            }

            this._states.tags[object.name] = $.grep(this._states.tags[object.name], $.proxy(function (tag, i) {
                return $.inArray(tag, this._states.tags[object.name]) === i;
            }, this));
        }
    };

	/**
	 * Suppresses events.
	 * @protected
	 * @param {Array.<String>} events - The events to suppress.
	 */
    Owl.prototype.suppress = function (events) {
        $.each(events, $.proxy(function (index, event) {
            this._supress[event] = true;
        }, this));
    };

	/**
	 * Releases suppressed events.
	 * @protected
	 * @param {Array.<String>} events - The events to release.
	 */
    Owl.prototype.release = function (events) {
        $.each(events, $.proxy(function (index, event) {
            delete this._supress[event];
        }, this));
    };

	/**
	 * Gets unified pointer coordinates from event.
	 * @todo #261
	 * @protected
	 * @param {Event} - The `mousedown` or `touchstart` event.
	 * @returns {Object} - Contains `x` and `y` coordinates of current pointer position.
	 */
    Owl.prototype.pointer = function (event) {
        var result = { x: null, y: null };

        event = event.originalEvent || event || window.event;

        event = event.touches && event.touches.length ?
            event.touches[0] : event.changedTouches && event.changedTouches.length ?
                event.changedTouches[0] : event;

        if (event.pageX) {
            result.x = event.pageX;
            result.y = event.pageY;
        } else {
            result.x = event.clientX;
            result.y = event.clientY;
        }

        return result;
    };

	/**
	 * Determines if the input is a Number or something that can be coerced to a Number
	 * @protected
	 * @param {Number|String|Object|Array|Boolean|RegExp|Function|Symbol} - The input to be tested
	 * @returns {Boolean} - An indication if the input is a Number or can be coerced to a Number
	 */
    Owl.prototype.isNumeric = function (number) {
        return !isNaN(parseFloat(number));
    };

	/**
	 * Gets the difference of two vectors.
	 * @todo #261
	 * @protected
	 * @param {Object} - The first vector.
	 * @param {Object} - The second vector.
	 * @returns {Object} - The difference.
	 */
    Owl.prototype.difference = function (first, second) {
        return {
            x: first.x - second.x,
            y: first.y - second.y
        };
    };

	/**
	 * The jQuery Plugin for the Owl Carousel
	 * @todo Navigation plugin `next` and `prev`
	 * @public
	 */
    $.fn.owlCarousel = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this = $(this),
                data = $this.data('owl.carousel');

            if (!data) {
                data = new Owl(this, typeof option == 'object' && option);
                $this.data('owl.carousel', data);

                $.each([
                    'next', 'prev', 'to', 'destroy', 'refresh', 'replace', 'add', 'remove'
                ], function (i, event) {
                    data.register({ type: Owl.Type.Event, name: event });
                    data.$element.on(event + '.owl.carousel.core', $.proxy(function (e) {
                        if (e.namespace && e.relatedTarget !== this) {
                            this.suppress([event]);
                            data[event].apply(this, [].slice.call(arguments, 1));
                            this.release([event]);
                        }
                    }, data));
                });
            }

            if (typeof option == 'string' && option.charAt(0) !== '_') {
                data[option].apply(data, args);
            }
        });
    };

	/**
	 * The constructor for the jQuery Plugin
	 * @public
	 */
    $.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoRefresh Plugin
 * @version 2.3.4
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the auto refresh plugin.
	 * @class The Auto Refresh Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
    var AutoRefresh = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * Refresh interval.
		 * @protected
		 * @type {number}
		 */
        this._interval = null;

		/**
		 * Whether the element is currently visible or not.
		 * @protected
		 * @type {Boolean}
		 */
        this._visible = null;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.autoRefresh) {
                    this.watch();
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, AutoRefresh.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);
    };

	/**
	 * Default options.
	 * @public
	 */
    AutoRefresh.Defaults = {
        autoRefresh: true,
        autoRefreshInterval: 500
    };

	/**
	 * Watches the element.
	 */
    AutoRefresh.prototype.watch = function () {
        if (this._interval) {
            return;
        }

        this._visible = this._core.isVisible();
        this._interval = window.setInterval($.proxy(this.refresh, this), this._core.settings.autoRefreshInterval);
    };

	/**
	 * Refreshes the element.
	 */
    AutoRefresh.prototype.refresh = function () {
        if (this._core.isVisible() === this._visible) {
            return;
        }

        this._visible = !this._visible;

        this._core.$element.toggleClass('owl-hidden', !this._visible);

        this._visible && (this._core.invalidate('width') && this._core.refresh());
    };

	/**
	 * Destroys the plugin.
	 */
    AutoRefresh.prototype.destroy = function () {
        var handler, property;

        window.clearInterval(this._interval);

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.AutoRefresh = AutoRefresh;

})(window.Zepto || window.jQuery, window, document);

/**
 * Lazy Plugin
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the lazy plugin.
	 * @class The Lazy Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
    var Lazy = function (carousel) {

		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * Already loaded items.
		 * @protected
		 * @type {Array.<jQuery>}
		 */
        this._loaded = [];

		/**
		 * Event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'initialized.owl.carousel change.owl.carousel resized.owl.carousel': $.proxy(function (e) {
                if (!e.namespace) {
                    return;
                }

                if (!this._core.settings || !this._core.settings.lazyLoad) {
                    return;
                }

                if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
                    var settings = this._core.settings,
                        n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
                        i = ((settings.center && n * -1) || 0),
                        position = (e.property && e.property.value !== undefined ? e.property.value : this._core.current()) + i,
                        clones = this._core.clones().length,
                        load = $.proxy(function (i, v) { this.load(v) }, this);
                    //TODO: Need documentation for this new option
                    if (settings.lazyLoadEager > 0) {
                        n += settings.lazyLoadEager;
                        // If the carousel is looping also preload images that are to the "left"
                        if (settings.loop) {
                            position -= settings.lazyLoadEager;
                            n++;
                        }
                    }

                    while (i++ < n) {
                        this.load(clones / 2 + this._core.relative(position));
                        clones && $.each(this._core.clones(this._core.relative(position)), load);
                        position++;
                    }
                }
            }, this)
        };

        // set the default options
        this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

        // register event handler
        this._core.$element.on(this._handlers);
    };

	/**
	 * Default options.
	 * @public
	 */
    Lazy.Defaults = {
        lazyLoad: false,
        lazyLoadEager: 0
    };

	/**
	 * Loads all resources of an item at the specified position.
	 * @param {Number} position - The absolute position of the item.
	 * @protected
	 */
    Lazy.prototype.load = function (position) {
        var $item = this._core.$stage.children().eq(position),
            $elements = $item && $item.find('.owl-lazy');

        if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
            return;
        }

        $elements.each($.proxy(function (index, element) {
            var $element = $(element), image,
                url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src') || $element.attr('data-srcset');

            this._core.trigger('load', { element: $element, url: url }, 'lazy');

            if ($element.is('img')) {
                $element.one('load.owl.lazy', $.proxy(function () {
                    $element.css('opacity', 1);
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this)).attr('src', url);
            } else if ($element.is('source')) {
                $element.one('load.owl.lazy', $.proxy(function () {
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this)).attr('srcset', url);
            } else {
                image = new Image();
                image.onload = $.proxy(function () {
                    $element.css({
                        'background-image': 'url("' + url + '")',
                        'opacity': '1'
                    });
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this);
                image.src = url;
            }
        }, this));

        this._loaded.push($item.get(0));
    };

	/**
	 * Destroys the plugin.
	 * @public
	 */
    Lazy.prototype.destroy = function () {
        var handler, property;

        for (handler in this.handlers) {
            this._core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the auto height plugin.
	 * @class The Auto Height Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
    var AutoHeight = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

        this._previousHeight = null;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'initialized.owl.carousel refreshed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.autoHeight) {
                    this.update();
                }
            }, this),
            'changed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.autoHeight && e.property.name === 'position') {
                    this.update();
                }
            }, this),
            'loaded.owl.lazy': $.proxy(function (e) {
                if (e.namespace && this._core.settings.autoHeight
                    && e.element.closest('.' + this._core.settings.itemClass).index() === this._core.current()) {
                    this.update();
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);
        this._intervalId = null;
        var refThis = this;

        // These changes have been taken from a PR by gavrochelegnou proposed in #1575
        // and have been made compatible with the latest jQuery version
        $(window).on('load', function () {
            if (refThis._core.settings.autoHeight) {
                refThis.update();
            }
        });

        // Autoresize the height of the carousel when window is resized
        // When carousel has images, the height is dependent on the width
        // and should also change on resize
        $(window).resize(function () {
            if (refThis._core.settings.autoHeight) {
                if (refThis._intervalId != null) {
                    clearTimeout(refThis._intervalId);
                }

                refThis._intervalId = setTimeout(function () {
                    refThis.update();
                }, 250);
            }
        });

    };

	/**
	 * Default options.
	 * @public
	 */
    AutoHeight.Defaults = {
        autoHeight: false,
        autoHeightClass: 'owl-height'
    };

	/**
	 * Updates the view.
	 */
    AutoHeight.prototype.update = function () {
        var start = this._core._current,
            end = start + this._core.settings.items,
            lazyLoadEnabled = this._core.settings.lazyLoad,
            visible = this._core.$stage.children().toArray().slice(start, end),
            heights = [],
            maxheight = 0;

        $.each(visible, function (index, item) {
            heights.push($(item).height());
        });

        maxheight = Math.max.apply(null, heights);

        if (maxheight <= 1 && lazyLoadEnabled && this._previousHeight) {
            maxheight = this._previousHeight;
        }

        this._previousHeight = maxheight;

        this._core.$stage.parent()
            .height(maxheight)
            .addClass(this._core.settings.autoHeightClass);
    };

    AutoHeight.prototype.destroy = function () {
        var handler, property;

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] !== 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the video plugin.
	 * @class The Video Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
    var Video = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * Cache all video URLs.
		 * @protected
		 * @type {Object}
		 */
        this._videos = {};

		/**
		 * Current playing item.
		 * @protected
		 * @type {jQuery}
		 */
        this._playing = null;

		/**
		 * All event handlers.
		 * @todo The cloned content removale is too late
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function (e) {
                if (e.namespace) {
                    this._core.register({ type: 'state', name: 'playing', tags: ['interacting'] });
                }
            }, this),
            'resize.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.video && this.isInFullScreen()) {
                    e.preventDefault();
                }
            }, this),
            'refreshed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.is('resizing')) {
                    this._core.$stage.find('.cloned .owl-video-frame').remove();
                }
            }, this),
            'changed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && e.property.name === 'position' && this._playing) {
                    this.stop();
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function (e) {
                if (!e.namespace) {
                    return;
                }

                var $element = $(e.content).find('.owl-video');

                if ($element.length) {
                    $element.css('display', 'none');
                    this.fetch($element, $(e.content));
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Video.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);

        this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function (e) {
            this.play(e);
        }, this));
    };

	/**
	 * Default options.
	 * @public
	 */
    Video.Defaults = {
        video: false,
        videoHeight: false,
        videoWidth: false
    };

	/**
	 * Gets the video ID and the type (YouTube/Vimeo/vzaar only).
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {jQuery} item - The item containing the video.
	 */
    Video.prototype.fetch = function (target, item) {
        var type = (function () {
            if (target.attr('data-vimeo-id')) {
                return 'vimeo';
            } else if (target.attr('data-vzaar-id')) {
                return 'vzaar'
            } else {
                return 'youtube';
            }
        })(),
            id = target.attr('data-vimeo-id') || target.attr('data-youtube-id') || target.attr('data-vzaar-id'),
            width = target.attr('data-width') || this._core.settings.videoWidth,
            height = target.attr('data-height') || this._core.settings.videoHeight,
            url = target.attr('href');

        if (url) {

			/*
					Parses the id's out of the following urls (and probably more):
					https://www.youtube.com/watch?v=:id
					https://youtu.be/:id
					https://vimeo.com/:id
					https://vimeo.com/channels/:channel/:id
					https://vimeo.com/groups/:group/videos/:id
					https://app.vzaar.com/videos/:id

					Visual example: https://regexper.com/#(http%3A%7Chttps%3A%7C)%5C%2F%5C%2F(player.%7Cwww.%7Capp.)%3F(vimeo%5C.com%7Cyoutu(be%5C.com%7C%5C.be%7Cbe%5C.googleapis%5C.com)%7Cvzaar%5C.com)%5C%2F(video%5C%2F%7Cvideos%5C%2F%7Cembed%5C%2F%7Cchannels%5C%2F.%2B%5C%2F%7Cgroups%5C%2F.%2B%5C%2F%7Cwatch%5C%3Fv%3D%7Cv%5C%2F)%3F(%5BA-Za-z0-9._%25-%5D*)(%5C%26%5CS%2B)%3F
			*/

            id = url.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

            if (id[3].indexOf('youtu') > -1) {
                type = 'youtube';
            } else if (id[3].indexOf('vimeo') > -1) {
                type = 'vimeo';
            } else if (id[3].indexOf('vzaar') > -1) {
                type = 'vzaar';
            } else {
                throw new Error('Video URL not supported.');
            }
            id = id[6];
        } else {
            throw new Error('Missing video URL.');
        }

        this._videos[url] = {
            type: type,
            id: id,
            width: width,
            height: height
        };

        item.attr('data-video', url);

        this.thumbnail(target, this._videos[url]);
    };

	/**
	 * Creates video thumbnail.
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {Object} info - The video info object.
	 * @see `fetch`
	 */
    Video.prototype.thumbnail = function (target, video) {
        var tnLink,
            icon,
            path,
            dimensions = video.width && video.height ? 'width:' + video.width + 'px;height:' + video.height + 'px;' : '',
            customTn = target.find('img'),
            srcType = 'src',
            lazyClass = '',
            settings = this._core.settings,
            create = function (path) {
                icon = '<div class="owl-video-play-icon"></div>';

                if (settings.lazyLoad) {
                    tnLink = $('<div/>', {
                        "class": 'owl-video-tn ' + lazyClass,
                        "srcType": path
                    });
                } else {
                    tnLink = $('<div/>', {
                        "class": "owl-video-tn",
                        "style": 'opacity:1;background-image:url(' + path + ')'
                    });
                }
                target.after(tnLink);
                target.after(icon);
            };

        // wrap video content into owl-video-wrapper div
        target.wrap($('<div/>', {
            "class": "owl-video-wrapper",
            "style": dimensions
        }));

        if (this._core.settings.lazyLoad) {
            srcType = 'data-src';
            lazyClass = 'owl-lazy';
        }

        // custom thumbnail
        if (customTn.length) {
            create(customTn.attr(srcType));
            customTn.remove();
            return false;
        }

        if (video.type === 'youtube') {
            path = "//img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
            create(path);
        } else if (video.type === 'vimeo') {
            $.ajax({
                type: 'GET',
                url: '//vimeo.com/api/v2/video/' + video.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function (data) {
                    path = data[0].thumbnail_large;
                    create(path);
                }
            });
        } else if (video.type === 'vzaar') {
            $.ajax({
                type: 'GET',
                url: '//vzaar.com/api/videos/' + video.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function (data) {
                    path = data.framegrab_url;
                    create(path);
                }
            });
        }
    };

	/**
	 * Stops the current video.
	 * @public
	 */
    Video.prototype.stop = function () {
        this._core.trigger('stop', null, 'video');
        this._playing.find('.owl-video-frame').remove();
        this._playing.removeClass('owl-video-playing');
        this._playing = null;
        this._core.leave('playing');
        this._core.trigger('stopped', null, 'video');
    };

	/**
	 * Starts the current video.
	 * @public
	 * @param {Event} event - The event arguments.
	 */
    Video.prototype.play = function (event) {
        var target = $(event.target),
            item = target.closest('.' + this._core.settings.itemClass),
            video = this._videos[item.attr('data-video')],
            width = video.width || '100%',
            height = video.height || this._core.$stage.height(),
            html,
            iframe;

        if (this._playing) {
            return;
        }

        this._core.enter('playing');
        this._core.trigger('play', null, 'video');

        item = this._core.items(this._core.relative(item.index()));

        this._core.reset(item.index());

        html = $('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>');
        html.attr('height', height);
        html.attr('width', width);
        if (video.type === 'youtube') {
            html.attr('src', '//www.youtube.com/embed/' + video.id + '?autoplay=1&rel=0&v=' + video.id);
        } else if (video.type === 'vimeo') {
            html.attr('src', '//player.vimeo.com/video/' + video.id + '?autoplay=1');
        } else if (video.type === 'vzaar') {
            html.attr('src', '//view.vzaar.com/' + video.id + '/player?autoplay=true');
        }

        iframe = $(html).wrap('<div class="owl-video-frame" />').insertAfter(item.find('.owl-video'));

        this._playing = item.addClass('owl-video-playing');
    };

	/**
	 * Checks whether an video is currently in full screen mode or not.
	 * @todo Bad style because looks like a readonly method but changes members.
	 * @protected
	 * @returns {Boolean}
	 */
    Video.prototype.isInFullScreen = function () {
        var element = document.fullscreenElement || document.mozFullScreenElement ||
            document.webkitFullscreenElement;

        return element && $(element).parent().hasClass('owl-video-frame');
    };

	/**
	 * Destroys the plugin.
	 */
    Video.prototype.destroy = function () {
        var handler, property;

        this._core.$element.off('click.owl.video');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the animate plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
    var Animate = function (scope) {
        this.core = scope;
        this.core.options = $.extend({}, Animate.Defaults, this.core.options);
        this.swapping = true;
        this.previous = undefined;
        this.next = undefined;

        this.handlers = {
            'change.owl.carousel': $.proxy(function (e) {
                if (e.namespace && e.property.name == 'position') {
                    this.previous = this.core.current();
                    this.next = e.property.value;
                }
            }, this),
            'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function (e) {
                if (e.namespace) {
                    this.swapping = e.type == 'translated';
                }
            }, this),
            'translate.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
                    this.swap();
                }
            }, this)
        };

        this.core.$element.on(this.handlers);
    };

	/**
	 * Default options.
	 * @public
	 */
    Animate.Defaults = {
        animateOut: false,
        animateIn: false
    };

	/**
	 * Toggles the animation classes whenever an translations starts.
	 * @protected
	 * @returns {Boolean|undefined}
	 */
    Animate.prototype.swap = function () {

        if (this.core.settings.items !== 1) {
            return;
        }

        if (!$.support.animation || !$.support.transition) {
            return;
        }

        this.core.speed(0);

        var left,
            clear = $.proxy(this.clear, this),
            previous = this.core.$stage.children().eq(this.previous),
            next = this.core.$stage.children().eq(this.next),
            incoming = this.core.settings.animateIn,
            outgoing = this.core.settings.animateOut;

        if (this.core.current() === this.previous) {
            return;
        }

        if (outgoing) {
            left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
            previous.one($.support.animation.end, clear)
                .css({ 'left': left + 'px' })
                .addClass('animated owl-animated-out')
                .addClass(outgoing);
        }

        if (incoming) {
            next.one($.support.animation.end, clear)
                .addClass('animated owl-animated-in')
                .addClass(incoming);
        }
    };

    Animate.prototype.clear = function (e) {
        $(e.target).css({ 'left': '' })
            .removeClass('animated owl-animated-out owl-animated-in')
            .removeClass(this.core.settings.animateIn)
            .removeClass(this.core.settings.animateOut);
        this.core.onTransitionEnd();
    };

	/**
	 * Destroys the plugin.
	 * @public
	 */
    Animate.prototype.destroy = function () {
        var handler, property;

        for (handler in this.handlers) {
            this.core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.3.4
 * @author Bartosz Wojciechowski
 * @author Artus Kolanowski
 * @author David Deutsch
 * @author Tom De Caluwé
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

	/**
	 * Creates the autoplay plugin.
	 * @class The Autoplay Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
    var Autoplay = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * The autoplay timeout id.
		 * @type {Number}
		 */
        this._call = null;

		/**
		 * Depending on the state of the plugin, this variable contains either
		 * the start time of the timer or the current timer value if it's
		 * paused. Since we start in a paused state we initialize the timer
		 * value.
		 * @type {Number}
		 */
        this._time = 0;

		/**
		 * Stores the timeout currently used.
		 * @type {Number}
		 */
        this._timeout = 0;

		/**
		 * Indicates whenever the autoplay is paused.
		 * @type {Boolean}
		 */
        this._paused = true;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'changed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && e.property.name === 'settings') {
                    if (this._core.settings.autoplay) {
                        this.play();
                    } else {
                        this.stop();
                    }
                } else if (e.namespace && e.property.name === 'position' && this._paused) {
                    // Reset the timer. This code is triggered when the position
                    // of the carousel was changed through user interaction.
                    this._time = 0;
                }
            }, this),
            'initialized.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.autoplay) {
                    this.play();
                }
            }, this),
            'play.owl.autoplay': $.proxy(function (e, t, s) {
                if (e.namespace) {
                    this.play(t, s);
                }
            }, this),
            'stop.owl.autoplay': $.proxy(function (e) {
                if (e.namespace) {
                    this.stop();
                }
            }, this),
            'mouseover.owl.autoplay': $.proxy(function () {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.pause();
                }
            }, this),
            'mouseleave.owl.autoplay': $.proxy(function () {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.play();
                }
            }, this),
            'touchstart.owl.core': $.proxy(function () {
                if (this._core.settings.autoplayHoverPause && this._core.is('rotating')) {
                    this.pause();
                }
            }, this),
            'touchend.owl.core': $.proxy(function () {
                if (this._core.settings.autoplayHoverPause) {
                    this.play();
                }
            }, this)
        };

        // register event handlers
        this._core.$element.on(this._handlers);

        // set default options
        this._core.options = $.extend({}, Autoplay.Defaults, this._core.options);
    };

	/**
	 * Default options.
	 * @public
	 */
    Autoplay.Defaults = {
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoplaySpeed: false
    };

	/**
	 * Transition to the next slide and set a timeout for the next transition.
	 * @private
	 * @param {Number} [speed] - The animation speed for the animations.
	 */
    Autoplay.prototype._next = function (speed) {
        this._call = window.setTimeout(
            $.proxy(this._next, this, speed),
            this._timeout * (Math.round(this.read() / this._timeout) + 1) - this.read()
        );

        if (this._core.is('interacting') || document.hidden) {
            return;
        }
        this._core.next(speed || this._core.settings.autoplaySpeed);
    }

	/**
	 * Reads the current timer value when the timer is playing.
	 * @public
	 */
    Autoplay.prototype.read = function () {
        return new Date().getTime() - this._time;
    };

	/**
	 * Starts the autoplay.
	 * @public
	 * @param {Number} [timeout] - The interval before the next animation starts.
	 * @param {Number} [speed] - The animation speed for the animations.
	 */
    Autoplay.prototype.play = function (timeout, speed) {
        var elapsed;

        if (!this._core.is('rotating')) {
            this._core.enter('rotating');
        }

        timeout = timeout || this._core.settings.autoplayTimeout;

        // Calculate the elapsed time since the last transition. If the carousel
        // wasn't playing this calculation will yield zero.
        elapsed = Math.min(this._time % (this._timeout || timeout), timeout);

        if (this._paused) {
            // Start the clock.
            this._time = this.read();
            this._paused = false;
        } else {
            // Clear the active timeout to allow replacement.
            window.clearTimeout(this._call);
        }

        // Adjust the origin of the timer to match the new timeout value.
        this._time += this.read() % timeout - elapsed;

        this._timeout = timeout;
        this._call = window.setTimeout($.proxy(this._next, this, speed), timeout - elapsed);
    };

	/**
	 * Stops the autoplay.
	 * @public
	 */
    Autoplay.prototype.stop = function () {
        if (this._core.is('rotating')) {
            // Reset the clock.
            this._time = 0;
            this._paused = true;

            window.clearTimeout(this._call);
            this._core.leave('rotating');
        }
    };

	/**
	 * Pauses the autoplay.
	 * @public
	 */
    Autoplay.prototype.pause = function () {
        if (this._core.is('rotating') && !this._paused) {
            // Pause the clock.
            this._time = this.read();
            this._paused = true;

            window.clearTimeout(this._call);
        }
    };

	/**
	 * Destroys the plugin.
	 */
    Autoplay.prototype.destroy = function () {
        var handler, property;

        this.stop();

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.3.4
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {
    'use strict';

	/**
	 * Creates the navigation plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} carousel - The Owl Carousel.
	 */
    var Navigation = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * Indicates whether the plugin is initialized or not.
		 * @protected
		 * @type {Boolean}
		 */
        this._initialized = false;

		/**
		 * The current paging indexes.
		 * @protected
		 * @type {Array}
		 */
        this._pages = [];

		/**
		 * All DOM elements of the user interface.
		 * @protected
		 * @type {Object}
		 */
        this._controls = {};

		/**
		 * Markup for an indicator.
		 * @protected
		 * @type {Array.<String>}
		 */
        this._templates = [];

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
        this.$element = this._core.$element;

		/**
		 * Overridden methods of the carousel.
		 * @protected
		 * @type {Object}
		 */
        this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        };

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'prepared.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.push('<div class="' + this._core.settings.dotClass + '">' +
                        $(e.content).find('[data-dot]').addBack('[data-dot]').attr('data-dot') + '</div>');
                }
            }, this),
            'added.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.splice(e.position, 0, this._templates.pop());
                }
            }, this),
            'remove.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.dotsData) {
                    this._templates.splice(e.position, 1);
                }
            }, this),
            'changed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && e.property.name == 'position') {
                    this.draw();
                }
            }, this),
            'initialized.owl.carousel': $.proxy(function (e) {
                if (e.namespace && !this._initialized) {
                    this._core.trigger('initialize', null, 'navigation');
                    this.initialize();
                    this.update();
                    this.draw();
                    this._initialized = true;
                    this._core.trigger('initialized', null, 'navigation');
                }
            }, this),
            'refreshed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._initialized) {
                    this._core.trigger('refresh', null, 'navigation');
                    this.update();
                    this.draw();
                    this._core.trigger('refreshed', null, 'navigation');
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

        // register event handlers
        this.$element.on(this._handlers);
    };

	/**
	 * Default options.
	 * @public
	 * @todo Rename `slideBy` to `navBy`
	 */
    Navigation.Defaults = {
        nav: false,
        navText: [
            '<span aria-label="' + 'Previous' + '">&#x2039;</span>',
            '<span aria-label="' + 'Next' + '">&#x203a;</span>'
        ],
        navSpeed: false,
        navElement: 'button type="button" role="presentation"',
        navContainer: false,
        navContainerClass: 'owl-nav',
        navClass: [
            'owl-prev',
            'owl-next'
        ],
        slideBy: 1,
        dotClass: 'owl-dot',
        dotsClass: 'owl-dots',
        dots: true,
        dotsEach: false,
        dotsData: false,
        dotsSpeed: false,
        dotsContainer: false
    };

	/**
	 * Initializes the layout of the plugin and extends the carousel.
	 * @protected
	 */
    Navigation.prototype.initialize = function () {
        var override,
            settings = this._core.settings;

        // create DOM structure for relative navigation
        this._controls.$relative = (settings.navContainer ? $(settings.navContainer)
            : $('<div>').addClass(settings.navContainerClass).appendTo(this.$element)).addClass('disabled');

        this._controls.$previous = $('<' + settings.navElement + '>')
            .addClass(settings.navClass[0])
            .html(settings.navText[0])
            .prependTo(this._controls.$relative)
            .on('click', $.proxy(function (e) {
                this.prev(settings.navSpeed);
            }, this));
        this._controls.$next = $('<' + settings.navElement + '>')
            .addClass(settings.navClass[1])
            .html(settings.navText[1])
            .appendTo(this._controls.$relative)
            .on('click', $.proxy(function (e) {
                this.next(settings.navSpeed);
            }, this));

        // create DOM structure for absolute navigation
        if (!settings.dotsData) {
            this._templates = [$('<button role="button">')
                .addClass(settings.dotClass)
                .append($('<span>'))
                .prop('outerHTML')];
        }

        this._controls.$absolute = (settings.dotsContainer ? $(settings.dotsContainer)
            : $('<div>').addClass(settings.dotsClass).appendTo(this.$element)).addClass('disabled');

        this._controls.$absolute.on('click', 'button', $.proxy(function (e) {
            var index = $(e.target).parent().is(this._controls.$absolute)
                ? $(e.target).index() : $(e.target).parent().index();

            e.preventDefault();

            this.to(index, settings.dotsSpeed);
        }, this));

		/*$el.on('focusin', function() {
			$(document).off(".carousel");

			$(document).on('keydown.carousel', function(e) {
				if(e.keyCode == 37) {
					$el.trigger('prev.owl')
				}
				if(e.keyCode == 39) {
					$el.trigger('next.owl')
				}
			});
		});*/

        // override public methods of the carousel
        for (override in this._overrides) {
            this._core[override] = $.proxy(this[override], this);
        }
    };

	/**
	 * Destroys the plugin.
	 * @protected
	 */
    Navigation.prototype.destroy = function () {
        var handler, control, property, override, settings;
        settings = this._core.settings;

        for (handler in this._handlers) {
            this.$element.off(handler, this._handlers[handler]);
        }
        for (control in this._controls) {
            if (control === '$relative' && settings.navContainer) {
                this._controls[control].html('');
            } else {
                this._controls[control].remove();
            }
        }
        for (override in this.overides) {
            this._core[override] = this._overrides[override];
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

	/**
	 * Updates the internal state.
	 * @protected
	 */
    Navigation.prototype.update = function () {
        var i, j, k,
            lower = this._core.clones().length / 2,
            upper = lower + this._core.items().length,
            maximum = this._core.maximum(true),
            settings = this._core.settings,
            size = settings.center || settings.autoWidth || settings.dotsData
                ? 1 : settings.dotsEach || settings.items;

        if (settings.slideBy !== 'page') {
            settings.slideBy = Math.min(settings.slideBy, settings.items);
        }

        if (settings.dots || settings.slideBy == 'page') {
            this._pages = [];

            for (i = lower, j = 0, k = 0; i < upper; i++) {
                if (j >= size || j === 0) {
                    this._pages.push({
                        start: Math.min(maximum, i - lower),
                        end: i - lower + size - 1
                    });
                    if (Math.min(maximum, i - lower) === maximum) {
                        break;
                    }
                    j = 0, ++k;
                }
                j += this._core.mergers(this._core.relative(i));
            }
        }
    };

	/**
	 * Draws the user interface.
	 * @todo The option `dotsData` wont work.
	 * @protected
	 */
    Navigation.prototype.draw = function () {
        var difference,
            settings = this._core.settings,
            disabled = this._core.items().length <= settings.items,
            index = this._core.relative(this._core.current()),
            loop = settings.loop || settings.rewind;

        this._controls.$relative.toggleClass('disabled', !settings.nav || disabled);

        if (settings.nav) {
            this._controls.$previous.toggleClass('disabled', !loop && index <= this._core.minimum(true));
            this._controls.$next.toggleClass('disabled', !loop && index >= this._core.maximum(true));
        }

        this._controls.$absolute.toggleClass('disabled', !settings.dots || disabled);

        if (settings.dots) {
            difference = this._pages.length - this._controls.$absolute.children().length;

            if (settings.dotsData && difference !== 0) {
                this._controls.$absolute.html(this._templates.join(''));
            } else if (difference > 0) {
                this._controls.$absolute.append(new Array(difference + 1).join(this._templates[0]));
            } else if (difference < 0) {
                this._controls.$absolute.children().slice(difference).remove();
            }

            this._controls.$absolute.find('.active').removeClass('active');
            this._controls.$absolute.children().eq($.inArray(this.current(), this._pages)).addClass('active');
        }
    };

	/**
	 * Extends event data.
	 * @protected
	 * @param {Event} event - The event object which gets thrown.
	 */
    Navigation.prototype.onTrigger = function (event) {
        var settings = this._core.settings;

        event.page = {
            index: $.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: settings && (settings.center || settings.autoWidth || settings.dotsData
                ? 1 : settings.dotsEach || settings.items)
        };
    };

	/**
	 * Gets the current page position of the carousel.
	 * @protected
	 * @returns {Number}
	 */
    Navigation.prototype.current = function () {
        var current = this._core.relative(this._core.current());
        return $.grep(this._pages, $.proxy(function (page, index) {
            return page.start <= current && page.end >= current;
        }, this)).pop();
    };

	/**
	 * Gets the current succesor/predecessor position.
	 * @protected
	 * @returns {Number}
	 */
    Navigation.prototype.getPosition = function (successor) {
        var position, length,
            settings = this._core.settings;

        if (settings.slideBy == 'page') {
            position = $.inArray(this.current(), this._pages);
            length = this._pages.length;
            successor ? ++position : --position;
            position = this._pages[((position % length) + length) % length].start;
        } else {
            position = this._core.relative(this._core.current());
            length = this._core.items().length;
            successor ? position += settings.slideBy : position -= settings.slideBy;
        }

        return position;
    };

	/**
	 * Slides to the next item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
    Navigation.prototype.next = function (speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
    };

	/**
	 * Slides to the previous item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
    Navigation.prototype.prev = function (speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
    };

	/**
	 * Slides to the specified item or page.
	 * @public
	 * @param {Number} position - The position of the item or page.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
	 */
    Navigation.prototype.to = function (position, speed, standard) {
        var length;

        if (!standard && this._pages.length) {
            length = this._pages.length;
            $.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
        } else {
            $.proxy(this._overrides.to, this._core)(position, speed);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.3.4
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {
    'use strict';

	/**
	 * Creates the hash plugin.
	 * @class The Hash Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
    var Hash = function (carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
        this._core = carousel;

		/**
		 * Hash index for the items.
		 * @protected
		 * @type {Object}
		 */
        this._hashes = {};

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
        this.$element = this._core.$element;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function (e) {
                if (e.namespace && this._core.settings.startPosition === 'URLHash') {
                    $(window).trigger('hashchange.owl.navigation');
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function (e) {
                if (e.namespace) {
                    var hash = $(e.content).find('[data-hash]').addBack('[data-hash]').attr('data-hash');

                    if (!hash) {
                        return;
                    }

                    this._hashes[hash] = e.content;
                }
            }, this),
            'changed.owl.carousel': $.proxy(function (e) {
                if (e.namespace && e.property.name === 'position') {
                    var current = this._core.items(this._core.relative(this._core.current())),
                        hash = $.map(this._hashes, function (item, hash) {
                            return item === current ? hash : null;
                        }).join();

                    if (!hash || window.location.hash.slice(1) === hash) {
                        return;
                    }

                    window.location.hash = hash;
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Hash.Defaults, this._core.options);

        // register the event handlers
        this.$element.on(this._handlers);

        // register event listener for hash navigation
        $(window).on('hashchange.owl.navigation', $.proxy(function (e) {
            var hash = window.location.hash.substring(1),
                items = this._core.$stage.children(),
                position = this._hashes[hash] && items.index(this._hashes[hash]);

            if (position === undefined || position === this._core.current()) {
                return;
            }

            this._core.to(this._core.relative(position), false, true);
        }, this));
    };

	/**
	 * Default options.
	 * @public
	 */
    Hash.Defaults = {
        URLhashListener: false
    };

	/**
	 * Destroys the plugin.
	 * @public
	 */
    Hash.prototype.destroy = function () {
        var handler, property;

        $(window).off('hashchange.owl.navigation');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);

/**
 * Support Plugin
 *
 * @version 2.3.4
 * @author Vivid Planet Software GmbH
 * @author Artus Kolanowski
 * @author David Deutsch
 * @license The MIT License (MIT)
 */
; (function ($, window, document, undefined) {

    var style = $('<support>').get(0).style,
        prefixes = 'Webkit Moz O ms'.split(' '),
        events = {
            transition: {
                end: {
                    WebkitTransition: 'webkitTransitionEnd',
                    MozTransition: 'transitionend',
                    OTransition: 'oTransitionEnd',
                    transition: 'transitionend'
                }
            },
            animation: {
                end: {
                    WebkitAnimation: 'webkitAnimationEnd',
                    MozAnimation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    animation: 'animationend'
                }
            }
        },
        tests = {
            csstransforms: function () {
                return !!test('transform');
            },
            csstransforms3d: function () {
                return !!test('perspective');
            },
            csstransitions: function () {
                return !!test('transition');
            },
            cssanimations: function () {
                return !!test('animation');
            }
        };

    function test(property, prefixed) {
        var result = false,
            upper = property.charAt(0).toUpperCase() + property.slice(1);

        $.each((property + ' ' + prefixes.join(upper + ' ') + upper).split(' '), function (i, property) {
            if (style[property] !== undefined) {
                result = prefixed ? property : true;
                return false;
            }
        });

        return result;
    }

    function prefixed(property) {
        return test(property, true);
    }

    if (tests.csstransitions()) {
        /* jshint -W053 */
        $.support.transition = new String(prefixed('transition'))
        $.support.transition.end = events.transition.end[$.support.transition];
    }

    if (tests.cssanimations()) {
        /* jshint -W053 */
        $.support.animation = new String(prefixed('animation'))
        $.support.animation.end = events.animation.end[$.support.animation];
    }

    if (tests.csstransforms()) {
        /* jshint -W053 */
        $.support.transform = new String(prefixed('transform'));
        $.support.transform3d = tests.csstransforms3d();
    }

})(window.Zepto || window.jQuery, window, document);

;jQuery(document).ready(function(p){var u="",m="",v="",h="",b="";jQuery(".ult-responsive").each(function(e,a){var t=jQuery(this),i=t.attr("data-responsive-json-new"),r=t.data("ultimate-target"),s="",d="",n="",l="",c="",o="";void 0===i&&null==i||p.each(p.parseJSON(i),function(e,a){var i=e;if(void 0!==a&&null!=a){var t=a.split(";");jQuery.each(t,function(e,a){if(void 0!==a||null!=a){var t=a.split(":");switch(t[0]){case"large_screen":s+=i+":"+t[1]+";";break;case"desktop":d+=i+":"+t[1]+";";break;case"tablet":n+=i+":"+t[1]+";";break;case"tablet_portrait":l+=i+":"+t[1]+";";break;case"mobile_landscape":c+=i+":"+t[1]+";";break;case"mobile":o+=i+":"+t[1]+";"}}})}}),""!=o&&(b+=r+"{"+o+"}"),""!=c&&(h+=r+"{"+c+"}"),""!=l&&(v+=r+"{"+l+"}"),""!=n&&(m+=r+"{"+n+"}"),""!=d&&(u+=r+"{"+d+"}"),""!=s&&r+"{"+s+"}"});var e="<style>/** Ultimate: Media Responsive **/ ";e+=u,e+="@media (max-width: 1199px) { "+m+"}",e+="@media (max-width: 991px)  { "+v+"}",e+="@media (max-width: 767px)  { "+h+"}",e+="@media (max-width: 479px)  { "+b+"}",e+="/** Ultimate: Media Responsive - **/</style>",jQuery("head").append(e)});
;!function(f){"use strict";function s(t,i,e){if("img"===e){var r=(s=parseInt(i.outerHeight()))/2;t.css("padding-top",r+"px"),t.parent().css("margin-top",r+20+"px"),i.css("top",-s+"px")}else{var s;r=(s=parseInt(i.outerHeight()))/2;t.css("padding-top",r+"px"),t.parent().css("margin-top",r+20+"px"),i.css("top",-s+"px")}}function n(t){0<t.find(".timeline-icon-block").length&&f(".timeline-block").each(function(t,i){var e=f(this).find(".timeline-header-block"),r=f(this).find(".timeline-icon-block");r.css({position:"absolute"});var s=r.outerHeight(),a=r.outerWidth(),o=-a/2;parseInt(e.find(".timeline-header").css("padding-left").replace(/[^\d.]/g,""));f(this).hasClass("timeline-post-left")?(r.css({left:o,right:"auto"}),jQuery("body").hasClass("rtl")&&r.css({left:"auto",right:o})):f(this).hasClass("timeline-post-right")&&(r.css({left:"auto",right:o}),jQuery("body").hasClass("rtl")&&r.css({left:o,right:"auto"}));var n=e.height()/2-s/2;r.css({top:n});var u=r.offset().left,l=f(window).width();(u<0||l<u+a)&&(r.css({position:"relative",top:"auto",left:"auto",right:"auto","text-align":"center"}),r.children().children().css({margin:"10px auto"}),e.css({padding:"0"}))})}function e(){jQuery(".ult-animation").each(function(){if(jQuery(this).attr("data-animate")){var t=jQuery(this).children("*"),a=jQuery(this).attr("data-animate"),i=jQuery(this).attr("data-animation-duration")+"s",e=jQuery(this).attr("data-animation-iteration"),r=jQuery(this).attr("data-animation-delay"),o=(jQuery(this).attr("data-opacity_start_effect"),"opacity:1;-webkit-animation-delay:"+r+"s;-webkit-animation-duration:"+i+";-webkit-animation-iteration-count:"+e+"; -moz-animation-delay:"+r+"s;-moz-animation-duration:"+i+";-moz-animation-iteration-count:"+e+"; animation-delay:"+r+"s;animation-duration:"+i+";animation-iteration-count:"+e+";"),s="opacity:1;-webkit-transition-delay: "+r+"s; -moz-transition-delay: "+r+"s; transition-delay: "+r+"s;";if(u(jQuery(this))){var n=jQuery(this).attr("style");void 0===n&&(n="test"),"opacity:0;"==(n=n.replace(/ /g,""))&&0!==n.indexOf(s)&&jQuery(this).attr("style",s),jQuery.each(t,function(t,i){var e=jQuery(i),r=e.attr("style");void 0===r&&(r="test");var s="";s=0==r.indexOf(o)?r:o+r,e.attr("style",s),u(e)&&e.addClass("animated").addClass(a)})}}})}function u(t){var i=jQuery(window).scrollTop(),e=jQuery(window).height();if(jQuery(t).hasClass("ult-animate-viewport"))var r=jQuery(t).data("opacity_start_effect");if(void 0===r||""==r)var s=2;else s=100-r;jQuery(t).outerHeight();return jQuery(t).offset().top-i<=e-e*(s/100)}function a(){jQuery(".ult-new-ib").each(function(t,i){var e=jQuery(this);if(e.hasClass("ult-ib-resp")){var r=jQuery(document).width(),s=e.data("min-width");r<=e.data("max-width")&&s<=r?e.find(".ult-new-ib-content").hide():e.find(".ult-new-ib-content").show()}})}f.fn.vc_translate_row=function(){var c=f(window).scrollTop(),d=f(window).height();f(this).each(function(t,i){var e=f(i).attr("data-row-effect-mobile-disable");if(e=void 0===e?"false":e.toString(),/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))r="true";else var r="false";if("true"==r&&"true"==e)var s="true";else s="false";if("false"==s){var a=f(i).outerHeight(),o=f(i).offset().top-c,n=o+a,u=f(i).attr("data-parallax-content-sense")/100,l=0;if(n<=d-0*d&&o<=0){if(d<a)l=(d-n)*u;else l=-o*u;l<0&&(l=0)}else l=0;f(i).find(".vc-row-translate-wrapper").children().each(function(t,i){jQuery(i).is(".upb_row_bg,.upb_video-wrapper,.ult-vc-seperator,.ult-easy-separator-wrapper")||f(i).css({transform:"translate3d(0,"+l+"px,0)","-webkit-transform":"translate3d(0,"+l+"px,0)","-ms-transform":"translate3d(0,"+l+"px,0)"})})}})},f.fn.vc_fade_row=function(){var d=f(window).scrollTop(),h=f(window).height();f(this).each(function(t,i){var e=f(i).attr("data-row-effect-mobile-disable");if(e=void 0===e?"false":e.toString(),/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))r="true";else var r="false";if("true"==r&&"true"==e)var s="true";else s="false";if("false"==s){var a=f(i).data("fadeout-percentage");a=100-a;var o=f(i).outerHeight(),n=f(i).offset().top-d+o,u=1,l=h-h*(a/100),c=(l-n)/l*1;0<c&&(u=1-c),n<=l?(u<0?u=0:1<u&&(u=1),f(i).children().each(function(t,i){f(i).is(".upb_row_bg,.upb_video-wrapper,.ult-vc-seperator")||f(i).css({opacity:u})})):f(i).children().each(function(t,i){f(i).css({opacity:u})})}})},jQuery(document).ready(function(){var u;u="",f(".ult-spacer").each(function(t,i){var e=f(i).data("id"),r=(f("body").width(),f(i).data("height-mobile")),s=f(i).data("height-mobile-landscape"),a=f(i).data("height-tab"),o=f(i).data("height-tab-portrait"),n=f(i).data("height");""!=n&&(u+=" .spacer-"+e+" { height:"+n+"px } "),""==a&&"0"!=a&&0!=a||(u+=" @media (max-width: 1199px) { .spacer-"+e+" { height:"+a+"px } } "),void 0===o||""==o&&"0"!=o&&0!=o||(u+=" @media (max-width: 991px) { .spacer-"+e+" { height:"+o+"px } } "),void 0===s||""==s&&"0"!=s&&0!=s||(u+=" @media (max-width: 767px) { .spacer-"+e+" { height:"+s+"px } } "),""==r&&"0"!=r&&0!=r||(u+=" @media (max-width: 479px) { .spacer-"+e+" { height:"+r+"px } } ")}),""!=u&&(u="<style>"+u+"</style>",f("head").append(u))}),jQuery(window).scroll(function(){var t=jQuery(".ult-no-mobile").length;/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)&&1<=t?jQuery(".ult-animation").css("opacity",1):e(),f(".vc-row-fade").vc_fade_row(),f(".vc-row-translate").vc_translate_row()}),jQuery(window).load(function(){jQuery(".ult-banner-block-custom-height").each(function(t,i){var e=jQuery(this).find("img"),r=jQuery(this).width(),s=jQuery(this).height();e.width();s<r&&e.css({width:"100%",height:"auto"})}),jQuery(".ult-new-ib").each(function(t,i){("ontouchstart"in window||0<navigator.MaxTouchPoints||0<navigator.msMaxTouchPoints)&&jQuery(this).find(".ult-new-ib-link").click(function(t){t.preventDefault();var i=jQuery(this).attr("href"),e=jQuery(this).data("touch-delay");null==e&&(e=200),setTimeout(function(){window.location=i},e)})});var t=0,i=0,e=function(){jQuery(".ifb-jq-height").each(function(){jQuery(this).find(".ifb-back").css("height","auto"),jQuery(this).find(".ifb-front").css("height","auto");var t=parseInt(jQuery(this).find(".ifb-front > div").outerHeight(!0)),i=parseInt(jQuery(this).find(".ifb-back > div").outerHeight(!0)),e=i<t?t:i;jQuery(this).find(".ifb-front").css("height",e+"px"),jQuery(this).find(".ifb-back").css("height",e+"px"),jQuery(this).hasClass("vertical_door_flip")?jQuery(this).find(".ifb-flip-box").css("height",e+"px"):jQuery(this).hasClass("horizontal_door_flip")?jQuery(this).find(".ifb-flip-box").css("height",e+"px"):jQuery(this).hasClass("style_9")&&jQuery(this).find(".ifb-flip-box").css("height",e+"px")}),jQuery(".ifb-auto-height").each(function(){if(jQuery(this).hasClass("horizontal_door_flip")||jQuery(this).hasClass("vertical_door_flip")){var t=parseInt(jQuery(this).find(".ifb-front > div").outerHeight()),i=parseInt(jQuery(this).find(".ifb-back > div").outerHeight()),e=i<t?t:i;jQuery(this).find(".ifb-flip-box").css("height",e+"px")}})};-1!=navigator.userAgent.indexOf("Safari")&&-1==navigator.userAgent.indexOf("Chrome")?setTimeout(function(){e()},500):e(),jQuery(document).on("ultAdvancedTabClicked",function(t,i){e()}),jQuery(window).resize(function(){t++,setTimeout(function(){t==++i&&e()},500)});var r=0;jQuery(window).resize(function(){a(),jQuery(".csstime.smile-icon-timeline-wrap").each(function(){n(jQuery(this))}),f(".jstime .timeline-wrapper").each(function(){n(jQuery(this))}),"none"==jQuery(".smile-icon-timeline-wrap.jstime .timeline-line").css("display")?0===r&&(f(".jstime .timeline-wrapper").masonry("destroy"),r=1):1==r&&(jQuery(".jstime .timeline-wrapper").masonry({itemSelector:".timeline-block"}),setTimeout(function(){jQuery(".jstime .timeline-wrapper").masonry({itemSelector:".timeline-block",width:"401px"}),jQuery(this).find(".timeline-block").each(function(){jQuery(this).css("left","initial"),"0px"==jQuery(this).css("left")?jQuery(this).addClass("timeline-post-left"):jQuery(this).addClass("timeline-post-right")}),r=0},300))}),f(".smile-icon-timeline-wrap").each(function(){var t=jQuery(this).data("timeline-cutom-width");t&&jQuery(this).css("width",2*t+40+"px");var i=parseInt(jQuery(this).width()),e=parseInt(jQuery(this).find(".timeline-block").width()),r=i-2*e-40;r=r/i*100,f(".jstime .timeline-wrapper").each(function(){jQuery(this).masonry({itemSelector:".timeline-block"})}),setTimeout(function(){f(".jstime .timeline-wrapper").each(function(){jQuery(this).find(".timeline-block").each(function(){"0px"==jQuery(this).css("left")?jQuery(this).addClass("timeline-post-left"):jQuery(this).addClass("timeline-post-right"),n(jQuery(this))}),jQuery(".timeline-block").each(function(){var t=parseInt(jQuery(this).css("top"))-parseInt(jQuery(this).next().css("top"));t<14&&0<t||0==t?jQuery(this).next().addClass("time-clash-right"):-14<t&&jQuery(this).next().addClass("time-clash-left")})}),jQuery(".timeline-post-right").each(function(){var t=jQuery(this).find(".timeline-icon-block").clone();jQuery(this).find(".timeline-icon-block").remove(),jQuery(this).find(".timeline-header-block").after(t)}),jQuery(".smile-icon-timeline-wrap").each(function(){var t=jQuery(this).data("time_block_bg_color");jQuery(this).find(".timeline-block").css("background-color",t),jQuery(this).find(".timeline-post-left.timeline-block l").css("border-left-color",t),jQuery(this).find(".timeline-post-right.timeline-block l").css("border-right-color",t),jQuery(this).find(".feat-item").css("background-color",t),0<jQuery(this).find(".feat-item").find(".feat-top").length?jQuery(this).find(".feat-item l").css("border-top-color",t):jQuery(this).find(".feat-item l").css("border-bottom-color",t),jQuery(".jstime.timeline_preloader").remove(),jQuery(this).find("div").hasClass("timeline-wrapper")?jQuery(this).css("opacity","1"):jQuery(this).remove()})},1e3),jQuery(this).find(".timeline-line ").next().hasClass("timeline-separator-text")||jQuery(this).find(".timeline-line").prepend("<span></span>");var s=jQuery(this).data("time_sep_color"),a=jQuery(this).data("time_sep_bg_color"),o=jQuery(".smile-icon-timeline-wrap .timeline-line").css("border-right-color");jQuery(this).find(".timeline-dot").css("background-color",a),jQuery(this).find(".timeline-line span").css("background-color",a),jQuery(this).find(".timeline-line span").css("background-color",a),jQuery(this).find(".timeline-separator-text").css("color",s),jQuery(this).find(".timeline-separator-text .sep-text").css("background-color",a),jQuery(this).find(".ult-timeline-arrow s").css("border-color","rgba(255, 255, 255, 0) "+o),jQuery(this).find(".feat-item .ult-timeline-arrow s").css("border-color",o+" rgba(255, 255, 255, 0)"),jQuery(this).find(".timeline-block").css("border-color",o),jQuery(this).find(".feat-item").css("border-color",o)})}),jQuery(document).ready(function(t){var i=jQuery(".ult-no-mobile").length;/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)&&1<=i?jQuery(".ult-animation").css("opacity",1):e(),a(),jQuery(".ubtn").hover(function(){var t=jQuery(this);t.find(".ubtn-text").css("color",t.data("hover")),t.find(".ubtn-hover").css("background",t.data("hover-bg")).addClass("ubtn-hover-active");var i=""!=t.data("hover-bg")&&t.data("hover-bg");setTimeout(function(){!1!==i&&t.hasClass(".ubtn-fade-bg")&&t.css("background",t.data("hover-bg"))},150);var e=t.attr("style");if(""!=t.data("shadow-hover")){t.css("box-shadow");e+="box-shadow:"+t.data("shadow-hover")}if(t.attr("style",e),""!=t.data("border-hover")&&t.css("border-color",t.data("border-hover")),"none"!=t.data("shadow-click")){var r=t.data("shd-shadow")-3;""!=t.is(".shd-left")?t.css({right:r}):""!=t.is(".shd-right")?t.css({left:r}):""!=t.is(".shd-top")?t.css({bottom:r}):""!=t.is(".shd-bottom")&&t.css({top:r})}},function(){var t=jQuery(this);t.find(".ubtn-text").removeAttr("style"),t.find(".ubtn-hover").removeClass("ubtn-hover-active"),t.css("background",t.data("bg"));var i=t.data("border-color"),e=t.attr("style");""!=t.data("shadow-hover")&&(e+="box-shadow:"+t.data("shadow")),t.attr("style",e),""!=t.data("border-hover")&&t.css("border-color",i),"none"!=t.data("shadow-click")&&(t.removeClass("no-ubtn-shadow"),""!=t.is(".shd-left")?t.css({right:"auto"}):""!=t.is(".shd-right")?t.css({left:"auto"}):""!=t.is(".shd-top")?t.css({bottom:"auto"}):""!=t.is(".shd-bottom")&&t.css({top:"auto"}))}),jQuery(".ubtn").on("focus blur mousedown mouseup",function(t){var i=jQuery(this);"none"!=i.data("shadow-click")&&setTimeout(function(){i.is(":focus")?(i.addClass("no-ubtn-shadow"),""!=i.is(".shd-left")?i.css({right:i.data("shd-shadow")+"px"}):""!=i.is(".shd-right")?i.css({left:i.data("shd-shadow")+"px"}):""!=i.is(".shd-top")?i.css({bottom:i.data("shd-shadow")+"px"}):""!=i.is(".shd-bottom")&&i.css({top:i.data("shd-shadow")+"px"})):(i.removeClass("no-ubtn-shadow"),""!=i.is(".shd-left")?i.css({right:"auto"}):""!=i.is(".shd-right")?i.css({left:"auto"}):""!=i.is(".shd-top")?i.css({bottom:"auto"}):""!=i.is(".shd-bottom")&&i.css({top:"auto"}))},0)}),jQuery(".ubtn").focusout(function(){var t=jQuery(this);t.removeClass("no-ubtn-shadow"),""!=t.is(".shd-left")?t.css({right:"auto"}):""!=t.is(".shd-right")?t.css({left:"auto"}):""!=t.is(".shd-top")?t.css({bottom:"auto"}):""!=t.is(".shd-bottom")&&t.css({top:"auto"})}),jQuery(".smile-icon-timeline-wrap.jstime").css("opacity","0"),jQuery(".jstime.timeline_preloader").css("opacity","1"),jQuery(".smile-icon-timeline-wrap.csstime .timeline-wrapper").each(function(){jQuery(".csstime .timeline-block:even").addClass("timeline-post-left"),jQuery(".csstime .timeline-block:odd").addClass("timeline-post-right")}),jQuery(".csstime .timeline-post-right").each(function(){jQuery(this).css("float","right"),jQuery("<div style='clear:both'></div>").insertAfter(jQuery(this))}),jQuery(".csstime.smile-icon-timeline-wrap").each(function(){var t=jQuery(this).data("time_block_bg_color");jQuery(this).find(".timeline-block").css("background-color",t),jQuery(this).find(".timeline-post-left.timeline-block l").css("border-left-color",t),jQuery(this).find(".timeline-post-right.timeline-block l").css("border-right-color",t),jQuery(this).find(".feat-item").css("background-color",t),0<jQuery(this).find(".feat-item").find(".feat-top").length?jQuery(this).find(".feat-item l").css("border-top-color",t):jQuery(this).find(".feat-item l").css("border-bottom-color",t),n(jQuery(this))}),jQuery(".aio-icon, .aio-icon-img, .flip-box, .ultb3-info, .icon_list_icon, .ult-banner-block, .uavc-list-icon, .ult_tabs, .icon_list_connector").each(function(){if(jQuery(this).attr("data-animation")){var i=jQuery(this).attr("data-animation"),e="delay-"+jQuery(this).attr("data-animation-delay");if(void 0===i||""===i)return!1;t(this).bsf_appear(function(){var t=jQuery(this);t.addClass("animated").addClass(i),t.addClass("animated").addClass(e)})}}),jQuery(".stats-block").each(function(){t(this).bsf_appear(function(){var t=parseFloat(jQuery(this).find(".stats-number").data("counter-value")),i=jQuery(this).find(".stats-number").data("counter-value")+" ",e=parseInt(jQuery(this).find(".stats-number").data("speed")),r=jQuery(this).find(".stats-number").data("id"),s=jQuery(this).find(".stats-number").data("separator"),a=jQuery(this).find(".stats-number").data("decimal"),o=i.split(".");o=o[1]?o[1].length-1:0;var n=!0;"none"==a&&(a=""),n="none"!=s;var u=new countUp(r,0,t,o,e,{useEasing:!0,useGrouping:n,separator:s,decimal:a});setTimeout(function(){u.start()},500)})}),/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?jQuery(".ifb-flip-box").on("click",function(t){var i=jQuery(this);i.hasClass("ifb-hover")?i.removeClass("ifb-hover"):i.addClass("ifb-hover")}):jQuery(document).on("mouseenter mouseleave hover",".ifb-flip-box",function(t){var i=jQuery(this);i.hasClass("ifb-hover")?i.removeClass("ifb-hover"):i.addClass("ifb-hover")}),jQuery(".ifb-flip-box").each(function(t,i){jQuery(this).parent().hasClass("style_9")&&(jQuery(this).hover(function(){jQuery(this).addClass("ifb-door-hover")},function(){jQuery(this).removeClass("ifb-door-hover")}),jQuery(this).on("click",function(){jQuery(this).toggleClass("ifb-door-right-open"),jQuery(this).removeClass("ifb-door-hover")}))}),jQuery(document).on("click",".ifb-flip-box",function(t){t.stopPropagation(),jQuery(document).trigger("ultFlipBoxClicked",jQuery(this))}),jQuery(".vertical_door_flip .ifb-front").each(function(){jQuery(this).wrap('<div class="v_door ifb-multiple-front ifb-front-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-front-1").addClass("ifb-front-2").insertAfter(jQuery(this).parent())}),jQuery(".reverse_vertical_door_flip .ifb-back").each(function(){jQuery(this).wrap('<div class="rv_door ifb-multiple-back ifb-back-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-back-1").addClass("ifb-back-2").insertAfter(jQuery(this).parent())}),jQuery(".horizontal_door_flip .ifb-front").each(function(){jQuery(this).wrap('<div class="h_door ifb-multiple-front ifb-front-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-front-1").addClass("ifb-front-2").insertAfter(jQuery(this).parent())}),jQuery(".reverse_horizontal_door_flip .ifb-back").each(function(){jQuery(this).wrap('<div class="rh_door ifb-multiple-back ifb-back-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-back-1").addClass("ifb-back-2").insertAfter(jQuery(this).parent())}),jQuery(".style_9 .ifb-front").each(function(){jQuery(this).wrap('<div class="new_style_9 ifb-multiple-front ifb-front-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-front-1").addClass("ifb-front-2").insertAfter(jQuery(this).parent())}),jQuery(".style_9 .ifb-back").each(function(){jQuery(this).wrap('<div class="new_style_9 ifb-multiple-back ifb-back-1"></div>'),jQuery(this).parent().clone().removeClass("ifb-back-1").addClass("ifb-back-2").insertAfter(jQuery(this).parent())}),/^((?!chrome).)*safari/i.test(navigator.userAgent)&&(jQuery(".vertical_door_flip").each(function(t,i){var e=jQuery(this).find(".flip_link").outerHeight();jQuery(this).find(".flip_link").css("top",-e/2+"px"),jQuery(this).find(".ifb-multiple-front").css("width","50.2%")}),jQuery(".horizontal_door_flip").each(function(t,i){var e=jQuery(this).find(".flip_link").outerHeight();jQuery(this).find(".flip_link").css("top",-e/2+"px"),jQuery(this).find(".ifb-multiple-front").css("height","50.2%")}),jQuery(".reverse_vertical_door_flip").each(function(t,i){var e=jQuery(this).find(".flip_link").outerHeight();jQuery(this).find(".flip_link").css("top",-e/2+"px")}),jQuery(".reverse_horizontal_door_flip").each(function(t,i){var e=jQuery(this).find(".flip_link").outerHeight();jQuery(this).find(".flip_link").css("top",-e/2+"px"),jQuery(this).find(".ifb-back").css("position","inherit")})),jQuery(".square_box-icon").each(function(t,i){var e=jQuery(this);if(0<jQuery(this).find(".aio-icon-img").length){var r=jQuery(this).find(".aio-icon-img");s(e,r,"img"),r.find(".img-icon").load(function(){s(e,r,"icon")})}else{r=jQuery(this).find(".aio-icon");s(e,r,"icon"),jQuery(window).load(function(){s(e,r,"icon")})}})})}(jQuery),jQuery(document).ready(function(){function t(){jQuery(".ult-new-ib").each(function(t,i){var e=jQuery(this).data("min-height")||"";jQuery(this).find(".ult-new-ib-img").data("min-height"),jQuery(this).find(".ult-new-ib-img").data("max-width");if(""!=e){jQuery(this).addClass("ult-ib2-min-height"),jQuery(this).css("height",e),jQuery(this).find(".ult-new-ib-img").removeClass("ult-ib2-toggle-size");jQuery(this).find(".ult-new-ib-img").width();var r=jQuery(this).find(".ult-new-ib-img").height();(jQuery(this).width()<=e||r<e)&&jQuery(this).find(".ult-new-ib-img").addClass("ult-ib2-toggle-size")}jQuery(this).hover(function(){jQuery(this).find(".ult-new-ib-img").css("opacity",jQuery(this).data("hover-opacity"))},function(){jQuery(this).find(".ult-new-ib-img").css("opacity",jQuery(this).data("opacity"))})})}t(),jQuery(window).load(function(){t()}),jQuery(window).resize(function(){t()})}),jQuery(document).ready(function(){function e(){jQuery(".ultimate-map-wrapper").each(function(t,i){var e=jQuery(i).attr("id");if(void 0===e||""===e)return!1;var r=jQuery(i).find(".ultimate_google_map").attr("id"),s=jQuery("#"+r).attr("data-map_override");jQuery("#"+r).css({"margin-left":0}),jQuery("#"+r).css({right:0});var a=jQuery("#"+e).parent();if("full"==s&&(a=jQuery("body"),"false"),"ex-full"==s&&(a=jQuery("html"),"false"),!isNaN(s))for(t=0;t<s&&"HTML"!=a.prop("tagName");t++)a=a.parent();if(0==s||"0"==s)var o=a.width();else o=a.outerWidth();var n=a.offset().left-jQuery("#"+r).offset().left;if(jQuery("#"+r).css({width:o}),0==s&&"0"==s||jQuery("#"+r).css({"margin-left":n}),"full"==s&&jQuery("body").hasClass("rtl")){var u=jQuery("#"+r),l=jQuery(window).width()-(u.offset().left+u.outerWidth());jQuery("#"+r).css({right:-l})}})}e(),jQuery(window).load(function(){e()}),jQuery(window).resize(function(){e()}),jQuery(".ui-tabs").bind("tabsactivate",function(t,i){0<jQuery(this).find(".ultimate-map-wrapper").length&&e()}),jQuery(".ui-accordion").bind("accordionactivate",function(t,i){0<jQuery(this).find(".ultimate-map-wrapper").length&&e()}),jQuery(document).on("onUVCModalPopupOpen",function(){e()}),jQuery(document).on("UVCMapResize",function(){e()})});
;!function(f){f.fn.bsf_appear=function(r,e){var h=f.extend({data:void 0,one:!0,accX:0,accY:0},e);return this.each(function(){var l=f(this);if(l.bsf_appeared=!1,r){var b=f(window),a=function(){if(l.is(":visible")){var e=b.scrollLeft(),a=b.scrollTop(),r=l.offset(),f=r.left,p=r.top,s=h.accX,n=h.accY,t=l.height(),c=b.height(),i=l.width(),o=b.width();a<=p+t+n&&p<=a+c+n&&e<=f+i+s&&f<=e+o+s?l.bsf_appeared||l.trigger("bsf_appear",h.data):l.bsf_appeared=!1}else l.bsf_appeared=!1},e=function(){if(l.bsf_appeared=!0,h.one){b.unbind("scroll",a);var e=f.inArray(a,f.fn.bsf_appear.checks);0<=e&&f.fn.bsf_appear.checks.splice(e,1)}r.apply(this,arguments)};h.one?l.one("bsf_appear",h.data,e):l.bind("bsf_appear",h.data,e),b.scroll(a),f.fn.bsf_appear.checks.push(a),a()}else l.trigger("bsf_appear",h.data)})},f.extend(f.fn.bsf_appear,{checks:[],timeout:null,checkAll:function(){var e=f.fn.bsf_appear.checks.length;if(0<e)for(;e--;)f.fn.bsf_appear.checks[e]()},run:function(){f.fn.bsf_appear.timeout&&clearTimeout(f.fn.bsf_appear.timeout),f.fn.bsf_appear.timeout=setTimeout(f.fn.bsf_appear.checkAll,20)}}),f.each(["append","prepend","after","before","attr","removeAttr","addClass","removeClass","toggleClass","remove","css","show","hide"],function(e,a){var r=f.fn[a];r&&(f.fn[a]=function(){var e=r.apply(this,arguments);return f.fn.bsf_appear.run(),e})})}(jQuery);
;window.bsfmodernizr=function(e,t,i){function n(e){p.cssText=e}function a(e,t){return typeof e===t}function c(e,t){for(var n in e){var r=e[n];if(!~(""+r).indexOf("-")&&p[r]!==i)return"pfx"!=t||r}return!1}function r(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),o=(e+" "+h.join(r+" ")+r).split(" ");return a(t,"string")||a(t,"undefined")?c(o,t):function(e,t,n){for(var r in e){var o=t[e[r]];if(o!==i)return!1===n?e[r]:a(o,"function")?o.bind(n||t):o}return!1}(o=(e+" "+m.join(r+" ")+r).split(" "),t,n)}var o,l,s={},u=t.documentElement,f=t.createElement("bsfmodernizr"),p=f.style,d="Webkit Moz O ms",h=d.split(" "),m=d.toLowerCase().split(" "),v={},y=[],g=y.slice,b={}.hasOwnProperty;for(var E in l=a(b,"undefined")||a(b.call,"undefined")?function(e,t){return t in e&&a(e.constructor.prototype[t],"undefined")}:function(e,t){return b.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(r){var o=this;if("function"!=typeof o)throw new TypeError;var i=g.call(arguments,1),a=function(){if(this instanceof a){var e=function(){};e.prototype=o.prototype;var t=new e,n=o.apply(t,i.concat(g.call(arguments)));return Object(n)===n?n:t}return o.apply(r,i.concat(g.call(arguments)))};return a}),v.csstransitions=function(){return r("transition")},v)l(v,E)&&(o=E.toLowerCase(),s[o]=v[E](),y.push((s[o]?"":"no-")+o));return s.addTest=function(e,t){if("object"==typeof e)for(var n in e)l(e,n)&&s.addTest(n,e[n]);else{if(e=e.toLowerCase(),s[e]!==i)return s;t="function"==typeof t?t():t,u.className+=" "+(t?"":"no-")+e,s[e]=t}return s},n(""),f=null,function(e,l){function s(){var e=h.elements;return"string"==typeof e?e.split(" "):e}function u(e){var t=c[e[r]];return t||(t={},a++,e[r]=a,c[a]=t),t}function f(e,t,n){return t||(t=l),d?t.createElement(e):(n||(n=u(t)),!(r=n.cache[e]?n.cache[e].cloneNode():i.test(e)?(n.cache[e]=n.createElem(e)).cloneNode():n.createElem(e)).canHaveChildren||o.test(e)||r.tagUrn?r:n.frag.appendChild(r));var r}function t(e){e||(e=l);var t,n,r,o,i,a,c=u(e);return h.shivCSS&&!p&&!c.hasCSS&&(c.hasCSS=(o="article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}",i=(r=e).createElement("p"),a=r.getElementsByTagName("head")[0]||r.documentElement,i.innerHTML="x<style>"+o+"</style>",!!a.insertBefore(i.lastChild,a.firstChild))),d||(t=e,(n=c).cache||(n.cache={},n.createElem=t.createElement,n.createFrag=t.createDocumentFragment,n.frag=n.createFrag()),t.createElement=function(e){return h.shivMethods?f(e,t,n):n.createElem(e)},t.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+s().join().replace(/[\w\-]+/g,function(e){return n.createElem(e),n.frag.createElement(e),'c("'+e+'")'})+");return n}")(h,n.frag)),e}var p,d,n=e.html5||{},o=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,i=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,r="_html5shiv",a=0,c={};!function(){try{var e=l.createElement("a");e.innerHTML="<xyz></xyz>",p="hidden"in e,d=1==e.childNodes.length||function(){l.createElement("a");var e=l.createDocumentFragment();return void 0===e.cloneNode||void 0===e.createDocumentFragment||void 0===e.createElement}()}catch(e){d=p=!0}}();var h={elements:n.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:"3.7.0",shivCSS:!1!==n.shivCSS,supportsUnknownElements:d,shivMethods:!1!==n.shivMethods,type:"default",shivDocument:t,createElement:f,createDocumentFragment:function(e,t){if(e||(e=l),d)return e.createDocumentFragment();for(var n=(t=t||u(e)).frag.cloneNode(),r=0,o=s(),i=o.length;r<i;r++)n.createElement(o[r]);return n}};e.html5=h,t(l)}(this,t),s._version="2.7.1",s._domPrefixes=m,s._cssomPrefixes=h,s.testProp=function(e){return c([e])},s.testAllProps=r,s.prefixed=function(e,t,n){return t?r(e,t,n):r(e,"pfx")},u.className=u.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+" js "+y.join(" "),s}(0,this.document),function(e,p,t){function f(e){return"[object Function]"==i.call(e)}function d(e){return"string"==typeof e}function h(){}function m(e){return!e||"loaded"==e||"complete"==e||"uninitialized"==e}function v(){var e=E.shift();j=1,e?e.t?g(function(){("c"==e.t?y.injectCss:y.injectJs)(e.s,0,e.a,e.x,e.e,1)},0):(e(),v()):j=0}function n(e,t,n,r,o){return j=0,t=t||"j",d(e)?function(n,r,e,t,o,i,a){function c(e){if(!s&&m(l.readyState)&&(f.r=s=1,!j&&v(),l.onload=l.onreadystatechange=null,e))for(var t in"img"!=n&&g(function(){S.removeChild(l)},50),F[r])F[r].hasOwnProperty(t)&&F[r][t].onload()}a=a||y.errorTimeout;var l=p.createElement(n),s=0,u=0,f={t:e,s:r,e:o,a:i,x:a};1===F[r]&&(u=1,F[r]=[]),"object"==n?l.data=r:(l.src=r,l.type=n),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){c.call(this,u)},E.splice(t,0,f),"img"!=n&&(u||2===F[r]?(S.insertBefore(l,C?null:b),g(c,a)):F[r].push(l))}("c"==t?s:l,e,t,this.i++,n,r,o):(E.splice(this.i++,0,e),1==E.length&&v()),this}function c(){var e=y;return e.loader={load:n,i:0},e}var r,y,o=p.documentElement,g=e.setTimeout,b=p.getElementsByTagName("script")[0],i={}.toString,E=[],j=0,a="MozAppearance"in o.style,C=a&&!!p.createRange().compareNode,S=C?o:b.parentNode,l=(o=e.opera&&"[object Opera]"==i.call(e.opera),o=!!p.attachEvent&&!o,a?"object":o?"script":"img"),s=o?"script":l,x=Array.isArray||function(e){return"[object Array]"==i.call(e)},w=[],F={},N={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}};(y=function(e){function u(e,t,n,r,o){var i=function(e){e=e.split("!");var t,n,r,o=w.length,i=e.pop(),a=e.length;for(i={url:i,origUrl:i,prefixes:e},n=0;n<a;n++)r=e[n].split("="),(t=N[r.shift()])&&(i=t(i,r));for(n=0;n<o;n++)i=w[n](i);return i}(e),a=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(t&&(t=f(t)?t:t[e]||t[r]||t[e.split("/").pop().split("?")[0]]),i.instead?i.instead(e,t,n,r,o):(F[i.url]?i.noexec=!0:F[i.url]=1,n.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":void 0,i.noexec,i.attrs,i.timeout),(f(t)||f(a))&&n.load(function(){c(),t&&t(i.origUrl,o,r),a&&a(i.origUrl,o,r),F[i.url]=2})))}function t(e,t){function n(n,e){if(n){if(d(n))e||(c=function(){var e=[].slice.call(arguments);l.apply(this,e),s()}),u(n,c,t,0,i);else if(Object(n)===n)for(o in r=function(){var e,t=0;for(e in n)n.hasOwnProperty(e)&&t++;return t}(),n)n.hasOwnProperty(o)&&(!e&&!--r&&(f(c)?c=function(){var e=[].slice.call(arguments);l.apply(this,e),s()}:c[o]=function(t){return function(){var e=[].slice.call(arguments);t&&t.apply(this,e),s()}}(l[o])),u(n[o],c,t,o,i))}else!e&&s()}var r,o,i=!!e.test,a=e.load||e.both,c=e.callback||h,l=c,s=e.complete||h;n(i?e.yep:e.nope,!!a),a&&n(a)}var n,r,o=this.yepnope.loader;if(d(e))u(e,0,o,0);else if(x(e))for(n=0;n<e.length;n++)d(r=e[n])?u(r,0,o,0):x(r)?y(r):Object(r)===r&&t(r,o);else Object(e)===e&&t(e,o)}).addPrefix=function(e,t){N[e]=t},y.addFilter=function(e){w.push(e)},y.errorTimeout=1e4,null==p.readyState&&p.addEventListener&&(p.readyState="loading",p.addEventListener("DOMContentLoaded",r=function(){p.removeEventListener("DOMContentLoaded",r,0),p.readyState="complete"},0)),e.yepnope=c(),e.yepnope.executeStack=v,e.yepnope.injectJs=function(e,t,n,r,o,i){var a,c,l=p.createElement("script");r=r||y.errorTimeout;for(c in l.src=e,n)l.setAttribute(c,n[c]);t=i?v:t||h,l.onreadystatechange=l.onload=function(){!a&&m(l.readyState)&&(a=1,t(),l.onload=l.onreadystatechange=null)},g(function(){a||t(a=1)},r),o?l.onload():b.parentNode.insertBefore(l,b)},e.yepnope.injectCss=function(e,t,n,r,o,i){var a;r=p.createElement("link"),t=i?v:t||h;for(a in r.href=e,r.rel="stylesheet",r.type="text/css",n)r.setAttribute(a,n[a]);o||(b.parentNode.insertBefore(r,b),g(t,0))}}(this,document),bsfmodernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
;window.bsfmodernizr=function(t,e,o){function n(t){d.cssText=t}function a(t,e){return typeof t===e}function s(t,e){for(var n in t){var r=t[n];if(!~(""+r).indexOf("-")&&d[r]!==o)return"pfx"!=e||r}return!1}function r(t,e,n){var r=t.charAt(0).toUpperCase()+t.slice(1),i=(t+" "+p.join(r+" ")+r).split(" ");return a(e,"string")||a(e,"undefined")?s(i,e):function(t,e,n){for(var r in t){var i=e[t[r]];if(i!==o)return!1===n?t[r]:a(i,"function")?i.bind(n||e):i}return!1}(i=(t+" "+g.join(r+" ")+r).split(" "),e,n)}var i,l,u={},c=e.documentElement,f=e.createElement("bsfmodernizr"),d=f.style,h="Webkit Moz O ms",p=h.split(" "),g=h.toLowerCase().split(" "),v={},m=[],y=m.slice,x={}.hasOwnProperty;for(var b in l=a(x,"undefined")||a(x.call,"undefined")?function(t,e){return e in t&&a(t.constructor.prototype[e],"undefined")}:function(t,e){return x.call(t,e)},Function.prototype.bind||(Function.prototype.bind=function(r){var i=this;if("function"!=typeof i)throw new TypeError;var o=y.call(arguments,1),a=function(){if(this instanceof a){var t=function(){};t.prototype=i.prototype;var e=new t,n=i.apply(e,o.concat(y.call(arguments)));return Object(n)===n?n:e}return i.apply(r,o.concat(y.call(arguments)))};return a}),v.csstransitions=function(){return r("transition")},v)l(v,b)&&(i=b.toLowerCase(),u[i]=v[b](),m.push((u[i]?"":"no-")+i));return u.addTest=function(t,e){if("object"==typeof t)for(var n in t)l(t,n)&&u.addTest(n,t[n]);else{if(t=t.toLowerCase(),u[t]!==o)return u;e="function"==typeof e?e():e,c.className+=" "+(e?"":"no-")+t,u[t]=e}return u},n(""),f=null,function(t,l){function u(){var t=p.elements;return"string"==typeof t?t.split(" "):t}function c(t){var e=s[t[r]];return e||(e={},a++,t[r]=a,s[a]=e),e}function f(t,e,n){return e||(e=l),h?e.createElement(t):(n||(n=c(e)),!(r=n.cache[t]?n.cache[t].cloneNode():o.test(t)?(n.cache[t]=n.createElem(t)).cloneNode():n.createElem(t)).canHaveChildren||i.test(t)||r.tagUrn?r:n.frag.appendChild(r));var r}function e(t){t||(t=l);var e,n,r,i,o,a,s=c(t);return p.shivCSS&&!d&&!s.hasCSS&&(s.hasCSS=(i="article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}",o=(r=t).createElement("p"),a=r.getElementsByTagName("head")[0]||r.documentElement,o.innerHTML="x<style>"+i+"</style>",!!a.insertBefore(o.lastChild,a.firstChild))),h||(e=t,(n=s).cache||(n.cache={},n.createElem=e.createElement,n.createFrag=e.createDocumentFragment,n.frag=n.createFrag()),e.createElement=function(t){return p.shivMethods?f(t,e,n):n.createElem(t)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+u().join().replace(/[\w\-]+/g,function(t){return n.createElem(t),n.frag.createElement(t),'c("'+t+'")'})+");return n}")(p,n.frag)),t}var d,h,n=t.html5||{},i=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,o=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,r="_html5shiv",a=0,s={};!function(){try{var t=l.createElement("a");t.innerHTML="<xyz></xyz>",d="hidden"in t,h=1==t.childNodes.length||function(){l.createElement("a");var t=l.createDocumentFragment();return void 0===t.cloneNode||void 0===t.createDocumentFragment||void 0===t.createElement}()}catch(t){h=d=!0}}();var p={elements:n.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:"3.7.0",shivCSS:!1!==n.shivCSS,supportsUnknownElements:h,shivMethods:!1!==n.shivMethods,type:"default",shivDocument:e,createElement:f,createDocumentFragment:function(t,e){if(t||(t=l),h)return t.createDocumentFragment();for(var n=(e=e||c(t)).frag.cloneNode(),r=0,i=u(),o=i.length;r<o;r++)n.createElement(i[r]);return n}};t.html5=p,e(l)}(this,e),u._version="2.7.1",u._domPrefixes=g,u._cssomPrefixes=p,u.testProp=function(t){return s([t])},u.testAllProps=r,u.prefixed=function(t,e,n){return e?r(t,e,n):r(t,"pfx")},c.className=c.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+" js "+m.join(" "),u}(0,this.document),function(t,d,e){function f(t){return"[object Function]"==o.call(t)}function h(t){return"string"==typeof t}function p(){}function g(t){return!t||"loaded"==t||"complete"==t||"uninitialized"==t}function v(){var t=b.shift();w=1,t?t.t?y(function(){("c"==t.t?m.injectCss:m.injectJs)(t.s,0,t.a,t.x,t.e,1)},0):(t(),v()):w=0}function n(t,e,n,r,i){return w=0,e=e||"j",h(t)?function(n,r,t,e,i,o,a){function s(t){if(!u&&g(l.readyState)&&(f.r=u=1,!w&&v(),l.onload=l.onreadystatechange=null,t))for(var e in"img"!=n&&y(function(){S.removeChild(l)},50),T[r])T[r].hasOwnProperty(e)&&T[r][e].onload()}a=a||m.errorTimeout;var l=d.createElement(n),u=0,c=0,f={t:t,s:r,e:i,a:o,x:a};1===T[r]&&(c=1,T[r]=[]),"object"==n?l.data=r:(l.src=r,l.type=n),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){s.call(this,c)},b.splice(e,0,f),"img"!=n&&(c||2===T[r]?(S.insertBefore(l,C?null:x),y(s,a)):T[r].push(l))}("c"==e?u:l,t,e,this.i++,n,r,i):(b.splice(this.i++,0,t),1==b.length&&v()),this}function s(){var t=m;return t.loader={load:n,i:0},t}var r,m,i=d.documentElement,y=t.setTimeout,x=d.getElementsByTagName("script")[0],o={}.toString,b=[],w=0,a="MozAppearance"in i.style,C=a&&!!d.createRange().compareNode,S=C?i:x.parentNode,l=(i=t.opera&&"[object Opera]"==o.call(t.opera),i=!!d.attachEvent&&!i,a?"object":i?"script":"img"),u=i?"script":l,k=Array.isArray||function(t){return"[object Array]"==o.call(t)},E=[],T={},M={timeout:function(t,e){return e.length&&(t.timeout=e[0]),t}};(m=function(t){function c(t,e,n,r,i){var o=function(t){t=t.split("!");var e,n,r,i=E.length,o=t.pop(),a=t.length;for(o={url:o,origUrl:o,prefixes:t},n=0;n<a;n++)r=t[n].split("="),(e=M[r.shift()])&&(o=e(o,r));for(n=0;n<i;n++)o=E[n](o);return o}(t),a=o.autoCallback;o.url.split(".").pop().split("?").shift(),o.bypass||(e&&(e=f(e)?e:e[t]||e[r]||e[t.split("/").pop().split("?")[0]]),o.instead?o.instead(t,e,n,r,i):(T[o.url]?o.noexec=!0:T[o.url]=1,n.load(o.url,o.forceCSS||!o.forceJS&&"css"==o.url.split(".").pop().split("?").shift()?"c":void 0,o.noexec,o.attrs,o.timeout),(f(e)||f(a))&&n.load(function(){s(),e&&e(o.origUrl,i,r),a&&a(o.origUrl,i,r),T[o.url]=2})))}function e(t,e){function n(n,t){if(n){if(h(n))t||(s=function(){var t=[].slice.call(arguments);l.apply(this,t),u()}),c(n,s,e,0,o);else if(Object(n)===n)for(i in r=function(){var t,e=0;for(t in n)n.hasOwnProperty(t)&&e++;return e}(),n)n.hasOwnProperty(i)&&(!t&&!--r&&(f(s)?s=function(){var t=[].slice.call(arguments);l.apply(this,t),u()}:s[i]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),u()}}(l[i])),c(n[i],s,e,i,o))}else!t&&u()}var r,i,o=!!t.test,a=t.load||t.both,s=t.callback||p,l=s,u=t.complete||p;n(o?t.yep:t.nope,!!a),a&&n(a)}var n,r,i=this.yepnope.loader;if(h(t))c(t,0,i,0);else if(k(t))for(n=0;n<t.length;n++)h(r=t[n])?c(r,0,i,0):k(r)?m(r):Object(r)===r&&e(r,i);else Object(t)===t&&e(t,i)}).addPrefix=function(t,e){M[t]=e},m.addFilter=function(t){E.push(t)},m.errorTimeout=1e4,null==d.readyState&&d.addEventListener&&(d.readyState="loading",d.addEventListener("DOMContentLoaded",r=function(){d.removeEventListener("DOMContentLoaded",r,0),d.readyState="complete"},0)),t.yepnope=s(),t.yepnope.executeStack=v,t.yepnope.injectJs=function(t,e,n,r,i,o){var a,s,l=d.createElement("script");r=r||m.errorTimeout;for(s in l.src=t,n)l.setAttribute(s,n[s]);e=o?v:e||p,l.onreadystatechange=l.onload=function(){!a&&g(l.readyState)&&(a=1,e(),l.onload=l.onreadystatechange=null)},y(function(){a||e(a=1)},r),i?l.onload():x.parentNode.insertBefore(l,x)},t.yepnope.injectCss=function(t,e,n,r,i,o){var a;r=d.createElement("link"),e=o?v:e||p;for(a in r.href=t,r.rel="stylesheet",r.type="text/css",n)r.setAttribute(a,n[a]);i||(x.parentNode.insertBefore(r,x),y(e,0))}}(this,document),bsfmodernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))},function(t){"use strict";function n(t){return new RegExp("(^|\\s+)"+t+"(\\s+|$)")}var r,i,o;function e(t,e){(r(t,e)?o:i)(t,e)}o="classList"in document.documentElement?(r=function(t,e){return t.classList.contains(e)},i=function(t,e){t.classList.add(e)},function(t,e){t.classList.remove(e)}):(r=function(t,e){return n(e).test(t.className)},i=function(t,e){r(t,e)||(t.className=t.className+" "+e)},function(t,e){t.className=t.className.replace(n(e)," ")});var a={hasClass:r,addClass:i,removeClass:o,toggleClass:e,has:r,add:i,remove:o,toggle:e};"function"==typeof define&&define.amd?define(a):t.classie=a}(window);var Froogaloop=function(){function e(t){return new e.fn.init(t)}function a(t,e,n){if(!n.contentWindow.postMessage)return!1;var r=n.getAttribute("src").split("?")[0];t=JSON.stringify({method:t,value:e});"//"===r.substr(0,2)&&(r=window.location.protocol+r),n.contentWindow.postMessage(t,r)}function t(t){var e,n;try{n=(e=JSON.parse(t.data)).event||e.method}catch(t){}if("ready"==n&&!l&&(l=!0),t.origin!=u)return!1;t=e.value;var r=e.data,i=""===i?null:e.player_id;return e=i?o[i][n]:o[n],n=[],!!e&&(void 0!==t&&n.push(t),r&&n.push(r),i&&n.push(i),0<n.length?e.apply(null,n):e.call())}function s(t,e,n){n?(o[n]||(o[n]={}),o[n][t]=e):o[t]=e}var o={},l=!1,u="";return(e.fn=e.prototype={element:null,init:function(t){"string"==typeof t&&(t=document.getElementById(t)),this.element=t,"//"===(t=this.element.getAttribute("src")).substr(0,2)&&(t=window.location.protocol+t);for(var e="",n=0,r=(t=t.split("/")).length;n<r&&n<3;n++)e+=t[n],n<2&&(e+="/");return u=e,this},api:function(t,e){if(!this.element||!t)return!1;var n=this.element,r=""!==n.id?n.id:null,i=e&&e.constructor&&e.call&&e.apply?null:e,o=e&&e.constructor&&e.call&&e.apply?e:null;return o&&s(t,o,r),a(t,i,n),this},addEvent:function(t,e){if(!this.element)return!1;var n=this.element,r=""!==n.id?n.id:null;return s(t,e,r),"ready"!=t?a("addEventListener",t,n):"ready"==t&&l&&e.call(null,r),this},removeEvent:function(t){if(!this.element)return!1;var e,n=this.element;t:{if((e=""!==n.id?n.id:null)&&o[e]){if(!o[e][t]){e=!1;break t}o[e][t]=null}else{if(!o[t]){e=!1;break t}o[t]=null}e=!0}"ready"!=t&&e&&a("removeEventListener",t,n)}}).init.prototype=e.fn,window.addEventListener?window.addEventListener("message",t,!1):window.attachEvent("onmessage",t),window.Froogaloop=window.$f=e}();!function(t){var h,p,d="hasOwnProperty",g=/[\.\/]/,a=function(){},v=function(t,e){return t-e},m={n:{}},y=function(t,e){t=String(t);var n,r=p,i=Array.prototype.slice.call(arguments,2),o=y.listeners(t),a=0,s=[],l={},u=[],c=h;h=t;for(var f=p=0,d=o.length;f<d;f++)"zIndex"in o[f]&&(s.push(o[f].zIndex),o[f].zIndex<0&&(l[o[f].zIndex]=o[f]));for(s.sort(v);s[a]<0;)if(n=l[s[a++]],u.push(n.apply(e,i)),p)return p=r,u;for(f=0;f<d;f++)if("zIndex"in(n=o[f]))if(n.zIndex==s[a]){if(u.push(n.apply(e,i)),p)break;do{if((n=l[s[++a]])&&u.push(n.apply(e,i)),p)break}while(n)}else l[n.zIndex]=n;else if(u.push(n.apply(e,i)),p)break;return p=r,h=c,u.length?u:null};y._events=m,y.listeners=function(t){var e,n,r,i,o,a,s,l,u=t.split(g),c=m,f=[c],d=[];for(i=0,o=u.length;i<o;i++){for(l=[],a=0,s=f.length;a<s;a++)for(n=[(c=f[a].n)[u[i]],c["*"]],r=2;r--;)(e=n[r])&&(l.push(e),d=d.concat(e.f||[]));f=l}return d},y.on=function(t,e){if(t=String(t),"function"!=typeof e)return function(){};for(var n=t.split(g),r=m,i=0,o=n.length;i<o;i++)r=(r=r.n).hasOwnProperty(n[i])&&r[n[i]]||(r[n[i]]={n:{}});for(r.f=r.f||[],i=0,o=r.f.length;i<o;i++)if(r.f[i]==e)return a;return r.f.push(e),function(t){+t==+t&&(e.zIndex=+t)}},y.f=function(t){var e=[].slice.call(arguments,1);return function(){y.apply(null,[t,null].concat(e).concat([].slice.call(arguments,0)))}},y.stop=function(){p=1},y.nt=function(t){return t?new RegExp("(?:\\.|\\/|^)"+t+"(?:\\.|\\/|$)").test(h):h},y.nts=function(){return h.split(g)},y.off=y.unbind=function(t,e){if(t){var n,r,i,o,a,s,l,u=t.split(g),c=[m];for(o=0,a=u.length;o<a;o++)for(s=0;s<c.length;s+=i.length-2){if(i=[s,1],n=c[s].n,"*"!=u[o])n[u[o]]&&i.push(n[u[o]]);else for(r in n)n[d](r)&&i.push(n[r]);c.splice.apply(c,i)}for(o=0,a=c.length;o<a;o++)for(n=c[o];n.n;){if(e){if(n.f){for(s=0,l=n.f.length;s<l;s++)if(n.f[s]==e){n.f.splice(s,1);break}!n.f.length&&delete n.f}for(r in n.n)if(n.n[d](r)&&n.n[r].f){var f=n.n[r].f;for(s=0,l=f.length;s<l;s++)if(f[s]==e){f.splice(s,1);break}!f.length&&delete n.n[r].f}}else for(r in delete n.f,n.n)n.n[d](r)&&n.n[r].f&&delete n.n[r].f;n=n.n}}else y._events=m={n:{}}},y.once=function(t,e){var n=function(){return y.unbind(t,n),e.apply(this,arguments)};return y.on(t,n)},y.version="0.4.2",y.toString=function(){return"You are running Eve 0.4.2"},"undefined"!=typeof module&&module.exports?module.exports=y:"undefined"!=typeof define?define("eve",[],function(){return y}):t.eve=y}(this),function(e,n){"function"==typeof define&&define.amd?define(["eve"],function(t){return n(e,t)}):n(e,e.eve)}(this,function(vt,mt){var s,c,f,l,d,h,t,p,v,m,y,x,b,w,C,yt=(s=void 0===mt?function(){}:mt,c={},f=vt.requestAnimationFrame||vt.webkitRequestAnimationFrame||vt.mozRequestAnimationFrame||vt.oRequestAnimationFrame||vt.msRequestAnimationFrame||function(t){setTimeout(t,16)},l=Array.isArray||function(t){return t instanceof Array||"[object Array]"==Object.prototype.toString.call(t)},d=0,h="M"+(+new Date).toString(36),t=Date.now||function(){return+new Date},p=function(t){var e=this;if(null==t)return e.s;var n=e.s-t;e.b+=e.dur*n,e.B+=e.dur*n,e.s=t},v=function(t){return null==t?this.spd:void(this.spd=t)},m=function(t){var e=this;return null==t?e.dur:(e.s=e.s*t/e.dur,void(e.dur=t))},y=function(){delete c[this.id],s("mina.stop."+this.id,this)},x=function(){var t=this;t.pdif||(delete c[t.id],t.pdif=t.get()-t.b)},b=function(){var t=this;t.pdif&&(t.b=t.get()-t.pdif,delete t.pdif,c[t.id]=t)},w=function(){var t=0;for(var e in c)if(c.hasOwnProperty(e)){var n,r=c[e],i=r.get();if(t++,r.s=(i-r.b)/(r.dur/r.spd),1<=r.s&&(delete c[e],r.s=1,t--,function(t){setTimeout(function(){s("mina.finish."+t.id,t)})}(r)),l(r.start)){n=[];for(var o=0,a=r.start.length;o<a;o++)n[o]=+r.start[o]+(r.end[o]-r.start[o])*r.easing(r.s)}else n=+r.start+(r.end-r.start)*r.easing(r.s);r.set(n)}t&&f(w)},(C=function(t,e,n,r,i,o,a){var s={id:h+(d++).toString(36),start:t,end:e,b:n,s:0,dur:r-n,spd:1,get:i,set:o,easing:a||C.linear,status:p,speed:v,duration:m,stop:y,pause:x,resume:b};c[s.id]=s;var l,u=0;for(l in c)if(c.hasOwnProperty(l)&&2==++u)break;return 1==u&&f(w),s}).time=t,C.getById=function(t){return c[t]||null},C.linear=function(t){return t},C.easeout=function(t){return Math.pow(t,1.7)},C.easein=function(t){return Math.pow(t,.48)},C.easeinout=function(t){if(1==t)return 1;if(0==t)return 0;var e=.48-t/1.04,n=Math.sqrt(.1734+e*e),r=n-e,i=-n-e,o=Math.pow(Math.abs(r),1/3)*(r<0?-1:1)+Math.pow(Math.abs(i),1/3)*(i<0?-1:1)+.5;return 3*(1-o)*o*o+o*o*o},C.backin=function(t){return 1==t?1:t*t*(2.70158*t-1.70158)},C.backout=function(t){return 0==t?0:(t-=1)*t*(2.70158*t+1.70158)+1},C.elastic=function(t){return t==!!t?t:Math.pow(2,-10*t)*Math.sin(2*(t-.075)*Math.PI/.3)+1},C.bounce=function(t){var e=7.5625,n=2.75;return t<1/n?e*t*t:t<2/n?e*(t-=1.5/n)*t+.75:t<2.5/n?e*(t-=2.25/n)*t+.9375:e*(t-=2.625/n)*t+.984375},vt.mina=C),e=function(){function l(t,e){if(t){if(t.tagName)return w(t);if(t instanceof d)return t;if(null==e)return w(t=B.doc.querySelector(t))}return new m(t=null==t?"100%":t,e=null==e?"100%":e)}function p(t,e){if(e){if("string"==typeof t&&(t=p(t)),"string"==typeof e)return"xlink:"==e.substring(0,6)?t.getAttributeNS(K,e.substring(6)):"xml:"==e.substring(0,4)?t.getAttributeNS(tt,e.substring(4)):t.getAttribute(e);for(var n in e)if(e[_](n)){var r=A(e[n]);r?"xlink:"==n.substring(0,6)?t.setAttributeNS(K,n.substring(6),r):"xml:"==n.substring(0,4)?t.setAttributeNS(tt,n.substring(4),r):t.setAttribute(n,r):t.removeAttribute(n)}}else t=B.doc.createElementNS(tt,t);return t}function y(t,e){return"finite"==(e=A.prototype.toLowerCase.call(e))?isFinite(t):!("array"!=e||!(t instanceof Array||Array.isArray&&Array.isArray(t)))||("null"==e&&null===t||e==typeof t&&null!==t||"object"==e&&t===Object(t)||R.call(t).slice(8,-1).toLowerCase()==e)}function e(o,a,s){return function t(){var e=Array.prototype.slice.call(arguments,0),n=e.join("␀"),r=t.cache=t.cache||{},i=t.count=t.count||[];return r[_](n)?function(t,e){for(var n=0,r=t.length;n<r;n++)if(t[n]===e)return t.push(t.splice(n,1)[0])}(i,n):(1e3<=i.length&&delete r[i.shift()],i.push(n),r[n]=o.apply(a,e)),s?s(r[n]):r[n]}}function a(t){return t%360*z/180}function s(t){return 180*t/z%360}function x(t,e,n,r,i,o){return null==e&&"[object SVGMatrix]"==R.call(t)?(this.a=t.a,this.b=t.b,this.c=t.c,this.d=t.d,this.e=t.e,void(this.f=t.f)):void(this.f=null!=t?(this.a=+t,this.b=+e,this.c=+n,this.d=+r,this.e=+i,+o):(this.a=1,this.b=0,this.c=0,this.d=1,this.e=0))}function i(t){var r=[];return t=t.replace(/(?:^|\s)(\w+)\(([^)]+)\)/g,function(t,e,n){return n=n.split(/\s*,\s*|\s+/),"rotate"==e&&1==n.length&&n.push(0,0),"scale"==e&&(2==n.length&&n.push(0,0),1==n.length&&n.push(n[0],0,0)),"skewX"==e?r.push(["m",1,0,j.tan(a(n[0])),1,0,0]):"skewY"==e?r.push(["m",1,j.tan(a(n[0])),0,1,0,0]):r.push([e.charAt(0)].concat(n)),t}),r}function o(t,e){var n=ct(t),r=new x;if(n)for(var i=0,o=n.length;i<o;i++){var a,s,l,u,c,f=n[i],d=f.length,h=A(f[0]).toLowerCase(),p=f[0]!=h,g=p?r.invert():0;"t"==h&&2==d?r.translate(f[1],0):"t"==h&&3==d?p?(a=g.x(0,0),s=g.y(0,0),l=g.x(f[1],f[2]),u=g.y(f[1],f[2]),r.translate(l-a,u-s)):r.translate(f[1],f[2]):"r"==h?2==d?(c=c||e,r.rotate(f[1],c.x+c.width/2,c.y+c.height/2)):4==d&&(p?(l=g.x(f[2],f[3]),u=g.y(f[2],f[3]),r.rotate(f[1],l,u)):r.rotate(f[1],f[2],f[3])):"s"==h?2==d||3==d?(c=c||e,r.scale(f[1],f[d-1],c.x+c.width/2,c.y+c.height/2)):4==d?p?(l=g.x(f[2],f[3]),u=g.y(f[2],f[3]),r.scale(f[1],f[1],l,u)):r.scale(f[1],f[1],f[2],f[3]):5==d&&(p?(l=g.x(f[3],f[4]),u=g.y(f[3],f[4]),r.scale(f[1],f[2],l,u)):r.scale(f[1],f[2],f[3],f[4])):"m"==h&&7==d&&r.add(f[1],f[2],f[3],f[4],f[5],f[6])}return r}function u(t,e){if(null==e){var n=!0;if(!(e="linearGradient"==t.type||"radialGradient"==t.type?t.node.getAttribute("gradientTransform"):"pattern"==t.type?t.node.getAttribute("patternTransform"):t.node.getAttribute("transform")))return new x;e=i(e)}else y(e=l._.rgTransform.test(e)?A(e).replace(/\.{3}|\u2026/g,t._.transform||D):i(e),"array")&&(e=l.path?l.path.toString.call(e):A(e)),t._.transform=e;var r=o(e,t.getBBox(1));return n?r:void(t.matrix=r)}function c(t){var e=l._.someDefs;if(e&&ht(e.ownerDocument.documentElement,e))return e;var n=t.node.ownerSVGElement&&w(t.node.ownerSVGElement)||t.node.parentNode&&w(t.node.parentNode)||l.select("svg")||l(0,0),r=n.select("defs"),i=null!=r&&r.node;return i||(i=b("defs",n.node).node),l._.someDefs=i}function n(n,r,i){function t(t){return null==t?D:t==+t?t:(p(l,{width:t}),l.getBBox().width)}function e(t){return null==t?D:t==+t?t:(p(l,{height:t}),l.getBBox().height)}function o(t,e){null==r?s[t]=e(n.attr(t)):t==r&&(s=e(null==i?n.attr(t):i))}var a=c(n),s={},l=a.querySelector(".svg---mgr");switch(l||(p(l=p("rect"),{width:10,height:10,class:"svg---mgr"}),a.appendChild(l)),n.type){case"rect":o("rx",t),o("ry",e);case"image":o("width",t),o("height",e);case"text":o("x",t),o("y",e);break;case"circle":o("cx",t),o("cy",e),o("r",t);break;case"ellipse":o("cx",t),o("cy",e),o("rx",t),o("ry",e);break;case"line":o("x1",t),o("x2",t),o("y1",e),o("y2",e);break;case"marker":o("refX",t),o("markerWidth",t),o("refY",e),o("markerHeight",e);break;case"radialGradient":o("fx",t),o("fy",e);break;case"tspan":o("dx",t),o("dy",e);break;default:o(r,t)}return s}function f(t){y(t,"array")||(t=Array.prototype.slice.call(arguments,0));for(var e=0,n=0,r=this.node;this[e];)delete this[e++];for(e=0;e<t.length;e++)"set"==t[e].type?t[e].forEach(function(t){r.appendChild(t.node)}):r.appendChild(t[e].node);var i=r.childNodes;for(e=0;e<i.length;e++)this[n++]=w(i[e]);return this}function d(t){if(t.snap in et)return et[t.snap];var e,n=this.id=Q();try{e=t.ownerSVGElement}catch(t){}if(this.node=t,e&&(this.paper=new m(e)),this.type=t.tagName,this.anims={},this._={transform:[]},t.snap=n,"g"==(et[n]=this).type)for(var r in this.add=f,m.prototype)m.prototype[_](r)&&(this[r]=m.prototype[r])}function h(t){for(var e,n=0,r=t.length;n<r;n++)if(e=e||t[n])return e}function v(t){this.node=t}function b(t,e){var n=p(t);e.appendChild(n);var r=w(n);return r.type=t,r}function m(t,e){var n,r,i,o=m.prototype;if(t&&"svg"==t.tagName){if(t.snap in et)return et[t.snap];for(var a in n=new d(t),r=t.getElementsByTagName("desc")[0],i=t.getElementsByTagName("defs")[0],r||((r=p("desc")).appendChild(B.doc.createTextNode("Created with Snap")),n.node.appendChild(r)),i||(i=p("defs"),n.node.appendChild(i)),n.defs=i,o)o[_](a)&&(n[a]=o[a]);n.paper=n.root=n}else p((n=b("svg",B.doc.body)).node,{height:e,version:1.1,width:t,xmlns:tt});return n}function w(t){return t?t instanceof d||t instanceof v?t:"svg"==t.tagName?new m(t):new d(t):t}function C(){return this.selectAll("stop")}function S(t,e){var n=p("stop"),r={offset:+e+"%"};return t=l.color(t),r["stop-color"]=t.hex,t.opacity<1&&(r["stop-opacity"]=t.opacity),p(n,r),this.node.appendChild(n),this}function k(){if("linearGradient"==this.type){var t=p(this.node,"x1")||0,e=p(this.node,"x2")||1,n=p(this.node,"y1")||0,r=p(this.node,"y2")||0;return l._.box(t,n,j.abs(e-t),j.abs(r-n))}var i=this.node.cx||.5,o=this.node.cy||.5,a=this.node.r||0;return l._.box(i-a,o-a,2*a,2*a)}function E(t,e){function n(t,e){for(var n=(e-s)/(t-l),r=l;r<t;r++)o[r].offset=+(+s+n*(r-l)).toFixed(2);l=t,s=e}var r,i=h(mt("snap.util.grad.parse",null,e));if(!i)return null;i.params.unshift(t),r="l"==i.type.toLowerCase()?T.apply(0,i.params):M.apply(0,i.params),i.type!=i.type.toLowerCase()&&p(r.node,{gradientUnits:"userSpaceOnUse"});var o=i.stops,a=o.length,s=0,l=0;a--;for(var u=0;u<a;u++)"offset"in o[u]&&n(u,o[u].offset);for(o[a].offset=o[a].offset||100,n(a,o[a].offset),u=0;u<=a;u++){var c=o[u];r.addStop(c.color,c.offset)}return r}function T(t,e,n,r,i){var o=b("linearGradient",t);return o.stops=C,o.addStop=S,o.getBBox=k,null!=e&&p(o.node,{x1:e,y1:n,x2:r,y2:i}),o}function M(t,e,n,r,i,o){var a=b("radialGradient",t);return a.stops=C,a.addStop=S,a.getBBox=k,null!=e&&p(a.node,{cx:e,cy:n,r:r}),null!=i&&null!=o&&p(a.node,{fx:i,fy:o}),a}function t(i){return function(t){if(mt.stop(),t instanceof v&&1==t.node.childNodes.length&&("radialGradient"==t.node.firstChild.tagName||"linearGradient"==t.node.firstChild.tagName||"pattern"==t.node.firstChild.tagName)&&(t=t.node.firstChild,c(this).appendChild(t),t=w(t)),t instanceof d)if("radialGradient"==t.type||"linearGradient"==t.type||"pattern"==t.type){t.node.id||p(t.node,{id:t.id});var e=nt(t.node.id)}else e=t.attr(i);else if((e=l.color(t)).error){var n=E(c(this),t);e=n?(n.node.id||p(n.node,{id:n.id}),nt(n.node.id)):t}else e=A(e);var r={};r[i]=e,p(this.node,r),this.node.style[i]=D}}l.version="0.2.0",l.toString=function(){return"Snap v"+this.version},l._={};var B={win:vt,doc:vt.document};l._.glob=B;var r,F,_="hasOwnProperty",A=String,N=parseFloat,P=parseInt,j=Math,L=j.max,q=j.min,O=j.abs,z=(j.pow,j.PI),D=(j.round,""),R=Object.prototype.toString,U=/^\s*((#[a-f\d]{6})|(#[a-f\d]{3})|rgba?\(\s*([\d\.]+%?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+%?(?:\s*,\s*[\d\.]+%?)?)\s*\)|hsba?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?%?)\s*\)|hsla?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?%?)\s*\))\s*$/i,G=/^url\(#?([^)]+)\)$/,$="\t\n\v\f\r   ᠎             　\u2028\u2029",V=new RegExp("[,"+$+"]+"),I=(new RegExp("["+$+"]","g"),new RegExp("["+$+"]*,["+$+"]*")),H={hs:1,rg:1},X=new RegExp("([a-z])["+$+",]*((-?\\d*\\.?\\d*(?:e[\\-+]?\\d+)?["+$+"]*,?["+$+"]*)+)","ig"),Y=new RegExp("([rstm])["+$+",]*((-?\\d*\\.?\\d*(?:e[\\-+]?\\d+)?["+$+"]*,?["+$+"]*)+)","ig"),W=new RegExp("(-?\\d*\\.?\\d*(?:e[\\-+]?\\d+)?)["+$+"]*,?["+$+"]*","ig"),J=0,Z="S"+(+new Date).toString(36),Q=function(){return Z+(J++).toString(36)},K="http://www.w3.org/1999/xlink",tt="http://www.w3.org/2000/svg",et={},nt=l.url=function(t){return"url('#"+t+"')"};l._.$=p,l._.id=Q,l.format=(r=/\{([^\}]+)\}/g,F=/(?:(?:^|\.)(.+?)(?=\[|\.|$|\()|\[('|")(.+?)\2\])(\(\))?/g,function(t,i){return A(t).replace(r,function(t,e){return n=t,o=r=i,e.replace(F,function(t,e,n,r,i){e=e||r,o&&(e in o&&(o=o[e]),"function"==typeof o&&i&&(o=o()))}),o=(null==o||o==r?n:o)+"";var n,r,o})});var rt=function(){function i(){this.parentNode.removeChild(this)}return function(t,e){var n=B.doc.createElement("img"),r=B.doc.body;n.style.cssText="position:absolute;left:-9999em;top:-9999em",n.onload=function(){e.call(n),n.onload=n.onerror=null,r.removeChild(n)},n.onerror=i,r.appendChild(n),n.src=t}}();l._.clone=function t(e){if("function"==typeof e||Object(e)!==e)return e;var n=new e.constructor;for(var r in e)e[_](r)&&(n[r]=t(e[r]));return n},l._.cacher=e,l.rad=a,l.deg=s,l.angle=function t(e,n,r,i,o,a){if(null!=o)return t(e,n,o,a)-t(r,i,o,a);var s=e-r,l=n-i;return s||l?(180+180*j.atan2(-l,-s)/z+360)%360:0},l.is=y,l.snapTo=function(t,e,n){if(n=y(n,"finite")?n:10,y(t,"array")){for(var r=t.length;r--;)if(O(t[r]-e)<=n)return t[r]}else{var i=e%(t=+t);if(i<n)return e-i;if(t-n<i)return e-i+t}return e},function(t){function i(t){return t[0]*t[0]+t[1]*t[1]}function o(t){var e=j.sqrt(i(t));t[0]&&(t[0]/=e),t[1]&&(t[1]/=e)}t.add=function(t,e,n,r,i,o){var a,s,l,u,c=[[],[],[]],f=[[this.a,this.c,this.e],[this.b,this.d,this.f],[0,0,1]],d=[[t,n,i],[e,r,o],[0,0,1]];for(t&&t instanceof x&&(d=[[t.a,t.c,t.e],[t.b,t.d,t.f],[0,0,1]]),a=0;a<3;a++)for(s=0;s<3;s++){for(l=u=0;l<3;l++)u+=f[a][l]*d[l][s];c[a][s]=u}return this.a=c[0][0],this.b=c[1][0],this.c=c[0][1],this.d=c[1][1],this.e=c[0][2],this.f=c[1][2],this},t.invert=function(){var t=this,e=t.a*t.d-t.b*t.c;return new x(t.d/e,-t.b/e,-t.c/e,t.a/e,(t.c*t.f-t.d*t.e)/e,(t.b*t.e-t.a*t.f)/e)},t.clone=function(){return new x(this.a,this.b,this.c,this.d,this.e,this.f)},t.translate=function(t,e){return this.add(1,0,0,1,t,e)},t.scale=function(t,e,n,r){return null==e&&(e=t),(n||r)&&this.add(1,0,0,1,n,r),this.add(t,0,0,e,0,0),(n||r)&&this.add(1,0,0,1,-n,-r),this},t.rotate=function(t,e,n){t=a(t),e=e||0,n=n||0;var r=+j.cos(t).toFixed(9),i=+j.sin(t).toFixed(9);return this.add(r,i,-i,r,e,n),this.add(1,0,0,1,-e,-n)},t.x=function(t,e){return t*this.a+e*this.c+this.e},t.y=function(t,e){return t*this.b+e*this.d+this.f},t.get=function(t){return+this[A.fromCharCode(97+t)].toFixed(4)},t.toString=function(){return"matrix("+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)].join()+")"},t.offset=function(){return[this.e.toFixed(4),this.f.toFixed(4)]},t.split=function(){var t={};t.dx=this.e,t.dy=this.f;var e=[[this.a,this.c],[this.b,this.d]];t.scalex=j.sqrt(i(e[0])),o(e[0]),t.shear=e[0][0]*e[1][0]+e[0][1]*e[1][1],e[1]=[e[1][0]-e[0][0]*t.shear,e[1][1]-e[0][1]*t.shear],t.scaley=j.sqrt(i(e[1])),o(e[1]),t.shear/=t.scaley;var n=-e[0][1],r=e[1][1];return r<0?(t.rotate=s(j.acos(r)),n<0&&(t.rotate=360-t.rotate)):t.rotate=s(j.asin(n)),t.isSimple=!(+t.shear.toFixed(9)||t.scalex.toFixed(9)!=t.scaley.toFixed(9)&&t.rotate),t.isSuperSimple=!+t.shear.toFixed(9)&&t.scalex.toFixed(9)==t.scaley.toFixed(9)&&!t.rotate,t.noRotation=!+t.shear.toFixed(9)&&!t.rotate,t},t.toTransformString=function(t){var e=t||this.split();return e.isSimple?(e.scalex=+e.scalex.toFixed(4),e.scaley=+e.scaley.toFixed(4),e.rotate=+e.rotate.toFixed(4),(e.dx||e.dy?"t"+[+e.dx.toFixed(4),+e.dy.toFixed(4)]:D)+(1!=e.scalex||1!=e.scaley?"s"+[e.scalex,e.scaley,0,0]:D)+(e.rotate?"r"+[+e.rotate.toFixed(4),0,0]:D)):"m"+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)]}}(x.prototype),l.Matrix=x,l.getRGB=e(function(t){if(!t||(t=A(t)).indexOf("-")+1)return{r:-1,g:-1,b:-1,hex:"none",error:1,toString:st};if("none"==t)return{r:-1,g:-1,b:-1,hex:"none",toString:st};if(!(H[_](t.toLowerCase().substring(0,2))||"#"==t.charAt())&&(t=it(t)),!t)return{r:-1,g:-1,b:-1,hex:"none",error:1,toString:st};var e,n,r,i,o,a,s=t.match(U);return s?(s[2]&&(r=P(s[2].substring(5),16),n=P(s[2].substring(3,5),16),e=P(s[2].substring(1,3),16)),s[3]&&(r=P((o=s[3].charAt(3))+o,16),n=P((o=s[3].charAt(2))+o,16),e=P((o=s[3].charAt(1))+o,16)),s[4]&&(a=s[4].split(I),e=N(a[0]),"%"==a[0].slice(-1)&&(e*=2.55),n=N(a[1]),"%"==a[1].slice(-1)&&(n*=2.55),r=N(a[2]),"%"==a[2].slice(-1)&&(r*=2.55),"rgba"==s[1].toLowerCase().slice(0,4)&&(i=N(a[3])),a[3]&&"%"==a[3].slice(-1)&&(i/=100)),s[5]?(a=s[5].split(I),e=N(a[0]),"%"==a[0].slice(-1)&&(e/=100),n=N(a[1]),"%"==a[1].slice(-1)&&(n/=100),r=N(a[2]),"%"==a[2].slice(-1)&&(r/=100),("deg"==a[0].slice(-3)||"°"==a[0].slice(-1))&&(e/=360),"hsba"==s[1].toLowerCase().slice(0,4)&&(i=N(a[3])),a[3]&&"%"==a[3].slice(-1)&&(i/=100),l.hsb2rgb(e,n,r,i)):s[6]?(a=s[6].split(I),e=N(a[0]),"%"==a[0].slice(-1)&&(e/=100),n=N(a[1]),"%"==a[1].slice(-1)&&(n/=100),r=N(a[2]),"%"==a[2].slice(-1)&&(r/=100),("deg"==a[0].slice(-3)||"°"==a[0].slice(-1))&&(e/=360),"hsla"==s[1].toLowerCase().slice(0,4)&&(i=N(a[3])),a[3]&&"%"==a[3].slice(-1)&&(i/=100),l.hsl2rgb(e,n,r,i)):(e=q(j.round(e),255),n=q(j.round(n),255),r=q(j.round(r),255),i=q(L(i,0),1),(s={r:e,g:n,b:r,toString:st}).hex="#"+(16777216|r|n<<8|e<<16).toString(16).slice(1),s.opacity=y(i,"finite")?i:1,s)):{r:-1,g:-1,b:-1,hex:"none",error:1,toString:st}},l),l.hsb=e(function(t,e,n){return l.hsb2rgb(t,e,n).hex}),l.hsl=e(function(t,e,n){return l.hsl2rgb(t,e,n).hex}),l.rgb=e(function(t,e,n,r){if(y(r,"finite")){var i=j.round;return"rgba("+[i(t),i(e),i(n),+r.toFixed(2)]+")"}return"#"+(16777216|n|e<<8|t<<16).toString(16).slice(1)});var it=function(t){var n=B.doc.getElementsByTagName("head")[0],r="rgb(255, 0, 0)";return(it=e(function(t){if("red"==t.toLowerCase())return r;n.style.color=r,n.style.color=t;var e=B.doc.defaultView.getComputedStyle(n,D).getPropertyValue("color");return e==r?null:e}))(t)},ot=function(){return"hsb("+[this.h,this.s,this.b]+")"},at=function(){return"hsl("+[this.h,this.s,this.l]+")"},st=function(){return 1==this.opacity||null==this.opacity?this.hex:"rgba("+[this.r,this.g,this.b,this.opacity]+")"},lt=function(t,e,n){if(null==e&&y(t,"object")&&"r"in t&&"g"in t&&"b"in t&&(n=t.b,e=t.g,t=t.r),null==e&&y(t,string)){var r=l.getRGB(t);t=r.r,e=r.g,n=r.b}return(1<t||1<e||1<n)&&(t/=255,e/=255,n/=255),[t,e,n]},ut=function(t,e,n,r){var i={r:t=j.round(255*t),g:e=j.round(255*e),b:n=j.round(255*n),opacity:y(r,"finite")?r:1,hex:l.rgb(t,e,n),toString:st};return y(r,"finite")&&(i.opacity=r),i};l.color=function(t){var e;return y(t,"object")&&"h"in t&&"s"in t&&"b"in t?(e=l.hsb2rgb(t),t.r=e.r,t.g=e.g,t.b=e.b,t.opacity=1,t.hex=e.hex):y(t,"object")&&"h"in t&&"s"in t&&"l"in t?(e=l.hsl2rgb(t),t.r=e.r,t.g=e.g,t.b=e.b,t.opacity=1,t.hex=e.hex):(y(t,"string")&&(t=l.getRGB(t)),y(t,"object")&&"r"in t&&"g"in t&&"b"in t&&!("error"in t)?(e=l.rgb2hsl(t),t.h=e.h,t.s=e.s,t.l=e.l,e=l.rgb2hsb(t),t.v=e.b):((t={hex:"none"}).r=t.g=t.b=t.h=t.s=t.v=t.l=-1,t.error=1)),t.toString=st,t},l.hsb2rgb=function(t,e,n,r){var i,o,a,s,l;return y(t,"object")&&"h"in t&&"s"in t&&"b"in t&&(n=t.b,e=t.s,r=(t=t.h).o),s=(l=n*e)*(1-O((t=(t*=360)%360/60)%2-1)),i=o=a=n-l,ut(i+=[l,s,0,0,s,l][t=~~t],o+=[s,l,l,s,0,0][t],a+=[0,0,s,l,l,s][t],r)},l.hsl2rgb=function(t,e,n,r){var i,o,a,s,l;return y(t,"object")&&"h"in t&&"s"in t&&"l"in t&&(n=t.l,e=t.s,t=t.h),(1<t||1<e||1<n)&&(t/=360,e/=100,n/=100),s=(l=2*e*(n<.5?n:1-n))*(1-O((t=(t*=360)%360/60)%2-1)),i=o=a=n-l/2,ut(i+=[l,s,0,0,s,l][t=~~t],o+=[s,l,l,s,0,0][t],a+=[0,0,s,l,l,s][t],r)},l.rgb2hsb=function(t,e,n){var r,i;return t=(n=lt(t,e,n))[0],e=n[1],n=n[2],{h:((0==(i=(r=L(t,e,n))-q(t,e,n))?null:r==t?(e-n)/i:r==e?(n-t)/i+2:(t-e)/i+4)+360)%6*60/360,s:0==i?0:i/r,b:r,toString:ot}},l.rgb2hsl=function(t,e,n){var r,i,o,a;return t=(n=lt(t,e,n))[0],e=n[1],n=n[2],r=((i=L(t,e,n))+(o=q(t,e,n)))/2,{h:((0==(a=i-o)?null:i==t?(e-n)/a:i==e?(n-t)/a+2:(t-e)/a+4)+360)%6*60/360,s:0==a?0:r<.5?a/(2*r):a/(2-2*r),l:r,toString:at}},l.parsePathString=function(t){if(!t)return null;var e=l.path(t);if(e.arr)return l.path.clone(e.arr);var o={a:7,c:6,o:2,h:1,l:2,m:2,r:4,q:4,s:4,t:2,v:1,u:3,z:0},a=[];return y(t,"array")&&y(t[0],"array")&&(a=l.path.clone(t)),a.length||A(t).replace(X,function(t,e,n){var r=[],i=e.toLowerCase();if(n.replace(W,function(t,e){e&&r.push(+e)}),"m"==i&&2<r.length&&(a.push([e].concat(r.splice(0,2))),i="l",e="m"==e?"l":"L"),"o"==i&&1==r.length&&a.push([e,r[0]]),"r"==i)a.push([e].concat(r));else for(;r.length>=o[i]&&(a.push([e].concat(r.splice(0,o[i]))),o[i]););}),a.toString=l.path.toString,e.arr=l.path.clone(a),a};var ct=l.parseTransformString=function(t){if(!t)return null;var i=[];return y(t,"array")&&y(t[0],"array")&&(i=l.path.clone(t)),i.length||A(t).replace(Y,function(t,e,n){var r=[];e.toLowerCase(),n.replace(W,function(t,e){e&&r.push(+e)}),i.push([e].concat(r))}),i.toString=l.path.toString,i};l._.svgTransform2string=i,l._.rgTransform=new RegExp("^[a-z]["+$+"]*-?\\.?\\d","i"),l._.transform2matrix=o,l._unit2px=n;var ft,dt,ht=B.doc.contains||B.doc.compareDocumentPosition?function(t,e){var n=9==t.nodeType?t.documentElement:t,r=e&&e.parentNode;return t==r||!(!r||1!=r.nodeType||!(n.contains?n.contains(r):t.compareDocumentPosition&&16&t.compareDocumentPosition(r)))}:function(t,e){if(e)for(;e;)if((e=e.parentNode)==t)return!0;return!1};l._.getSomeDefs=c,l.select=function(t){return w(B.doc.querySelector(t))},l.selectAll=function(t){for(var e=B.doc.querySelectorAll(t),n=(l.set||Array)(),r=0;r<e.length;r++)n.push(w(e[r]));return n},function(t){function v(n,r,i){return function(t){var e=t.slice(n,r);return 1==e.length&&(e=e[0]),i?i(e):e}}function e(o){return function(){var t=o?"<"+this.type:"",e=this.node.attributes,n=this.node.childNodes;if(o)for(var r=0,i=e.length;r<i;r++)t+=" "+e[r].name+'="'+e[r].value.replace(/"/g,'\\"')+'"';if(n.length){for(o&&(t+=">"),r=0,i=n.length;r<i;r++)3==n[r].nodeType?t+=n[r].nodeValue:1==n[r].nodeType&&(t+=w(n[r]).toString());o&&(t+="</"+this.type+">")}else o&&(t+="/>");return t}}t.attr=function(t,e){var n=this;if(n.node,!t)return n;if(y(t,"string")){if(!(1<arguments.length))return h(mt("snap.util.getattr."+t,n));var r={};r[t]=e,t=r}for(var i in t)t[_](i)&&mt("snap.util.attr."+i,n,t[i]);return n},t.getBBox=function(t){var e=this;if("use"==e.type&&(e=e.original),e.removed)return{};var n=e._;return t?(n.bboxwt=l.path.get[e.type]?l.path.getBBox(e.realPath=l.path.get[e.type](e)):l._.box(e.node.getBBox()),l._.box(n.bboxwt)):(e.realPath=(l.path.get[e.type]||l.path.get.deflt)(e),n.bbox=l.path.getBBox(l.path.map(e.realPath,e.matrix)),l._.box(n.bbox))};var o=function(){return this.string};t.transform=function(t){var e=this._;if(null!=t)return t instanceof x&&(t=t.toTransformString()),u(this,t),this.node&&("linearGradient"==this.type||"radialGradient"==this.type?p(this.node,{gradientTransform:this.matrix}):"pattern"==this.type?p(this.node,{patternTransform:this.matrix}):p(this.node,{transform:this.matrix})),this;var n=new x(this.node.getCTM()),r=u(this),i=r.toTransformString();return{string:A(r)==A(this.matrix)?e.transform:i,globalMatrix:n,localMatrix:r,diffMatrix:n.clone().add(r.invert()),global:n.toTransformString(),local:i,toString:o}},t.parent=function(){return w(this.node.parentNode)},t.append=t.add=function(t){if(t){if("set"==t.type){var e=this;return t.forEach(function(t){e.add(t)}),this}t=w(t),this.node.appendChild(t.node),t.paper=this.paper}return this},t.appendTo=function(t){return t&&(t=w(t)).append(this),this},t.prepend=function(t){if(t){var e=(t=w(t)).parent();this.node.insertBefore(t.node,this.node.firstChild),this.add&&this.add(),t.paper=this.paper,this.parent()&&this.parent().add(),e&&e.add()}return this},t.prependTo=function(t){return(t=w(t)).prepend(this),this},t.before=function(t){if("set"==t.type){var n=this;return t.forEach(function(t){var e=t.parent();n.node.parentNode.insertBefore(t.node,n.node),e&&e.add()}),this.parent().add(),this}var e=(t=w(t)).parent();return this.node.parentNode.insertBefore(t.node,this.node),this.parent()&&this.parent().add(),e&&e.add(),t.paper=this.paper,this},t.after=function(t){var e=(t=w(t)).parent();return this.node.nextSibling?this.node.parentNode.insertBefore(t.node,this.node.nextSibling):this.node.parentNode.appendChild(t.node),this.parent()&&this.parent().add(),e&&e.add(),t.paper=this.paper,this},t.insertBefore=function(t){t=w(t);var e=this.parent();return t.node.parentNode.insertBefore(this.node,t.node),this.paper=t.paper,e&&e.add(),t.parent()&&t.parent().add(),this},t.insertAfter=function(t){t=w(t);var e=this.parent();return t.node.parentNode.insertBefore(this.node,t.node.nextSibling),this.paper=t.paper,e&&e.add(),t.parent()&&t.parent().add(),this},t.remove=function(){var t=this.parent();return this.node.parentNode&&this.node.parentNode.removeChild(this.node),delete this.paper,this.removed=!0,t&&t.add(),this},t.select=function(t){return w(this.node.querySelector(t))},t.selectAll=function(t){for(var e=this.node.querySelectorAll(t),n=(l.set||Array)(),r=0;r<e.length;r++)n.push(w(e[r]));return n},t.asPX=function(t,e){return null==e&&(e=this.attr(t)),+n(this,t,e)},t.use=function(){var t,e=this.node.id;return e||(e=this.id,p(this.node,{id:e})),p((t="linearGradient"==this.type||"radialGradient"==this.type||"pattern"==this.type?b(this.type,this.node.parentNode):b("use",this.node.parentNode)).node,{"xlink:href":"#"+e}),t.original=this,t},t.clone=function(){var t=w(this.node.cloneNode(!0));return p(t.node,"id")&&p(t.node,{id:t.id}),function(t){function e(n,r){var t=p(n.node,r);(t=(t=t&&t.match(o))&&t[2])&&"#"==t.charAt()&&(t=t.substring(1))&&(s[t]=(s[t]||[]).concat(function(t){var e={};e[r]=nt(t),p(n.node,e)}))}function n(e){var t=p(e.node,"xlink:href");t&&"#"==t.charAt()&&(t=t.substring(1))&&(s[t]=(s[t]||[]).concat(function(t){e.attr("xlink:href","#"+t)}))}for(var r,i=t.selectAll("*"),o=/^\s*url\(("|'|)(.*)\1\)\s*$/,a=[],s={},l=0,u=i.length;l<u;l++){e(r=i[l],"fill"),e(r,"stroke"),e(r,"filter"),e(r,"mask"),e(r,"clip-path"),n(r);var c=p(r.node,"id");c&&(p(r.node,{id:r.id}),a.push({old:c,id:r.id}))}for(l=0,u=a.length;l<u;l++){var f=s[a[l].old];if(f)for(var d=0,h=f.length;d<h;d++)f[d](a[l].id)}}(t),t.insertAfter(this),t},t.toDefs=function(){return c(this).appendChild(this.node),this},t.pattern=function(t,e,n,r){var i=b("pattern",c(this));return null==t&&(t=this.getBBox()),y(t,"object")&&"x"in t&&(e=t.y,n=t.width,r=t.height,t=t.x),p(i.node,{x:t,y:e,width:n,height:r,patternUnits:"userSpaceOnUse",id:i.id,viewBox:[t,e,n,r].join(" ")}),i.node.appendChild(this.node),i},t.marker=function(t,e,n,r,i,o){var a=b("marker",c(this));return null==t&&(t=this.getBBox()),y(t,"object")&&"x"in t&&(e=t.y,n=t.width,r=t.height,i=t.refX||t.cx,o=t.refY||t.cy,t=t.x),p(a.node,{viewBox:[t,e,n,r].join(" "),markerWidth:n,markerHeight:r,orient:"auto",refX:i||0,refY:o||0,id:a.id}),a.node.appendChild(this.node),a};var m=function(t,e,n,r){"function"!=typeof n||n.length||(r=n,n=yt.linear),this.attr=t,this.dur=e,n&&(this.easing=n),r&&(this.callback=r)};l.animation=function(t,e,n,r){return new m(t,e,n,r)},t.inAnim=function(){var t=[];for(var e in this.anims)this.anims[_](e)&&function(e){t.push({anim:new m(e._attrs,e.dur,e.easing,e._callback),curStatus:e.status(),status:function(t){return e.status(t)},stop:function(){e.stop()}})}(this.anims[e]);return t},l.animate=function(t,e,n,r,i,o){"function"!=typeof i||i.length||(o=i,i=yt.linear);var a=yt.time(),s=yt(t,e,a,a+r,yt.time,n,i);return o&&mt.once("mina.finish."+s.id,o),s},t.stop=function(){for(var t=this.inAnim(),e=0,n=t.length;e<n;e++)t[e].stop();return this},t.animate=function(t,e,n,r){"function"!=typeof n||n.length||(r=n,n=yt.linear),t instanceof m&&(r=t.callback,e=(n=t.easing).dur,t=t.attr);var i,o,a,s,l=[],u=[],c={},f=this;for(var d in t)if(t[_](d)){f.equal?(i=(s=f.equal(d,A(t[d]))).from,o=s.to,a=s.f):(i=+f.attr(d),o=+t[d]);var h=y(i,"array")?i.length:1;c[d]=v(l.length,l.length+h,a),l=l.concat(i),u=u.concat(o)}var p=yt.time(),g=yt(l,u,p,p+e,yt.time,function(t){var e={};for(var n in c)c[_](n)&&(e[n]=c[n](t));f.attr(e)},n);return(f.anims[g.id]=g)._attrs=t,g._callback=r,mt.once("mina.finish."+g.id,function(){delete f.anims[g.id],r&&r.call(f)}),mt.once("mina.stop."+g.id,function(){delete f.anims[g.id]}),f};var i={};t.data=function(t,e){var n=i[this.id]=i[this.id]||{};if(0==arguments.length)return mt("snap.data.get."+this.id,this,n,null),n;if(1!=arguments.length)return n[t]=e,mt("snap.data.set."+this.id,this,e,t),this;if(l.is(t,"object")){for(var r in t)t[_](r)&&this.data(r,t[r]);return this}return mt("snap.data.get."+this.id,this,n[t],t),n[t]},t.removeData=function(t){return null==t?i[this.id]={}:i[this.id]&&delete i[this.id][t],this},t.outerSVG=t.toString=e(1),t.innerSVG=e()}(d.prototype),l.parse=function(t){var e=B.doc.createDocumentFragment(),n=!0,r=B.doc.createElement("div");if((t=A(t)).match(/^\s*<\s*svg(?:\s|>)/)||(t="<svg>"+t+"</svg>",n=!1),r.innerHTML=t,t=r.getElementsByTagName("svg")[0])if(n)e=t;else for(;t.firstChild;)e.appendChild(t.firstChild);return r.innerHTML=D,new v(e)},v.prototype.select=d.prototype.select,v.prototype.selectAll=d.prototype.selectAll,l.fragment=function(){for(var t=Array.prototype.slice.call(arguments,0),e=B.doc.createDocumentFragment(),n=0,r=t.length;n<r;n++){var i=t[n];i.node&&i.node.nodeType&&e.appendChild(i.node),i.nodeType&&e.appendChild(i),"string"==typeof i&&e.appendChild(l.parse(i).node)}return new v(e)},(dt=m.prototype).el=function(t,e){return b(t,this.node).attr(e)},dt.rect=function(t,e,n,r,i,o){var a;return null==o&&(o=i),y(t,"object")&&"x"in t?a=t:null!=t&&(a={x:t,y:e,width:n,height:r},null!=i&&(a.rx=i,a.ry=o)),this.el("rect",a)},dt.circle=function(t,e,n){var r;return y(t,"object")&&"cx"in t?r=t:null!=t&&(r={cx:t,cy:e,r:n}),this.el("circle",r)},dt.image=function(t,e,n,r,i){var o=b("image",this.node);if(y(t,"object")&&"src"in t)o.attr(t);else if(null!=t){var a={"xlink:href":t,preserveAspectRatio:"none"};null!=e&&null!=n&&(a.x=e,a.y=n),null!=r&&null!=i?(a.width=r,a.height=i):rt(t,function(){p(o.node,{width:this.offsetWidth,height:this.offsetHeight})}),p(o.node,a)}return o},dt.ellipse=function(t,e,n,r){var i=b("ellipse",this.node);return y(t,"object")&&"cx"in t?i.attr(t):null!=t&&i.attr({cx:t,cy:e,rx:n,ry:r}),i},dt.path=function(t){var e=b("path",this.node);return y(t,"object")&&!y(t,"array")?e.attr(t):t&&e.attr({d:t}),e},dt.group=dt.g=function(t){var e=b("g",this.node);for(var n in e.add=f,dt)dt[_](n)&&(e[n]=dt[n]);return 1==arguments.length&&t&&!t.type?e.attr(t):arguments.length&&e.add(Array.prototype.slice.call(arguments,0)),e},dt.text=function(t,e,n){var r=b("text",this.node);return y(t,"object")?r.attr(t):null!=t&&r.attr({x:t,y:e,text:n||""}),r},dt.line=function(t,e,n,r){var i=b("line",this.node);return y(t,"object")?i.attr(t):null!=t&&i.attr({x1:t,x2:n,y1:e,y2:r}),i},dt.polyline=function(t){1<arguments.length&&(t=Array.prototype.slice.call(arguments,0));var e=b("polyline",this.node);return y(t,"object")&&!y(t,"array")?e.attr(t):null!=t&&e.attr({points:t}),e},dt.polygon=function(t){1<arguments.length&&(t=Array.prototype.slice.call(arguments,0));var e=b("polygon",this.node);return y(t,"object")&&!y(t,"array")?e.attr(t):null!=t&&e.attr({points:t}),e},dt.gradient=function(t){return E(this.defs,t)},dt.gradientLinear=function(t,e,n,r){return T(this.defs,t,e,n,r)},dt.gradientRadial=function(t,e,n,r,i){return M(this.defs,t,e,n,r,i)},dt.toString=function(){var t,e=B.doc.createDocumentFragment(),n=B.doc.createElement("div"),r=this.node.cloneNode(!0);return e.appendChild(n),n.appendChild(r),p(r,{xmlns:tt}),t=n.innerHTML,e.removeChild(e.firstChild),t},dt.clear=function(){for(var t,e=this.node.firstChild;e;)t=e.nextSibling,"defs"!=e.tagName&&e.parentNode.removeChild(e),e=t},l.ajax=function(t,e,n,r){var i=new XMLHttpRequest,o=Q();if(i){if(y(e,"function"))r=n,n=e,e=null;else if(y(e,"object")){var a=[];for(var s in e)e.hasOwnProperty(s)&&a.push(encodeURIComponent(s)+"="+encodeURIComponent(e[s]));e=a.join("&")}return i.open(e?"POST":"GET",t,!0),i.setRequestHeader("X-Requested-With","XMLHttpRequest"),e&&i.setRequestHeader("Content-type","application/x-www-form-urlencoded"),n&&(mt.once("snap.ajax."+o+".0",n),mt.once("snap.ajax."+o+".200",n),mt.once("snap.ajax."+o+".304",n)),i.onreadystatechange=function(){4==i.readyState&&mt("snap.ajax."+o+"."+i.status,r,i)},4==i.readyState||i.send(e),i}},l.load=function(t,n,r){l.ajax(t,function(t){var e=l.parse(t.responseText);r?n.call(r,e):n(e)})},mt.on("snap.util.attr.mask",function(t){if(t instanceof d||t instanceof v){if(mt.stop(),t instanceof v&&1==t.node.childNodes.length&&(t=t.node.firstChild,c(this).appendChild(t),t=w(t)),"mask"==t.type)var e=t;else(e=b("mask",c(this))).node.appendChild(t.node),!e.node.id&&p(e.node,{id:e.id});p(this.node,{mask:nt(e.id)})}}),ft=function(t){if(t instanceof d||t instanceof v){if(mt.stop(),"clipPath"==t.type)var e=t;else(e=b("clipPath",c(this))).node.appendChild(t.node),!e.node.id&&p(e.node,{id:e.id});p(this.node,{"clip-path":nt(e.id)})}},mt.on("snap.util.attr.clip",ft),mt.on("snap.util.attr.clip-path",ft),mt.on("snap.util.attr.clipPath",ft),mt.on("snap.util.attr.fill",t("fill")),mt.on("snap.util.attr.stroke",t("stroke"));var pt=/^([lr])(?:\(([^)]*)\))?(.*)$/i;mt.on("snap.util.grad.parse",function(t){var e=(t=A(t)).match(pt);if(!e)return null;var n=e[1],r=e[2],i=e[3];return 1==(r=r.split(/\s*,\s*/).map(function(t){return+t==t?+t:t})).length&&0==r[0]&&(r=[]),{type:n,params:r,stops:i=(i=i.split("-")).map(function(t){var e={color:(t=t.split(":"))[0]};return t[1]&&(e.offset=t[1]),e})}}),mt.on("snap.util.attr.d",function(t){mt.stop(),y(t,"array")&&y(t[0],"array")&&(t=l.path.toString.call(t)),(t=A(t)).match(/[ruo]/i)&&(t=l.path.toAbsolute(t)),p(this.node,{d:t})})(-1),mt.on("snap.util.attr.#text",function(t){mt.stop(),t=A(t);for(var e=B.doc.createTextNode(t);this.node.firstChild;)this.node.removeChild(this.node.firstChild);this.node.appendChild(e)})(-1),mt.on("snap.util.attr.path",function(t){mt.stop(),this.attr({d:t})})(-1),mt.on("snap.util.attr.viewBox",function(t){var e;e=y(t,"object")&&"x"in t?[t.x,t.y,t.width,t.height].join(" "):y(t,"array")?t.join(" "):t,p(this.node,{viewBox:e}),mt.stop()})(-1),mt.on("snap.util.attr.transform",function(t){this.transform(t),mt.stop()})(-1),mt.on("snap.util.attr.r",function(t){"rect"==this.type&&(mt.stop(),p(this.node,{rx:t,ry:t}))})(-1),mt.on("snap.util.attr.textpath",function(t){if(mt.stop(),"text"==this.type){var e,n,r;if(!t&&this.textPath){for(n=this.textPath;n.node.firstChild;)this.node.appendChild(n.node.firstChild);return n.remove(),void delete this.textPath}if(y(t,"string")){var i=c(this),o=w(i.parentNode).path(t);i.appendChild(o.node),e=o.id,o.attr({id:e})}else(t=w(t))instanceof d&&((e=t.attr("id"))||(e=t.id,t.attr({id:e})));if(e)if(n=this.textPath,r=this.node,n)n.attr({"xlink:href":"#"+e});else{for(n=p("textPath",{"xlink:href":"#"+e});r.firstChild;)n.appendChild(r.firstChild);r.appendChild(n),this.textPath=w(n)}}})(-1),mt.on("snap.util.attr.text",function(t){if("text"==this.type){for(var e=this.node,r=function(t){var e=p("tspan");if(y(t,"array"))for(var n=0;n<t.length;n++)e.appendChild(r(t[n]));else e.appendChild(B.doc.createTextNode(t));return e.normalize&&e.normalize(),e};e.firstChild;)e.removeChild(e.firstChild);for(var n=r(t);n.firstChild;)e.appendChild(n.firstChild)}mt.stop()})(-1);var gt={"alignment-baseline":0,"baseline-shift":0,clip:0,"clip-path":0,"clip-rule":0,color:0,"color-interpolation":0,"color-interpolation-filters":0,"color-profile":0,"color-rendering":0,cursor:0,direction:0,display:0,"dominant-baseline":0,"enable-background":0,fill:0,"fill-opacity":0,"fill-rule":0,filter:0,"flood-color":0,"flood-opacity":0,font:0,"font-family":0,"font-size":0,"font-size-adjust":0,"font-stretch":0,"font-style":0,"font-variant":0,"font-weight":0,"glyph-orientation-horizontal":0,"glyph-orientation-vertical":0,"image-rendering":0,kerning:0,"letter-spacing":0,"lighting-color":0,marker:0,"marker-end":0,"marker-mid":0,"marker-start":0,mask:0,opacity:0,overflow:0,"pointer-events":0,"shape-rendering":0,"stop-color":0,"stop-opacity":0,stroke:0,"stroke-dasharray":0,"stroke-dashoffset":0,"stroke-linecap":0,"stroke-linejoin":0,"stroke-miterlimit":0,"stroke-opacity":0,"stroke-width":0,"text-anchor":0,"text-decoration":0,"text-rendering":0,"unicode-bidi":0,visibility:0,"word-spacing":0,"writing-mode":0};mt.on("snap.util.attr",function(t){var e=mt.nt(),n={};n[e=e.substring(e.lastIndexOf(".")+1)]=t;var r=e.replace(/-(\w)/gi,function(t,e){return e.toUpperCase()}),i=e.replace(/[A-Z]/g,function(t){return"-"+t.toLowerCase()});gt[_](i)?this.node.style[r]=null==t?D:t:p(this.node,n)}),mt.on("snap.util.getattr.transform",function(){return mt.stop(),this.transform()})(-1),mt.on("snap.util.getattr.textpath",function(){return mt.stop(),this.textPath})(-1),function(){function t(e){return function(){mt.stop();var t=B.doc.defaultView.getComputedStyle(this.node,null).getPropertyValue("marker-"+e);return"none"==t?t:l(B.doc.getElementById(t.match(G)[1]))}}function e(r){return function(t){mt.stop();var e="marker"+r.charAt(0).toUpperCase()+r.substring(1);if(""!=t&&t){if("marker"==t.type){var n=t.node.id;return n||p(t.node,{id:t.id}),void(this.node.style[e]=nt(n))}}else this.node.style[e]="none"}}mt.on("snap.util.getattr.marker-end",t("end"))(-1),mt.on("snap.util.getattr.markerEnd",t("end"))(-1),mt.on("snap.util.getattr.marker-start",t("start"))(-1),mt.on("snap.util.getattr.markerStart",t("start"))(-1),mt.on("snap.util.getattr.marker-mid",t("mid"))(-1),mt.on("snap.util.getattr.markerMid",t("mid"))(-1),mt.on("snap.util.attr.marker-end",e("end"))(-1),mt.on("snap.util.attr.markerEnd",e("end"))(-1),mt.on("snap.util.attr.marker-start",e("start"))(-1),mt.on("snap.util.attr.markerStart",e("start"))(-1),mt.on("snap.util.attr.marker-mid",e("mid"))(-1),mt.on("snap.util.attr.markerMid",e("mid"))(-1)}(),mt.on("snap.util.getattr.r",function(){return"rect"==this.type&&p(this.node,"rx")==p(this.node,"ry")?(mt.stop(),p(this.node,"rx")):void 0})(-1),mt.on("snap.util.getattr.text",function(){if("text"==this.type||"tspan"==this.type){mt.stop();var t=function t(e){for(var n=[],r=e.childNodes,i=0,o=r.length;i<o;i++){var a=r[i];3==a.nodeType&&n.push(a.nodeValue),"tspan"==a.tagName&&(1==a.childNodes.length&&3==a.firstChild.nodeType?n.push(a.firstChild.nodeValue):n.push(t(a)))}return n}(this.node);return 1==t.length?t[0]:t}})(-1),mt.on("snap.util.getattr.#text",function(){return this.node.textContent})(-1),mt.on("snap.util.getattr.viewBox",function(){mt.stop();var t=p(this.node,"viewBox").split(V);return l._.box(+t[0],+t[1],+t[2],+t[3])})(-1),mt.on("snap.util.getattr.points",function(){var t=p(this.node,"points");return mt.stop(),t.split(V)}),mt.on("snap.util.getattr.path",function(){var t=p(this.node,"d");return mt.stop(),t}),mt.on("snap.util.getattr",function(){var t=mt.nt(),e=(t=t.substring(t.lastIndexOf(".")+1)).replace(/[A-Z]/g,function(t){return"-"+t.toLowerCase()});return gt[_](e)?B.doc.defaultView.getComputedStyle(this.node,null).getPropertyValue(e):p(this.node,t)});return l.getElementByPoint=function(t,e){var n,r,i,o,a,s,l,u=(this.canvas,B.doc.elementFromPoint(t,e));if(B.win.opera&&"svg"==u.tagName){var c=(r=(n=u).getBoundingClientRect(),i=n.ownerDocument,o=i.body,a=i.documentElement,s=a.clientTop||o.clientTop||0,l=a.clientLeft||o.clientLeft||0,{y:r.top+(g.win.pageYOffset||a.scrollTop||o.scrollTop)-s,x:r.left+(g.win.pageXOffset||a.scrollLeft||o.scrollLeft)-l}),f=u.createSVGRect();f.x=t-c.x,f.y=e-c.y,f.width=f.height=1;var d=u.getIntersectionList(f,null);d.length&&(u=d[d.length-1])}return u?w(u):null},l.plugin=function(t){t(l,d,m,B)},B.win.Snap=l}();return e.plugin(function(V,v){function x(e){var n=x.ps=x.ps||{};return n[e]?n[e].sleep=100:n[e]={sleep:100},setTimeout(function(){for(var t in n)n[r](t)&&t!=e&&(n[t].sleep--,!n[t].sleep&&delete n[t])}),n[e]}function h(t,e,n,r){return null==t&&(t=e=n=r=0),null==e&&(e=t.y,n=t.width,r=t.height,t=t.x),{x:t,y:e,width:n,w:n,height:r,h:r,x2:t+n,y2:e+r,cx:t+n/2,cy:e+r/2,r1:I.min(n,r)/2,r2:I.max(n,r)/2,r0:I.sqrt(n*n+r*r)/2,path:s(t,e,n,r),vb:[t,e,n,r].join(" ")}}function b(){return this.join(",").replace(n,"$1")}function w(t){var e=g(t);return e.toString=b,e}function m(t,e,n,r,i,o,a,s,l){return null==l?E(t,e,n,r,i,o,a,s):C(t,e,n,r,i,o,a,s,function(t,e,n,r,i,o,a,s,l){if(!(l<0||E(t,e,n,r,i,o,a,s)<l)){var u,c=.5,f=1-c;for(u=E(t,e,n,r,i,o,a,s,f);.01<X(u-l);)u=E(t,e,n,r,i,o,a,s,f+=(u<l?1:-1)*(c/=2));return f}}(t,e,n,r,i,o,a,s,l))}function t(h,p){function g(t){return+(+t).toFixed(3)}return V._.cacher(function(t,e,n){t instanceof v&&(t=t.attr("d"));for(var r,i,o,a,s,l="",u={},c=0,f=0,d=(t=P(t)).length;f<d;f++){if("M"==(o=t[f])[0])r=+o[1],i=+o[2];else{if(e<c+(a=m(r,i,o[1],o[2],o[3],o[4],o[5],o[6]))){if(p&&!u.start){if(l+=["C"+g((s=m(r,i,o[1],o[2],o[3],o[4],o[5],o[6],e-c)).start.x),g(s.start.y),g(s.m.x),g(s.m.y),g(s.x),g(s.y)],n)return l;u.start=l,l=["M"+g(s.x),g(s.y)+"C"+g(s.n.x),g(s.n.y),g(s.end.x),g(s.end.y),g(o[5]),g(o[6])].join(),c+=a,r=+o[5],i=+o[6];continue}if(!h&&!p)return m(r,i,o[1],o[2],o[3],o[4],o[5],o[6],e-c)}c+=a,r=+o[5],i=+o[6]}l+=o.shift()+o}return u.end=l,h?c:p?u:C(r,i,o[0],o[1],o[2],o[3],o[4],o[5],1)},null,V._.clone)}function C(t,e,n,r,i,o,a,s,l){var u=1-l,c=D(u,3),f=D(u,2),d=l*l,h=d*l,p=t+2*l*(n-t)+d*(i-2*n+t),g=e+2*l*(r-e)+d*(o-2*r+e),v=n+2*l*(i-n)+d*(a-2*i+n),m=r+2*l*(o-r)+d*(s-2*o+r);return{x:c*t+3*f*l*n+3*u*l*l*i+h*a,y:c*e+3*f*l*r+3*u*l*l*o+h*s,m:{x:p,y:g},n:{x:v,y:m},start:{x:u*t+l*n,y:u*e+l*r},end:{x:u*i+l*a,y:u*o+l*s},alpha:90-180*I.atan2(p-v,g-m)/H}}function S(t,e,n,r,i,o,a,s){V.is(t,"array")||(t=[t,e,n,r,i,o,a,s]);var l=p.apply(null,t);return h(l.min.x,l.min.y,l.max.x-l.min.x,l.max.y-l.min.y)}function i(t,e,n){return e>=t.x&&e<=t.x+t.width&&n>=t.y&&n<=t.y+t.height}function k(t,e){return t=h(t),i(e=h(e),t.x,t.y)||i(e,t.x2,t.y)||i(e,t.x,t.y2)||i(e,t.x2,t.y2)||i(t,e.x,e.y)||i(t,e.x2,e.y)||i(t,e.x,e.y2)||i(t,e.x2,e.y2)||(t.x<e.x2&&t.x>e.x||e.x<t.x2&&e.x>t.x)&&(t.y<e.y2&&t.y>e.y||e.y<t.y2&&e.y>t.y)}function y(t,e,n,r,i){return t*(t*(-3*e+9*n-9*r+3*i)+6*e-12*n+6*r)-3*e+3*n}function E(t,e,n,r,i,o,a,s,l){null==l&&(l=1);for(var u=(l=1<l?1:l<0?0:l)/2,c=[-.1252,.1252,-.3678,.3678,-.5873,.5873,-.7699,.7699,-.9041,.9041,-.9816,.9816],f=[.2491,.2491,.2335,.2335,.2032,.2032,.1601,.1601,.1069,.1069,.0472,.0472],d=0,h=0;h<12;h++){var p=u*c[h]+u,g=y(p,t,n,i,a),v=y(p,e,r,o,s),m=g*g+v*v;d+=f[h]*I.sqrt(m)}return u*d}function T(t,e,n,r,i,o,a,s){if(!(z(t,n)<O(i,a)||O(t,n)>z(i,a)||z(e,r)<O(o,s)||O(e,r)>z(o,s))){var l=(t-n)*(o-s)-(e-r)*(i-a);if(l){var u=((t*r-e*n)*(i-a)-(t-n)*(i*s-o*a))/l,c=((t*r-e*n)*(o-s)-(e-r)*(i*s-o*a))/l,f=+u.toFixed(2),d=+c.toFixed(2);if(!(f<+O(t,n).toFixed(2)||f>+z(t,n).toFixed(2)||f<+O(i,a).toFixed(2)||f>+z(i,a).toFixed(2)||d<+O(e,r).toFixed(2)||d>+z(e,r).toFixed(2)||d<+O(o,s).toFixed(2)||d>+z(o,s).toFixed(2)))return{x:u,y:c}}}}function M(t,e,n){if(!k(S(t),S(e)))return n?0:[];for(var r=~~(E.apply(0,t)/5),i=~~(E.apply(0,e)/5),o=[],a=[],s={},l=n?0:[],u=0;u<r+1;u++){var c=C.apply(0,t.concat(u/r));o.push({x:c.x,y:c.y,t:u/r})}for(u=0;u<i+1;u++)c=C.apply(0,e.concat(u/i)),a.push({x:c.x,y:c.y,t:u/i});for(u=0;u<r;u++)for(var f=0;f<i;f++){var d=o[u],h=o[u+1],p=a[f],g=a[f+1],v=X(h.x-d.x)<.001?"y":"x",m=X(g.x-p.x)<.001?"y":"x",y=T(d.x,d.y,h.x,h.y,p.x,p.y,g.x,g.y);if(y){if(s[y.x.toFixed(4)]==y.y.toFixed(4))continue;s[y.x.toFixed(4)]=y.y.toFixed(4);var x=d.t+X((y[v]-d[v])/(h[v]-d[v]))*(h.t-d.t),b=p.t+X((y[m]-p[m])/(g[m]-p[m]))*(g.t-p.t);0<=x&&x<=1&&0<=b&&b<=1&&(n?l++:l.push({x:y.x,y:y.y,t1:x,t2:b}))}}return l}function o(t,e,n){t=P(t),e=P(e);for(var r,i,o,a,s,l,u,c,f,d,h=n?0:[],p=0,g=t.length;p<g;p++){var v=t[p];if("M"==v[0])r=s=v[1],i=l=v[2];else{i="C"==v[0]?(r=(f=[r,i].concat(v.slice(1)))[6],f[7]):(f=[r,i,r,i,s,l,s,l],r=s,l);for(var m=0,y=e.length;m<y;m++){var x=e[m];if("M"==x[0])o=u=x[1],a=c=x[2];else{a="C"==x[0]?(o=(d=[o,a].concat(x.slice(1)))[6],d[7]):(d=[o,a,o,a,u,c,u,c],o=u,c);var b=M(f,d,n);if(n)h+=b;else{for(var w=0,C=b.length;w<C;w++)b[w].segment1=p,b[w].segment2=m,b[w].bez1=f,b[w].bez2=d;h=h.concat(b)}}}}}return h}function a(t){var e=x(t);if(e.bbox)return g(e.bbox);if(!t)return h();for(var n,r=0,i=0,o=[],a=[],s=0,l=(t=P(t)).length;s<l;s++)if("M"==(n=t[s])[0])r=n[1],i=n[2],o.push(r),a.push(i);else{var u=p(r,i,n[1],n[2],n[3],n[4],n[5],n[6]);o=o.concat(u.min.x,u.max.x),a=a.concat(u.min.y,u.max.y),r=n[5],i=n[6]}var c=O.apply(0,o),f=O.apply(0,a),d=h(c,f,z.apply(0,o)-c,z.apply(0,a)-f);return e.bbox=g(d),d}function s(t,e,n,r,i){if(i)return[["M",t+i,e],["l",n-2*i,0],["a",i,i,0,0,1,i,i],["l",0,r-2*i],["a",i,i,0,0,1,-i,i],["l",2*i-n,0],["a",i,i,0,0,1,-i,-i],["l",0,2*i-r],["a",i,i,0,0,1,i,-i],["z"]];var o=[["M",t,e],["l",n,0],["l",0,r],["l",-n,0],["z"]];return o.toString=b,o}function B(t,e,n,r,i){if(null==i&&null==r&&(r=n),null!=i)var o=Math.PI/180,a=t+n*Math.cos(-r*o),s=t+n*Math.cos(-i*o),l=[["M",a,e+n*Math.sin(-r*o)],["A",n,n,0,+(180<i-r),0,s,e+n*Math.sin(-i*o)]];else l=[["M",t,e],["m",0,-r],["a",n,r,0,1,1,0,2*r],["a",n,r,0,1,1,0,-2*r],["z"]];return l.toString=b,l}function F(t){var e=x(t);if(e.abs)return w(e.abs);if(L(t,"array")&&L(t&&t[0],"array")||(t=V.parsePathString(t)),!t||!t.length)return[["M",0,0]];var n,r=[],i=0,o=0,a=0,s=0,l=0;"M"==t[0][0]&&(a=i=+t[0][1],s=o=+t[0][2],l++,r[0]=["M",i,o]);for(var u,c,f=3==t.length&&"M"==t[0][0]&&"R"==t[1][0].toUpperCase()&&"Z"==t[2][0].toUpperCase(),d=l,h=t.length;d<h;d++){if(r.push(u=[]),(n=(c=t[d])[0])!=n.toUpperCase())switch(u[0]=n.toUpperCase(),u[0]){case"A":u[1]=c[1],u[2]=c[2],u[3]=c[3],u[4]=c[4],u[5]=c[5],u[6]=+(c[6]+i),u[7]=+(c[7]+o);break;case"V":u[1]=+c[1]+o;break;case"H":u[1]=+c[1]+i;break;case"R":for(var p=[i,o].concat(c.slice(1)),g=2,v=p.length;g<v;g++)p[g]=+p[g]+i,p[++g]=+p[g]+o;r.pop(),r=r.concat(j(p,f));break;case"O":r.pop(),(p=B(i,o,c[1],c[2])).push(p[0]),r=r.concat(p);break;case"U":r.pop(),r=r.concat(B(i,o,c[1],c[2],c[3])),u=["U"].concat(r[r.length-1].slice(-2));break;case"M":a=+c[1]+i,s=+c[2]+o;default:for(g=1,v=c.length;g<v;g++)u[g]=+c[g]+(g%2?i:o)}else if("R"==n)p=[i,o].concat(c.slice(1)),r.pop(),r=r.concat(j(p,f)),u=["R"].concat(c.slice(-2));else if("O"==n)r.pop(),(p=B(i,o,c[1],c[2])).push(p[0]),r=r.concat(p);else if("U"==n)r.pop(),r=r.concat(B(i,o,c[1],c[2],c[3])),u=["U"].concat(r[r.length-1].slice(-2));else for(var m=0,y=c.length;m<y;m++)u[m]=c[m];if("O"!=(n=n.toUpperCase()))switch(u[0]){case"Z":i=a,o=s;break;case"H":i=u[1];break;case"V":o=u[1];break;case"M":a=u[u.length-2],s=u[u.length-1];default:i=u[u.length-2],o=u[u.length-1]}}return r.toString=b,e.abs=w(r),r}function _(t,e,n,r){return[t,e,n,r,n,r]}function A(t,e,n,r,i,o){return[1/3*t+2/3*n,1/3*e+2/3*r,1/3*i+2/3*n,1/3*o+2/3*r,i,o]}function N(t,e,n,r,i,o,a,s,l){var u=1-l;return{x:D(u,3)*t+3*D(u,2)*l*n+3*u*l*l*i+D(l,3)*a,y:D(u,3)*e+3*D(u,2)*l*r+3*u*l*l*o+D(l,3)*s}}function p(t,e,n,r,i,o,a,s){var l,u=i-2*n+t-(a-2*i+n),c=2*(n-t)-2*(i-n),f=t-n,d=(-c+I.sqrt(c*c-4*u*f))/2/u,h=(-c-I.sqrt(c*c-4*u*f))/2/u,p=[e,s],g=[t,a];return"1e12"<X(d)&&(d=.5),"1e12"<X(h)&&(h=.5),0<d&&d<1&&(l=N(t,e,n,r,i,o,a,s,d),g.push(l.x),p.push(l.y)),0<h&&h<1&&(l=N(t,e,n,r,i,o,a,s,h),g.push(l.x),p.push(l.y)),u=o-2*r+e-(s-2*o+r),f=e-r,d=(-(c=2*(r-e)-2*(o-r))+I.sqrt(c*c-4*u*f))/2/u,h=(-c-I.sqrt(c*c-4*u*f))/2/u,"1e12"<X(d)&&(d=.5),"1e12"<X(h)&&(h=.5),0<d&&d<1&&(l=N(t,e,n,r,i,o,a,s,d),g.push(l.x),p.push(l.y)),0<h&&h<1&&(l=N(t,e,n,r,i,o,a,s,h),g.push(l.x),p.push(l.y)),{min:{x:O.apply(0,g),y:O.apply(0,p)},max:{x:z.apply(0,g),y:z.apply(0,p)}}}function P(t,e){var n=!e&&x(t);if(!e&&n.curve)return w(n.curve);for(var o=F(t),a=e&&F(e),r={x:0,y:0,bx:0,by:0,X:0,Y:0,qx:null,qy:null},i={x:0,y:0,bx:0,by:0,X:0,Y:0,qx:null,qy:null},s=function(t,e){if(!t)return["C",e.x,e.y,e.x,e.y,e.x,e.y];switch(!(t[0]in{T:1,Q:1})&&(e.qx=e.qy=null),t[0]){case"M":e.X=t[1],e.Y=t[2];break;case"A":t=["C"].concat(function t(e,n,r,i,o,a,s,l,u,c){var f,d=120*H/180,h=H/180*(+o||0),p=[],g=V._.cacher(function(t,e,n){return{x:t*I.cos(n)-e*I.sin(n),y:t*I.sin(n)+e*I.cos(n)}});if(c)k=c[0],E=c[1],C=c[2],S=c[3];else{e=(f=g(e,n,-h)).x,n=f.y,l=(f=g(l,u,-h)).x,u=f.y;var v=(I.cos(H/180*o),I.sin(H/180*o),(e-l)/2),m=(n-u)/2,y=v*v/(r*r)+m*m/(i*i);1<y&&(r*=y=I.sqrt(y),i*=y);var x=r*r,b=i*i,w=(a==s?-1:1)*I.sqrt(X((x*b-x*m*m-b*v*v)/(x*m*m+b*v*v))),C=w*r*m/i+(e+l)/2,S=w*-i*v/r+(n+u)/2,k=I.asin(((n-S)/i).toFixed(9)),E=I.asin(((u-S)/i).toFixed(9));(k=e<C?H-k:k)<0&&(k=2*H+k),(E=l<C?H-E:E)<0&&(E=2*H+E),s&&E<k&&(k-=2*H),!s&&k<E&&(E-=2*H)}var T=E-k;if(X(T)>d){var M=E,B=l,F=u;E=k+d*(s&&k<E?1:-1),p=t(l=C+r*I.cos(E),u=S+i*I.sin(E),r,i,o,0,s,B,F,[E,M,C,S])}T=E-k;var _=I.cos(k),A=I.sin(k),N=I.cos(E),P=I.sin(E),j=I.tan(T/4),L=4/3*r*j,q=4/3*i*j,O=[e,n],z=[e+L*A,n-q*_],D=[l+L*P,u-q*N],R=[l,u];if(z[0]=2*O[0]-z[0],z[1]=2*O[1]-z[1],c)return[z,D,R].concat(p);for(var U=[],G=0,$=(p=[z,D,R].concat(p).join().split(",")).length;G<$;G++)U[G]=G%2?g(p[G-1],p[G],h).y:g(p[G],p[G+1],h).x;return U}.apply(0,[e.x,e.y].concat(t.slice(1))));break;case"S":t=["C",e.x+(e.x-(e.bx||e.x)),e.y+(e.y-(e.by||e.y))].concat(t.slice(1));break;case"T":e.qx=e.x+(e.x-(e.qx||e.x)),e.qy=e.y+(e.y-(e.qy||e.y)),t=["C"].concat(A(e.x,e.y,e.qx,e.qy,t[1],t[2]));break;case"Q":e.qx=t[1],e.qy=t[2],t=["C"].concat(A(e.x,e.y,t[1],t[2],t[3],t[4]));break;case"L":t=["C"].concat(_(e.x,e.y,t[1],t[2]));break;case"H":t=["C"].concat(_(e.x,e.y,t[1],e.y));break;case"V":t=["C"].concat(_(e.x,e.y,e.x,t[1]));break;case"Z":t=["C"].concat(_(e.x,e.y,e.X,e.Y))}return t},l=function(t,e){if(7<t[e].length){t[e].shift();for(var n=t[e];n.length;)t.splice(e++,0,["C"].concat(n.splice(0,6)));t.splice(e,1),f=z(o.length,a&&a.length||0)}},u=function(t,e,n,r,i){t&&e&&"M"==t[i][0]&&"M"!=e[i][0]&&(e.splice(i,0,["M",r.x,r.y]),n.bx=0,n.by=0,n.x=t[i][1],n.y=t[i][2],f=z(o.length,a&&a.length||0))},c=0,f=z(o.length,a&&a.length||0);c<f;c++){o[c]=s(o[c],r),l(o,c),a&&(a[c]=s(a[c],i)),a&&l(a,c),u(o,a,r,i,c),u(a,o,i,r,c);var d=o[c],h=a&&a[c],p=d.length,g=a&&h.length;r.x=d[p-2],r.y=d[p-1],r.bx=q(d[p-4])||r.x,r.by=q(d[p-3])||r.y,i.bx=a&&(q(h[g-4])||i.x),i.by=a&&(q(h[g-3])||i.y),i.x=a&&h[g-2],i.y=a&&h[g-1]}return a||(n.curve=w(o)),a?[o,a]:o}function j(t,e){for(var n=[],r=0,i=t.length;r<i-2*!e;r+=2){var o=[{x:+t[r-2],y:+t[r-1]},{x:+t[r],y:+t[r+1]},{x:+t[r+2],y:+t[r+3]},{x:+t[r+4],y:+t[r+5]}];e?r?i-4==r?o[3]={x:+t[0],y:+t[1]}:i-2==r&&(o[2]={x:+t[0],y:+t[1]},o[3]={x:+t[2],y:+t[3]}):o[0]={x:+t[i-2],y:+t[i-1]}:i-4==r?o[3]=o[2]:r||(o[0]={x:+t[r],y:+t[r+1]}),n.push(["C",(-o[0].x+6*o[1].x+o[2].x)/6,(-o[0].y+6*o[1].y+o[2].y)/6,(o[1].x+6*o[2].x-o[3].x)/6,(o[1].y+6*o[2].y-o[3].y)/6,o[2].x,o[2].y])}return n}var e=v.prototype,L=V.is,g=V._.clone,r="hasOwnProperty",n=/,?([a-z]),?/gi,q=parseFloat,I=Math,H=I.PI,O=I.min,z=I.max,D=I.pow,X=I.abs,l=t(1),u=t(),c=t(0,1),f=V._unit2px,d={path:function(t){return t.attr("path")},circle:function(t){var e=f(t);return B(e.cx,e.cy,e.r)},ellipse:function(t){var e=f(t);return B(e.cx,e.cy,e.rx,e.ry)},rect:function(t){var e=f(t);return s(e.x,e.y,e.width,e.height,e.rx,e.ry)},image:function(t){var e=f(t);return s(e.x,e.y,e.width,e.height)},text:function(t){var e=t.node.getBBox();return s(e.x,e.y,e.width,e.height)},g:function(t){var e=t.node.getBBox();return s(e.x,e.y,e.width,e.height)},symbol:function(t){var e=t.getBBox();return s(e.x,e.y,e.width,e.height)},line:function(t){return"M"+[t.attr("x1"),t.attr("y1"),t.attr("x2"),t.attr("y2")]},polyline:function(t){return"M"+t.attr("points")},polygon:function(t){return"M"+t.attr("points")+"z"},svg:function(t){var e=t.node.getBBox();return s(e.x,e.y,e.width,e.height)},deflt:function(t){var e=t.node.getBBox();return s(e.x,e.y,e.width,e.height)}};V.path=x,V.path.getTotalLength=l,V.path.getPointAtLength=u,V.path.getSubpath=function(t,e,n){if(this.getTotalLength(t)-n<1e-6)return c(t,e).end;var r=c(t,n,1);return e?c(r,e).end:r},e.getTotalLength=function(){return this.node.getTotalLength?this.node.getTotalLength():void 0},e.getPointAtLength=function(t){return u(this.attr("d"),t)},e.getSubpath=function(t,e){return V.path.getSubpath(this.attr("d"),t,e)},V._.box=h,V.path.findDotsAtSegment=C,V.path.bezierBBox=S,V.path.isPointInsideBBox=i,V.path.isBBoxIntersect=k,V.path.intersection=function(t,e){return o(t,e)},V.path.intersectionNumber=function(t,e){return o(t,e,1)},V.path.isPointInside=function(t,e,n){var r=a(t);return i(r,e,n)&&1==o(t,[["M",e,n],["H",r.x2+10]],1)%2},V.path.getBBox=a,V.path.get=d,V.path.toRelative=function(t){var e=x(t),n=String.prototype.toLowerCase;if(e.rel)return w(e.rel);V.is(t,"array")&&V.is(t&&t[0],"array")||(t=V.parsePathString(t));var r=[],i=0,o=0,a=0,s=0,l=0;"M"==t[0][0]&&(a=i=t[0][1],s=o=t[0][2],l++,r.push(["M",i,o]));for(var u=l,c=t.length;u<c;u++){var f=r[u]=[],d=t[u];if(d[0]!=n.call(d[0]))switch(f[0]=n.call(d[0]),f[0]){case"a":f[1]=d[1],f[2]=d[2],f[3]=d[3],f[4]=d[4],f[5]=d[5],f[6]=+(d[6]-i).toFixed(3),f[7]=+(d[7]-o).toFixed(3);break;case"v":f[1]=+(d[1]-o).toFixed(3);break;case"m":a=d[1],s=d[2];default:for(var h=1,p=d.length;h<p;h++)f[h]=+(d[h]-(h%2?i:o)).toFixed(3)}else{f=r[u]=[],"m"==d[0]&&(a=d[1]+i,s=d[2]+o);for(var g=0,v=d.length;g<v;g++)r[u][g]=d[g]}var m=r[u].length;switch(r[u][0]){case"z":i=a,o=s;break;case"h":i+=+r[u][m-1];break;case"v":o+=+r[u][m-1];break;default:i+=+r[u][m-2],o+=+r[u][m-1]}}return r.toString=b,e.rel=w(r),r},V.path.toAbsolute=F,V.path.toCubic=P,V.path.map=function(t,e){if(!e)return t;var n,r,i,o,a,s,l;for(i=0,a=(t=P(t)).length;i<a;i++)for(o=1,s=(l=t[i]).length;o<s;o+=2)n=e.x(l[o],l[o+1]),r=e.y(l[o],l[o+1]),l[o]=n,l[o+1]=r;return t},V.path.toString=b,V.path.clone=w}),e.plugin(function(t){var s=Math.max,l=Math.min,u=function(t){if(this.items=[],this.length=0,this.type="set",t)for(var e=0,n=t.length;e<n;e++)t[e]&&(this[this.items.length]=this.items[this.items.length]=t[e],this.length++)},e=u.prototype;e.push=function(){for(var t,e,n=0,r=arguments.length;n<r;n++)(t=arguments[n])&&(this[e=this.items.length]=this.items[e]=t,this.length++);return this},e.pop=function(){return this.length&&delete this[this.length--],this.items.pop()},e.forEach=function(t,e){for(var n=0,r=this.items.length;n<r;n++)if(!1===t.call(e,this.items[n],n))return this;return this},e.remove=function(){for(;this.length;)this.pop().remove();return this},e.attr=function(t){for(var e=0,n=this.items.length;e<n;e++)this.items[e].attr(t);return this},e.clear=function(){for(;this.length;)this.pop()},e.splice=function(t,e){t=t<0?s(this.length+t,0):t,e=s(0,l(this.length-t,e));var n,r=[],i=[],o=[];for(n=2;n<arguments.length;n++)o.push(arguments[n]);for(n=0;n<e;n++)i.push(this[t+n]);for(;n<this.length-t;n++)r.push(this[t+n]);var a=o.length;for(n=0;n<a+r.length;n++)this.items[t+n]=this[t+n]=n<a?o[n]:r[n-a];for(n=this.items.length=this.length-=e-a;this[n];)delete this[n++];return new u(i)},e.exclude=function(t){for(var e=0,n=this.length;e<n;e++)if(this[e]==t)return this.splice(e,1),!0;return!1},e.insertAfter=function(t){for(var e=this.items.length;e--;)this.items[e].insertAfter(t);return this},e.getBBox=function(){for(var t=[],e=[],n=[],r=[],i=this.items.length;i--;)if(!this.items[i].removed){var o=this.items[i].getBBox();t.push(o.x),e.push(o.y),n.push(o.x+o.width),r.push(o.y+o.height)}return{x:t=l.apply(0,t),y:e=l.apply(0,e),x2:n=s.apply(0,n),y2:r=s.apply(0,r),width:n-t,height:r-e,cx:t+(n-t)/2,cy:e+(r-e)/2}},e.clone=function(t){t=new u;for(var e=0,n=this.items.length;e<n;e++)t.push(this.items[e].clone());return t},e.toString=function(){return"Snap‘s set"},e.type="set",t.set=function(){var t=new u;return arguments.length&&t.push.apply(t,Array.prototype.slice.call(arguments,0)),t}}),e.plugin(function(f,t){function d(t){var e=t[0];switch(e.toLowerCase()){case"t":return[e,0,0];case"m":return[e,1,0,0,1,0,0];case"r":return 4==t.length?[e,0,t[2],t[3]]:[e,0];case"s":return 5==t.length?[e,1,1,t[3],t[4]]:3==t.length?[e,1,1]:[e,1]}}function u(t){return t}function c(t){return f.rgb(t[0],t[1],t[2])}function h(t){var e,n,r,i,o,a,s=0,l=[];for(e=0,n=t.length;e<n;e++){for(o="[",a=['"'+t[e][0]+'"'],r=1,i=t[e].length;r<i;r++)a[r]="val["+s+++"]";o+=a+"]",l[e]=o}return Function("val","return Snap.path.toString.call(["+l+"])")}function p(t){for(var e=[],n=0,r=t.length;n<r;n++)for(var i=1,o=t[n].length;i<o;i++)e.push(t[n][i]);return e}var g={},v=/[a-z]+$/i,m=String;g.stroke=g.fill="colour",t.prototype.equal=function(t,e){var n,r,i=m(this.attr(t)||""),o=this;if(i==+i&&e==+e)return{from:+i,to:+e,f:u};if("colour"==g[t])return n=f.color(i),r=f.color(e),{from:[n.r,n.g,n.b,n.opacity],to:[r.r,r.g,r.b,r.opacity],f:c};if("transform"==t||"gradientTransform"==t||"patternTransform"==t)return e instanceof f.Matrix&&(e=e.toTransformString()),f._.rgTransform.test(e)||(e=f._.svgTransform2string(e)),function(t,e,n){e=m(e).replace(/\.{3}|\u2026/g,t),t=f.parseTransformString(t)||[],e=f.parseTransformString(e)||[];for(var r,i,o,a,s=Math.max(t.length,e.length),l=[],u=[],c=0;c<s;c++){if(o=t[c]||d(e[c]),a=e[c]||d(o),o[0]!=a[0]||"r"==o[0].toLowerCase()&&(o[2]!=a[2]||o[3]!=a[3])||"s"==o[0].toLowerCase()&&(o[3]!=a[3]||o[4]!=a[4])){t=f._.transform2matrix(t,n()),e=f._.transform2matrix(e,n()),l=[["m",t.a,t.b,t.c,t.d,t.e,t.f]],u=[["m",e.a,e.b,e.c,e.d,e.e,e.f]];break}for(l[c]=[],u[c]=[],r=0,i=Math.max(o.length,a.length);r<i;r++)r in o&&(l[c][r]=o[r]),r in a&&(u[c][r]=a[r])}return{from:p(l),to:p(u),f:h(l)}}(i,e,function(){return o.getBBox(1)});if("d"==t||"path"==t)return{from:p((n=f.path.toCubic(i,e))[0]),to:p(n[1]),f:h(n[0])};if("points"==t)return{from:n=m(i).split(","),to:r=m(e).split(","),f:function(t){return t}};var a,s=i.match(v),l=m(e).match(v);return s&&s==l?{from:parseFloat(i),to:parseFloat(e),f:(a=s,function(t){return+t.toFixed(3)+a})}:{from:this.asPX(t),to:this.asPX(t,e),f:u}}}),e.plugin(function(c,t,e,s){for(var n=t.prototype,d=("createTouch"in s.doc),r=["click","dblclick","mousedown","mousemove","mouseout","mouseover","mouseup","touchstart","touchmove","touchend","touchcancel"],h={mousedown:"touchstart",mousemove:"touchmove",mouseup:"touchend"},p=function(t){var e="y"==t?"scrollTop":"scrollLeft";return s.doc.documentElement[e]||s.doc.body[e]},l=function(){this.returnValue=!1},g=function(){return this.originalEvent.preventDefault()},u=function(){this.cancelBubble=!0},v=function(){return this.originalEvent.stopPropagation()},i=s.doc.addEventListener?function(l,u,c,f){var t=d&&h[u]?h[u]:u,e=function(t){var e=p("y"),n=p("x");if(d&&h.hasOwnProperty(u))for(var r=0,i=t.targetTouches&&t.targetTouches.length;r<i;r++)if(t.targetTouches[r].target==l||l.contains(t.targetTouches[r].target)){var o=t;(t=t.targetTouches[r]).originalEvent=o,t.preventDefault=g,t.stopPropagation=v;break}var a=t.clientX+n,s=t.clientY+e;return c.call(f,t,a,s)};return u!==t&&l.addEventListener(u,e,!1),l.addEventListener(t,e,!1),function(){return u!==t&&l.removeEventListener(u,e,!1),l.removeEventListener(t,e,!1),!0}}:s.doc.attachEvent?function(t,e,o,a){var n=function(t){t=t||s.win.event;var e=p("y"),n=p("x"),r=t.clientX+n,i=t.clientY+e;return t.preventDefault=t.preventDefault||l,t.stopPropagation=t.stopPropagation||u,o.call(a,t,r,i)};return t.attachEvent("on"+e,n),function(){return t.detachEvent("on"+e,n),!0}}:void 0,f=[],m=function(t){for(var e,n=t.clientX,r=t.clientY,i=p("y"),o=p("x"),a=f.length;a--;){if(e=f[a],d){for(var s,l=t.touches&&t.touches.length;l--;)if((s=t.touches[l]).identifier==e.el._drag.id||e.el.node.contains(s.target)){n=s.clientX,r=s.clientY,(t.originalEvent?t.originalEvent:t).preventDefault();break}}else t.preventDefault();var u=e.el.node;c._.glob,u.nextSibling,u.parentNode,u.style.display,n+=o,r+=i,mt("snap.drag.move."+e.el.id,e.move_scope||e.el,n-e.el._drag.x,r-e.el._drag.y,n,r,t)}},y=function(t){c.unmousemove(m).unmouseup(y);for(var e,n=f.length;n--;)(e=f[n]).el._drag={},mt("snap.drag.end."+e.el.id,e.end_scope||e.start_scope||e.move_scope||e.el,t);f=[]},o=r.length;o--;)!function(r){c[r]=n[r]=function(t,e){return c.is(t,"function")&&(this.events=this.events||[],this.events.push({name:r,f:t,unbind:i(this.shape||this.node||s.doc,r,t,e||this)})),this},c["un"+r]=n["un"+r]=function(t){for(var e=this.events||[],n=e.length;n--;)if(e[n].name==r&&(e[n].f==t||!t))return e[n].unbind(),e.splice(n,1),!e.length&&delete this.events,this;return this}}(r[o]);n.hover=function(t,e,n,r){return this.mouseover(t,n).mouseout(e,r||n)},n.unhover=function(t,e){return this.unmouseover(t).unmouseout(e)};var x=[];n.drag=function(r,i,o,a,s,l){function t(t,e,n){(t.originalEvent||t).preventDefault(),this._drag.x=e,this._drag.y=n,this._drag.id=t.identifier,!f.length&&c.mousemove(m).mouseup(y),f.push({el:this,move_scope:a,start_scope:s,end_scope:l}),i&&mt.on("snap.drag.start."+this.id,i),r&&mt.on("snap.drag.move."+this.id,r),o&&mt.on("snap.drag.end."+this.id,o),mt("snap.drag.start."+this.id,s||a||this,e,n,t)}return arguments.length?(this._drag={},x.push({el:this,start:t}),this.mousedown(t),this):this.drag(function(t,e){this.attr({transform:n+(n?"T":"t")+[t,e]})},function(){n=this.transform().local});var n},n.undrag=function(){for(var t=x.length;t--;)x[t].el==this&&(this.unmousedown(x[t].start),x.splice(t,1),mt.unbind("snap.drag.*."+this.id));return!x.length&&c.unmousemove(m).unmouseup(y),this}}),e.plugin(function(o,a,t){var e=(a.prototype,t.prototype),n=/^\s*url\((.+)\)/,s=String,l=o._.$;o.filter={},e.filter=function(t){var e=this;"svg"!=e.type&&(e=e.paper);var n=o.parse(s(t)),r=o._.id(),i=(e.node.offsetWidth,e.node.offsetHeight,l("filter"));return l(i,{id:r,filterUnits:"userSpaceOnUse"}),i.appendChild(n.node),e.defs.appendChild(i),new a(i)},mt.on("snap.util.getattr.filter",function(){mt.stop();var t=l(this.node,"filter");if(t){var e=s(t).match(n);return e&&o.select(e[1])}}),mt.on("snap.util.attr.filter",function(t){if(t instanceof a&&"filter"==t.type){mt.stop();var e=t.node.id;e||(l(t.node,{id:t.id}),e=t.id),l(this.node,{filter:o.url(e)})}t&&"none"!=t||(mt.stop(),this.node.removeAttribute("filter"))}),o.filter.blur=function(t,e){null==t&&(t=2);var n=null==e?t:[t,e];return o.format('<feGaussianBlur stdDeviation="{def}"/>',{def:n})},o.filter.blur.toString=function(){return this()},o.filter.shadow=function(t,e,n,r){return r=r||"#000",null==n&&(n=4),"string"==typeof n&&(r=n,n=4),null==t&&(t=0,e=2),null==e&&(e=t),r=o.color(r),o.format('<feGaussianBlur in="SourceAlpha" stdDeviation="{blur}"/><feOffset dx="{dx}" dy="{dy}" result="offsetblur"/><feFlood flood-color="{color}"/><feComposite in2="offsetblur" operator="in"/><feMerge><feMergeNode/><feMergeNode in="SourceGraphic"/></feMerge>',{color:r,dx:t,dy:e,blur:n})},o.filter.shadow.toString=function(){return this()},o.filter.grayscale=function(t){return null==t&&(t=1),o.format('<feColorMatrix type="matrix" values="{a} {b} {c} 0 0 {d} {e} {f} 0 0 {g} {b} {h} 0 0 0 0 0 1 0"/>',{a:.2126+.7874*(1-t),b:.7152-.7152*(1-t),c:.0722-.0722*(1-t),d:.2126-.2126*(1-t),e:.7152+.2848*(1-t),f:.0722-.0722*(1-t),g:.2126-.2126*(1-t),h:.0722+.9278*(1-t)})},o.filter.grayscale.toString=function(){return this()},o.filter.sepia=function(t){return null==t&&(t=1),o.format('<feColorMatrix type="matrix" values="{a} {b} {c} 0 0 {d} {e} {f} 0 0 {g} {h} {i} 0 0 0 0 0 1 0"/>',{a:.393+.607*(1-t),b:.769-.769*(1-t),c:.189-.189*(1-t),d:.349-.349*(1-t),e:.686+.314*(1-t),f:.168-.168*(1-t),g:.272-.272*(1-t),h:.534-.534*(1-t),i:.131+.869*(1-t)})},o.filter.sepia.toString=function(){return this()},o.filter.saturate=function(t){return null==t&&(t=1),o.format('<feColorMatrix type="saturate" values="{amount}"/>',{amount:1-t})},o.filter.saturate.toString=function(){return this()},o.filter.hueRotate=function(t){return t=t||0,o.format('<feColorMatrix type="hueRotate" values="{angle}"/>',{angle:t})},o.filter.hueRotate.toString=function(){return this()},o.filter.invert=function(t){return null==t&&(t=1),o.format('<feComponentTransfer><feFuncR type="table" tableValues="{amount} {amount2}"/><feFuncG type="table" tableValues="{amount} {amount2}"/><feFuncB type="table" tableValues="{amount} {amount2}"/></feComponentTransfer>',{amount:t,amount2:1-t})},o.filter.invert.toString=function(){return this()},o.filter.brightness=function(t){return null==t&&(t=1),o.format('<feComponentTransfer><feFuncR type="linear" slope="{amount}"/><feFuncG type="linear" slope="{amount}"/><feFuncB type="linear" slope="{amount}"/></feComponentTransfer>',{amount:t})},o.filter.brightness.toString=function(){return this()},o.filter.contrast=function(t){return null==t&&(t=1),o.format('<feComponentTransfer><feFuncR type="linear" slope="{amount}" intercept="{amount2}"/><feFuncG type="linear" slope="{amount}" intercept="{amount2}"/><feFuncB type="linear" slope="{amount}" intercept="{amount2}"/></feComponentTransfer>',{amount:t,amount2:.5-t/2})},o.filter.contrast.toString=function(){return this()}}),e}),function(u){u(".overlay-show");var o=u("div.ult-overlay");o.find("div.ult-overlay-close");function n(t){var e="div.ult-overlay."+t;if(joverlay=document.querySelector(e),(o=u(e)).hasClass("ult-open")){o.removeClass("ult-open"),o.addClass("ult-close");var n=function(t){if(support.transitions){if("visibility"!==t.propertyName)return;this.removeEventListener(transEndEventName,n)}o.removeClass("ult-close")};support.transitions?(joverlay.addEventListener(transEndEventName,n),o.removeClass("ult-close"),i<r&&u("html").css({overflow:"auto"})):n()}else o.hasClass("ult-close")||o.addClass("ult-open");var r=o.find(".ult_modal").outerHeight(),i=u(window).outerHeight();i<r&&u("html").css({overflow:"hidden"})}transEndEventNames={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",msTransition:"MSTransitionEnd",transition:"transitionend"},transEndEventName=transEndEventNames[bsfmodernizr.prefixed("transition")],support={transitions:bsfmodernizr.csstransitions};u(".overlay-show-cornershape").find("path").attr("d");function r(t){var e="div.overlay-cornershape."+t,n=document.querySelector(e),r=u(e),i=Snap(n.querySelector("svg")).select("path"),o="m 0,0 1439.999975,0 0,805.99999 0,-805.99999 z ",a=" m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z  ";if(r.hasClass("ult-open")){r.removeClass("ult-open"),r.addClass("ult-close");i.animate({path:o},400,mina.linear,function(t){r.removeClass("ult-close")})}else r.hasClass("ult-close")||(r.addClass("ult-open"),i.animate({path:a},400,mina.linear))}function i(t){var e="div.overlay-genie."+t,n=document.querySelector(e),r=u(e),i=Snap(n.querySelector("svg")).select("path"),o=n.getAttribute("data-steps").split(";"),a=o.length;if(r.hasClass("ult-open")){var s=a-1;r.removeClass("ult-open"),r.addClass("ult-close");(l=function(t){--t<0||i.animate({path:o[t]},60,mina.linear,function(){0===t&&r.removeClass("ult-close"),l(t)})})(s)}else if(!r.hasClass("ult-close")){var l;s=0;r.addClass("ult-open"),(l=function(t){a-1<++t||i.animate({path:o[t]},60,mina.linear,function(){l(t)})})(s)}}function a(t){var e="div.overlay-boxes."+t,n=document.querySelector(e),r=u(e),i=[].slice.call(n.querySelectorAll("svg > path")),o=i.length,a=0;!function(t){for(var e,n,r=t.length;0!==r;)n=Math.floor(Math.random()*r),e=t[r-=1],t[r]=t[n],t[n]=e}(i),r.hasClass("ult-open")?(r.removeClass("ult-open"),r.addClass("ult-close"),i.forEach(function(t,e){setTimeout(function(){++a,t.style.display="none",a===o&&r.removeClass("ult-close")},30*e)})):r.hasClass("ult-close")||(r.addClass("ult-open"),i.forEach(function(t,e){setTimeout(function(){t.style.display="block"},30*e)}))}function s(t){var e=u("."+t).find(".ult_modal-content").height();u(window).height()<e?u("."+t).addClass("ult_modal-auto-top"):u("."+t).removeClass("ult_modal-auto-top"),0<u("."+t).find("iframe").length&&u("."+t).find("iframe").each(function(t,e){u(e).attr("src",u(e).attr("src"))}),u(document).trigger("onUVCModalPopupOpen",t)}u(window).load(function(){var e=new Array;u(".ult-onload").each(function(t){e.push(u(this)),setTimeout(function(){e[t].trigger("click")},1e3*parseInt(u(this).data("onload-delay")))}),u(".ult-vimeo iframe").each(function(t,e){u(this).attr("id");var n=u(this)[0],r=$f(n);r.addEvent("ready",function(){r.addEvent("pause"),r.addEvent("finish")})})}),u(document).ready(function(){u(".ult-overlay").each(function(){u(this).appendTo(document.body)}),u(".ult-overlay").show(),u(".overlay-show").each(function(t,e){var n=u(this).data("class-id");u("."+n).find(".ult-vimeo iframe").attr("id","video_"+n),u("."+n).find(".ult-youtube iframe").attr("id","video_"+n)});u(document).on("click",".overlay-show",function(t){t.stopPropagation(),t.preventDefault();var e=u(this).data("class-id");1!=u(this).parent().hasClass("modal-hide-mobile")&&1!=u(this).parent().hasClass("modal-hide-tablet")&&(u("."+e).find(".ult_modal-content").removeClass("ult-hide"),u("."+e).find(".ult-vimeo iframe").html(u(".ult-vimeo iframe").html()),u("."+e).addClass(u(this).data("overlay-class")),setTimeout(function(){u("body, html").addClass("ult_modal-body-open"),n(e),s(e)},500),"keypress-control-enable"!=u(this).parent().attr("data-keypress-control")&&"keypress-control-enable"!=u(this).attr("data-keypress-control")||(window.onkeydown=function(t){27==t.keyCode&&u(document).find(".ult-overlay.ult-open."+e).removeClass("ult-open")}))}),u(document).on("click",".overlay-show-cornershape",function(t){t.stopPropagation(),t.preventDefault();var e=u(this).data("class-id");u("."+e).find(".ult_modal-content").removeClass("ult-hide"),setTimeout(function(){u("."+e).addClass("overlay-cornershape"),r(e),u("body, html").addClass("ult_modal-body-open"),s(e)},300)}),u(document).on("click","div.overlay-cornershape div.ult-overlay-close",function(t){t.stopPropagation();var e=u(this).parents("div.overlay-cornershape").data("class");r(e),u("body, html").removeClass("ult_modal-body-open"),u("html").css({overflow:"auto"}),u(document).trigger("onUVCModalPopUpClosed",e)}),u(document).on("click",".overlay-show-boxes",function(t){t.stopPropagation(),t.preventDefault();var e=u(this).data("class-id");u("."+e).find(".ult_modal-content").removeClass("ult-hide"),setTimeout(function(){u("."+e).addClass("overlay-boxes"),a(e),u("body, html").addClass("ult_modal-body-open"),s(e)},300)}),u(document).on("click","div.overlay-boxes div.ult-overlay-close",function(t){t.stopPropagation();var e=u(this).parents("div.overlay-boxes").data("class");a(e),u("body, html").removeClass("ult_modal-body-open"),u("html").css({overflow:"auto"}),u(document).trigger("onUVCModalPopUpClosed",e)}),u(document).on("click",".overlay-show-genie",function(t){t.preventDefault();var e=u(this).data("class-id");u("."+e).find(".ult_modal-content").removeClass("ult-hide"),setTimeout(function(){u("."+e).addClass("overlay-genie"),i(e),u("body, html").addClass("ult_modal-body-open"),s(e),u("html").css({overflow:"auto"})},300)}),u(document).on("click","div.overlay-genie div.ult-overlay-close",function(t){t.stopPropagation();var e=u(this).parents("div.overlay-genie").data("class");i(e),u("body, html").removeClass("ult_modal-body-open"),u("html").css({overflow:"auto"}),u(document).trigger("onUVCModalPopUpClosed",e)}),u(document).on("click",".ult-overlay .ult-overlay-close",function(t){t.stopPropagation(),$this=u(this),n($this.parents(".ult-overlay").data("class")),u("body, html").removeClass("ult_modal-body-open"),$this.parent().find(".ult-vimeo").length&&$this.parent().find(".ult-vimeo iframe").each(function(t,e){var n=u(e),r=u(e).attr("src");u(e).attr("src",""),u(e).attr("src",r);e=n[0];$f(e).api("pause")}),$this.parent().find(".ult-youtube").length&&$this.parent().find(".ult-youtube iframe").each(function(t,e){var n=u(e).attr("src");u(e).attr("src",""),u(e).attr("src",n)}),$this.parent().find(".ult-video-shortcode").length&&$this.parent().find(".ult-video-shortcode video").each(function(t,e){e.pause()}),u("html").css({overflow:"auto"}),u(document).trigger("onUVCModalPopUpClosed")}),u(document).on("click",".ult-overlay .ult_modal",function(t){t.stopPropagation()}),u(document).on("click",".ult-overlay",function(t){t.stopPropagation(),t.preventDefault(),$this=u(this);var e=$this.data("class");u(document).find(".ult-modal-input-wrapper").children().each(function(){u(this).data("class-id")==e&&"overlay-control-enable"==u(this).parent(".ult-modal-input-wrapper").data("overlay-control")&&($this.find(".ult-overlay-close").trigger("click"),u("html").css({overflow:"auto"}))})})}),u(document).on("onUVCModalPopupOpen",function(){u(".ult_modal-body iframe").each(function(t,e){var n=u(this).parent().width(),r=(u(this).parent().parent().parent().hasClass("ult-small"),u(this).parent().parent().parent().hasClass("ult-medium"),!!u(this).parent().parent().parent().hasClass("ult-container")),i=!!u(this).parent().parent().parent().hasClass("ult-block"),o=n*(9/16)+n/10;if(!u(this).parent().hasClass("ult-youtube")&&!u(this).parent().hasClass("ult-vimeo"))return!1;if(r){var a=u(window).height();a<o&&(o=a-100)}i&&(void 0!==(n=u(this).attr("width"))&&""!=n||(n=640),void 0!==(o=u(this).attr("height"))&&""!=o||(o=360)),u(this).css({width:n+"px",height:o+"px"})}),u(window).trigger("resize")})}(jQuery);
;;window.Modernizr=function(a,b,c){function x(a){j.cssText=a}function y(a,b){return x(prefixes.join(a+";")+(b||""))}function z(a,b){return typeof a===b}function A(a,b){return!!~(""+a).indexOf(b)}function B(a,b){for(var d in a){var e=a[d];if(!A(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function C(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:z(f,"function")?f.bind(d||b):f}return!1}function D(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+n.join(d+" ")+d).split(" ");return z(b,"string")||z(b,"undefined")?B(e,b):(e=(a+" "+o.join(d+" ")+d).split(" "),C(e,b,c))}var d="2.7.1",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m="Webkit Moz O ms",n=m.split(" "),o=m.toLowerCase().split(" "),p={},q={},r={},s=[],t=s.slice,u,v={}.hasOwnProperty,w;!z(v,"undefined")&&!z(v.call,"undefined")?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=t.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(t.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(t.call(arguments)))};return e}),p.csstransitions=function(){return D("transition")};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)w(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},x(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._domPrefixes=o,e._cssomPrefixes=n,e.testProp=function(a){return B([a])},e.testAllProps=D,e.prefixed=function(a,b,c){return b?D(a,b,c):D(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+s.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
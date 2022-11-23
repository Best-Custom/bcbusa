$(document).ready(function(){

  $('.dynamic_call_to_action').hide();
  $(document).on('click', '.arrow-icon-back', function(){
    $(".dynamic_call_to_action").hide("slide", {direction: "right"}, 1000);
    $(".dynamic_call_to_action_close").show("slide", {direction: "right"}, 1000);
  });
   $(document).on('click', '.arrow-icon-open', function(){
    $(".dynamic_call_to_action").show("slide", {direction: "right"}, 1000);
    $(".dynamic_call_to_action_close").hide("slide", {direction: "right"}, 1000);
  });

});
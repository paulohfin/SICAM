var form = $('.form');
var btn = $('#submit');
var topbar = $('.topbar');
var input = $('#password');
var input = $('#loguin')
var article =$('.article');
var tries = 0;
var h = input.height();

$('.spanColor').height(h+23);

$('#findpass').on('click',function(){
  $(this).text('testecamara');
});

input.on('focus',function(){
  topbar.removeClass('error success');
  input.text('');
});

$('.form').keypress(function(e){
   if(e.keyCode==13)
   submit.click();
});

input.keypress(function(){
  topbar.removeClass('success error');
});
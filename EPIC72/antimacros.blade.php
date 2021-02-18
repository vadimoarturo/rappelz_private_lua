<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
    .capbox {
    	background-color: #BBBBBB;
    	background-image: linear-gradient(#BBBBBB, #9E9E9E);
    	border: #2A7D05 0px solid;
    	border-width: 2px 2px 2px 20px;
    	box-sizing: border-box;
    	-moz-box-sizing: border-box;
    	-webkit-box-sizing: border-box;
    	display: inline-block;
    	padding: 5px 8px 5px 8px;
    	border-radius: 4px 4px 4px 4px;
    	}
    .capbox-inner {
    	font: bold 12px arial, sans-serif;
    	color: #000000;
    	background-color: #E3E3E3;
    	margin: 0px auto 0px auto;
    	padding: 3px 10px 5px 10px;
    	border-radius: 4px;
    	display: inline-block;
    	vertical-align: middle;
    	}
    #CaptchaDiv {
    	color: #000000;
    	font: normal 25px Impact, Charcoal, arial, sans-serif;
    	font-style: italic;
    	text-align: center;
    	vertical-align: middle;
    	background-color: #FFFFFF;
    	user-select: none;
    	display: inline-block;
    	padding: 3px 14px 3px 8px;
    	margin-right: 4px;
    	border-radius: 4px;
    	}
    #CaptchaInput {
    	border: #38B000 2px solid;
    	margin: 3px 0px 1px 0px;
    	width: 105px;
    	}
</style>

  </head>
  <body>
    @foreach ($blockinfo as $antimacrosblockinfo)

    @if ($antimacrosblockinfo->value == 1 )

    @foreach ($blockpers as $antimacrosblockinfopers)
    <p>{{ $antimacrosblockinfopers->name }} вы заблокированы за подозрения в макросе!</p>
    @endforeach

    @foreach ($blockinfodate as $antimacrosblockinfodate)
    <p>Время блокировки: {{  $antimacrosblockinfodate->value }}</p>
    @endforeach

    <form method="POST" action="{{ route('antimacros-blockdrop') }}"  onsubmit="return checkform(this);">
        @csrf
        @foreach ($blockpers as $antimacrosblockinfopers)
              <input type="hidden" name="account_name"  value="{{ $antimacrosblockinfopers->account }}" >
        @endforeach

        @foreach ($blockpers as $antimacrosblockinfopers)
                  <input type="hidden" name="pers_name"  value="{{ $antimacrosblockinfopers->name }}" >
        @endforeach

        <!-- START CAPTCHA -->
        <br>
        <div class="capbox">

        <div id="CaptchaDiv"></div>

        <div class="capbox-inner">
        Type the number:<br>

        <input type="hidden" id="txtCaptcha">
        <input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>

        </div>
        </div>
        <br><br>
        <!-- END CAPTCHA -->

                <button type="submit" class="btn btn-primary">
                    {{ __('Снять блокировку') }}
                </button>

    </form>

    @else
    <p>Что ты тут делаешь?</p>
    @endif
    @endforeach
  </body>

  <script type="text/javascript">
// Captcha Script
function checkform(theform){
var why = "";
if(theform.CaptchaInput.value == ""){
why += "- Please Enter CAPTCHA Code.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- The CAPTCHA Code Does Not Match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}
var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';
var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;
// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}
// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>
</html>

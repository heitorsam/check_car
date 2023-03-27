
<html>
<head>


<iframe src="https://pageloot.com/qr-code-scanner/" height="500" width="500" title="Iframe Example"></iframe>
  
<title>Web QR</title>

<script type="text/javascript" src="https://webqr.com/llqrcode.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="https://webqr.com/webqr.js"></script>

</head>

<body>
<div id="main">
<div id="header">
<div style="position:relative;top:+20px;left:0px;">
<p id="mp1">
QR Code scanner
</p>

</div>
<div id="mainbody">
<table class="tsel" border="0" width="100%">
<tr>
<td valign="top" align="center" width="50%">
<table class="tsel" border="0">
<tr>
<td><img class="selector" id="webcamimg" src="https://webqr.com/vid.png" onclick="setwebcam()" align="left" /></td>
<td><img class="selector" id="qrimg" src="https://webqr.com/cam.png" onclick="setimg()" align="right"/></td></tr>
<tr><td colspan="2" align="center">
<div id="outdiv">
</div></td></tr>
</table>
</td>
</tr>

<tr><td colspan="3" align="center">
<div id="result"></div>
</td></tr>
</table>

<!-- webqr_2016 -->

</div>&nbsp;
<div id="footer">

<h5 align="center">Copyright &copy; 2011 <a target="_blank" href="http://www.lazarsoft.info">Lazar Laszlo</a></h5>
</div>
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
</body>

</html>

<style>

body{
    width:100%;
    text-align:center;
}
img{
    border:0;
}
#main{
    margin: 15px auto;
    background:white;
    overflow: auto;
	width: 100%;
}
#header{
    background:white;
    margin-bottom:15px;
}
#mainbody{
    background: white;
    width:100%;
	display:none;
}
#footer{
    background:white;
}
#v{
    width:640px;
    height:480px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:1600px;
    height:1200px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
	margin-left:35px;
	margin-right:35px;
	padding-top:10px;
	padding-bottom:10px;
	border-radius:20px;
}
.selector{
    margin:0;
    padding:0;
    cursor:pointer;
    margin-bottom:-5px;
}
#outdiv
{
    width:640px;
    height:480px;
	border: solid;
	border-width: 3px 3px 3px 3px;
}
#result{
    border: solid;
	border-width: 1px 1px 1px 1px;
	padding:20px;
	width:70%;
}

ul{
    margin-bottom:0;
    margin-right:40px;
}
li{
    display:inline;
    padding-right: 0.5em;
    padding-left: 0.5em;
    font-weight: bold;
    border-right: 1px solid #333333;
}
li a{
    text-decoration: none;
    color: black;
}

#footer a{
	color: black;
}
.tsel{
    padding:0;
}

</style>

<script>

load();
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24451557-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
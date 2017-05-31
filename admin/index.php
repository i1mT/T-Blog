<?php
include_once "../API/function.php";
$t = new T_function();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<title>Terminal-Blog</title>
<link href="../asset/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
html{
	background: #000;
}
</style>
</head>
<body>
	<div id="islogin" style="display:none">
		<?php
			if($t->isLogin()) echo "1";
			else echo "0";
		?>
	</div>
<div class="terminal">
	<div class="terminal-output">
	</div>
	<ul class="cmd">
		<li class="output"><span>欢迎进入T-Blog</span></li>
		<li class="input" id="onInput"><span></span><i class="cursor blink">&nbsp;</i>
		</li>
	</ul>
</div>
<textarea id="getText" spellcheck="false"></textarea>
</body>
<script src="../asset/jquery-3.1.1.min.js"></script>
<script src="../asset/terminal.js"></script>
<script src="../asset/taominal.js"></script>
</html>
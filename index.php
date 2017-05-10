<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="asset/HyperDown.js/Parser.js"></script>
    <title>Markdown-preview</title>
</head>
<body>
<script>
    var parser = new HyperDown;
    var text = document.getElementById("art").innerHTML;
    var html = parser.makeHtml(text);
    var toArt = document.getElementById("art1");
    toArt.innerHTML = html;
    document.getElementById("art").innerHTML = "";
</script>
</body>
</html>
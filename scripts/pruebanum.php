<html>
<head>
<title>untitled</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<script type="text/javascript">
function randomnumber() {
document.forms[0].randomnumber.value=(Math.round(Math.random()*1+1));
}
onload=randomnumber
</script>
</head>
<body>
<form action="">
<input name="randomnumber" readonly>
</form>
</body>
</html>

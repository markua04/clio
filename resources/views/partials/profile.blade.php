<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>My Profile</title>

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body class="body">

<h3>Welcome {{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
<br />
<p>This is your profile. Please choose your location below so that we may provide you with the weather for today.</p>

<script src="js/index.js"></script>

</body>

</html>
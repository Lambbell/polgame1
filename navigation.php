<?php
include 'adminscripts/connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$con = OpenCon(); // opens a connection to the database, this function is from the above included script
$stmt = $con->prepare('SELECT polstate, polname FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($polstate, $polname);
$stmt->fetch();
$stmt->close();

?>
<head>
    <meta charset="utf-8">
    <title class="main-title-header">AHD - <?=$polname?></title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
</head>
<body>
<nav class="navtop">
    <h1 id="main-title-header" class="main-title-header">A House Divided</h1>
    <div class="navgrid">

        <div><a href="profile.php"><i class="fas fa-user-circle"></i><?php echo $polname ?></a></div>
        <div><a href="parties.php"><i class="fas fa-democrat"></i> Parties</a></div>
        <div><a href="campaignoffice.php"><i class="fas fa-briefcase"></i> Campaign Office</a></div>
        <div><a href="state.php?state=<?=$polstate?>"><i class="fas fa-flag-usa"></i><?=$polstate?></a></div>
        <div><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></div>
    </div>
</nav>
<br>

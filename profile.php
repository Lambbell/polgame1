<?php
$id = $_GET['id'];
include 'navigation.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
print "$id";
if (is_null($id)) {
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
    $stmt = $con->prepare('SELECT email, influence, polstate, polname, imgurl, social, economic, action, funding FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $email, $influence, $polstate, $polname, $imgurl, $social, $economic, $ap, $funds);
    $stmt->fetch();
    $stmt->close();
}
else {
    $con = OpenCon(); // opens a connection to the database, this function is from the above included script
    $stmt = $con->prepare('SELECT  influence, polstate, polname, imgurl, social, economic, action, funding FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['id']); // gets the id var from the current session, binds it to the
    $stmt->execute();
    $stmt->bind_result( $influence, $polstate, $polname, $imgurl, $social, $economic, $ap, $funds);
    $stmt->fetch();
    $stmt->close();
}
?>


<div class="content">
    <h2><?=$polname?></h2>
    <div>
        <h1></h1>
        <table>
            <img src="<?=$imgurl?>">
            <tr>
                <td>Recognition:</td>
                <td><?=$influence?>%</td>
            </tr>
            <tr>
                <td>Actions:</td>
                <td><?=$ap?> actions remaining</td>
            </tr>
            <tr>
                <td>Funding:</td>
                <td><?=$funds?>$</td>
            </tr>
            <tr>
                <td>Location:</td>
                <td><a href="state.php?state=<?=$polstate?>"><?=$polstate?></a></td>
            </tr>
            <tr>
                <td>Social Position:</td>
                <td>
                    <?php
                    if ($social <= 5){
                        $formattedsocial = "Very Right Wing";
                    }
                    if ($social <= 4){
                        $formattedsocial = "Right Wing";
                    }
                    if ($social <= 3){
                        $formattedsocial = "Leans Right Wing";
                    }
                    if ($social <= 1){
                        $formattedsocial = "Center Right";
                    }
                    if ($social <= 0){
                        $formattedsocial = "Centrist";
                    }
                    if ($social <= -1){
                        $formattedsocial = "Center Left";
                    }
                    if ($social <= -3){
                        $formattedsocial = "Leans Left Wing";
                    }
                    if ($social <= -4){
                        $formattedsocial = "Left Wing";
                    }
                    if ($social <= -5){
                        $formattedsocial = "Libertarian Left";
                    }
                    echo $formattedsocial;
                    ?>


                </td>
            </tr>  <!--- social position formatting ---->
            <tr>
                <td>Economic Position:</td>
                <td>

                    <?php

                    if ($economic <= 5){
                        $formattedeconomic = "Libertarian Right";
                    }
                    if ($economic <= 4){
                        $formattedeconomic = "Right Wing";
                    }
                    if ($economic <= 3){
                        $formattedeconomic = "Leans Right Wing";
                    }
                    if ($economic <= 1){
                        $formattedeconomic = "Center Right";
                    }
                    if ($economic <= 0){
                        $formattedeconomic = "Centrist";
                    }
                    if ($economic <= -1){
                        $formattedeconomic = "Center Left";
                    }
                    if ($economic <= -3){
                        $formattedeconomic = "Leans Left Wing";
                    }
                    if ($economic <= -4){
                        $formattedeconomic = "Left Wing";
                    }
                    if ($economic <= -5){
                        $formattedeconomic = "Very Left Wing";
                    }


                    echo "$formattedeconomic";
                    ?>


                </td>
            </tr>  <!--- economic position formatting ---->
        </table>
        <?php
        if (isset($id)) {

        }
        else if (is_null($id)){
            echo"
            <table>
                <tr>
                    <p><i>Your account details are below (Only Visible to you):<i></i></p>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>" . $_SESSION['name'] . "</td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>" . $email . "</td>
                </tr>

        </table>";
        }
        else {
            header("Location: index.html");
        }

        ?>
    </div>
</div>
</body>
</html>
<?php
CloseCon($con);

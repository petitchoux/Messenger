<?php

$con = mysqli_connect("localhost", "root", "", "messenger") or die("Connection was not established");

function search_user(){
    global $con;

    if (isset($_GET['search_btn'])) {
        $search_query = htmlentities($_GET['search_query']);
        $get_user = "SELECT * FROM users WHERE user_name LIKE '%$search_query%'";
    } else {
        $get_user = "SELECT * FROM users ORDER BY user_name DESC LIMIT 5";
    }

    $run_user = mysqli_query($con, $get_user);

    while ($row_user=mysqli_fetch_array($run_user)) {
        $user_name = $row_user['user_name'];
        $user_profile = $row_user['user_profile'];

        // Display data

        echo "
        <div class='card'>
        <img src='../$user_profile'>
        <h1>$user_name</h1>
        <form method='post'>
        <p><button name='add'>Start a Coversation</button>
        </p>
        </form>
        </div><br><br>
        ";

        if (isset($_POST['add'])){
            echo "<script>window.open('../home.php?user_name=$user_name', '_self')</script>";
        }
    }
}

?>
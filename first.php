<?php

require_once ('connect.php');

$sql = "select counties.seniunija, month(registered_people.gimimo_data) as 'menuo', count(registered_people.id) as 'vaikai' from registered_people inner join counties on counties.seniunnr = registered_people.seniun_nr where year(gimimo_data) = 2014 group by counties.seniunija, month(registered_people.gimimo_data)";
$result = $conn->query($sql);

$conn->close();

function printResult($result){
    for($i = 0; $i < $result->num_rows; $i += 12){
        echo "<tr>";
        for($j = 0; $j < 12; $j++){
            $row = $result->fetch_assoc();
            if($j == 0){
                echo "<td style='font-weight: bold;'>" . $row['seniunija'] . "</td>";
            }
            echo "<td>" . $row['vaikai'] . "</td>";
        }
        echo "</tr>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pirma užduotis</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <h1>Pirma užduotis</h1>
    <p>Kiek 2014 metais kiekviename mikrorajone (seniūnijoje) kas mėnesį gimė vaikų.</p>

    <table class="table">
        <thead>
        <tr>
            <th>Seniūnija</th>
            <th>Sausis</th>
            <th>Vasaris</th>
            <th>Kovas</th>
            <th>Balandis</th>
            <th>Gegužė</th>
            <th>Birželis</th>
            <th>Liepa</th>
            <th>Rugpjūtis</th>
            <th>Rugsėjis</th>
            <th>Spalis</th>
            <th>Lapkritis</th>
            <th>Gruodis</th>
        </tr>
        </thead>
        <tbody>
        <?php
        printResult($result);
        ?>
        </tbody>
    </table>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
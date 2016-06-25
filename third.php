<?php

// Prisijungiama prie duomenų bazės
require_once ('connect.php');

// Užklausa skirta gauti lentelei, kuri bus naudojama kitose užklausose
$all_counties_query = "(select counties.seniunija as seniunija, count(registered_people.id) as counted from registered_people inner join counties on counties.seniunnr = registered_people.seniun_nr where timestampdiff(year, gimimo_data, '2020-01-01') >= 64 and lytis = 'V' or timestampdiff(year, gimimo_data, '2020-01-01') >= 63 and lytis = 'M' group by counties.seniunija)";

// Užklausa skirta gauti didziausią žmonių skaičių iš $all_counties_query lentelės
$max_people_query = "select max(counted) as maximum from " . $all_counties_query . " as counts";
$result = $conn->query($max_people_query);
$row = $result->fetch_assoc();
// Gautas didžiausias žmonių skaičius
$max_people = $row['maximum'];

// Užklausa skirta gauti seniūnijos pavadinimą, kurioje yra didžiausias žmonių skaičius. Naudojama $all_counties_query lentelė ir $max_people
$max_county_query = "select seniunija from " . $all_counties_query . " as counts where counted = $max_people";
$result = $conn->query($max_county_query);
$row = $result->fetch_assoc();
// Gautas seniūnijos pavadinimas
$max_county = $row['seniunija'];

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trečia užduotis</title>

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
    <h1>Trečia užduotis</h1>
    <p>Kuriame mikrorajone (seniūnijoje) 2020 m. bus didžiausias pensinio amžiaus gyventojų skaičius.</p>

    <div class="col-md-5" style="background-color: #eee">
        <h3>Rezultatas:</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Seniūnija</th>
                <th>Pensijinio amžiaus žmonės</th>
            </tr>
            </thead>
            <tbody>
                <tr>
<!--                    Atspausdinami rezultatai-->
                    <td><?php echo $max_county ?></td>
                    <td><?php echo $max_people ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>
    <h3>Komentaras:</h3>
    <p>Prisijungęs prie duomenų bazės, parašiau užklausą:</p>
    <p style="font-weight: bold">"select counties.seniunija as seniunija, count(registered_people.id) as counted from registered_people inner join counties on counties.seniunnr = registered_people.seniun_nr where timestampdiff(year, gimimo_data, '2020-01-01') >= 64 and lytis = 'V' or timestampdiff(year, gimimo_data, '2020-01-01') >= 63 and lytis = 'M' group by counties.seniunija"</p>
    <p>kurią naudojau gauti lentelei su seniūnijų pavadinimais ir žmonių, kurių amžius 2020-01-01 bus pensijinis. 2020 metais vyrų pensijinis amžius
        turėtų būti 64, moterų - 63 metai. Šią užklausą naudojau kitos užklausos viduje kaip lentelę duomenims gauti ir suradau didžiausią
        pensijinio amžiaus žmonių skaičių. Tada kitoje užklausoje vėl naudojau aukščiau parašytą užklausą kaip lentelę ir taip suradau
        seniūnijos pavadinimą, kuriai priklauso didžiausias pensijinio amžiaus žmonių skaičius.</p>
    <p>Gauti rezultatai atspausdinami lentelėje.</p>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
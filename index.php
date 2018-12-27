<html>
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link href="https://fonts.googleapis.com/css?family=Advent+Pro|Neucha|Oxygen|Saira+Extra+Condensed|Sedgwick+Ave|Yanone+Kaffeesatz" rel="stylesheet">`
<style>

body {
background-color: #9099A2;
margin: 0px;
font-size: .8em; /* currently ems cause chrome bug misinterpreting rems on body element */
  line-height: 1.6;
  font-weight: 400;
  font-family: "Raleway", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
}

table {
        font-family: 'Oxygen', sans-serif;
        font-size: 1em;
        padding: 6px;
	border-spacing: 0.2rem;

}

td {
        background-color: #8D097A0;
	
}

th {
        font-family: 'Yanone Kaffeesatz', sans-serif;
        font-size: 1.1em;
        text-align: left;
}
a:link {
        color: #FFEEEE;
        text-decoration: none;
        font-weight: bold;
}

a:hover {
        color: #FFEEEE;
        text-decoration: none;
}

a:visited {
        color: #FFEEEE;
        text-decoration: none;
}

a:active {
        color: #FFEEEE;
        text-decoration: none;
}

.container {
  position: relative;
  width: 100%;
  max-width: 100%;
  margin: 0 5px;
  padding: 0 5px;
  box-sizing: border-box;
  display: flex;
}

.wrapper {
max-width: 100%;
margin: 40px auto 0 auto;
line-height: 1.65;
padding: 20px 50px;
display: flex;
}

.FirstLast {
        flex: 4;
	background-color: #829295;
	border: 1px solid #777777;
	margin: 5;
	padding: 3;
}

.LastTen {
        flex: 2;
	background-color: #829295;
	border: 1px solid #777777;
	margin: 5;
	padding: 3;
}

.Dataz {
        flex: 1;
	background-color: #829295;
	border: 1px solid #777777;
	margin: 5;
	padding: 3;
}
</style>
</head>

<title>NerdRadio Stats</title>
<body>
<?php
include_once("functions.php");
?>


<div class="wrapper">
     <div class="FirstLast">
<?php
print "<br><b>Lonestar 92.5</b><br />";
FirstLast("Lonestar925");
?>
	</div>

	<div class="FirstLast">
<?php
print "<br><b>WMMS 100.7</b><br />";
FirstLast("WMMS");
?>
	</div>

	<div class="FirstLast">
<?php
print "<br><b>Overall Statistics - WMMS </b><br />";
BandCount("WMMS", "1");
BandCount("WMMS", "0");
SongCount("WMMS", "1");
SongCount("WMMS", "0");
?>
	</center>
	</div>

        <div class="FirstLast">
<?php
print "<br><b>Overall Statistics - Lonestar 92.5</b><br />";
BandCount("Lonestar925", "1");
BandCount("Lonestar925", "0");
SongCount("Lonestar925", "1");
SongCount("Lonestar925", "0");
?>
        </center>
        </div>

</div>


<div class="wrapper">
	<div class="LastTen">
<?php
print "<br>Last 10 Songs - Lonestar 92.5<br />";
LastTen("Lonestar925");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Yesterday Most Played Songs - Lonestar 92.5<br />";
MostPlayedSongs("Lonestar925", "1");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Overall Most Played Songs - Lonestar 92.5<br />";
MostPlayedSongs("Lonestar925", "0");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Yesterday Most Played Bands - Lonestar 92.5<br />";
MostPlayedBands("Lonestar925", "1");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Overall Most Played Bands - Lonestar 92.5<br />";
MostPlayedBands("Lonestar925", "0");
?>
	</div>

</div>

<div class="wrapper">
	<div class="LastTen">
<?php
print "<br>Last 10 Songs - WMMS 100.7<br />";
LastTen("WMMS");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Yesterday Most Played Songs - WMMS 100.7";
MostPlayedSongs("WMMS", "1");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Overall Most Played Songs - WMMS 100.7<br />";
MostPlayedSongs("WMMS", "0");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Yesterday Most Played Bands - WMMS 100.7<br />";
MostPlayedBands("WMMS", "1");
?>
	</div>

	<div class="Dataz">
<?php
print "<br>Overall Most Played Bands - WMMS 100.7<br />";
MostPlayedBands("WMMS", "0");
?>
	</div>
</div>

</body>
</html>

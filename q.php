<html>
<body bgcolor="#DDDDDD">
<title>Search Results</title>
<center>
<table cellspacing=4>
<tr>
<th bgcolor="#EEEEEE">#</th><th bgcolor="#EEEEEE">Band/Artist</th><th bgcolor="#EEEEEE">Song Title</th><th bgcolor="EEEEEE">Play Date/Time<th>
</tr>
<tr>
<?php

require("c.php");
include("functions.php");

$WhichBand = $_GET["band"];
$WhichSong = $_GET["song"];


$count="1";

$mysqli = new mysqli('localhost', $uname, $pass, $db );

        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

	if (!empty($WhichBand) )
        $sql = "SELECT * FROM ArtistData WHERE artistid=\"$WhichBand\"";

	if (!empty($WhichSong) )
	$sql = "SELECT * FROM SongData WHERE trackid=\"$WhichSong\"";

        $query = $mysqli->query( $sql );

        if( $query ) {
                while( $row = mysqli_fetch_array( $query ) )
                        {
                        $band = $row['artistid'];
                        $title = $row['trackid'];
			$playtime = $row['playtime'];

			$SongName = Translate("Song",$title);
			$BandName = Translate("Band",$band);
                print "<!-- start entry -->\n";
		print "<tr>\n";
                print "<td>$count</td><td><a href=\"q.php?band=$band\">$BandName</a></td>\n";
		print "<td><a href=\"q.php?song=$title\">$SongName</a></td><td>$playtime</td>\n";
                print "</tr>\n";
                print "<!-- end entry -->\n\n";
		$count++;
                }
	}
?>

</table>
<a href="index.php">HOME</a>
</center>

<?php

// function that takes a 'type' argument, ie: Song, or Band, and the id integer for it, 
// which gets translated into the actual song name, or band name.
function Translate($type, $which) {
require("c.php");
$mysqli = new mysqli('localhost', $uname, $pass, $db );
        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

	if ( $type == "Song" )
	{
		$songName = $mysqli->query("SELECT songname FROM SongData WHERE trackid='$which'")->fetch_object()->songname;
		return $songName;
	}

	if ( $type == "Band" )
	{
	        $bandName = $mysqli->query("SELECT artistname FROM ArtistData WHERE artistid='$which'")->fetch_object()->artistname;
		return $bandName;
	}
}


function BandCount( $station, $option ) {
require("c.php");
print "<table>\n<tr>";


$mysqli = new mysqli('localhost', $uname, $pass, $db );
        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

	if ( $option == "1" )
	{ // yesterday
        $sql = "select distinct artistid from $station where playtime > date(now()) -1;";
	$when = "Yesterday";
	}
	else
	{ // total
	$sql = "select distinct artistid from $station;";
	$when = "All time";
	}
        $query = $mysqli->query($sql);
        $numberofBands = mysqli_num_rows($query);

print "<td>$numberofBands</td><td>unique bands</td><td>$when</td></tr></table>\n";
}


function DistinctSongs() {
require("c.php");
print "<table>\n<tr>";
$mysqli = new mysqli('localhost', $uname, $pass, $db );
        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

        $sql = "SELECT DISTINCT trackid FROM SongData;";
        $query = $mysqli->query($sql);
        $numberofSongs = mysqli_num_rows($query);

print "<td>$numberofSongs</td><td>unique songs</td></tr></table>\n";
}


function FirstLast($station) {
require("c.php");

print "<table>\n";
print "<tr>\n<th>First and Last Song</th>\n";
print "</tr><tr>\n";
print "<td>Band/Artist</td>";
print "<td>Song Title</td>";
print "<td>Play Date/Time</td></tr>\n";

$mysqli = new mysqli('localhost', $uname, $pass, $db );
        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

        $first = "select s.songname,a.artistname, p.playtime from $station as p, SongData as s, ArtistData as a WHERE p.trackid = s.trackid AND p.artistid = a.artistid order by p.playtime asc limit 1;";
        $last = "select s.songname,a.artistname, p.playtime from $station as p, SongData as s, ArtistData as a WHERE p.trackid = s.trackid AND p.artistid = a.artistid order by p.playtime desc limit 1;";
//	$totalcount = "SELECT * FROM songs";

	$connStatus = $mysqli->query($totalcount);
	$numberofRows = mysqli_num_rows($connStatus);

        $query = $mysqli->query( $first );
        if( $query ) {
                while( $row = mysqli_fetch_array( $query ) )
                        {
                        $band = stripslashes($row['artistname']);
                        $title = stripslashes($row['songname']);
                        $playtime = stripslashes($row['playtime']);
                print "<!-- start entry -->\n";
	print "<tr><td><a href=\"query.php?band=$band\">$band</a></td><td><a href=\"query.php?title=$title\">$title</a></td><td>$playtime</td></tr>\n";
                print "<!-- end entry -->\n\n";
                }
        }
        $query2 = $mysqli->query( $last );
      if( $query2 ) {
                while( $row = mysqli_fetch_array( $query2 ) )
                        {
                        $band = stripslashes($row['artistname']);
                        $title = stripslashes($row['songname']);
                        $playtime = stripslashes($row['playtime']);
                print "<!-- start entry -->\n";
	print "<tr><td><a href=\"query.php?band=$band\">$band</a></td><td><a href=\"query.php?title=$title\">$title</a></td><td>$playtime</td></tr>\n";
                print "<!-- end entry -->\n\n";
                }
        }
	// print "<tr><td align=right>$numberofRows</td><td colspan=2>songs in database</td></tr>\n";
	print "</table>";
	// DistinctSongs();
	// CountBands();
}


function LastTen( $station ) {
require("c.php");

$count="1";

$mysqli = new mysqli('localhost', $uname, $pass, $db );

        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }
print "<table>\n";
print "<tr>\n";
print "<th>#</th><th>Band/Artist</th><th>Song Title</th><th>Play Date/Time</th>\n";
print "</tr>\n";

        $sql = "select s.songname,a.artistname, p.playtime from $station as p, SongData as s, ArtistData as a WHERE p.trackid = s.trackid AND p.artistid = a.artistid order by p.playtime desc limit 10";

        $query = $mysqli->query( $sql );

        if( $query ) {
                while( $row = mysqli_fetch_array( $query ) )
                        {
                        $band = stripslashes($row['artistname']);
                        $title = stripslashes($row['songname']);
                        $playtime = stripslashes($row['playtime']);

                print "<!-- start entry -->\n";
                print "<tr>\n";
                print "<td>$count</td><td><a href=\"query.php?band=$band\">$band</a></td><td><a href=\"query.php?title=$title\">$title</a></td><td>$playtime</td>\n";
                print "</tr>\n";
                print "<!-- end entry -->\n\n";
                $count++;
                }
        }
	print "</table>\n";
}

function MostPlayedBands( $station, $option ) {
require("c.php");

$count="1";

$mysqli = new mysqli('localhost', $uname, $pass, $db );

        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }

	print "<table><tr><th>#</th><th>Band/Artist</th><th>Times Played</th></tr>\n";


                if( $option == "1" )
                {
                        $sql = "SELECT artistid, count(*) AS artistcount FROM $station WHERE playtime > date(now()) -1 GROUP BY artistid ORDER BY artistcount DESC LIMIT 10;";
                        }
                        else
                        {
                        $sql = "select artistid, count(*) as artistcount from $station group by artistid order by artistcount desc limit 10;";
                }



        $query = $mysqli->query( $sql );

        if( $query ) {
                while( $row = mysqli_fetch_array( $query ) )
                        {
			$played = stripslashes($row['artistcount']);
                        $artistid = stripslashes($row['artistid']);
			$artistName = Translate("Band", $artistid);

			
                print "<!-- start entry -->\n";
                print "<tr><td>$count</td><td><a href=\"query.php?band=$artistName\">$artistName</a></td><td>$played</td></tr>\n";
                print "<!-- end entry -->\n\n";
                $count++;
                }
        }
	print"</table>";
}


function MostPlayedSongs( $station, $option ) {

require("c.php");


$count="1";

$mysqli = new mysqli('localhost', $uname, $pass, $db );

        if( $mysqli->connect_error ) {
        die('Connect error: ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error );
        }
	  print "<table>\n<tr><th>#</th>\n<th>Song Title</th><th>Times Played</th></tr>\n<tr>\n";

		if( $option == "1" ) 
		{  // 0 = alltime, 1 = yesterday
			$sql = "SELECT trackid, count(*) AS songcount FROM $station WHERE playtime > date(now()) -1 GROUP BY trackid ORDER BY songcount DESC LIMIT 10;";
			}
			else // assume alltime
			{
			$sql = "select trackid, count(*) as songcount from $station group by trackid order by songcount desc limit 10;";
		}	

        $query = $mysqli->query( $sql );

        if( $query ) {
                while( $row = mysqli_fetch_array( $query ) )
                        {
                        $trackid = stripslashes($row['trackid']);
                        $played = stripslashes($row['songcount']);
			$title = Translate( "Song", $trackid );
                print "<!-- start entry -->\n";
                print "<tr>\n";
                print "<td>$count</td><td><a href=\"query.php?song=$title\">$title</a></td><td>$played</td>\n";
                print "</tr>\n";
                print "<!-- end entry -->\n\n";
                $count++;
                }
        }
	print "</table>\n";
}

?>

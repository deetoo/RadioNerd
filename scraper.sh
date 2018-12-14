#!/bin/bash
#
x=1
OUTFILE="/tmp/uniquefilename.html"
# download the html file with the recently played songs.
# you need to update the URL to the station page you want to scrape.
wget https://lonestar925.iheart.com/music -O $OUTFILE

HEAD="1"

DBUSER=<enter your database user here>
DBPASS=<enter the db user password>
DB=<enter the name of the database to connect to>

SQLFILE="/tmp/radio.sql"

#clean up any old data file
if [ -f $SQLFILE ]
	then
		rm $SQLFILE 
	fi

# grab the last 10 songs listed on the webpage
while [ $x -le 10 ]
 do
# parse through the downloaded file to get band, song and time song was played.
 ARTIST=`cat $OUTFILE |grep "<figcaption>" -A 27 |grep "artist-name" -A 1 |grep target |cut -d'>' -f2 |cut -d'<' -f1 |head -$HEAD |tail -1`
 TITLE=`cat $OUTFILE |grep "<figcaption>" -A 27 |grep "song-title" -A 1 |grep target |cut -d'>' -f2 |cut -d'<' -f1 |head -$HEAD |tail -1`
 PLAYTIME=`cat $OUTFILE |grep "<figcaption>" -A 27 |grep datetime |cut -d'"' -f4 |head -$HEAD |tail -1`
 ARTISTID=`cat $OUTFILE |grep 'data-thumb-direction=\"up\"' -A2 |grep data-artist |cut -d\" -f2 |uniq |head -$HEAD |tail -1`
 TRACKID=`cat $OUTFILE |grep 'data-thumb-direction=\"up\"' -A2 |grep data-trackid |cut -d\" -f2 |uniq |head -$HEAD |tail -1`

# replace Lonestar925 with whatever tablename you create (I use table names that duplicate station names)
echo "INSERT INTO Lonestar925 VALUES( \"$PLAYTIME\", \"$TRACKID\", \"$ARTISTID\" ) ON duplicate key update playtime=playtime;" >>$SQLFILE
echo "INSERT INTO ArtistData VALUES( \"$ARTISTID\", \"$ARTIST\" ) on duplicate key update ArtistID=ArtistID;" >>$SQLFILE
echo "INSERT INTO SongData VALUES( \"$TRACKID\", \"$TITLE\" ) on duplicate key update trackid=trackid;" >> $SQLFILE

mysql --user=$DBUSER --password=$DBPASS $DB < $SQLFILE
 # increment head and tail values
 (( HEAD++ ))
 # increment the counter for the loop
 (( x++ ))
 done


# RadioNerd
My scraping and stats gathering mess of code for iHeart radio


DB info:
```
DB name: radio

MariaDB [radio]> desc ArtistData;
+------------+-------------+------+-----+---------+-------+
| Field      | Type        | Null | Key | Default | Extra |
+------------+-------------+------+-----+---------+-------+
| artistid   | int(11)     | NO   | PRI | NULL    |       |
| artistname | varchar(80) | YES  |     | NULL    |       |
+------------+-------------+------+-----+---------+-------+

MariaDB [radio]> desc SongData;
+----------+--------------+------+-----+---------+-------+
| Field    | Type         | Null | Key | Default | Extra |
+----------+--------------+------+-----+---------+-------+
| trackid  | int(11)      | NO   | PRI | NULL    |       |
| songname | varchar(100) | YES  |     | NULL    |       |
+----------+--------------+------+-----+---------+-------+

MariaDB [radio]> desc WMMS;
+----------+----------+------+-----+---------+-------+
| Field    | Type     | Null | Key | Default | Extra |
+----------+----------+------+-----+---------+-------+
| playtime | datetime | NO   | PRI | NULL    |       |
| trackid  | int(11)  | YES  |     | NULL    |       |
| artistid | int(11)  | YES  |     | NULL    |       |
+----------+----------+------+-----+---------+-------+

MariaDB [radio]> desc Lonestar925;
+----------+----------+------+-----+---------+-------+
| Field    | Type     | Null | Key | Default | Extra |
+----------+----------+------+-----+---------+-------+
| playtime | datetime | NO   | PRI | NULL    |       |
| trackid  | int(11)  | YES  |     | NULL    |       |
| artistid | int(11)  | YES  |     | NULL    |       |
+----------+----------+------+-----+---------+-------+
```

<p align="center">
    <img src="readme/title.png">
</p>

# oldsu!stream Server
A server specifically made for osu!stream (oldsu!stream, modified) written in PHP 7.4
<br><br>
I mainly chose PHP for this Project to familliarize myself with PHP again, <br>
After having written a [osu!2007 Server](https://github.com/Eeveelution/Eevee-osuserver) in it over half a year ago (as of the time that I'm writing this, look at the code at your own risk.)<br>
And so far I have to say that the Language (PHP 7.4 Specifically) is very comfortable to use.<br>
Since PHP 7 Added Type annotations, and PHPDoc existing, it's a fairly comfortable language to use for any project.

# Usage
This server isn't specifically made for running manually, <br>
because it uses private oldsu! SQL queries. (Mainly for login) <br>
but if you want to run it regardless, here are the steps:

1. Clone the repository using: ``git clone https://github.com/Eeveelution/oldsu-stream-server``
1. Go into the folder where it extracted (NOT IN ``/src/``)
1. Import the ``sql/import.sql`` File into your MySQL Database
1. Copy ``.env.example`` and paste as ``.env``
1. Fill the contents of ``.env`` with your values
 <br><br>Example Contents:
    ````
    MYSQL_USERNAME=eevee
    MYSQL_PASSWORD=ssh
    MYSQL_DATABASE=flanderemod
    MYSQL_LOCATION=localhost
    PUBLIC_HTML=/public
   SERVER_LOCATION=http://127.0.0.1:80
    ````
1. Run the main script with the PHP interpreter by running: ``php Main.php``

With a tiny bit of luck, you should have this server running properly.

# How to play (using oldsu!stream)
The oldsu!stream Client provides a easy way to switch servers from the defaults (osustream.com / oldsu.ayyeve.xyz/stream)<br>
The way you switch servers is in the ``osum.cfg`` File in the root of the oldsu!stream directory.<br><br>
Typical Contents:
````
offset = 0
VolumeEffect = 5
VolumeMusic = 7
NewsLastRead = 
NewsLastRetrieved = 2020-06-26
firstrun = 0
StoreLastRead = 2020-02-26
StoreLastRetrieved = 2020-02-26
EasyMode = 0
GuideFingers = 0

````

You need to add a line manually which says which server to use, example:
````
Server = http://127.0.0.1:8080
````
This will switch the server oldsu!stream is using to a server which is expected to run on localhost:8080

# License
*oldsu!stream Server*'s code is released under the [AGPL-3.0 License](https://github.com/Eeveelution/oldsu-stream-server/blob/master/LICENSE). Please see [The license file](https://github.com/Eeveelution/oldsu-stream-server/blob/master/LICENSE) for more information.


<!--
// Begin Script "sidereal.js"

/*  SIDEREAL CLOCK
Local Sidereal Clock for Windows Desktop By James Melatis
webmaster@indigotide.com
Click on set-up button to get a prompt window
Set longitude to decimalized local longitude to compute offset for Local Sidereal Time
Setting will round automatically to 7 decimal places
7 decimal places puts you within 1/2" at the equator (0.0004 arc seconds)
and even less closer to the poles
longitude = 0 = Greenwich Mean Sidereal Time (GMST)
longitude negative = West longitude offset
longitude positive = East longitude offset
EXAMPLE: West Longitude 117° 31' 51.71988" = -117.5310333°
*/

// execute this when the form loads

function loadUserSetting()
{
document.getElementById( "date" ).readOnly = true;
document.getElementById( "utc" ).readOnly = true;
document.getElementById( "gmst" ).readOnly = true;
document.getElementById( "angle" ).readOnly = true;
document.getElementById( "lst" ).readOnly = true;

UpdateClock();  // Have longitude so bail and start clock update routine
}

function UpdateClock()  //loop to keep time displays current
{
var long = 11.182725;

var now = new Date(); // get current date & time from computer clock
var jd = Math.floor((now.valueOf()/86400000)+2440587.5);

var date = now.toLocaleString();  // format date as local full date and 12 hour clock
var utc = now.toUTCString();  // format utc as UTC date & time

var beg = new Date( now.getUTCFullYear() - 1, 11, 31 ); // get last day of previous year in milliseconds
var day = Math.floor( ( now - beg ) / 86400000 ); // compute integer day of year (86400000 ms/day)

var mst = getGMST( now ); // get adjusted GMST in degrees for current system time
var mstAngle = mst; // save for GMST Angle display

// compute integer GMST hour angle deg min sec
var gmstdeg = Math.floor( mstAngle ); // get integer GMST hour angle degrees right ascension of vernal equinox

mstAngle = mstAngle - gmstdeg;  // get integer GMST hour angle minutes right ascension of vernal equinox
mstAngle = mstAngle * 60;
var gmstmin = Math.floor( mstAngle );

mstAngle = mstAngle - gmstmin;  // get integer GMST hour angle seconds right ascension of vernal equinox
mstAngle = mstAngle * 60;
var gmstsec = Math.floor( mstAngle );

var lst = mst + long; // now we know GMST so just add local longitude offset

if( lst > 0.0 ) // circle goes round and round, adjust LST if < 0 or > 360 degrees
{
while( lst > 360.0 )
lst -= 360.0;
}
else
{
while( lst < 0.0 )
lst += 360.0;
}

var ras = lst;  // save LST degrees right ascension for hour angle display

lst = lst / 15.0; // change LST from degrees to time units (15 deg/hour)
mst = mst / 15.0; // change MST from degrees to time units (15 deg/hour)

// compute integer LST hour angle deg min sec
var deg = Math.floor( ras );  // get integer hour angle degrees right ascension of vernal equinox

ras = ras - deg;  // get integer hour angle minutes right ascension of vernal equinox
ras = ras * 60;
var min = Math.floor( ras );

ras = ras - min;  // get integer hour angle seconds right ascension of vernal equinox
ras = ras * 60;
var sec = Math.floor( ras );

// compute local sidereal time hour minute second
hour = Math.floor( lst ); // get integer LST hour

lst = lst - hour; // get integer LST minute
lst = lst * 60;
minute = Math.floor( lst );

lst = lst - minute; //get integer LST second
lst = lst * 60;
second = Math.floor( lst );
// compute GMST time hours minutes seconds
hours = Math.floor( mst );  // get integer MST hours

mst = mst - hours;  // get integer MST minutes
mst = mst * 60;
minutes = Math.floor( mst );

mst = mst - minutes;  //get integer MST seconds
mst = mst * 60;
seconds = Math.floor( mst );

document.clock.jd.value = " " + jd;
document.clock.date.value = " " + date; // update "clock" form displays
document.clock.utc.value = " " + utc;
document.clock.gmstangle.value = " " + addZero( gmstdeg ) + "° " + addZero( gmstmin ) + "\' " + addZero( gmstsec ) + "\"";
document.clock.gmst.value = " " + addZero( hours ) + " : " + addZero( minutes ) + " : " + addZero( seconds );
document.clock.angle.value = " " + addZero( deg ) + "° " + addZero( min ) + "\' " + addZero( sec ) + "\"";
document.clock.lst.value = " " + addZero( hour ) + " : " + addZero( minute ) + " : " + addZero( second );

newtime = window.setTimeout("UpdateClock();", 1000);  // update all clock displays once per second
}

function addZero( n ) // adds leading zero if 1 digit number
{
if( n < 10 )
{
return "0" + n;
}
else
return n;
}

// Function getGMST computes Mean Sidereal Time (J2000)
// Input: Current Date
// Returns: Adjusted Greenwich Mean Sidereal Time (GMST) in degrees

function getGMST( now )
{
var year = now.getUTCFullYear();  // get UTC from computer clock date & time (var now)
var month = now.getUTCMonth() + 1;
var day = now.getUTCDate();
var hour = now.getUTCHours();
var minute = now.getUTCMinutes();
var second = now.getUTCSeconds();

if( month == 1 || month == 2 )
{
year = year - 1;
month = month + 12;
}

var lc = Math.floor( year/100 );  //integer # days / leap century
var ly = 2 - lc + Math.floor( lc/4 ); //integer # days / leap year
var y = Math.floor(365.25 * year);  //integer # days / year
var m = Math.floor(30.6001 * (month + 1));  //integer # days / month

// now get julian days since J2000.0
var jd = ly + y + m - 730550.5 + day + (hour + minute/60.0 + second/3600.0)/24.0;

// julian centuries since J2000.0
var jc = jd/36525.0;

// Greenwich Mean Sidereal Time (GMST) in degrees
var GMST = 280.46061837 + 360.98564736629*jd + 0.000387933*jc*jc - jc*jc*jc/38710000;

if( GMST > 0.0 )  // circle goes round and round, adjust if < 0 or > 360 degrees
{
while( GMST > 360.0 )
GMST -= 360.0;
}
else
{
while( GMST < 0.0 )
GMST += 360.0;
}

return GMST;  // in degrees
}

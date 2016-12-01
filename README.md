# HW11 RSS and XML
Your Name:

Grading Notes:


Link to your page on cscilab.bc.edu:

http://cscilab.bc.edu/~guevarja/hw11/hw11p2.php
-------
Create an application to give you information from two sources on the web using rss and xml.

You need two categories.  For my first category, I used weather from
http://w1.weather.gov/ and used several locations.

$weatherlocs = array(
    "http://w1.weather.gov/xml/current_obs/KBOS.xml"=>"Boston",
    "http://w1.weather.gov/xml/current_obs/KORD.xml"=>"Chicago",
    "http://w1.weather.gov/xml/current_obs/KROC.xml"=>"Rochester");

To see how the data is stored, navigate to
http://w1.weather.gov/xml/current_obs/KBOS.xml and view the page source.
 You should see something like the xml below.


<?xml version="1.0" encoding="ISO-8859-1"?>
<?xml-stylesheet href="latest_ob.xsl" type="text/xsl"?>
<current_observation version="1.0"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="http://www.weather.gov/view/current_observation.xsd">
    <credit>NOAA's National Weather Service</credit>
    <credit_URL>http://weather.gov/</credit_URL>
    <image>
          <url>http://weather.gov/images/xml_logo.gif</url>
          <title>NOAA's National Weather Service</title>
          <link>http://weather.gov</link>
  </image>
  <suggested_pickup>15 minutes after the hour</suggested_pickup>
  <suggested_pickup_period>60</suggested_pickup_period>
  <location>Boston, Logan International Airport, MA</location>
  <station_id>KBOS</station_id>
  <latitude>42.36056</latitude>
  <longitude>-71.01056</longitude>
  <observation_time>Last Updated on Feb 12 2015, 2:54 pm EST</observation_time>
        <observation_time_rfc822>Thu, 12 Feb 2015 14:54:00 -0500</observation_time_rfc822>
  <weather>Overcast</weather>
  <temperature_string>29.0 F (-1.7 C)</temperature_string>
  <temp_f>29.0</temp_f>
  <temp_c>-1.7</temp_c>
  <relative_humidity>78</relative_humidity>
  <wind_string>Southwest at 5.8 MPH (5 KT)</wind_string>
  <wind_dir>Southwest</wind_dir>
  <wind_degrees>220</wind_degrees>
  <wind_mph>5.8</wind_mph>
  <wind_kt>5</wind_kt>
  <pressure_string>1005.4 mb</pressure_string>
  <pressure_mb>1005.4</pressure_mb>
  <pressure_in>29.69</pressure_in>
  <dewpoint_string>23.0 F (-5.0 C)</dewpoint_string>
  <dewpoint_f>23.0</dewpoint_f>
  <dewpoint_c>-5.0</dewpoint_c>
  <windchill_string>23 F (-5 C)</windchill_string>
          <windchill_f>23</windchill_f>
          <windchill_c>-5</windchill_c>
  <visibility_mi>9.00</visibility_mi>
  <icon_url_base>http://forecast.weather.gov/images/wtf/small/</icon_url_base>
  <two_day_history_url>http://www.weather.gov/data/obhistory/KBOS.html</two_day_history_url>
  <icon_url_name>ovc.png</icon_url_name>
  <ob_url>http://www.weather.gov/data/METAR/KBOS.1.txt</ob_url>
  <disclaimer_url>http://weather.gov/disclaimer.html</disclaimer_url>
  <copyright_url>http://weather.gov/disclaimer.html</copyright_url>
  <privacy_policy_url>http://weather.gov/notice.html</privacy_policy_url>
</current_observation>



To access the data contained in the xml, create an object and use the
notation below.  You can get the location like this:

$xml= new SimpleXMLElement(file_get_contents(http://w1.weather.gov/xml/current_obs/KBOS.xml));
$location =  $xml-> location;

and get other information in a similar fashion.

Take a look at the page here to find a list of locations you can use: 
http://w1.weather.gov/xml/current_obs/seek.php

For the second category I poked around to find different news feeds. 
Look around and find ones that are interesting to you.

For each category, I used a selection menu that I created with an array
using a slightly modified version of the
createmenu() from lecture.  Create an array of sites for each category
and create a sticky menu for your sources.  I used two forms and two
field sets as shown below.  There are two separate screen shots. Because
I used two forms, only one of the two categories returned data at a
time.

Because the rss feeds were lengthy, I wanted a scroll bar on the news
returned.  I did that by surrounding the news in an element and using
the overflow property.  Take a look in the HTML/CSS text or google it.

.news {

    overflow: auto;
    height: 300px;
    border: 3px groove blue;
}

If you are looking for an extra challenge, the weather site above has
images that you can use for each type of weather reported.  Poke around
and see if you can get that to work.


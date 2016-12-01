<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title>HW11</title>
 <link rel= "stylesheet" type= "text/css" href= "css/hw11p2.css"/>
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
	<?php 
		$weatherlocs = array(
			"http://w1.weather.gov/xml/current_obs/KBOS.xml"=>"Boston",
			"http://w1.weather.gov/xml/current_obs/KORD.xml"=>"Chicago",
			"http://w1.weather.gov/xml/current_obs/KROC.xml"=>"Rochester"
			);
	
		$newsfeed = array (
			'http://rss.nytimes.com/services/xml/rss/nyt/Space.xml' => "NY Times",
			'http://www.usa.gov/rss/updates.xml'  =>"USA.GOV",
			'http://www.nasa.gov/rss/dyn/image_of_the_day.rss'  =>"NASA",
			'http://cscilab.bc.edu/~csinsider/?feed=rss2'  =>"CSCILAB",
			'http://www.newyorker.com/feed/humor' => "New Yorker"
			);
		print_r($_GET);
	?>
	
	<h1> RSS Weather and News Feed</h1>
	<?php
		$location = isset($_GET['weather']) ? $_GET['weather'] : "";
		create_form($weatherlocs, 'weather' );
		if (isset($_GET['weather'])){
			handle_weather($_GET['weather']);
		}
		create_form($newsfeed, 'news');
		if (isset($_GET['news'])){
			handle_form($_GET['news']);
		}
	?>
	
	
</body>
</html>

<?php
	function handle_weather($location){
		ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
		$xml= new SimpleXMLElement(file_get_contents("$location"));
		$location = $xml -> location;
		$temp = $xml -> temperature_string;
		$wind = $xml -> wind_string;
		$winds= $xml -> wind_mph;
		echo "<div class = 'we'>";
		echo "Location: $location <br>";
		echo "Temperature: $temp <br>";
		echo "Wind Velocity: $winds MPH <br>";
		echo "Wind Chill: $wind <br>";
		echo "</div>";
	}
	function handle_form($feed){
		$rss = simplexml_load_file ($feed);
		$title = $rss->channel->title;
		echo "<h1> $title</h1>";
		$items = $rss-> channel->item;
		if (!$items){
			$items = $rss-> item;
		}
		foreach($items as $item){
			echo "<div class = 'news'>
				<h2> $item->title<h2>\n";
			echo '<a href = "' . $item-> link . '">' . $item-> title . '</a><br>';
			echo $item-> description . "<br><br>\n";
			echo "</div>";
		}
	}
	
	function create_form($farray, $menuname){
?>
<form method = 'get'>
	<?php create_menu($farray, $menuname); ?>
	<br>
	<input type = 'submit' name = $menuname class ='btn btn-success btn-block' value = 'Get Feed!'>
	<br><br>
</form>
<?php
}
	function create_menu($farray, $menuname){
		$current_feed = isset($_GET['$menuname']) ? $_GET['$menuname'] : "";
		echo "<select name = '$menuname' class='form-control input-small'>";
		foreach ($farray as $key => $value){
			if ($current_feed == $f) {
				echo "<option value = '$key' selected>$value</option>";
			}
			else {
				echo "<option value = '$key'>$value</option>";
			}
		}
		echo "</select>";
	}
?>		
			
			
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title>HW11</title>
 <link rel= "stylesheet" type= "text/css" href= "css/hw11.css"/>
 
</head>

<?php 
	$weatherlocs = array(
		"http://w1.weather.gov/xml/current_obs/KBOS.xml"=>"Boston",
    	"http://w1.weather.gov/xml/current_obs/KORD.xml"=>"Chicago",
    	"http://w1.weather.gov/xml/current_obs/KROC.xml"=>"Rochester"
    	);
    
    $newsfeed = array (
    	'http://rss.nytimes.com/services/xml/rss/nyt/Space.xml' => "nytimes",
		'http://www.usa.gov/rss/updates.xml'  =>"usa.gov",
		'http://www.nasa.gov/rss/dyn/image_of_the_day.rss'  =>"nasa",
		'http://cscilab.bc.edu/~csinsider/?feed=rss2'  =>"cscilab",
		'http://www.newyorker.com/feed/humor' => "newyorker"
		);

?>

<body>
	<fieldset>
		<form method = 'get'>
			<?php
				echo "<select name = 'place' >";
				foreach ($weatherlocs as $key => $value){
					if ($location == $key) {
						echo "<option value ='$key'> $value </option>";
					}
					else {
						echo "<option value = '$key'> $value </option>";
					}
				}
			?>
			</select><br>
			
			<input type = 'submit' name = 'submit' value = 'Search'>
			<br><br>
			<?php
				$location = $_GET['place'];
				
				if (isset ($_GET['submit'])){
					displayWeather($location);
				}
			?>
		</form>
	</fieldset>
	
	<fieldset>
		<?php
			$news = $_GET['news'];
			
			if (isset($_GET['news'])){
				displayNews($news);
			}
		?>
		<form method = 'get'>
			<?php
				echo "<select name = 'news'>";
				foreach($newsfeed as $key1 => $value1){
					if($news == $key1){
						echo "<option selected value = 'key1'> $value1 </option> <br><br>";
					}
					else {
						echo "<option value = $key1> $value1 </option> <br><br>";
					}
				}
			?> </select><br>
			
			<input type = 'submit' name = 'news' value = 'search'>
		</form>
	</fieldset>

</body>
</html>

<?php
	function displayWeather($location){
		ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
		$xml= new SimpleXMLElement(file_get_contents("$location"));
	
		$location = $xml -> location;
		$temp = $xml -> temperature_string;
		$wind = $xml -> wind_string;
		$winds= $xml -> wind_mph;
	
		echo "$location";
		echo "$temp";
		echo "$wind";
		echo "$winds";
	}
	function displayNews($news) {
		$rss = simplexml_load_file($news);
		$title =  $rss->channel->title;
		$items = $rss->channel->item;
		      if (!$items)
		        $items = $rss->item;

		        echo "<div class='news'>";
		      	foreach ( $items as $item ) {
				echo "<h2>$item->title<h2>\n";
		        echo '<a href="' . $item->link . '">Click For Link</a><br>';
		        echo $item->description . "<br> <br>\n";
		        }
      echo "</div>";
	}


?>			
<?php

$filedata = file_get_contents('http://192.168.0.147/moduliRPI/sensor_H2O.php');

//$filedata = 32;
	if($filedata == true)
	{

		if($filedata < 0)
		{
		echo ' <a style="color: #8000ff; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		elseif($filedata >= 0 and $filedata < 10)
		{
		echo ' <a style="color: blue; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		elseif($filedata >= 10 and $filedata <= 20)
		{
		echo ' <a style="color: #40ff00; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		elseif($filedata > 20 and $filedata <= 30)
		{
			echo ' <a style="color: #ff6600; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		elseif($filedata > 30 and $filedata <= 33)
		{
			echo ' <a style="color: #ff0000; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		elseif($filedata >= 34)
		{
			echo ' <a style="color: #990000; font-size: 40px;">' .$filedata. "°C".'</a>';
		}
		echo "<br>";
	}
?>

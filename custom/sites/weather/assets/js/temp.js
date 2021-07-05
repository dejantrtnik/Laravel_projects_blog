var auto_refresh_temp1 = setInterval(
function()
  {
      $('#ds18b20_raw').load('inc/ds18b20_raw.php').fadeIn("slow");
      //console.log(auto_refresh_temp1);
  }, 1000);

$(document).ready(function () {
  showGraph();
});
function showGraph()
{
  {
    $.post("inc/temp.php",
    function (data)
    {
      //console.log(data);
      var pres = [];
      var temp = [];
      var date = [];
      //console.log(date);
      for (var i in data) {
        pres.push(data[i].pressure);
        temp.push(data[i].temperature);
        date.push(data[i].date + ':00');
      }
      var chartdata = {
        labels: date,
        datasets: [
          {
            label: 'Temperatura °C - BMP180',
            fill: false,
            borderColor: "#1a32d5",
            //borderCapStyle: 'butt',
            //borderDash: [5, 5],
            data: temp
          }]
      };

      var chartdata_press = {
        labels: date,
        datasets: [
          {
            label: 'Pritisk - vsako uro',
            fill: false,
            backgroundColor: '#496bff',
            borderColor: '#46d5f1',
            hoverBackgroundColor: '#CCCCCC',
            hoverBorderColor: '#666666',
            data: pres
          }]
      };

      //console.log(chartdata);
      var graphTarget = $("#graphCanvasTemp");
      var graphTarget_press = $("#graphCanvasPress");

      var barGraph = new Chart(graphTarget, {
        type: 'line',
        data: chartdata
      });

      var barGraph = new Chart(graphTarget_press, {
        type: 'line',
        data: chartdata_press,
        options: {
          scales: {
              yAxes: [{
                  ticks: {
                    min: 980,
                    max: 1040,
                    stepSize: 5
                  }
              }]
          }
      }
      });
    });
  }
}

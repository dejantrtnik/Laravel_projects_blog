$(document).ready(function () {
  showGraphWeek();
});
function showGraphWeek()
{
  {
    $.post("inc/tempWeek.php",
    function (data)
    {
      //console.log(data);
      var pres = [];
      var date = [];
      //console.log(date);
      for (var i in data) {
        pres.push(data[i].pressure);
        date.push(data[i].date);
      }
      var chartdata_press = {
        labels: date,
        datasets: [
          {
            label: 'Pritisk - na vsakih 12 ur',
            fill: false,
            backgroundColor: '#496bff',
            borderColor: '#46d5f1',
            hoverBackgroundColor: '#CCCCCC',
            hoverBorderColor: '#666666',
            data: pres
          }]
      };

      //console.log(chartdata);

      var graphTarget_press = $("#graphCanvasPressWeek");

      var barGraph = new Chart(graphTarget_press, {
        type: 'line',
        data: chartdata_press,
        options: {
          scales: {
              yAxes: [{
                  ticks: {
                    min: 980,
                    max: 1050,
                    stepSize: 5
                  }
              }]
          }
      }
      });
    });
  }
}

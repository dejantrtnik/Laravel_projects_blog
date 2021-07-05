<div class="modal fade" id="opisModal" tabindex="-1" role="dialog" aria-labelledby="opisModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="opisModalLabel">Opis meritve</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="margin: 0px 10px 10px">Strojna oprema: <br>
           - Raspberry 3 B+ <br>
           - Server - Oracle Linux 8 OS ( Intel CoreDuo )<br>
           <br>
           Sensorji: <br>
                - BMP180 (temperatura, pritisk) <br>
                - DHT11 (temperatura, vlaga) <br>
                - DS18B20 (temperatura) <br>
           - Sensorji se očitavajo s Python programskim jezikom <br>
           - Podatki se zapisujejo v SQL bazo <br>
           - Grafi so prikazani s pomočjo "chart.js" skript <br>
           - Vse skupaj povezano deluje na zasebnem Linux serverju <br>
           <br>
           Meritev: <br>
           - temperatura v obliki številke se osvežuje vsako sekundo (senzor - DS18B20) <br>
           - Grafi prikazujejo podatke na eno uro iz podatkovne baze (senzor - BMP180) <br>

           <br>

           Github <br>
           <a href="https://github.com/dejantrtnik?tab=repositories">https://github.com/dejantrtnik?tab=repositories</a> <br>
           <br>
           Web <br>
           <a href="/">linijart</a>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

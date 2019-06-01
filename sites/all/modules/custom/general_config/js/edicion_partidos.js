(function($) {
  Drupal.behaviors.clarionCardsDescriptions = {
    attach: function (context) {
      // Marcadores.
      var golesEquipo1 = "span#goles-equipo-1";
      var golesEquipo2 = "span#goles-equipo-2";
      // Text inputs.
      var golesJugador1Equipo1 = "input#edit-field-goles-jugador-1-equipo-1-und-0-value";
      var golesJugador2Equipo1 = "input#edit-field-goles-jugador-2-equipo-1-und-0-value";
      var golesJugador1Equipo2 = "input#edit-field-goles-jugador-1-equipo-2-und-0-value";
      var golesJugador2Equipo2 = "input#edit-field-goles-jugador-2-equipo-2-und-0-value";
      // Check inicial de los goles para evitar errores de validación.
      $(golesEquipo1).text(parseInt($(golesJugador1Equipo1).val()) + parseInt($(golesJugador2Equipo1).val()));
      $(golesEquipo2).text(parseInt($(golesJugador1Equipo2).val()) + parseInt($(golesJugador2Equipo2).val()));
      // Recalcular resultado al escribir en los inputs.
      $(golesJugador1Equipo1).keyup(function () {
        $(golesEquipo1).text(parseInt($(golesJugador1Equipo1).val()) + parseInt($(golesJugador2Equipo1).val()));
      });
      $(golesJugador2Equipo1).keyup(function () {
        $(golesEquipo1).text(parseInt($(golesJugador1Equipo1).val()) + parseInt($(golesJugador2Equipo1).val()));
      });
      $(golesJugador1Equipo2).keyup(function () {
        $(golesEquipo2).text(parseInt($(golesJugador1Equipo2).val()) + parseInt($(golesJugador2Equipo2).val()));
      });
      $(golesJugador2Equipo2).keyup(function () {
        $(golesEquipo2).text(parseInt($(golesJugador1Equipo2).val()) + parseInt($(golesJugador2Equipo2).val()));
      });
    }
  }
})(jQuery);

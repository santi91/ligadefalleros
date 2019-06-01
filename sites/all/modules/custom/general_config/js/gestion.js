(function($) {
  Drupal.behaviors.clarionCardsDescriptions = {
    attach: function (context) {
      // Wrappers disponibles para esconderlos.
      var faseLiga = $("#edit-field-fase-liga-tid-wrapper");
      var jornadaGrupo1 = $("#edit-field-jornada-grupo-1-tid-wrapper");
      var jornadaGrupo2 = $("#edit-field-jornada-grupo-2-tid-wrapper");
      var jornadaCopa = $("#edit-field-jornada-copa-tid-wrapper");
      var jornadaFaseFinal = $("#edit-field-jornada-fase-final-tid-wrapper");
      // Selects.
      var competicionSelect = "select#edit-field-competicion-tid";
      var faseLigaSelect = "select#edit-field-fase-liga-tid";
      var jornadaGrupo1Select = "select#edit-field-jornada-grupo-1-tid";
      var jornadaGrupo2Select = "select#edit-field-jornada-grupo-2-tid";
      var jornadaFaseFinalSelect = "select#edit-field-jornada-fase-final-tid";
      var jornadaCopaSelect = "select#edit-field-jornada-copa-tid";

      // Gestionar el inicio de página (tener en cuenta filtros en URL).
      // Competicion.
      $(competicionSelect + " option").each(function (key, value) {
        if ($(this).attr('selected')) {
          // Si Liga.
          if ($(this).val() == 3) {
            faseLiga.show();
            jornadaGrupo1.hide();
            jornadaGrupo2.hide();
            jornadaCopa.hide();
            jornadaFaseFinal.hide();
          }
          // Si Copa.
          else if ($(this).val() == 4) {
            faseLiga.hide();
            jornadaGrupo1.hide();
            jornadaGrupo2.hide();
            jornadaFaseFinal.hide();
            jornadaCopa.show();
          }
          else {
            faseLiga.hide();
            jornadaGrupo1.hide();
            jornadaGrupo2.hide();
            jornadaCopa.hide();
            jornadaFaseFinal.hide();
          }
        }
      });
      // Fase Liga.
      $(faseLigaSelect + " option").each(function (key, value) {
        if ($(this).attr('selected')) {
          // Si Grupo 1.
          if ($(this).val() == 5) {
            jornadaGrupo1.show();
            jornadaGrupo2.hide();
            jornadaFaseFinal.hide();
          }
          // Si Grupo 2.
          else if ($(this).val() == 6) {
            jornadaGrupo1.hide();
            jornadaGrupo2.show();
            jornadaFaseFinal.hide();
          }
          // Si Fase Final.
          else if ($(this).val() == 7) {
            jornadaGrupo1.hide();
            jornadaGrupo2.hide();
            jornadaFaseFinal.show();
          }
          // Si no hay seleccionada se esconden todos.
          else {
            jornadaGrupo1.hide();
            jornadaGrupo2.hide();
            jornadaFaseFinal.hide();
          }
        }
      });

      // Gestionar los cambios de filtro. Los filtros escondidos tienen que ser reseteados a "Any".
      // Competición.
      $(competicionSelect).change(function () {
        $(competicionSelect + " option").each(function (key, value) {
          if ($(this).attr('selected')) {
            // Si Liga.
            if ($(this).val() == 3) {
              faseLiga.show();
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaCopa.hide();
              $(jornadaCopaSelect + " option[value=All]").attr('selected', 'selected');
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
            // Si Copa.
            else if ($(this).val() == 4) {
              faseLiga.hide();
              $(faseLigaSelect + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaCopa.show();
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
            // Si no hay seleccionada se esconden todos.
            else {
              faseLiga.hide();
              $(faseLigaSelect + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaCopa.hide();
              $(jornadaCopaSelect + " option[value=All]").attr('selected', 'selected');
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
          }
        });
      });
      // Fase Liga.
      $(faseLigaSelect).change(function () {
        $(faseLigaSelect + ' option').each(function (key, value) {
          if ($(this).attr('selected')) {
            // Si Grupo 1.
            if ($(this).val() == 5) {
              jornadaGrupo1.show();
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
            // Si Grupo 2.
            else if ($(this).val() == 6) {
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.show();
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
            // Si Fase Final.
            else if ($(this).val() == 7) {
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaFaseFinal.show();
            }
            // Si no hay seleccionada se esconden todos.
            else {
              jornadaGrupo1.hide();
              $(jornadaGrupo1Select + " option[value=All]").attr('selected', 'selected');
              jornadaGrupo2.hide();
              $(jornadaGrupo2Select + " option[value=All]").attr('selected', 'selected');
              jornadaFaseFinal.hide();
              $(jornadaFaseFinalSelect + " option[value=All]").attr('selected', 'selected');
            }
          }
        });
      });
    }
  }
})(jQuery);

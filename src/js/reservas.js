const horaApertura = moment("08:00 am", "hh:mm A");
const horaCierre = moment("09:00 pm", "hh:mm A");
const horaActual = moment();
// const horaActual = moment("08:10 am", "hh:mm A");

function obtenerHora() {
  console.clear();
  console.log(horaActual.locale("es").format("LLLL"));

  if (horaActual.isBetween(moment(horaApertura).subtract("1", "minutes"), moment(horaCierre).subtract("29", "minutes"))) {
    const minutosFaltantes = horaActual.minute() % 30 > 0
      ? 30 - horaActual.minute() % 30
      : horaActual.minute() % 30;
    var horaCercana = moment(horaActual).add(minutosFaltantes, "minutes");
    $("#btnHoraIn").html(horaCercana.format("hh:mm A"));
    obtenerOpcionesHoraInicial(horaCercana);
  } else if (horaActual.isBetween(moment("11:59 pm", "hh:mm A").subtract(1, "days"), horaApertura)) {
    $("#btnHoraIn").html(horaApertura.format("hh:mm A"));
    obtenerOpcionesHoraInicial(horaApertura);
  } else {
    $("#btnHoraIn").html(horaApertura.format("hh:mm A")).addClass("disabled");
    $("#btnHoraFin").html(horaApertura.format("hh:mm A")).addClass("disabled");
  }
}

function obtenerOpcionesHoraInicial(hora) {
  $("#dropHoraIn").empty();
  var horaOpcion = hora;
  do {
    var a = $('<a class="dropdown-item" href="#" >' + horaOpcion.format("hh:mm A") + "</a>");
    a.attr("value", horaOpcion.format("hh:mm A"));
    $("#dropHoraIn").append(a);
    horaOpcion.add(30, "minutes");
  } while (horaOpcion.unix() < moment("09:00 pm", "hh:mm A").unix());
}

function obtenerOpcionesHoraFinal(hora) {
  $("#dropHoraFin").empty();
  var horaOpcion = moment(hora, "hh:mm A");
  for (let index = 0; index < 4; index++) {
    horaOpcion.add(30, "minutes");
    var a = $('<a class="dropdown-item" href="#" >' + horaOpcion.format("hh:mm A") + "</a>");
    a.attr("value", horaOpcion.format("hh:mm A"));
    $("#dropHoraFin").append(a);
    if (horaOpcion.unix() == moment("09:00 pm", "hh:mm A").unix()) {
      break;
    }
  }
  $("#btnHoraFin").html(horaOpcion.format("hh:mm A"));
  mostrarSeleccionHoraFinal();
}

function mostrarSeleccionCapacidad() {
  $("#dropCapa a").on("click", function () {
    var capacidad = $(this).text();
    $("#btnCapa").html(capacidad);
    mostrarHoras();
  });
}

function mostrarSeleccionHoraInic() {
  $("#dropHoraIn a").on("click", function () {
    var horaInicial = $(this).text();
    $("#btnHoraIn").html(horaInicial);
    obtenerOpcionesHoraFinal(horaInicial);
    mostrarHoras();
  });
}

function mostrarSeleccionHoraFinal() {
  $("#dropHoraFin a").on("click", function () {
    var horaFinal = $(this).text();
    $("#btnHoraFin").html(horaFinal);
    mostrarHoras();
  });
}

function mostrarHoras() {
  var capacidad = $("#btnCapa").text();
  var horaInicio = $("#btnHoraIn").text();
  var horaFinal = $("#btnHoraFin").text();

  $("#inputCapacidad").attr("value", capacidad);
  $("#inputHoraInicio").attr("value", horaInicio);
  $("#inputHoraFinal").attr("value", horaFinal);

  console.log("Capacidad " + capacidad + "\nHora inicial " + horaInicio + "\nHora final " + horaFinal);
}

window.onload = window.onload = function () {
  obtenerHora();
  obtenerOpcionesHoraFinal($("#btnHoraIn").text());
  mostrarSeleccionCapacidad();
  mostrarSeleccionHoraInic();
  mostrarSeleccionHoraFinal();
  mostrarHoras();
  if (!window.location.href.includes("#")) {
    $("#btnBuscar").click();
    // window.location.href = "reserva.php#";
  }
};
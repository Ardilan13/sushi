//Ajax revisa el login y genera credenciales
$("#btn_login").on("click", function (e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/login.php",
    data: $("#ingreso").serialize(),
    type: "POST",
    dataType: "text",
    success: function (text) {
      if (text == 1) {
        $(location).prop("href", "productos.php");
      } else {
        alert("Contraseña incorrecta.");
        $("#clave").val("");
      }
    },
    error: function (xhr, status, errorThrown) {
      alert("Error");
    },
  });
});

// Filtro y busqueda tablas

let temp = $("#clonar").clone();
$("#clonar").click(function () {
  $("#clonar").after(temp);
});

$(document).ready(function () {
  var table = $("#productos").DataTable({
    orderCellsTop: true,
    fixedHeader: true,
  });

  //Crea el buscador de cada atributo
  /*   $("#productos thead tr").clone(true).appendTo("#productos thead");
   */
  $("#productos thead tr:eq(1) th").each(function (i) {
    var title = $(this).text(); //es el nombre de la columna
    $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');

    $("input", this).on("keyup change", function () {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });
});

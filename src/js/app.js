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

//boton acceder al modulo de crear nuevo producto
$("#new_pro").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_producto.php?");
});

//Ajax crea un nuevo producto
$("#add_producto").on("click", function (e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/add_producto.php",
    data: $("#new_producto").serialize(),
    type: "POST",
    dataType: "text",
    success: function (text) {
      if (text == 1) {
        alert("Producto Creado!");
        $(location).prop("href", "productos.php");
      } else {
        alert("Error, intente nuevamente.");
        terminal(text);
      }
    },
    error: function (xhr, status, errorThrown) {
      alert("Error");
    },
  });
});

//accede al menu actualizar producto y le pasa el id por metodo GET
$(".edit_pro").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_producto.php?id=" + $(this).attr("id"));
});

//Ajax actualiza el producto seleccionado
$("#btn_update_pro").on("click", function (e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/update_producto.php",
    data: $("#new_producto").serialize(),
    type: "POST",
    dataType: "text",
    success: function (text) {
      if (text == 1) {
        alert("Producto Actualizado!");
        $(location).prop("href", "productos.php");
      } else {
        alert("Error, intente nuevamente.");
        terminal(text);
      }
    },
    error: function (xhr, status, errorThrown) {
      alert("Error");
    },
  });
});

//boton acceder al modulo de generar una compra
$("#new_com").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_compra.php?");
});

//Ajax que genera una nueva compra
$("#add_compra").on("click", function (e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/add_compra.php",
    data: $("#new_compra").serialize(),
    type: "POST",
    dataType: "text",
    success: function (text) {
      if (text == 1) {
        alert("Compra generada y producto actualizado!");
        $(location).prop("href", "compras.php");
      } else {
        alert("Error, intente nuevamente.");
        terminal(text);
      }
    },
    error: function (xhr, status, errorThrown) {
      alert("Error");
    },
  });
});

//Actualizar la cantidad para tener en cuenta las unidades, modulo agreagr compras
$("#producto").change(function () {
  var unidad = $("#producto option:selected").attr("unidad");
  switch (unidad) {
    case "1":
      resultado = " en Kgs:";
      break;
    case "2":
      resultado = " en Lts:";
      break;
    case "3":
      resultado = " en Und:";
      break;
    default:
      resultado = ":";
  }
  $("#unidad_producto").html("Cantidad" + resultado);
});

// Filtro y busqueda tablas
$(document).ready(function () {
  let temp = $("#clonar").clone();
  $("#clonar").click(function () {
    $("#clonar").after(temp);
  });

  var table = $("#tabla").DataTable({
    orderCellsTop: true,
    fixedHeader: true,
  });

  //Crea el buscador de cada atributo
  $("#tabla thead tr").clone(true).appendTo("#tabla thead");

  $("#tabla thead tr:eq(1) th").each(function (i) {
    $(this).html(
      '<input type="text" style="width:80%; padding: 5px;border-radius: 5px;border:.5px solid grey;"/>'
    );

    $("input", this).on("keyup change", function () {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });

  $.ajax({
    url: "ajax/list_productos.php",
    data: null,
    type: "POST",
    dataType: "text",
    success: function (text) {
      $("#producto").html(text);
    },
  });
});

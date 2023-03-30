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

  $(location).prop("href", "new_producto.php");
});

//Ajax crea un nuevo producto
$("#add_producto").on("click", function (e) {
  e.preventDefault();

  if (
    $("#nombre").val().length > 0 &&
    $("#proveedor").val().length > 0 &&
    $("#tipo").val().length > 0 &&
    $("#merma").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#precio").val().length > 0 &&
    $("#unidad").val().length > 0
  ) {
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
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$(".edit_tipo").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_tipo.php?id=" + $(this).attr("id"));
});

$("#new_tipo").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_tipo.php");
});

$("#add_tipo").on("click", function (e) {
  e.preventDefault();

  if ($("#nombre").val().length > 0) {
    $.ajax({
      url: "ajax/add_tipo.php",
      data: $("#new_tipos").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Tipo Creado!");
          $(location).prop("href", "tipos.php");
        } else {
          alert("Error, intente nuevamente.");
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#btn_update_tipo").on("click", function (e) {
  e.preventDefault();

  if ($("#nombre").val().length > 0) {
    $.ajax({
      url: "ajax/add_tipo.php",
      data: $("#new_tipos").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Tipo Actualizado!");
          $(location).prop("href", "tipos.php");
        } else {
          alert("Error, intente nuevamente.");
          console(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

//accede al menu actualizar producto y le pasa el id por metodo GET
$(".edit_pro").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_producto.php?id=" + $(this).attr("id"));
});

$(".edit_ventas").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_venta.php?id=" + $(this).attr("id"));
});

$(".new_ven").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_venta.php");
});

$("#agg_producto1").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "create_producto.php?id=" + $(this).val());
});

$("#agg_producto").on("click", function (e) {
  e.preventDefault();

  if ($("#fecha").val().length > 0) {
    $.ajax({
      url: "ajax/create_venta.php",
      data: { fecha: $("#fecha").val() },
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text != 0) {
          $(location).prop("href", "create_producto.php?id=" + text);
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#agg_receta1").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "create_receta.php?id=" + $(this).val());
});

$("#agg_receta").on("click", function (e) {
  e.preventDefault();
  if ($("#fecha").val().length > 0) {
    $.ajax({
      url: "ajax/create_venta.php",
      data: { fecha: $("#fecha").val() },
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text != 0) {
          $(location).prop("href", "create_receta.php?id=" + text);
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#agg_producto_venta").on("click", function (e) {
  e.preventDefault();

  if (
    $("#producto").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#valor").val().length > 0
  ) {
    $.ajax({
      url: "ajax/verificar_cantidad.php",
      data: $("#new_producto_venta").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          $.ajax({
            url: "ajax/create_venta.php",
            data: $("#new_producto_venta").serialize(),
            type: "POST",
            dataType: "text",
            success: function (text1) {
              if (text1 == 1) {
                alert("Producto Agregado a venta!");
                $(location).prop("href", "ventas.php");
              } else {
                alert("Error, intente nuevamente.");
                console(text1);
              }
            },
            error: function (xhr, status, errorThrown) {
              alert("Error");
            },
          });
        } else {
          alert(
            "La cantidad de la salida " +
              $("#cantidad").val() +
              " no puede ser mayor a " +
              text
          );
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#agg_venta").on("click", function (e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/guardar_venta.php",
    data: $("#new_venta").serialize(),
    type: "POST",
    dataType: "text",
    success: function (text) {
      if (text > 0) {
        alert("Venta guardada!");
        window.history.go(-1);
      } else {
        alert("Error, intente nuevamente.");
        console.log(text);
      }
    },
    error: function (xhr, status, errorThrown) {
      alert("Error");
    },
  });
});

$("#agg_receta_venta").on("click", function (e) {
  e.preventDefault();

  if (
    $("#receta").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#valor_receta").val().length > 0
  ) {
    $.ajax({
      url: "ajax/create_venta.php",
      data: $("#new_producto_venta").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Receta Agregado a venta!");
          $(location).prop("href", "ventas.php");
        } else {
          alert("Error, intente nuevamente.");
          console(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

//Ajax actualiza el producto seleccionado
$("#btn_update_pro").on("click", function (e) {
  e.preventDefault();

  if (
    $("#nombre").val().length > 0 &&
    $("#proveedor").val().length > 0 &&
    $("#tipo").val().length > 0 &&
    $("#merma").val().length > 0 &&
    $("#unidad").val().length > 0
  ) {
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
          console(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#btn_historial").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "historial.php?id=" + $("#id").val());
});

$("#btn_producir").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "produccion.php?id=" + $("#id").val());
});

$("input:radio[name=producido]").on("click", function (e) {
  if ($("input:radio[name=producido]:checked").val() == "nuevo") {
    $(".nuevo").show();
    $(".existente").css("display", "none");
  } else {
    $(".existente").show();
    $(".nuevo").css("display", "none");
  }
});

$("#add_producto_pro").on("click", function (e) {
  e.preventDefault();

  if (
    $("#nombre").val().length > 0 &&
    $("#tipo").val().length > 0 &&
    $("#unidad").val().length > 0 &&
    $("#valor_new").val().length > 0 &&
    $("#cantidad_new").val().length > 0
  ) {
    producto = parseFloat($("#cantidad_pro_1").val());
    cantidad = parseFloat($("#test").val());
    if (producto <= cantidad) {
      $.ajax({
        url: "ajax/add_produccion.php",
        data: $("#new_producto_pro").serialize(),
        type: "POST",
        dataType: "text",
        success: function (text) {
          if (text == 1) {
            alert("Producto Creado y Cantidad Restada!");
            $(location).prop("href", "productos.php");
          } else {
            alert("Error, intente nuevamente.");
            alert(text);
          }
        },
        error: function (xhr, status, errorThrown) {
          alert("Error");
        },
      });
    } else {
      alert("La cantidad a usar no puede ser mayor a la cantidad existente.");
    }
  } else {
    alert("Llena todos los campos.");
  }
});

$("#update_produccion").on("click", function (e) {
  e.preventDefault();

  if (
    $("#producto").val().length > 0 &&
    $("#cantidad_pro_2").val().length > 0 &&
    $("#valor_old").val().length > 0
  ) {
    producto = parseFloat($("#cantidad_pro_2").val());
    cantidad = parseFloat($("#test1").val());
    if (producto <= cantidad) {
      $.ajax({
        url: "ajax/update_produccion.php",
        data: $("#update_producto_pro").serialize(),
        type: "POST",
        dataType: "text",
        success: function (text) {
          if (text == 1) {
            alert("Producto Actualizado y Cantidad Restada!");
            $(location).prop("href", "productos.php");
          } else {
            alert("Error, intente nuevamente.");
            alert(text);
          }
        },
        error: function (xhr, status, errorThrown) {
          alert("Error");
        },
      });
    } else {
      alert("La cantidad a usar no puede ser mayor a la cantidad existente.");
    }
  } else {
    alert("Llena todos los campos.");
  }
});

$(".new_pre").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_preparacion.php");
});

$(".new_rec").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_preparacion.php?receta=1");
});

$(".des_exc").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "ajax/descargar_excel.php");
});

$(".edit_pre").on("click", function (e) {
  e.preventDefault();
  $(location).prop("href", "new_preparacion.php?id=" + $(this).attr("id"));
});

$("#add_preparacion").on("click", function (e) {
  e.preventDefault();

  if ($("#nombre").val().length > 0 && $("#tipo").val().length > 0) {
    $.ajax({
      url: "ajax/add_preparacion.php",
      data: $("#new_preparacion").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Creado correctamente!");
          window.history.go(-1);
        } else {
          alert("Error, intente nuevamente.");
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

//Ajax actualiza la preparacion seleccionado
$("#btn_update_pre").on("click", function (e) {
  e.preventDefault();

  if (
    $("#nombre").val().length > 0 &&
    $("#proveedor").val().length > 0 &&
    $("#tipo").val().length > 0 &&
    $("#merma").val().length > 0 &&
    $("#unidad").val().length > 0
  ) {
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
          console(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#new_ing").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_ingrediente.php?id=" + $("#id").val());
});

$("#historial_rec").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "historial_recetas.php?id=" + $("#id").val());
});

$("#save_pre").on("click", function (e) {
  e.preventDefault();

  if (
    $("#unidad").val().length > 0 &&
    $("#nombre").val().length > 0 &&
    $("#cantidad").val().length > 0
  ) {
    $.ajax({
      url: "ajax/update_preparacion.php",
      data: $("#new_preparacion").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text > 0) {
          alert("Actualizado Correctamente!");
          window.history.go(-1);
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#save_pre").on("click", function (e) {
  e.preventDefault();

  if (
    $("#unidad").val().length > 0 &&
    $("#nombre").val().length > 0 &&
    $("#cantidad").val().length > 0
  ) {
    $.ajax({
      url: "ajax/update_preparacion.php",
      data: $("#new_preparacion").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text > 0) {
          alert("Actualizado Correctamente!");
          window.history.go(-1);
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#add_ing").on("click", function (e) {
  e.preventDefault();

  if (
    $("#producto").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#valor").val().length > 0
  ) {
    $.ajax({
      url: "ajax/add_ingrediente.php",
      data: $("#new_ingrediente").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Ingrediente agregado y valor actualizado!");
          $(location).prop(
            "href",
            "new_preparacion.php?id=" + $("#id_preparacion").val()
          );
        } else {
          alert("Error, intente nuevamente.");
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$(".edit_pre_pro").on("click", function (e) {
  e.preventDefault();

  $(location).prop(
    "href",
    "new_ingrediente.php?ingrediente=" + $(this).attr("id")
  );
});

$(".add_pre_rec").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_receta_pre.php?id=" + $(this).attr("id"));
});

$("#add_pre").on("click", function (e) {
  e.preventDefault();

  if (
    $("#cantidad_pre").val().length > 0 &&
    $("#valor_pre").val().length > 0 &&
    $("#preparacion").val().length > 0
  ) {
    $.ajax({
      url: "ajax/add_ingrediente.php",
      data: $("#new_preparacion_receta").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Preparacion agregada!");
          $(location).prop(
            "href",
            "new_preparacion.php?id=" + $("#id_receta").val()
          );
        } else {
          alert("Error, intente nuevamente.");
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$("#update_ing").on("click", function (e) {
  e.preventDefault();

  if ($("#cantidad").val().length > 0 && $("#valor").val().length > 0) {
    $.ajax({
      url: "ajax/update_ingrediente.php",
      data: $("#new_ingrediente").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Ingrediente y valor actualizados!");
          window.history.go(-1);
        } else {
          alert("Error, intente nuevamente.");
          alert(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

//boton acceder al modulo de generar una compra
$("#new_com").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_compra.php");
});

//Ajax que genera una nueva compra
$("#add_compra").on("click", function (e) {
  e.preventDefault();

  if (
    $("#producto").val().length > 0 &&
    $("#fecha").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#valor").val().length > 0
  ) {
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
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$(".edit_com").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_compra.php?id=" + $(this).attr("id"));
});

$("#btn_update_com").on("click", function (e) {
  e.preventDefault();

  if (
    $("#id").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#precio").val().length > 0
  ) {
    $.ajax({
      url: "ajax/update_compra.php",
      data: $("#new_compra").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Compra Actualizada!");
          $(location).prop("href", "compras.php");
        } else {
          alert("Error, intente nuevamente.");
          console(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
});

$(".delete_com").on("click", function (e) {
  e.preventDefault();

  id = $(this).attr("id");

  if (confirm("Desea borrar la compra con id:" + id + "?")) {
    $.ajax({
      url: "ajax/delete_compra.php",
      data: "id=" + id,
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Compra eliminada y cantidad modificada!");
          $(location).prop("href", "compras.php");
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  }
});

$(".delete_pro").on("click", function (e) {
  e.preventDefault();

  id = $(this).attr("id");
  nombre = $(this).attr("name");

  if (confirm("Desea borrar el producto " + nombre + "?")) {
    $.ajax({
      url: "ajax/delete_producto.php",
      data: "id=" + id,
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          alert("Producto eliminado!");
          $(location).prop("href", "productos.php");
        } else {
          alert("Error, intente nuevamente.");
          console.log(text);
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  }
});

$("#receta").change(function () {
  //poner que tipo de unidad es el producto
  var valor = $("#receta option:selected").attr("valor");
  $("#valor_receta").attr("placeholder", valor);
});

//Actualizar la cantidad para tener en cuenta las unidades, modulo agreagr compras
$("#producto").change(function () {
  //poner que tipo de unidad es el producto
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

  //poner el precio y cantidad anterior de ese producto
  var producto = $("#producto option:selected").val();
  $.ajax({
    url: "ajax/get_data_producto.php",
    data: "id=" + producto,
    type: "GET",
    dataType: "text",
    success: function (text) {
      if (text != 0) {
        //traen los datos en un json y se muestran en los placeholder
        var data = $.parseJSON(text);
        $("#precio").attr("placeholder", data.precio);
        $("#valor").attr("placeholder", data.precio);
        $("#cantidad").attr("placeholder", data.cantidad);
        $("#cantidad").attr("precio", data.valor);
        $("#cantidad").val("");
        $("#valor").val("");
      }
    },
  });
});

$("#preparacion").change(function () {
  //poner que tipo de unidad es el producto
  var unidad = $("#preparacion option:selected").attr("unidad");
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

  //poner el precio y cantidad anterior de ese producto
  var preparacion = $("#preparacion option:selected").val();
  $.ajax({
    url: "ajax/get_data_preparacion.php",
    data: "id=" + preparacion,
    type: "GET",
    dataType: "text",
    success: function (text) {
      if (text != 0) {
        //traen los datos en un json y se muestran en los placeholder
        var data = $.parseJSON(text);
        $("#valor_pre").attr("placeholder", data.valor);
        $("#cantidad_pre").attr("placeholder", data.cantidad);
        $("#cantidad_pre").val("");
        $("#valor_pre").val("");
      } else {
        console.log(text);
      }
    },
  });
});

//Actualizar el valor de manera automatica al cambiar la cantidad
/* $("#cantidad").change(function () {
  var cantidad = parseFloat($(this).val());
  var precio = parseFloat($(this).attr("precio"));
  $("#valor").attr("placeholder", precio);
}); */

//acceder al menudo de generar movimientos, entradas o salidas
$(".new_mov").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_movimiento.php");
});

//Genera un movimiento de entrada o de salida y lo guarda
$("#add_movimiento").on("click", function (e) {
  e.preventDefault();
  if (
    $("#producto").val().length > 0 &&
    $("#fecha").val().length > 0 &&
    $("#cantidad").val().length > 0 &&
    $("#tipo").val().length > 0 &&
    $("#motivo").val().length > 0
  ) {
    $.ajax({
      url: "ajax/verificar_cantidad.php",
      data: $("#new_movimiento").serialize(),
      type: "POST",
      dataType: "text",
      success: function (text) {
        if (text == 1) {
          $.ajax({
            url: "ajax/add_movimiento.php",
            data: $("#new_movimiento").serialize(),
            type: "POST",
            dataType: "text",
            success: function (text) {
              if (text == 1) {
                alert("Movimiento generado y producto actualizado!");
                $(location).prop("href", "movimientos.php");
              } else {
                alert("Error, intente nuevamente.");
                console(text);
              }
            },
            error: function (xhr, status, errorThrown) {
              alert("Error");
            },
          });
        } else {
          alert(
            "La cantidad de la salida " +
              $("#cantidad").val() +
              " no puede ser mayor a " +
              text
          );
        }
      },
      error: function (xhr, status, errorThrown) {
        alert("Error");
      },
    });
  } else {
    alert("Llena todos los campos.");
  }
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
      '<input type="text" style="width:80%; padding: 5px;border-radius: 5px;border:.5px solid grey;" placeholder="Buscar..."/>'
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

  total = 0;
  $(".historial tbody tr").each(function (i) {
    cantidad = parseFloat($(this).find(".cantidad").html());
    total = total + cantidad;
  });
  $("#inventario").val(total);
});

$(".historial").click(function (e) {
  e.preventDefault();
  total = 0;

  $(".historial tbody tr").each(function (i) {
    cantidad = parseFloat($(this).find(".cantidad").html());
    total = total + cantidad;
  });
  $("#inventario").val(total);
});

$(".refresh").click(function (e) {
  e.preventDefault();
  total = 0;

  $(".historial tbody tr").each(function (i) {
    cantidad = parseFloat($(this).find(".cantidad").html());
    total = total + cantidad;
  });
  $("#inventario").val(total);
});

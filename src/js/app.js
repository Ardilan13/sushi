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
    $("#cantidad").val().length > 0
  ) {
    if ($("#cantidad_pro_1").val() <= $("#test").val()) {
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
      alert("La cantidad a usar no pued ser mayor a la cantidad existente.");
    }
  } else {
    alert("Llena todos los campos.");
  }
});

$("#update_produccion").on("click", function (e) {
  e.preventDefault();

  if (
    $("#producto").val().length > 0 &&
    $("#cantidad_pro_2").val().length > 0
  ) {
    if ($("#cantidad_pro_2").val() <= $("#test1").val()) {
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
      alert("La cantidad a usar no pued ser mayor a la cantidad existente.");
    }
  } else {
    alert("Llena todos los campos.");
  }
});

$(".new_pre").on("click", function (e) {
  e.preventDefault();

  $(location).prop("href", "new_preparacion.php");
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
          alert("Preparacion Creada!");
          $(location).prop("href", "preparaciones.php");
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
        if (text == 1) {
          alert("Preparacion actualizada!");
          $(location).prop("href", "preparaciones.php");
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
          $(location).prop("href", "preparaciones.php");
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
          $(location).prop("href", "preparaciones.php");
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
          $(location).prop("href", "preparaciones.php");
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
    $("#cantidad").val().length > 0 &&
    $("#precio").val().length > 0
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
$("#cantidad").change(function () {
  var cantidad = parseFloat($(this).val());
  var precio = parseFloat($(this).attr("precio"));
  var valor = cantidad * precio;
  $("#valor").val(valor);
});

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
});

$(function() {
    $("#registros").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                firts: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
            search: 'Buscar: ',
            lengthMenu: "Mostrar _MENU_ Entradas ",
            infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
        }
    });

    $('#crear_registro_admin').attr('disabled', true);

    $('#repetir_password').on('input', function() {
        var password_nuevo = $('#password').val();
        if ($(this).val() == password_nuevo) {
            $('#resultado_password').text('Passwords iguales');
            $('#resultado_password').parent('.form-group').addClass('has-success').removeClass('has-error');
            $('input#password').parent('.form-group').addClass('has-success').removeClass('has-error');
            $('#crear_registro_admin').attr('disabled', false);
        } else {
            $('#resultado_password').text('Los passwords no son iguales!');
            $('#resultado_password').parent('.form-group').addClass('has-error').removeClass('has-success');
            $('input#password').parent('.form-group').addClass('has-error').removeClass('has-success');
        }
    });

    // validaciones

    function filterFloat(evt, input) {
        // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempValue = input.value + chark;
        if (key >= 48 && key <= 57) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            if (key == 8 || key == 13 || key == 0) {
                return true;
            } else if (key == 46) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    function filter(__val__) {
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if (preg.test(__val__) === true) {
            return true;
        } else {
            return false;
        }

    }
    // Validar input tipo date
    $(".anio").focusout(function() {
        s = $(this).val();
        var bits = s.split('/');
        var d = new Date(bits[2] + '/' + bits[0] + '/' + bits[1]);
        alert(d);
    });

    /* $('#crear_registro').click(function() {
        $("#guardar-registro-archivo").validate(); // This is not working and is not validating the form
    }); */


    //Date range picker

    $('#fecha').datetimepicker({
        format: 'L',
        locale: 'es'
    });

    //Initialize Select2 Elements
    $('.seleccionar').select2();


    // DESTALLE-PROYECTO
    $("#myBtn").click(function() {
        $("#exampleModal").modal("hide");
    });

    // Supero presupuesto total vs presupuesto invertido
    $("#boton01").click(function() {
        var proyecto_id = $("#proyecto_id").val();
        var presupuesto_inversion = $("#presupuesto_inversion").text();
        var presupuesto_total = $("#presupuesto_total").text();
        if (parseInt(presupuesto_inversion) < parseInt(presupuesto_total)) {

            setTimeout(function() {
                window.location.href = `crear-cuenta.php?id=${parseInt(proyecto_id)}`;

            }, 500);

        } else {

            Swal.fire({
                title: 'Supera el presupuesto',
                text: "No se puede registrar más inversiones!",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })

        }
    });

    // Clic Guardar cambios

    $('#boton01').click(function() {
        var detalle_cerrado = $('#detalle-cerrado').text();
        console.log(detalle_cerrado);
        if (detalle_cerrado == "Cerrado") {
            $('#boton01').attr("disabled", true);
        } else {
            $('#boton01').attr("disabled", false);
        }
    });

    // Valor año del listado por estado y año

    $('#Cabecera_1').datetimepicker({
        viewMode: 'years',
        format: 'YYYY',
        onClose: function(theDate) {
            $('#valor-query').text = theDate;
        }
    });



    function crearCookie(nombre, valor, dias) {
        var expira;
        if (dias) {
            var date = new Date();
            date.setTime(date.getTime() + (dias * 24 * 60 * 60 * 1000));
            expira = "; expires=" + date.toGMTString();
        } else {
            expira = "";
        }
        document.cookie = escape(nombre) + "=" + escape(valor) + expira + "; path=/";
    }


    // Envio de parametro a url
    $('#valor-query').on('input', function() {
            var query = parseInt($(this).val());

            if (location.search.indexOf('q=') < 0) {

                crearCookie("query", query, 2);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }


        }

    );

    $('#presupuesto').on('input', function() {
        var presu = $("#presu").text();
        var presuTotal = $('#presuTotal').text();
        /* console.log(presu);
        console.log(presuTotal); */

        if (parseInt(presuTotal) < parseInt(presu)) {
            var resto = parseInt(presu) - parseInt(presuTotal);
            $('#resultado_resto').text('La inversión puede ser menor o igual a: $ ' + resto);
            $('#presupuesto').on('input', function() {
                var input = $('#presupuesto').val();
                if (input > resto) {
                    $('#guardar-presu').attr("disabled", true);
                } else {
                    $('#guardar-presu').attr("disabled", false);
                }
            })
        } else {
            $('#presupuesto').attr('disabled', true);
            $('#guardar-presu').attr("disabled", true);
            Swal.fire({
                title: 'Supera el presupuesto',
                text: "No se puede registrar una inversión!",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    });


    // Validacion fecha anterior

    $('#input-fecha').on('input', function() {

        var input_fecha = new Date($("#input-fecha").val());
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };


        if (input_fecha < fecha_actual) {

            /* console.log('no se puede ingresar lla fecha'); */
            $('#guardar-presu').attr("disabled", true);
            $('#mensaje').text('No puede registrar inversiones posteriores a la fecha: ' + fecha_actual.toLocaleDateString("es-Ec", options));
            $('#mensaje').show();
            return false;

        }
        if (input_fecha == fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;
        }


        if (input_fecha > fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;

        }

    });

    $('#cuenta-div').hide();

    $('#estado').on('change', function() {

        var estado = $("#estado option:selected").text();
        /* Elimino todos los espacios en blanco que tenga la cadena delante y detrás */
        var value_without_space = $.trim(estado);


        /*         console.log(value_without_space);
                console.log(tipo); */
        if (value_without_space == 'Análisis' || value_without_space == 'Entrega') {
            /*  console.log('esconder div'); */
            $('#cuenta-div').hide();
        } else {
            $('#cuenta-div').show();

            var tipo = $('#crear_registro').text();
            var input_cuenta = $('#cuenta').val();
            console.log(input_cuenta);

            if (tipo == "Añadir") {
                console.log(tipo);
                $('#cuenta').val('');
            } else if (input_cuenta == 0) {

                console.log(input_cuenta);
                $('#cuenta').val('');
                $('#cuenta').removeAttr('disabled');

            } else {

                $('#cuenta').attr('readonly', true);

            }

        }
    });

    $('#lista').click(() => {
        $('#lista').attr('href', 'admin-area.php');
    });
    $('#back').click(() => {
        window.history.back();
    });

});
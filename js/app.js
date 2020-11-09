$(function () {
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

    $('#repetir_password').on('input', function () {
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

    $('#presupuesto_inicial').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#presupuesto').keyup(function () {
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });


    // Validar input tipo date
    $(".anio").focusout(function () {
        s = $(this).val();
        var bits = s.split('/');
        var d = new Date(bits[2] + '/' + bits[0] + '/' + bits[1]);
        alert(d);
    });

    $('#crear_registro').click(function () {
        $("#guardar-registro-archivo").validate(); // This is not working and is not validating the form
    });


    //Date range picker
    $('#fecha').datetimepicker({
        format: 'L'
    });

    //Initialize Select2 Elements
    $('.seleccionar').select2();

   
    // DESTALLE-PROYECTO
 $("#myBtn").click(function () {
        $("#exampleModal").modal("hide");
    });

    // Supero presupuesto total vs presupuesto invertido
    $("#boton01").click(function () {
        var proyecto_id = $("#proyecto_id").val();
        var presupuesto_inversion = $("#presupuesto_inversion").text();
        var presupuesto_total = $("#presupuesto_total").text();
        if (parseInt(presupuesto_inversion) < parseInt(presupuesto_total)) {

            setTimeout(function () {
                window.location.href = `crear-cuenta.php?id=${parseInt(proyecto_id)}`;

            }, 500);

        } else {

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

        }
    });

    // Clic Guardar cambios

   /*  $('#detalle-cerrado').click(function(){
        var detalle_cerrado = $('#detalle-cerrado').val();
        console.log(detalle_cerrado);
        if (detalle_cerrado == "Cerrado") {
            $('#boton01').attr("disabled", true);
        } else {
            $('#boton01').attr("disabled", false);
        } 
    });
 */
    // Valor año del listado por estado y año

    $('#Cabecera_1').datetimepicker({
        viewMode: 'years',
        format: 'YYYY',
        onClose: function (theDate) {
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
    $('#valor-query').on('input', function () {
        var query = parseInt($(this).val());

        if (location.search.indexOf('q=') < 0) {

            crearCookie("query", query, 2);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }


    }

    );

    $('#presupuesto').on('input', function(){
        var presu = $("#presu").text();
        var presuTotal = $('#presuTotal').text();
        /* console.log(presu);
        console.log(presuTotal); */

        if(parseInt(presuTotal) < parseInt(presu)){
            var resto =parseInt(presu)- parseInt(presuTotal);
            $('#resultado_resto').text('La inversión puede ser menor o igual a: $ '+ resto);
            $('#presupuesto').on('input', function(){
               var input = $('#presupuesto').val(); 
            if (input > resto) {
                $('#guardar-presu').attr("disabled", true);
            } else {
                $('#guardar-presu').attr("disabled", false);
            }
        })
        }else{
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

});
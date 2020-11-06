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

    $('#presupuesto_inicial').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#presupuesto').keyup(function() {
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

    // Validar input tipo date
    $(".anio").focusout(function() {
        s = $(this).val();
        var bits = s.split('/');
        var d = new Date(bits[2] + '/' + bits[0] + '/' + bits[1]);
        alert(d);
    });

    $('#crear_registro').click(function() {
        $("#guardar-registro-archivo").validate(); // This is not working and is not validating the form
    });


    //Date range picker
    $('#fecha').datetimepicker({
        format: 'L'
    });

    //Initialize Select2 Elements
    $('.seleccionar').select2();

    //Supera el Presupuesto asignado
   /*  $('#supera').on('input', function() {
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
    }); */

});
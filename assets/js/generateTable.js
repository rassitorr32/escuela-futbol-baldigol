function generateTable(idTable, tituloReporte) {
  console.log(idTable);
  const table = $("#" + idTable);
  table.DataTable({
    "lengthChange": false,
    "autoWidth": true,
    "scrollX": false,
    "pageLength": 10,

    "buttons": (idTable=='tableTurno'||idTable=='tableArea'||idTable=='tableComplejo'||idTable=='tableCargo'||idTable=='tableRol'||idTable=='tableCategoria')?false:[
      { extend: "excel", className: "btn btn-success", text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>', title: tituloReporte },
      { extend: "pdf", className: "btn btn-danger", text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>', title: tituloReporte },
      { extend: "print", className: "btn btn-primary", text: '<i class="fa fa-print" aria-hidden="true"></i>', title: tituloReporte, exportOptions: { columns: ':not(:last-child)' } },//ocutar la ultima columna para sacar el reporte
      {
        extend: "colvis", className: "btn btn-secondary", text: "Ver"
      }
    ],
    "searching": (idTable=='tableTurno'||idTable=='tableArea'||idTable=='tableComplejo'||idTable=='tableCargo'||idTable=='tableRol'||idTable=='tableCategoria')?false:true,
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No se encontraron resultados",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
      "infoEmpty": "Mostrando 0 a 0 de 0 registros",
      "infoFiltered": "(filtrados de _MAX_ registros totales)",
      "search": "<label class=\"text-muted\">Buscar:</label>",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    
  }).buttons().container().appendTo("#" + idTable + "_wrapper .col-md-6:eq(0)");

  // Eliminar bordes de los botones con clases Bootstrap dentro del contenedor del DataTable
  $("#" + idTable + "_Tablewrapper .btn.btn-primary, #" + idTable + "wrapper .btn.btn-success, #" + idTable + "_Tablewrapper .btn.btn-warning, #" + idTable + "wrapper .btn.btn-danger, #" + idTable + "_Tablewrapper .btn.btn-info, #" + idTable + "_Tablewrapper .btn.btn-secondary").css("border", "none");

  const minEl = document.querySelector("#minDateTable");
  const maxEl = document.querySelector("#maxDateTable");

  if (minEl != null && maxEl != null) {
    // Custom range filtering function
    $.fn.dataTable.ext.search.push(
      function (settings, data, dataIndex) {
        var minDate = new Date(minEl.value);
        var maxDate = new Date(maxEl.value);
        var rowData = data[9]; // Suponiendo que la columna 5 contiene la fecha en formato YYYY-MM-DD

        var currentDate = new Date(rowData);

        if ((isNaN(minDate.getTime()) && isNaN(maxDate.getTime())) ||
          (isNaN(minDate.getTime()) && currentDate <= maxDate) ||
          (minDate <= currentDate && isNaN(maxDate.getTime())) ||
          (minDate <= currentDate && currentDate <= maxDate)) {
          return true;
        }

        return false;
      }
    );

    // Cambios en los campos de entrada de fecha dispararán un redraw para actualizar la tabla
    minEl.addEventListener("input", function () {
      $("#" + idTable).DataTable().draw();
    });

    maxEl.addEventListener("input", function () {
      $("#" + idTable).DataTable().draw();
    });
  }
}

    <hr class="hr-footer">
    <div class="footer">
        <footer class="text-center">&copy; <?=date("Y")?> <?=$config->title?> <i class="fas fa-heart"></i></footer>
    </div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
            function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
              try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
              } catch (e) {
                console.log(e)
              }
            }
            
            $('#tabeldata').DataTable({
                "lengthChange": true,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                    };

                    // Total over all pages
                    total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Total over this page
                    pageTotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        'Pendapatan berdasarkan Filter : Rp. '+formatMoney(pageTotal)+' | Total Pendapatan : Rp.'+ formatMoney(total) + ''
                        );
                },
                "lengthMenu": [[5, 10, 25, 50, 100, 200, 500], [5, 10, 25, 50, 100, 200, 500]]
            });
		});
    </script>
  </body>
</html>
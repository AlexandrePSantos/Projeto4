    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>GESImoveis</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

        <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-select/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-datepicker/datepicker3.css') }}">
        <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-toggle/bootstrap-toggle.min.css') }}">
        <style type="text/css">
            /* Fix Charts Tooltip Flickering on hover*/
            svg > g > g:last-child { pointer-events: none }
            #tableFaturacaoWrapper .pam { padding-left: 5px !important; padding-right: 5px !important; }
            #tableFaturacaoWrapper .colpaddingspecial { padding-left: 10px !important; padding-right: 10px !important; }
            #tableFaturacaoWrapper .h4special { font-size: 17px !important; }
            .historyFilterWrapper .select2-container, .historyFilterWrapper.select2-container--default { display: inline-block; width: 50% !important; /*margin-left: 5% !important;*/ }
            /*.historyFilterWrapper .historyFilterCls { display: inline-block; width: 50% !important;  }*/
            .historyFilterWrapper .historyFilterBtn { display: inline-block; width: 40% !important; max-width: 40% !important; }
            .historyFilterWrapper { padding-left: 0; }
            .seriesFilterWrapper { display: flex; justify-content: end; padding-right: 0px; }
        </style>
        <!-- //ADDED CSS -->

    <link rel="shortcut icon" href="{{ asset('uploads/favicon.png') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    </head>
    <body>
        <div class="main-wrapper">

            <div class="page-wrapper">

                <!-- partial:partials/_navbar.html -->
                @include('admin.body.header')
                <!-- partial -->

                <!-- partial:partials/index.html -->
                @yield('admin')
                <!-- partial -->

                <!-- partial:partials/_footer.html -->
                @include('admin.body.footer')
                <!-- partial -->

            </div>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script src="{{ asset('js/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/vendors/bootstrap-select/defaults-pt_BR.min.js') }}"></script>

        <script src="{{ asset('js/vendors/DataTables/media/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('js/vendors/DataTables/media/js/dataTables.bootstrap.js') }}"></script>

        <script src="{{ asset('js/vendors/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('js/vendors/bootstrap-datepicker/bootstrap-datepicker.pt.js') }}"></script>
        <script src="{{ asset('js/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
        <script src="{{ asset('js/fnReload.js') }}"></script>

        <script src="{{ asset('js/jquery.showmore.js') }}"></script>
        <script src="{{ asset('js/autoNumeric.js') }}"></script>
        <script src="{{ asset('js/vendors/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
            @endif
        </script>

        <script type="text/javascript">
            table = null;
            /** |------------------- Ajax Calls ------------------| */
            function getDataJSON(graphID, callbackFunc){
                // $(".fullscreen").show();

                var graphFile='';
                //process graphID
                switch(graphID){
                    case 5: graphFile="variacao.php"; break;
                    case 6: graphFile="variacao_compras.php"; break;
                    case 7: graphFile="variacao_imposto.php"; break;
                    case 8: graphFile="centros_custo.php"; break;
                    case 9: graphFile="centros_custo_compras.php"; break;

                    default: graphFile=""; break;
                }

                //ajax
                var jsonData;
                if(graphFile != ''){
                    //async ajax
                    jsonData = $.ajax({
                        url : "/gesfaturacao/server/graficos/"+graphFile,
                        type : "POST",
                        global : false,
                        data : {
                            filterYear : $("#history_year").val(),
                            filterTypeGraph : typeGraphToggle,
                            filterSerie: $("#history_serie").val(),
                        },
                        dataType : "json",
                        async : true,
                        success : function(resposta){
                            return callbackFunc(resposta);
                        }
                    });
                }else{
                    jsonData = null;
                }
                // var myObject = JSON.parse(jsonData);

                //return the data
                // return myObject;
                return true;
            }

            /** |--------------- Graphics Funcions ---------------| */

            //variacao anual
            function getGraphVariacao(){
                var wrapperMain = $('#graphicWrapperTitle1');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Variação Anual da Facturação</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    width : '100%',
                    height : 300,
                    // colors: ['#1976D2', '#E53935', '#FF9900'],
                    sliceVisibilityThreshold:0,
                    // is3D: true,
                    legend: { position: "none" },
                };

                //get the data from json
                var jsonData = getDataJSON(1);

                //process graph1 - Bars
                var data = new google.visualization.arrayToDataTable(jsonData);

                // Instantiate and draw the chart.
                var chart = new google.visualization.ColumnChart(document.getElementById('graphicWrapper1'));
                chart.draw(data, options);
            }

            //faturacao
            function fill_faturacao(){
                // console.log("fill_faturacao", new Date().getTime());
                // $(".fullscreen").show();

                var htmlCode = '';
                    htmlCode += '<div class="row mtxl mbxl">';
                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-hoje" class="money text-green mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'Faturado Hoje';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';

                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-mes" class="money text-blue mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'Faturado Mês';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';

                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-ano" class="money text-info mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'Faturado Ano';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';



                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-iva-anterior" class="money text-green mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'IVA Mês Anterior';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';

                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-iva-atual" class="money text-blue mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'IVA Mês Atual';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';

                        htmlCode += '<div class="col-xs-12 col-md-2 mtm colpaddingspecial">';
                            htmlCode += '<a>';
                                htmlCode += '<div class="portlet box color portlet-gesautarquia">';
                                    htmlCode += '<div class="pam">';
                                        htmlCode += '<i class="fa fa-eur fa-4x flt-left"></i>';
                                        htmlCode += '<div class="text-right">';
                                            htmlCode += '<h4 class="man mts h4special">';
                                                htmlCode += '<span id="valor-iva-ano" class="money text-info mtl font500">0</span>';
                                            htmlCode += '</h4>';
                                        htmlCode += '</div>';
                                        htmlCode += '<div class="text-right mts">';
                                            htmlCode += 'IVA Anual';
                                        htmlCode += '</div>';
                                    htmlCode += '</div>';
                                htmlCode += '</div>';
                            htmlCode += '</a>';
                        htmlCode += '</div>';
                    htmlCode += '</div>';

                $('#tableFaturacaoWrapper').append(htmlCode);

                //init elements
                $(".money").autoNumeric("init", {
                    aSep : '.',
                    aDec : ',',
                    aSign : ' €',
                    pSign : 's'
                });

                $.ajax({
                    type : 'POST',
                    url : '/gesfaturacao/server/graficos/faturacao.php',
                    global : false,
                    dataType : 'json',
                    async : true,
                    data : { filterYear : $("#history_year").val(), filterTypeGraph : typeGraphToggle, },
                    success : function(resposta) {
                        var resp = resposta;
                        if (resposta)
                            if (!resposta.errors) {
                                $('#valor-hoje').autoNumeric('set', resposta['Hoje']);
                                $('#valor-mes').autoNumeric('set', resposta['Mes']);
                                $('#valor-ano').autoNumeric('set', resposta['Ano']);
                                $('#valor-iva-anterior').autoNumeric('set', resposta['IAnterior']);
                                $('#valor-iva-atual').autoNumeric('set', resposta['IAtual']);
                                $('#valor-iva-ano').autoNumeric('set', resposta['IAnual']);
                            }
                    },
                    complete : function(){
                    }
                });
            }

            //Faturacao faturas
            function getGraphFaturacaoFat(){
                // $(".fullscreen").show();

                var wrapperMain = $('#graphicWrapperTitle5');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Variação Anual de Faturação</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    width : '100%',
                    height : 300,
                    colors: ['#4285F4', '#1D975A'],
                    sliceVisibilityThreshold:0,
                    // hAxis: {
                    // }
                    // is3D: true,
                    legend: { textStyle: { fontSize : 12 }, },
                    vAxis: { format: '###,###,###,###.## €' },
                    pointSize: 8,
                };

                //get the data from json
                var jsonData = getDataJSON(5, function(jsonDataRec){
                    //process graph1 - Bars
                    var data = new google.visualization.arrayToDataTable(jsonDataRec);

                    var formatter = new google.visualization.NumberFormat({decimalSymbol: ',',groupingSymbol: '.', negativeColor: 'red', negativeParens: false, prefix: ' '});
                    formatter.format(data, 1);
                    formatter.format(data, 2);

                    // Instantiate and draw the chart.
                    if( typeGraphToggle!=undefined && typeGraphToggle == true){
                        var chart = new google.visualization.ColumnChart(document.getElementById('graphicWrapper5'));
                        chart.draw(data, options);
                    }else{
                        var chart = new google.visualization.AreaChart(document.getElementById('graphicWrapper5'));
                        chart.draw(data, options);
                    }
                });

                $(".fullscreen").fadeOut();
            }

            //Faturacao compras
            function getGraphFaturacaoComp(){
                // $(".fullscreen").show();

                var wrapperMain = $('#graphicWrapperTitle6');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Variação Anual de Compras</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    width : '100%',
                    height : 300,
                    colors: ['#C84334', '#1D975A'],
                    sliceVisibilityThreshold:0,
                    // is3D: true,
                    legend: { textStyle: { fontSize : 12 }, },
                    vAxis: { format: '###,###,###,###.## €' },
                    pointSize: 8,
                };

                //get the data from json
                var jsonData = getDataJSON(6, function(jsonDataRec){
                    //process graph1 - Bars
                    var data = new google.visualization.arrayToDataTable(jsonDataRec);

                    var formatter = new google.visualization.NumberFormat({decimalSymbol: ',',groupingSymbol: '.', negativeColor: 'red', negativeParens: false, prefix: ' '});
                    formatter.format(data, 1);
                    formatter.format(data, 2);

                    // Instantiate and draw the chart.
                    if( typeGraphToggle!=undefined && typeGraphToggle == true){
                        var chart = new google.visualization.ColumnChart(document.getElementById('graphicWrapper6'));
                        chart.draw(data, options);
                    }else{
                        var chart = new google.visualization.AreaChart(document.getElementById('graphicWrapper6'));
                        chart.draw(data, options);
                    }
                });

                $(".fullscreen").fadeOut();
            }

            //Faturacao faturas
            function getGraphFaturacaoImp(){
                var wrapperMain = $('#graphicWrapperTitle7');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Variação Anual de Impostos</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    width : '100%',
                    height : 300,
                    colors: ['#4285F4', '#C84334', '#1D975A'],
                    sliceVisibilityThreshold:0,
                    // hAxis: {
                    // }
                    // is3D: true,
                    legend: { textStyle: { fontSize : 12 }, },
                    vAxis: { format: '###,###,###,###.## €' },
                };

                //get the data from json
                var jsonData = getDataJSON(7);

                //process graph1 - Bars
                var data = new google.visualization.arrayToDataTable(jsonData);

                var formatter = new google.visualization.NumberFormat({decimalSymbol: ',',groupingSymbol: '.', negativeColor: 'red', negativeParens: false, prefix: ' '});
                formatter.format(data, 1);
                formatter.format(data, 2);

                // Instantiate and draw the chart.
                var chart = new google.visualization.ColumnChart(document.getElementById('graphicWrapper7'));
                chart.draw(data, options);
            }

            //Faturacao centros custo
            function getGraphFaturacaoCentCusto(){
                var wrapperMain = $('#graphicWrapperTitle8');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Centros de Custo Vendas</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    // width : '100%',
                    height : 300,
                    colors: ['#4285F4', '#C84334', '#1D975A'],
                    sliceVisibilityThreshold:0,
                    // hAxis: {
                    // }
                    // is3D: true,
                    legend: { textStyle: { fontSize : 12 }, },
                    // vAxis: { format: '###,###,###,###.## €' },
                };

                //get the data from json
                var jsonData = getDataJSON(8);

                //process graph1 - Bars
                var data = new google.visualization.arrayToDataTable(jsonData);

                var formatter = new google.visualization.NumberFormat({decimalSymbol: ',',groupingSymbol: '.', negativeColor: 'red', negativeParens: false, prefix: ' '});
                formatter.format(data, 1);

                // Instantiate and draw the chart.
                var chart = new google.visualization.PieChart(document.getElementById('graphicWrapper8'));
                chart.draw(data, options);
            }

            //Faturacao centros custo compras
            function getGraphFaturacaoCentCustoComp(){
                var wrapperMain = $('#graphicWrapperTitle9');

                var htmlContent = '<h4><i class="fa fa-bar-chart"></i>&nbsp;Centros de Custo Compras</h4><br>';
                // htmlContent += '<div id="graphWrapper1"></div>';

                wrapperMain.html(htmlContent);

                var options = {
                    // width : '100%',
                    height : 300,
                    colors: ['#4285F4', '#C84334', '#1D975A'],
                    sliceVisibilityThreshold:0,
                    // hAxis: {
                    // }
                    // is3D: true,
                    legend: { textStyle: { fontSize : 12 }, },
                    // vAxis: { format: '###,###,###,###.## €' },
                };

                //get the data from json
                var jsonData = getDataJSON(9);

                //process graph1 - Bars
                var data = new google.visualization.arrayToDataTable(jsonData);

                var formatter = new google.visualization.NumberFormat({decimalSymbol: ',',groupingSymbol: '.', negativeColor: 'red', negativeParens: false, prefix: ' '});
                formatter.format(data, 1);

                // Instantiate and draw the chart.
                var chart = new google.visualization.PieChart(document.getElementById('graphicWrapper9'));
                chart.draw(data, options);
            }

            //init listeners
            function initCheckboxListener(){
                /* ------------------- LISTNERS ------------------ */
                $(document).on('ifChanged', 'input#global_checkbox', function(event) {
                    if( $('input#global_checkbox').is(":checked") ) {
                        //put all checkbox checked
                        $(".row_checkbox").each(function(key, value) {
                            $(this).iCheck('check');
                        });
                    }
                    else {
                        //put all checkbox unchecked
                        $(".row_checkbox").each(function(key, value) {
                            $(this).iCheck('uncheck');
                        });
                    }
                });
                /* ----------------------------------------------- */
            }

            //init icheck
            function init_iCheck(){
                /* INPUT RADIO */
                $('input:radio').removeAttr("checked");
                $(".default_radio").attr("checked", true);
                $('input[type=radio]').iCheck({
                    radioClass : 'iradio_square-orange',
                    increaseArea : '20%' // optional
                });

                /* INPUT CHECKBOX */
                $('input.global_checkbox').removeAttr("checked");
                $(".default_checked").attr("checked", true);
                $('input.global_checkbox').iCheck({
                    checkboxClass : 'icheckbox_flat-orange',
                    increaseArea : '20%' // optional
                });

                /* INPUT CHECKBOX ROWS */
                $('input.row_checkbox').removeAttr("checked");
                $(".default_checked").attr("checked", true);
                $('input.row_checkbox').iCheck({
                    checkboxClass : 'icheckbox_flat-orange',
                    increaseArea : '20%' // optional
                });
            }
        </script>

    </body>
    </html>

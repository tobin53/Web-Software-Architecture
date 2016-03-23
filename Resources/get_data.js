/**
 *
 *  Author: H. James de St. Germain
 *  Date:   Spring 2016
 *
 *  Make an AJAX request for data using the new jquery:
 *
 *    done and fail and always
 *
 *  deferred function syntax
 *
 */

//
//
//

function find_data(  )
{

    $.ajax(
        {
            type:'POST',
            //url:  $("input[name=cause_error]").is(':checked') ? "asdf" : "get_data.php",
            url: "../../../../Resources/get_data.php",
            data: $('#form_id').serialize(),
            dataType: "text",  		      // The type of data that is getting returned.

            success: function(response)
            {
                // note: this function should be removed and use only the done function below
                console.log("success function");
            },

            /**
             * What to do before the ajax request is sent. Perhaps gather
             * page information, prep form, etc.
             */
            beforeSend: function()
            {
                //var check_box = $("input[name=before_send]");
                //
                //if (check_box.is(':checked'))
                //{
                //    alert ( "prepping AJAX call with data: " + $('#form_id').serialize() );
                //}

            },

        })
        .done( function ( data )
        {
            //console.log("done function")
            //var check_box = $("input[name=on_success]");
            //
            ///**
            // * What to do when the data is successfully retreived
            // */
            //if (check_box.is(':checked'))
            //{
            //    alert ( "Data Rerturned Successfully!" );
            //}

           // var jContent = $( "#content" ); // put data here


            //$("#content").html(data);
           // $("#content").find("script").each(function(i) {
             //   eval($(this).text());

               // jContent.script(data);

           // jContent.html( data );

            data_series[0].data.push(data);




        } )
        .fail( function ( text, options, err )
        {
            /**
             * What to do if there is an error
             *
             */
            // something went wrong
            var jContent = $( "#content" );
            //jContent.html( "<h2>Error - Only a programmer can fix this!! </h3>"  );
            jContent.html(text + "   " + options +"   " + err);
            console.log('Jim, error message: ' + text );
            console.log('Jim, error message: ' + options );
            console.log('Jim, error message: ' + err);
        } )
        .always( function ( )
        {
            /**
             * What to do no matter what
             *
             */
            console.log('Jim, cleaning up');
        } );

    // if this
    // disable a page submit
    //return false;
}

$(document).ready(function () {
    ajaxcall();
    setInterval(ajaxcall, 60000);

    $('#linechart').highcharts({
        chart: {type: 'column'},
        title: {
            text: 'GPAs',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: Jim',
            x: -20
        },
        xAxis: {
            title: 'credit_hours',
        },
        yAxis: {
            min: 0, max: 4,
            title: {
                text: 'GPA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{"name": "GPAS", "data": data_series}]
    });
});


    //$(document).ready(function() {
    //    $('#columnchart').highcharts({
    //        chart: {type: 'column'},
    //        title: {
    //            text: 'GPAs',
    //            x: -20 //center
    //        },
    //        subtitle: {
    //            text: 'Source: Jim',
    //            x: -20
    //        },
    //        xAxis: {
    //            title: 'credit_hours',
    //        },
    //        yAxis: {
    //            min: 0, max: 4,
    //            title: {
    //                text: 'GPA'
    //            },
    //            plotLines: [{
    //                value: 0,
    //                width: 1,
    //                color: '#808080'
    //            }]
    //        },
    //        legend: {
    //            layout: 'vertical',
    //            align: 'right',
    //            verticalAlign: 'middle',
    //            borderWidth: 0
    //        },
    //        series: [data]
    //    });
    //});




//<html>
//<head>
//<title>Metrics info</title>
//<script type="text/javascript"
//src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
//    </script>
//    <script src="http://code.highcharts.com/highcharts.js"></script>
//
//    <script type="text/javascript">
//    $(function () {
//
//        var data = {
//        };
//
//        var v_series = [{
//            data: []
//        }], v_categories = [];
//
//        function ajaxcall() {
//            $.ajax({
//                url: "http://localhost:8080/metricgraph/helloWorld.do",
//                type: "GET",
//                async: false,
//                dataType: 'text',
//                success: function (response) {
//                    var arr = response.split("|");
//
//                    for (i = 0; i < arr.length; i++) {
//                        var temp = arr[i].split(",");
//                        data[temp[0]] = Number(temp[1]);
//                    }
//
//                    for(var category in data) {
//                        var points = data[category];
//                        v_categories.push(category);
//                        v_series[0].data.push(points);
//                    }
//                }
//            });
//        }
//
//        $(document).ready(function () {
//            ajaxcall();
//            setInterval(ajaxcall,60000);
//
//            $('#container').highcharts({
//                chart: {
//                    type: 'spline',
//                    animation: Highcharts.svg,
//                    marginRight: 10,
//                },
//                title: {
//                    text: 'Live metrics data'
//                },
//                xAxis: {
//                    title: {
//                        text: 'Time'
//                    },
//                    categories: v_categories,
//                    tickPixelInterval: 150
//                },
//                yAxis: {
//                    title: {
//                        text: 'Value'
//                    },
//                    min:0,
//                    tickInterval: 10,
//                    plotLines: [{
//                        value: 0,
//                        width: 1,
//                        color: '#808080'
//                    }]
//                },
//                tooltip: {
//                    formatter: function () {
//                        return '<b>'+'Value: ' + '</b>' + Highcharts.numberFormat(this.y, 2)  + '<br/>' + '<b>' + 'Time: ' + '</b>' + this.x//Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
//                    }
//                },
//                legend: {
//                    enabled: false
//                },
//                series: v_series
//            });
//        });
//    });
//
//</script>
//
//</head>
//<body>
//<div id="container" style="width:100%; height:400px;"></div>
//    </body>
//    </html>
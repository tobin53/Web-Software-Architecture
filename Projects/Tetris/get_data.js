/**
 * Created by Fumiko on 3/31/2016.
 */

function find_data(  )
{
    var score;

    $.ajax(
        {
            type:'POST',
            url: "get_data.php",
            data: $('#nameSubmit').serialize(),
            dataType: "html",  		      // The type of data that is getting returned.

            //success: function(response)
            //{
            //    // note: this function should be removed and use only the done function below
            //    console.log("success function");
            //},

            /**
             * What to do before the ajax request is sent. Perhaps gather
             * page information, prep form, etc.
             */
            beforeSend: function()
            {
                // Determine which form we are dealing with
               // state = $('#state').val();
               // score = document.nameSubmit.myinput.value = '1';

                alert("received score value of " + score + " in AJAX");

                score = document.getElementById("scoreValue").value;

                alert("received score value of " + score + " in AJAX");
            }

        })
        .done( function ( data )
        {
            console.log('TOBIN MADE IT HERE' );

            console.log('DATA is ' + data);

            var jContent = $( "#table" ); // put data here
            jContent.html( data );

        } )
        .fail( function ( text, options, err )
        {
            /**
             * What to do if there is an error
             *
             */
            // something went wrong
            var jContent = $( "#content" );
            jContent.html(text + "   " + options +"   " + err);
            console.log('Tobin, error message: ' + text );
            console.log('Tobin, error message: ' + options );
            console.log('Tobin, error message: ' + err);
        } )
        .always( function ( )
        {
            /**
             * What to do no matter what
             *
             */
            console.log('Tobin, cleaning up');
        } );

    return false;
}


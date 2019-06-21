</div>
    <!-- /#wrapper -->

 

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        //for ck editor 5
        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

        // checkbox
        $('#selectAllBoxes').click(function(event){

            if(this.checked){
                $('.checkBoxes').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkBoxes').each(function(){
                    this.checked = false;
                });
            }
        });
        //---loader
            
        var div_box = "<div id='load-screen'><div id='loading'></div></div>";

        $("body").prepend(div_box);

        $('#load-screen').delay(500).fadeOut(300, function(){
        $(this).remove();
        });

    });
        // ajax code for showing user online
        function loadUsersOnline(){
            $.get("functions.php?onlineusers=result", function(data){

                $(".usersonline").text(data);
            });
        }

        setInterval(function(){

            loadUsersOnline();

        },500);

    </script>
</body>

</html>
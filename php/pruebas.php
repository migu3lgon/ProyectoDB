<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/foundation-icons/foundation-icons.css">
    <script src="../js/vendor/jquery.js"></script>
    <script language='javascript'> 
        /*$.ajax({
                url: "../jsons/cat_json.php",
                dataType: "JSON",
                success: function(json){
                    //here inside json variable you've the json returned by your PHP
                    for(var i=0;i<json.length;i++){
                        //$('#items_container').append(json[i].item_id)
                        alert(json[i].item_id);
                        alert("hola");
                    }
                }
            })*/
    </script>
    
    <script>
    $(document).ready(function(){
        $.ajax({
                type:'POST',
                url:'../jsons/subcat_json.php',
                dataType: "json",
                success:function(data){
                    var $test2 = $('#test2');
                    $test2.empty();
                    for (var i = 0; i < data.length; i++) {
                        $test2.append('<option value='+ data[i][0] + '>'+ data[i][2] +'</option>');   
                    }
                }
            });
    });
    </script>
  <head>  
  <body>
    
    <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>
    <p id="test">test</p>
    <select id='test2'>
    </select>
    <input type='button' id="fun" value="Get External Content">
  </body>
</html>
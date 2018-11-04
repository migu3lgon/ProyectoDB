$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '../jsons/cat_json.php',
        dataType: "json",
        success: function(data) {
            var $cat = $('#cat');
            $cat.empty();
            for (var i = 0; i < data.length; i++) {
                $cat.append("<li><a href=\"cat.php?cat=" + data[i][0] + "\">" + data[i][1] + "</a></li>");
            }
        }
    });
});
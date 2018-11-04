$(document).ready(function() {
    $.ajax({
        url: '../jsons/subcat_json.php',
        dataType: "json",
        success: function(data) {
            var $subc = $('#subc');
            $subc.empty();
            for (var a = 0; a < data['cat'].length; a++) {
                $subc.append('<optgroup label=' + data['cat'][a][1] + '/>')
                for (var i = 0; i < data['subcat'].length; i++) {
                    if (data['cat'][a][0] == data['subcat'][i][1]) {
                        $subc.append('<option value=' + data['subcat'][i][0] + '>' + data['subcat'][i][2] + '</option>');
                    }
                }
            }
        }
    });
    $.ajax({
        url: '../jsons/ubic_json.php',
        dataType: "json",
        success: function(data2) {
            var $ubic = $('#ubic');
            $ubic.empty();
            for (var l = 0; l < data2.length; l++) {
                $ubic.append('<option value=' + data2[l][0] + '>' + data2[l][1] + '</option>');
            }
        }
    });
});
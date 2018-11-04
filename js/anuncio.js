    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '../jsons/anuncio_json.php',
            dataType: "json",
            data: { 'id_add': globalVariable.idadd },
            success: function(data2) {
                var $title = $('#titulo');
                var $desc = $('#descr');
                var $precio = $('#precio');
                var $precio2 = $('#precio2');
                var $mas_info = $('#mas_info');
                var $dat_t = $('#dat_t');
                $title.append(data2[0][0]);
                $desc.append(data2[0][1]);
                $precio.append(data2[0][2]);
                $precio2.append(data2[0][2]);
                $dat_t.append(data2[0][3]);
                $mas_info.append(data2[0][4]);
            }
        });
    });
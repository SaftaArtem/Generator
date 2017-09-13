$(document).ready(function () {
    arr_list = [];
    $(".change_color").click(function() {
        $(this).css('background-color', '#995d3b');
        var val1 = $(this).text();
        arr_list.push(val1);
    });
    gener_arr = [];
    $('#save').click(function() {
        align = $('#align :selected').text();
        valign = $('#valign :selected').text();
        color = $('#color :selected').text();
        bgcolor = $('#bgcolor :selected').text();
        text = $('#vvod').val();
        arr_str = arr_list.join('');
        arr_list = [];
        farr =  {
            text: text,
            cells:arr_str,
            align: align,
            valign: valign,
            color: color,
            bgcolor: bgcolor
        };
        gener_arr.push(farr);
    });
    $('#send').click(function () {
        $.post(
            "test.php",{
            gener_arr:gener_arr
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data)
        {
            // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
            $('label').html(data)
        }


        return false
    })


});
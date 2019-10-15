export const load_data = (url, data) => {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            console.log(response);
        }
    })
}
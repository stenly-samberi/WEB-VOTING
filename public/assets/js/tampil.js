function updateStatus(id, isChecked) {
    var xhr = new XMLHttpRequest();
    var url = '/api/updateStatus'; // Sesuaikan dengan route yang Anda definisikan

    var params = 'id=' + id + '&status=' + (isChecked ? 'true' : 'false');

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(params);
}

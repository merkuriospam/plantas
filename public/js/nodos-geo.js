function error(msg) {
    console.log(msg);
}
function success(position) {
    $('.nodo-lat').val(position.coords.latitude);
    $('.nodo-lng').val(position.coords.longitude);
}

$(document).ready(function() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(success, error);
    } else {
      alert('position not supported');
    }
});
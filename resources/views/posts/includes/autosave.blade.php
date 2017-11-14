function updateTime() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    if (minutes < 10) {
        minutes = '0' + minutes;
    }

    var time_str = hours + ':' + minutes + ' ';

    if (hours > 11) {
        time_str += 'pm';
    } else {
        time_str += 'am';
    }

    $('#saved').text('Autosaved: ' + time_str);
}
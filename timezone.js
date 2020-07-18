$(document).ready(function(){

/*  Returns the number of minutes behind or ahead of the green wich meridian */
var offset = new Date().getTimezoneOffset();
/* Return number of milliseconds since 1970/010/01 */
var timestamp = new Date().getTime();

/* We convert our time to : Universal Time Coordinated / Universal Coordinated Time */
var utc_timestamp = timestamp + (60000 * offset);

$('#time_zone_offset').val(offset);
$('#utc_timestamp').val(utc_timestamp);

})
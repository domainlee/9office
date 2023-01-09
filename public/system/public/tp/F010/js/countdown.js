$(function() {
    var yy = $("#years").attr('yy');
    var mm = $("#months").attr('mm');
    var dd = $("#days").attr('dd');
    var h = $("#hours").attr('h');
    var m = $("#minutes").attr('m');
    var s = $("#seconds").attr('s');
    var time = yy + "-" + mm + "-" + dd + " " + h + ":" + m + ":" + s;
    var dateTime = new Date(time).getTime();
    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = dateTime - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"

        document.getElementById("countdown-days").innerHTML = days + " ngày";
        document.getElementById("countdown-hours").innerHTML = hours + " giờ";
        document.getElementById("countdown-minutes").innerHTML = minutes + " phút";
        document.getElementById("countdown-seconds").innerHTML = seconds + " giây";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown-expired").style.display = "block";
            document.getElementsByClassName("countdown-list")[0].style.display = "none";
            document.getElementById("countdown-expired").innerHTML = "Sự kiện kết thúc";
        }
    }, 1000);
});
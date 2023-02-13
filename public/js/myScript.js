// function that check if the username and password are correct, using ajax and jquery

function checkLogin() {
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "/ajaxlogin",
        data: { username: username, password: password },
        success: function (data) {
            if (data == "true") {
                window.location.href = "/home";
            }
            else {
                $("#error").html("Username or password is incorrect");
            }
        }
    });
}

// clock and date
function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var date = now.getDate();
    var month = now.getMonth() + 1;
    var year = now.getFullYear();
    var clockHours = document.querySelector(".clock-hours");
    var clockMinutes = document.querySelector(".clock-minutes");
    var clockSeconds = document.querySelector(".clock-seconds");
    var clockDate = document.querySelector(".clock-date");
    clockHours.innerHTML = addLeadingZero(hours);
    clockMinutes.innerHTML = addLeadingZero(minutes);
    clockSeconds.innerHTML = addLeadingZero(seconds);
    clockDate.innerHTML = addLeadingZero(date) + "/" + addLeadingZero(month) + "/" + year;
  }
  
  function addLeadingZero(num) {
    return (num < 10 ? "0" : "") + num;
  }
  
  setInterval(updateClock, 1000);
  
  
  
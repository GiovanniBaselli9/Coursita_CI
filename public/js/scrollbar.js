window.addEventListener("scroll", function() {
    var windowHeight = document.body.scrollHeight - window.innerHeight;
    var progress = (window.scrollY / windowHeight) * 100;

    document.getElementById("progress-bar").style.width = progress + "%";
});
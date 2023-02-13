$("#search_type").change(function() {
    if ($(this).val() === "macroarea") {
      $("#macroarea").show();
    } else {
      $("#macroarea").hide();
    }
});
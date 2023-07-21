$(document).ready(() => {
  $(".links h5").slideUp(4000);
  $(".links p:last-child").animate(
    {
      marginLeft: 80,
    },
    1000
  );
});
$("body").on("click", () => {
  $("body").addClass("body");
});

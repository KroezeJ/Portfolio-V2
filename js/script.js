$(document).ready(function () {
    var origTitle, timer;
    var titles = [
      "Portfolio - Justin Kroeze",
      "Stay tuned for updates"
    ];
    var currentTitleIndex = 0;

    function animateTitle() {
      origTitle = document.title;
      timer = setInterval(changeTitle, 2000);

      function changeTitle() {
        currentTitleIndex = (currentTitleIndex + 1) % titles.length;
        document.title = titles[currentTitleIndex];
      }
    }

    function restoreTitle() {
      clearInterval(timer);
      document.title = origTitle;
    }

    $(window).blur(function () {
      animateTitle();
    });

    $(window).focus(function () {
      restoreTitle();
    });
  });
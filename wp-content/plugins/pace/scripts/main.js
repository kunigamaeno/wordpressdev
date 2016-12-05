document.addEventListener("DOMContentLoaded", function() {

  /**
   * Listen for collapse/expand of admin sidebar and adjust iframe width accordingly
   */

  var collapse = document.querySelector("#collapse-menu");

  if (collapse) {
    var resizeDebounce = debounce(function() {
      resizeIframe();
    }, 100);
    collapse.addEventListener("click", resizeIframe);
    window.addEventListener("resize", resizeDebounce);
    // Since admin menu could be collapsed by default, run the resize function on load
    resizeIframe();
  }

});

function resizeIframe() {
  var sidebar = document.querySelector("ul#adminmenu");
  var iframe = document.querySelector(".eager-embedded-iframe");
  if (iframe) {
    iframe.style.width = "calc(100% - " + sidebar.offsetWidth + "px";
  }
};

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};
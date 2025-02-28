jQuery(document).ready(function ($) {
  // Toggle active class on checkbox labels
  $('.custom-checkbox input[type="checkbox"]').on("change", function () {
    $(this).parent("label").toggleClass("active", $(this).is(":checked"));
  });


//   check box jquery 
  $(".wpcf7-list-item-label").on("click", function () {
    var checkbox = $(this).siblings('input[type="checkbox"]');
    checkbox.prop("checked", !checkbox.prop("checked")); // Toggle checkbox state

    // Toggle active class for styling
    $(this).toggleClass("active");
  });

  $('.off-canvas-manu-link ul li a').on("click", function () {
    // $(".ekit-canvas-menu .ekit-wid-con .info-group").removeClass("ekit_isActive");
    $('.ekit-canvas-menu .ekit-wid-con .info-group .ekit-sidebar-widget .ekit_close-side-widget').trigger('click');
  });

  if ($('body').hasClass('page-id-2339')) {
    $('.footer-contact-section').hide();
  }


});
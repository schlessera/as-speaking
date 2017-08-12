/**
 * AlainSchlesser.com Speaking Page Plugin.
 *
 * @package   AlainSchlesser\Speaking
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.alainschlesser.com/
 * @copyright 2017 Alain Schlesser
 */

jQuery(document).ready(function ($) {
  var $talkCPTEventFields = $('#talk-cpt-event-fields');
  var $talkCPTSessionFields = $('#talk-cpt-session-fields');
  var $talkCPTVideoInput = $('#talk-cpt-video-input');
  var $talkCPTSlidesInput = $('#talk-cpt-slides-input');
  var $talkCPTImageLinkSelect = $('#talk-cpt-image-link-select');

  /**
   * Make sure the event represents the current settings.
   *
   * @returns {boolean} True.
   */
  var updateEvent = function () {

    var talkCPTEventName = $('#talk_cpt_event_name');
    var talkCPTEventLink = $('#talk_cpt_event_link');
    var eventName = talkCPTEventName.val();
    var eventLink = talkCPTEventLink.val();
    var eventDisplayHtml = eventName;

    if (talkCPTEventName.is(':hidden') || talkCPTEventLink.is(':hidden')) {
      $('.edit-talk-cpt-event').show();
    }

    // Update "Event:" to currently configured event.
    if (eventLink) {
      eventDisplayHtml = '<a href="' + eventLink + '">' + eventName + '</a>';
    }

    $('#talk-cpt-event-display').html(eventDisplayHtml);
    return true;
  };

  // Talk CPT Event edit click.
  $talkCPTEventFields.siblings('a.edit-talk-cpt-event').click(
    function (event) {
      if ($talkCPTEventFields.is(':hidden')) {
        $talkCPTEventFields.slideDown('fast', function () {
          $talkCPTEventFields.find('select').focus();
        });
        $(this).hide();
      }
      event.preventDefault();
    }
  );

  // Save the Talk CPT Event changes and hide the options.
  $talkCPTEventFields.find('.save-talk-cpt-event').click(
    function (event) {
      $talkCPTEventFields.slideUp('fast')
        .siblings('a.edit-talk-cpt-event').show().focus();
      updateEvent();
      event.preventDefault();
    }
  );

  // Cancel Talk CPT Event editing and hide the options.
  $talkCPTEventFields.find('.cancel-talk-cpt-event').click(
    function (event) {
      $talkCPTEventFields.slideUp('fast')
        .siblings('a.edit-talk-cpt-event').show().focus();
      $('#talk_cpt_event_name').val($('#hidden_talk_cpt_event_name').val());
      $('#talk_cpt_event_link').val($('#hidden_talk_cpt_event_link').val());
      updateEvent();
      event.preventDefault();
    }
  );

  /**
   * Make sure the session represents the current settings.
   *
   * @returns {boolean} True.
   */
  var updateSession = function () {

    var talkCPTSessionDate = $('#talk_cpt_session_date');
    var talkCPTSessionLink = $('#talk_cpt_session_link');
    var sessionDate = talkCPTSessionDate.val();
    var sessionLink = talkCPTSessionLink.val();
    var sessionDisplayHtml = sessionDate;

    if (talkCPTSessionDate.is(':hidden') || talkCPTSessionLink.is(':hidden')) {
      $('.edit-talk-cpt-session').show();
    }

    // Update "Session:" to currently configured session.
    if (sessionLink) {
      sessionDisplayHtml = '<a href="' + sessionLink + '">' + sessionDate + '</a>';
    }

    $('#talk-cpt-session-display').html(sessionDisplayHtml);
    return true;
  };

  // Talk CPT Session edit click.
  $talkCPTSessionFields.siblings('a.edit-talk-cpt-session').click(
    function (event) {
      if ($talkCPTSessionFields.is(':hidden')) {
        $talkCPTSessionFields.slideDown('fast', function () {
          $talkCPTSessionFields.find('select').focus();
        });
        $(this).hide();
      }
      event.preventDefault();
    }
  );

  // Save the Talk CPT Session changes and hide the options.
  $talkCPTSessionFields.find('.save-talk-cpt-session').click(
    function (event) {
      $talkCPTSessionFields.slideUp('fast')
        .siblings('a.edit-talk-cpt-session').show().focus();
      updateSession();
      event.preventDefault();
    }
  );

  // Cancel Talk CPT Session editing and hide the options.
  $talkCPTSessionFields.find('.cancel-talk-cpt-session').click(
    function (event) {
      $talkCPTSessionFields.slideUp('fast')
        .siblings('a.edit-talk-cpt-session').show().focus();
      $('#talk_cpt_session_date').val($('#hidden_talk_cpt_session_date').val());
      $('#talk_cpt_session_link').val($('#hidden_talk_cpt_session_link').val());
      updateSession();
      event.preventDefault();
    }
  );

  /**
   * Make sure the video represents the current settings.
   *
   * @returns {boolean} True.
   */
  var updateVideo = function () {

    var talkCPTVideo = $('#talk_cpt_video');
    var video = talkCPTVideo.val();
    var videoDisplayHtml = '';

    if (talkCPTVideo.is(':hidden')) {
      $('.edit-talk-cpt-video').show();
    }

    // Update "Video:" to currently configured video.
    if (video) {
      videoDisplayHtml = '<a href="' + video + '">Link</a>';
    }

    $('#talk-cpt-video-display').html(videoDisplayHtml);
    return true;
  };

  // Talk CPT Video edit click.
  $talkCPTVideoInput.siblings('a.edit-talk-cpt-video').click(
    function (event) {
      if ($talkCPTVideoInput.is(':hidden')) {
        $talkCPTVideoInput.slideDown('fast', function () {
          $talkCPTVideoInput.find('select').focus();
        });
        $(this).hide();
      }
      event.preventDefault();
    }
  );

  // Save the Talk CPT Video changes and hide the options.
  $talkCPTVideoInput.find('.save-talk-cpt-video').click(
    function (event) {
      $talkCPTVideoInput.slideUp('fast')
        .siblings('a.edit-talk-cpt-video').show().focus();
      updateVideo();
      event.preventDefault();
    }
  );

  // Cancel Talk CPT Video editing and hide the options.
  $talkCPTVideoInput.find('.cancel-talk-cpt-video').click(
    function (event) {
      $talkCPTVideoInput.slideUp('fast')
        .siblings('a.edit-talk-cpt-video').show().focus();
      $('#talk_cpt_video').val($('#hidden_talk_cpt_video').val());
      updateVideo();
      event.preventDefault();
    }
  );

  /**
   * Make sure the slides represents the current settings.
   *
   * @returns {boolean} True.
   */
  var updateSlides = function () {

    var talkCPTSlides = $('#talk_cpt_slides');
    var slides = talkCPTSlides.val();
    var slidesDisplayHtml = '';

    if (talkCPTSlides.is(':hidden')) {
      $('.edit-talk-cpt-slides').show();
    }

    // Update "Slides:" to currently configured slides.
    if (slides) {
      slidesDisplayHtml = '<a href="' + slides + '">Link</a>';
    }

    $('#talk-cpt-slides-display').html(slidesDisplayHtml);
    return true;
  };

  // Talk CPT Slides edit click.
  $talkCPTSlidesInput.siblings('a.edit-talk-cpt-slides').click(
    function (event) {
      if ($talkCPTSlidesInput.is(':hidden')) {
        $talkCPTSlidesInput.slideDown('fast', function () {
          $talkCPTSlidesInput.find('select').focus();
        });
        $(this).hide();
      }
      event.preventDefault();
    }
  );

  // Save the Talk CPT Slides changes and hide the options.
  $talkCPTSlidesInput.find('.save-talk-cpt-slides').click(
    function (event) {
      $talkCPTSlidesInput.slideUp('fast')
        .siblings('a.edit-talk-cpt-slides').show().focus();
      updateSlides();
      event.preventDefault();
    }
  );

  // Cancel Talk CPT Slides editing and hide the options.
  $talkCPTSlidesInput.find('.cancel-talk-cpt-slides').click(
    function (event) {
      $talkCPTSlidesInput.slideUp('fast')
        .siblings('a.edit-talk-cpt-slides').show().focus();
      $('#talk_cpt_slides').val($('#hidden_talk_cpt_slides').val());
      updateSlides();
      event.preventDefault();
    }
  );

  /**
   * Make sure the image link represents the current settings.
   *
   * @returns {boolean} True.
   */
  var updateImageLink = function () {

    var talkCPTImageLink = $('#talk_cpt_image_link');

    if (talkCPTImageLink.is(':hidden')) {
      $('.edit-talk-cpt-image-link').show();
    }

    // Update "Image links to:" to currently selected link.
    $('#talk-cpt-image-link-display').html(
      $('option:selected', talkCPTImageLink).text()
    );
    return true;
  };

  // Talk CPT Image Link edit click.
  $talkCPTImageLinkSelect.siblings('a.edit-talk-cpt-image-link').click(
    function (event) {
      if ($talkCPTImageLinkSelect.is(':hidden')) {
        $talkCPTImageLinkSelect.slideDown('fast', function () {
          $talkCPTImageLinkSelect.find('select').focus();
        });
        $(this).hide();
      }
      event.preventDefault();
    }
  );

  // Save the Talk CPT Image Link changes and hide the options.
  $talkCPTImageLinkSelect.find('.save-talk-cpt-image-link').click(
    function (event) {
      $talkCPTImageLinkSelect.slideUp('fast')
        .siblings('a.edit-talk-cpt-image-link').show().focus();
      updateImageLink();
      event.preventDefault();
    }
  );

  // Cancel Talk CPT Image Link editing and hide the options.
  $talkCPTImageLinkSelect.find('.cancel-talk-cpt-image-link').click(
    function (event) {
      $talkCPTImageLinkSelect.slideUp('fast')
        .siblings('a.edit-talk-cpt-image-link').show().focus();
      $('#talk_cpt_image_link').val($('#hidden_talk_cpt_image_link').val());
      updateImageLink();
      event.preventDefault();
    }
  );
});

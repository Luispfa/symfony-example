'use strict';

(function ($) {

  var $collectionHolder;
  var $addTagLink = $('<a href="#" class="add_tag_link">Add a tag</a>');
  var $newLinkLi = $('<li></li>').append($addTagLink);

  $collectionHolder = $('ul.tags');
  $collectionHolder.append($newLinkLi);
  $collectionHolder.data('index', $collectionHolder.find(':input').length);

  $addTagLink.on('click', function (e) {
    e.preventDefault();

    addTagForm($collectionHolder, $newLinkLi);
  });

  function addTagForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    var $newFormLi = $('<li></li>').append(newForm);

    $collectionHolder.data('index', index + 1);
    $newLinkLi.before($newFormLi);
  }

  $('#ajax-button').click(function(e) {
    e.preventDefault();
    var $ajaxResponse = $('#ajax-response');
    $ajaxResponse.html('<p>Calculando foros...');
    $.getJSON('/ajax', function(data) {
      $ajaxResponse
        .removeClass('alert-warning')
        .addClass('alert-success')
        .html('<p>Hay ' + data.total + ' foros creados</p>');
    });
  });

}(jQuery));


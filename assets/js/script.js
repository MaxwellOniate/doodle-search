let timer;

$(document).ready(function() {
  $('.result').on('click', function() {
    const url = $(this).attr('href');
    const id = $(this).attr('data-linkID');

    increaseLinkClicks(id, url);

    return false;
  });

  const grid = $('.image-results');

  grid.on('layoutComplete', function() {
    $('.grid-item img').css('visibility', 'visible');
  });

  grid.masonry({
    itemSelector: '.grid-item',
    columnWidth: 200,
    gutter: 5,
    isInitLayout: false
  });

  $('[data-fancybox]').fancybox({
    caption: function(instance, item) {
      var caption = $(this).data('caption') || '';
      var siteURL = $(this).data('siteurl') || '';

      if (item.type === 'image') {
        caption =
          (caption.length ? caption + '<br />' : '') +
          '<a href="' +
          item.src +
          '">View Image</a><br>' +
          '<a href="' +
          siteURL +
          '">View Page</a>';
      }

      return caption;
    },
    afterShow: function(instance, item) {
      increaseImageClicks(item.src);
    }
  });
});

function increaseLinkClicks(linkID, url) {
  $.post('ajax/updateLinkCount.php', { linkID: linkID }).done(function(result) {
    if (result != '') {
      alert(result);
      return;
    }

    window.location.href = url;
  });
}

function increaseImageClicks(imageURL) {
  $.post('ajax/updateImageCount.php', { imageURL: imageURL }).done(function(
    result
  ) {
    if (result != '') {
      alert(result);
      return;
    }
  });
}

function loadImage(src, className) {
  const image = $('<img>');

  image.on('load', function() {
    $('.' + className + ' a').append(image);

    clearTimeout(timer);

    timer = setTimeout(function() {
      $('.image-results').masonry();
    }, 500);
  });

  image.on('error', function() {
    $('.' + className).remove();
    $.post('ajax/setBroken.php', { src: src });
  });

  image.attr('src', src);
}

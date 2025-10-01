(function($) {
  var $window = $(window)
  var $document = $(document)
  
  var itemContext = []
  var maxScrollTop = $document.height() - $window.height()
  var currentScrollTop = $window.scrollTop()
  
  function scrollContext(context) {
    // Can not see the current item
    if (currentScrollTop < context.scrollTop.min ||
        currentScrollTop > context.scrollTop.max) {
      return
    }

    var ratio = (currentScrollTop - context.scrollTop.min) / context.scrollTop.delta;

    context.$image.css('top', (1 - ratio) * context.imageTopMin)
    
    if (context.scrollTop.min === 0) {
      ratio = .5 + ratio / 2 // [0, 1] -> [.5, 1]
    } else if (context.scrollTop.max === maxScrollTop) {
      ratio = ratio / 2 // [0, 1] -> [0, .5]
    }
    context.$caption.css({
      'top': ratio * context.captionTopMax,
      'opacity': 1 - Math.abs(.5 - ratio) * 2
    })
  }
  
  function updateContext(context) {
    var carouselTop = context.$carousel.offset().top
    var carouselHeight = context.$carousel.height()
    
    var scrollTop = {
      'min': carouselTop - $window.height(),
      'max': carouselTop + carouselHeight
    }
    
    if (scrollTop.min < 0) // show on top
      scrollTop.min = 0
      
    if (scrollTop.max > maxScrollTop) // show on bottom
      scrollTop.max = maxScrollTop
    
    scrollTop.delta = scrollTop.max - scrollTop.min
    context.scrollTop = scrollTop
    
    setTimeout(function () {
      // image: max is 0, delta is -min
      context.imageTopMin = carouselHeight - context.$image.height()
      // caption: min is 0, delta is max
      context.captionTopMax = carouselHeight - context.$caption.height()
      // update position
      scrollContext(context)
    }, 0)
  }
  
  function scroll() {
    currentScrollTop = $window.scrollTop();
    
    for (var i = 0, l = itemContext.length; i < l; i++) {
      scrollContext(itemContext[i])
    }
  }
  
  function update() {
    maxScrollTop = $document.height() - $window.height()
    currentScrollTop = $window.scrollTop()
    
    for (var i = 0, l = itemContext.length; i < l; i++) {
      updateContext(itemContext[i])
    }
  }
  
  function addContext(carousel, item) {
    // build context of new items only
    for (var i = 0, l = itemContext.length; i < l; i++) {
      if (itemContext[i].item === item) {
        return
      }
    }
    
    // set some parallax style
    var $carousel = $(carousel)
    var $image = $('img', item).css('position', 'relative')
    var $caption = $('.carousel-caption', item).css('padding', 0)
    $caption.children().css('margin', 0)    
    
    // initialize the context
    var context = {
      'item': item,
      '$carousel': $carousel,
      '$image': $image,
      '$caption': $caption
    }
    
    updateContext(context)
    itemContext.push(context)
  }
  
  $window.on('load', function () {
    $('[data-ride="carousel"]').each(function () {
      addContext(this, $('.item', this)[0])
    })
  })
  
  var originalCarousel = $.fn.carousel
  $.fn.carousel = function () {
    originalCarousel.apply(this, arguments)
    addContext(this, $('.item', this)[0])
  }
  
  $document.on('slide.bs.carousel', function (event) {
    addContext(event.target, event.relatedTarget)
  })
  
  $window.on('resize', update);
  $window.on('scroll', scroll);
})(jQuery)
<script>
  var cb = function() {
    var l = document.createElement('link'); 
    l.rel = 'stylesheet';
    l.href = 'css/normalize.min.css';
    var m = document.createElement('link'); 
    m.rel = 'stylesheet';
    m.href = 'css/main.min.css';
    var h = document.getElementsByTagName('head')[0]; 
    h.parentNode.insertBefore(l, h);
    h.parentNode.insertBefore(m, h);
  };
  var raf = requestAnimationFrame || mozRequestAnimationFrame ||
      webkitRequestAnimationFrame || msRequestAnimationFrame;
  if (raf) raf(cb);
  else window.addEventListener('load', cb);
</script>
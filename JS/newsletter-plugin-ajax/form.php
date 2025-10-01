<!-- #newsletter-form -->
<aside id="newsletter-form">
  <div>
    <h1 class="widget-title">Newsletter</h1>
    <div class="widget">
      <p>Be upddated!</p>
    </div>
    <div class="widget">
      <form id="newsletter" role="form" method="get" class="search-form" action="http://domain.com/">
        <label>
          <span class="screen-reader-text">E-mail:</span>
          <span class="notification" aria-hidden="true"></span>
          <input class="email-field" placeholder="Type your e-mail" value="" name="ne" type="email">
        </label>
        <input type="hidden" name="na" value="S">
        <input type="hidden" name="nhr" value="<?php echo get_bloginfo('url') ?>">
        <input class="email-submit" value="Submit" type="submit">
      </form>
    </div>
  </div>
</aside>

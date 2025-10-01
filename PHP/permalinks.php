<?php
  $siteurl = "https://www.example.com/";
  $fileurl = ($_SERVER['REQUEST_URI']);
?>

<meta name="URL" content="<?php echo $siteurl . $fileurl; ?>">
<link rel="canonical" href="<?php echo $siteurl . $fileurl; ?>">

<?php

//process permalink
$permalink_temp = str_replace(' ', '-', $blog_permalink);
$permalink_temp = preg_replace('/[^A-Za-z0-9\-]/', '', $permalink_temp);
$permalink_temp = preg_replace('/-+/', '-', $permalink_temp);
$blog_permalink = strtolower($permalink_temp);

?>


//htaccess

#permalinks for blogs
#RewriteEngine on

#blog-single.php?post=3
RewriteRule ^blog/([^/\.]+)/?$ /blog-single.php?post=$1

#blog-single.php?link=the-permalink-link-structure
RewriteRule ^blog/([^/\.]+)/?$ /blog-single2.php?link=$1

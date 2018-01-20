<?php

$embed_yt_template = "https://www.youtube.com/embed/";

$url = "https://www.youtube.com/embed/inHawE1JnM4";
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (strrpos($url, 'https://www.youtube.com/watch?v=') == 0) {
        $id = explode('=', $url)[1];
        $id = explode('&', $id)[0];
        $url = $embed_yt_template . $id;
    }
}
?><!DOCTYPE html>
<html>
    <head>
        <?php if(!isset($_GET['url'])):?> <link rel="stylesheet" href="/css/app.css"><?php endif;?>
        <link rel="stylesheet" href="/css/style.css">
        
    </head>
    <body style="">
        <?php if (isset($_GET['url'])): ?>
        <div style="position: relative">
            <img src="/images/tv.jpg" style="position: absolute; left: 0pt; top: 0pt">
            <iframe <?php if ($_GET['format'] == 'oldschool'):?> width="1300" height="1215" style="position: absolute; left: 150pt; top: 28pt; opacity: 0.9" <?php else: ?> width="1000" height="715" style="position: absolute; left: 250pt; top: 200pt;" <?php endif; ?> src="<?php echo $url ?>" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
            <img src="/images/tv_overlay.png" style="pointer-events: none; position: absolute; left: 0pt; top: 0pt; z-index: 9000">
        </div>
        <?php else: ?>
        <form style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%)" method="GET" action="/">
            <label for="url" class="label">Enter YouTube URL</label>
            <input type="url" name="url" class="form-control" placeholder="https://www.youtube.com/watch?v=n7PWpQ-rISk">
            
            <input type="radio" name="format" value="modern">Modern format<br>
            <input type="radio" name="format" value="oldschool">Old school format (Better for old videos ripped from television)
            
            <button class="btn btn-primary" type="submit">View!</button>
        </form>
        <?php endif; ?>
        <footer style="position: fixed; z-index: 10000; color: white ">&copy; 2018 <a href="https://buddhalow.se" target="_blank"><img style="display: inline-block; filter: invert(1); width: 10pt" src="/images/logo.svg">Buddhalow Music</a></footer>
    </body>
</html>
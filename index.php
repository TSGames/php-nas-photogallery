<?php
	require "common.php";
?>
<html>
<head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Core CSS file -->
<link rel="stylesheet" href="photoswipe/photoswipe.css"> 

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="photoswipe/default-skin/default-skin.css"> 
<script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
<!-- Core JS file -->
<script src="photoswipe/photoswipe.min.js"></script> 

<!-- UI JS file -->
<script src="photoswipe/photoswipe-ui-default.min.js"></script>
<style>
.container div{
	float:left;
	padding:2px;
	text-align:center;
	width:<?php echo THUMB_SIZE; ?>px;
	height:<?php echo THUMB_SIZE+30; ?>px;
	overflow:hidden;
}
.container div img{
	width:<?php echo THUMB_SIZE; ?>px;
	height:<?php echo THUMB_SIZE; ?>px;
}
.container .empty{
	padding-top:40%;
	overflow:visible;
	width:100%;
	color:#ccc;	
}
.pswp__caption__center{
	text-align:center;
}
body{
	background:#111;
}
a{
	color:#ccc;
}
a:hover{
	color:#fff;
}
.glyphicon{
	color:#fff;
	font-size:4em;
	position:fixed;
	top:50%;
	left:50%;
	margin-left:-30px;
	margin-top:-30px;
}
.glyphicon-refresh-animate {
    -animation: spin 1.7s infinite linear;
    -webkit-animation: spin2 1.7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
</style>
<title>Gallery</title>
</head>
<body>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!--<nav class="navbar navbar-default">
<div class="container-fluid">
<div class="navbar-header">
<form class="form-inline" role="form">
<div class="form-group">
<label for="rating">Rating:</label>
<select class="form-control" name="rating" onchange="filterRating(this.value)"><option value="0">0 (All)</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
</select>
</div>
</form>
</div>
</div>
</nav>-->
<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
<div class="container"></div>
<?php
	echo "<script>var path='".cleanPath(@$_GET["path"])."';</script>";
?>
<script src="script.js"></script> 
</body>
</html>


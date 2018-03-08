<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */
?>

	<div id="footer">
		<div class="footmenu">
			<ul>
				<?php wp_nav_menu( array('menu' => 'main') ); ?>
			</ul>
		</div>
	</div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<script>
(function() {
	var Config = {
		Link: "a.share",
		Width: 500,
		Height: 500
	};

	var slink = document.querySelectorAll(Config.Link);
	for (var a = 0; a < slink.length; a++) {
		slink[a].onclick = PopupHandler;
	}

	function PopupHandler(e) {

		e = (e ? e : window.event);
		var t = (e.target ? e.target : e.srcElement);

		var
			px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
			py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);

		var popup = window.open(t.href, "social", 
			"width="+Config.Width+",height="+Config.Height+
			",left="+px+",top="+py+
			",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
		if (popup) {
			popup.focus();
			if (e.preventDefault) e.preventDefault();
			e.returnValue = false;
		}

		return !!popup;
	}

}());

	$(".gallery-icon a").addClass("galleria").attr("rel","fancybox-thumb");	
	$(".sl").hide();
	$(".show a").attr("data-fancybox-type","iframe");
  
    $(".galleria").fancybox({
    	'padding' : 0,
		'width' : '1280',
        'height' : '860',  
        'autoScale' : false,  
        'transitionIn' : 'none',  
        'transitionOut' : 'none',
        'title' : false,  
        'hideOnOverlayClick' : false       
	});
	
  $(document).ready(function() {
	$(".show a").fancybox({
		fitToView	: false,
		width		: '1024',
		height		: '100%',
    autoSize	: true,
		closeClick	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
    'title' : false
	});
});
</script>

</body>
</html>
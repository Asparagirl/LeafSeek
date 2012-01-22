
    <!--
	<script type="text/javascript" src="http://use.typekit.com/tpe2ctc.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    -->
    <script type="text/javascript">
      TypekitConfig = {
        kitId: 'tpe2ctc',
        scriptTimeout: 5000
      };
      (function() {
        $('html').addClass('wf-loading');
        var t = setTimeout(function() {
          $('html').removeClass('wf-loading').addClass('wf-inactive');
        }, TypekitConfig.scriptTimeout);
        $.ajax({
          url: '//use.typekit.com/' + TypekitConfig.kitId + '.js',
          dataType: 'script',
          cache: true,
          success: function() {
            clearTimeout(t);
            try { Typekit.load(TypekitConfig); } catch (e) {}
          }
        });
      })();
    </script> 
    <style type="text/css">
		.wf-loading h1, .wf-loading h2, .wf-loading h3, .wf-loading h4, .wf-loading .navigation p, .wf-loading #footer p, .wf-loading #footer ul li {
			/* Hide the title while web fonts are loading */
			visibility: hidden;
		}
	</style>

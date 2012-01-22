
	<!-- This script controls the pop-up Google Maps attached to records, which show up inside a "colorbox" pop-up window -->
    <link href="_css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="_js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			// POP-UP GOOGLE MAPS BOX
			$(".result-body a").colorbox({iframe:'true',innerWidth:'85%',innerHeight:'85%'});
		});
	</script>

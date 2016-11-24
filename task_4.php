<html>
	<head>
	<style>
		button {
			display:block;
		}
	</style>
	<script
	  src="https://code.jquery.com/jquery-3.1.1.js"
	  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
	  crossorigin="anonymous"></script>	
	  <script type="text/javascript">
	  $(document).ready(function() {
		for (var i = 1; i < 4; i++) {
			var test = $('<button>'+i+'</button>').click(function () {
				var btn = $('button').first().detach();
				btn.hide().appendTo('#working_area').fadeIn(1000);
			});

			$( '#working_area' ).append( test );
		}
	  });
	  </script>
	</head>
<body>
	<div id="working_area"></div>
</body>
</html>

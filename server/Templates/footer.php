		
		</div>
	  </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script>
			$(function(){
				
				$('#rapid-design-logo').click(function(event){
					var mainMenu = $('#main-menu');
					mainMenu.stop(true, true);
					if ($(this).hasClass('closed')) {
						mainMenu.slideDown();
						$(this).removeClass('closed');
					} else {
						mainMenu.slideUp();
						$(this).addClass('closed');
					}
					event.preventDefault();
				});
			});
		</script>
	</body>
</html>
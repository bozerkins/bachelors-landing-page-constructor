		
		</div>
	  </div>
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
		
		<script>
			$('.btn-delete').click(function(event){
				if (confirm('Are you sure to delete everything connected to this page?')) {
					return true;
				} else {
					return false;
				}
			})
		</script>
	</body>
</html>
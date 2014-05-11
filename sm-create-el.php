<!DOCTYPE html>
<html>
	<head>
		<title>BOST - dynamic layout tools</title>
		<link type="text/css" rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
		<link type="text/css" rel="stylesheet" href="css/sm-create-el.css">
		<script src="javascript/jquery-1.10.2.js"></script>
		<script src="javascript/modules/oc.js"></script>
	</head>
	<body>
		<aside class="controls-menu">
			<div class="basic">
				<div class="position">
					<div class="move">
						move left
					</div>
					<div class="move">
						move right
					</div>
				</div>
				<div class="closing">
					close
				</div>
			</div>
			<div class="first-group">
				<header class="namer">
					create element
				</header>
				<div class="caller">
					<div class="caller-el">containers</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">article</div>
						<div class="caller-el-type-el">aside</div>
						<div class="caller-el-type-el">nav</div>
						<div class="caller-el-type-el">div</div>
						<div class="caller-el-type-el">header</div>
						<div class="caller-el-type-el">footer</div>
					</div>
					<div class="caller-el">elements</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">a</div>
						<div class="caller-el-type-el">pre</div>
						<div class="caller-el-type-el">ul</div>
						<div class="caller-el-type-el">ol</div>
						<div class="caller-el-type-el">table - th, tr - td</div>
						<div class="caller-el-type-el">h1-h6</div>
						<div class="caller-el-type-el">img</div>
						<div class="caller-el-type-el">label</div>
						<div class="caller-el-type-el">p</div>
						<div class="caller-el-type-el">span</div>
					</div>
					<div class="caller-el">interaction+presets</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">form</div>
						<div class="caller-el-type-el">input</div>
						<div class="caller-el-type-el">select</div>
						<div class="caller-el-type-el">script</div>
					</div>
					<script>
						$('.caller-el').click(function(){
							oc($(this));
							oc($(this).next('.caller-el-type'));
						});
					</script>
				</div>
			</div>
		</aside>
	</body>
</html>
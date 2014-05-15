<!DOCTYPE html>
<html>
	<head>
		<title>BOST - dynamic layout tools</title>
		<link type="text/css" rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
		<link type="text/css" rel="stylesheet" href="css/sm-create-el.css">
		<link type="text/css" rel="stylesheet" href="css/sm-attributes-el.css">
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
					edit styles: A
				</header>
				<div class="caller">
					<div class="caller-el">Indention</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">padding</div>
						<div class="caller-el-type-el">margin</div>
						<div class="caller-el-type-el">overflow</div>
					</div>
					<div class="caller-el">Position</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">position</div>
						<div class="caller-el-type-el">float</div>
						<div class="caller-el-type-el">top, right, bottom, left</div>
					</div>
					<div class="caller-el">Form/Size</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">width, min-width, max-width</div>
						<div class="caller-el-type-el">height, min-height, max-height</div>
						<div class="caller-el-type-el">border, border-radius</div>
						<div class="caller-el-type-el">box-shadow</div>
					</div>
					<div class="caller-el">Font</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">font-size, font-weight, text-decoration, text-style :: bold, italic, underline</div>
						<div class="caller-el-type-el">font-family</div>
						<div class="caller-el-type-el">color</div>
						<div class="caller-el-type-el">shadow</div>
					</div>
					<div class="caller-el">Text</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">line-height</div>
						<div class="caller-el-type-el">align</div>
						<div class="caller-el-type-el">word-breaking</div>
						<div class="caller-el-type-el">indent</div>
						<div class="caller-el-type-el">tab-size</div>
						<div class="caller-el-type-el">letter-spacing</div>
						<div class="caller-el-type-el">word-wrap</div>
					</div>
					<div class="caller-el">Background</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">color</div>
						<div class="caller-el-type-el">position</div>
						<div class="caller-el-type-el">image</div>
					</div>
					<div class="caller-el">Visibility</div>
					<div class="caller-el-type">
						<div class="caller-el-type-el">display</div>
						<div class="caller-el-type-el">visibility</div>
						<div class="caller-el-type-el">opacity</div>
					</div>
					<div class="finisher">
						<input type="button" value="Save">
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
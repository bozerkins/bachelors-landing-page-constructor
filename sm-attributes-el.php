<!DOCTYPE html>
<html>
	<head>
		<title>BOST - dynamic layout tools</title>
		<link type="text/css" rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
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
					attributes edit: a
				</header>
				<div class="caller">
					<div class="caller-change">
						<div class="caller-change-title">label</div>
						<div class="caller-change-option">
							<input type="text">
						</div>
					</div>
					<div class="caller-change">
						<div class="caller-change-title">value</div>
						<div class="caller-change-option">
							<input type="text">
						</div>
					</div>
					<div class="caller-change">
						<div class="caller-change-title">link</div>
						<div class="caller-change-option">
							<input type="text">
						</div>
					</div>
					<div class="caller-change">
						<div class="caller-change-title">target</div>
						<div class="caller-change-option">
							<select>
								<option>blank</option>
								<option>self</option>
								<option>parent</option>
								<option>top</option>
							</select>
						</div>
					</div>
				</div>
				<div class="finisher">
					<input type="button" value="Back">&nbsp;<input type="button" value="Create">
				</div>
			</div>
		</aside>
	</body>
</html>
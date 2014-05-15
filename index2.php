<!DOCTYPE html>
<html>
	<head>
		<title>BOST - dynamic layout tools</title>
		<link type="text/css" rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.css">
		<link type="text/css" rel="stylesheet" href="css/modules/template.css">
		<link type="text/css" rel="stylesheet" href="css/modules/list-popup.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
		<!-- pages -->
		<link type="text/css" rel="stylesheet" href="css/sm-attributes-el.css">
		<link type="text/css" rel="stylesheet" href="css/sm-create-el.css">
	</head>
	<body>
		<!-- templates -->
		<script id="template-controls-menu" type="text/template">
			<aside class="controls-menu">
				<div class="basic">
					<div class="position">
						<div class="move" data-side="left">
							move left
						</div>
						<div class="move" data-side="right">
							move right
						</div>
					</div>
					<div class="closing">
						close
					</div>
				</div>
				<div class="first-group">
					<header class="namer">
					<!-- put name here -->
					</header>
					<div class="caller">
					<!-- put container here -->
					</div>
				</div>
			</aside>
		</script>
		<script id="template-controls-add-element" type="text/template">
			<div class="caller-el"><%=title%></div>
			<div class="caller-el-type">
				<% _.each(elements, function(item){ %>
					<div class="caller-el-type-el" data-group="<%=name%>" data-name="<%=item.name%>"><%=item.title%></div>			
				<% }) %>
			</div>
		</script>
		<script id="template-controls-attribute" type="text/template">
			<div class="caller-change">
				<div class="caller-change-title"><%=title%></div>
				<div class="caller-change-option">
					<% if (type === 'text') { %>
						<input type="text" name="<%=name%>" value="<%=typeof value !== 'undefined' ? value : '' %>">
					<% } %>
				</div>
			</div>
		</script>
		<script id="template-controls-attribute-controls" type="text/template">
			<div class="finisher">
				<input type="button" value="Back" class="back">&nbsp;<input type="button" value="Create" class="create">
			</div>
		</script>
		<script src="http://requirejs.org/docs/release/2.1.11/minified/require.js" data-main="scripts/init"></script>
	</body>
</html>
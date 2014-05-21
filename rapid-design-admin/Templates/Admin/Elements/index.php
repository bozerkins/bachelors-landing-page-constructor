<?php foreach($list as $item) : ?>
<div class="panel panel-default">
  <div class="panel-body">
	  <h4><?=$item->title; ?></h4>
	  <?php foreach($item->elements as $element) : ?>
	  
		<div class="panel-body">
			<?=$element->title; ?>&nbsp(Tag: <?=$element->tag; ?>)
	  <span class="groups-view-link">
			<a href="<?=$base_url . $base_url_segment_attributes . $element->id; ?>" class="navbar-link">view attributes</a>&nbsp;&nbsp;&nbsp;
			<a href="<?=$base_url . $base_url_segment_styles . $element->id; ?>" class="navbar-link">view styles</a>
	  </span>
		</div>
	  <?php endforeach; ?>
  </div>
</div>
<?php endforeach; ?>

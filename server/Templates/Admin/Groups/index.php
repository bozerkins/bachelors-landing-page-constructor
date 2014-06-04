<form role="form" class="form-inline form-padding"  method="post" action="<?=$base_url . $base_url_segment_add; ?>">
	<div class="panel-body text-center">
		<label for="inputEmail3"> Title:&nbsp;</label><input type="text"  name="title" class="form-control"  placeholder="Title" value="">
		<button type="submit" class="btn btn-default">Create</button>
	 </div>
</form>
<?php foreach($list as $item) : ?>
<div class="panel panel-default">
  <div class="panel-body">
    <?=$item->title; ?> 
	  <a href="<?=$base_url . $base_url_segment . $item->id; ?>" class="navbar-link groups-view-link">view</a>
	  <a href="<?=$base_url . $base_url_segment_delete . $item->id; ?>" class="navbar-link groups-view-link btn-delete" style="margin: 0 5px">delete</a>
  </div>
</div>
<?php endforeach; ?>
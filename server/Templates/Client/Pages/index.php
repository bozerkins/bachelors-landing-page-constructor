<form role="form" class="form-inline form-padding"  method="post" action="<?=$base_url_segment_add; ?>">
	<div class="panel-body text-center">
		<label for="inputEmail3"> Title:&nbsp;</label><input type="text"  name="title" class="form-control"  placeholder="Title" value="">
		<button type="submit" class="btn btn-default">Create</button>
	 </div>
</form>
<?php foreach($list as $item) : ?>
	<div class="panel-body text-center">
		<form role="form" class="form-inline form-padding" method="post" action="<?=$base_url_segment_change . $item->id; ?>">
		  <div class="form-group">
			  <label for="inputEmail3"> Title:&nbsp;</label><input type="text" name="title" class="form-control"  placeholder="Title" value="<?=$item->name; ?>">
		  <button type="submit" class="btn btn-default">Save</button>
		  <a href="<?=$base_url_segment_delete . $item->id; ?>" class="btn-delete"><button type="button" class="btn btn-default">Delete</button></a>
		  <a href="<?=$base_url_segment_view . ($item->hash); ?>" class="btn-view"> <button type="button" class="btn btn-default">View</button></a>
		  </div>
		</form>
	</div>
<?php endforeach; ?>

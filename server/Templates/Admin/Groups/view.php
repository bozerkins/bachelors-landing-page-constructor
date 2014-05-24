<div class="page-header">
  <h2>Group &nbsp;&nbsp;&nbsp;<small><?=$group->title; ?>&nbsp(ID: <?=$group->id; ?>)</small></h2>
</div>
<div class="panel panel-default">
<?php foreach($list as $item) : ?>
	<div class="panel-body text-center">
		<form role="form" class="form-inline form-padding" method="post" action="<?=$base_url_segment_change . $item->id; ?>">
		  <label>ID: <?=$item->id; ?></label>
		  <div class="form-group">
			  <label for="inputEmail3"> Title:&nbsp;</label><input type="text" name="title" class="form-control"  placeholder="Title" value="<?=$item->title; ?>">
			 <label for="inputEmail3"> Tag:&nbsp;</label><input type="text" name="tag" class="form-control"  placeholder="Title" value="<?=$item->tag; ?>">
		  <button type="submit" class="btn btn-default">Save</button>
		  </div>
		</form>
	</div>
<?php endforeach; ?>
	<form role="form" class="form-inline form-padding"  method="post" action="<?=$base_url_segment_add; ?>">
		<div class="panel-body text-center">
			<input type="hidden" name="group_id" value="<?=$group->id; ?>">
			<label for="inputEmail3"> Title:&nbsp;</label><input type="text"  name="title" class="form-control"  placeholder="Title" value="">
			<label for="inputEmail3"> Tag:&nbsp;</label><input type="text" name="tag" class="form-control"  placeholder="Title" value="">
			<button type="submit" class="btn btn-default">Create</button>
		 </div>
	</form>
</div>
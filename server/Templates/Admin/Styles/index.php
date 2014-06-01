<div class="panel panel-default">
	<form role="form" class="form-inline form-padding"  method="post" action="<?=$base_url_segment_add; ?>">
		<div class="panel-body text-center">
			<label for="inputEmail3"> Title:&nbsp;</label><input type="text"  name="title" class="form-control"  placeholder="Title" value="">
			<label for="inputEmail3"> Type:&nbsp;</label>
				<select multiple  class="form-control" name='type[]'>
					<?php foreach($types as $type) : ?>
					<option value='<?=$type; ?>'><?=$type; ?></option>
					<?php endforeach; ?>
				</select>
			 <label for="inputEmail3"> Group:&nbsp;</label>
				<select class="form-control" name='style_group_id'>
					<option value='0'></option>
					<?php foreach($styleGroups as $styleGroup) : ?>
					<option value='<?=$styleGroup->id; ?>' <?=$groupId == $styleGroup->id ? 'selected' : ''; ?>><?=$styleGroup->title; ?></option>
					<?php endforeach; ?>
				</select>
			<label for="inputEmail3"> Name:&nbsp;</label><input type="text"  name="name" class="form-control"  placeholder="Name" value="">
			<button type="submit" class="btn btn-default">Create</button>
		 </div>
	</form>
<?php foreach($list as $item) : ?>
	<div class="panel-body text-center">
		<form role="form" class="form-inline form-padding" method="post" action="<?=$base_url_segment_change . $item->id; ?>">
		  <label>ID: <?=$item->id; ?></label>
		  <div class="form-group">
			  <label for="inputEmail3"> Title:&nbsp;</label><input type="text" name="title" class="form-control"  placeholder="Title" value="<?=$item->title; ?>">
			 <label for="inputEmail3"> Type:&nbsp;</label>
				<select multiple  class="form-control" name='type[]'>
					<?php foreach($types as $type) : ?>
					<option value='<?=$type; ?>' <?=in_array($type, $item->type) ? 'selected' : ''; ?>><?=$type; ?></option>
					<?php endforeach; ?>
				</select>
			 <label for="inputEmail3"> Group:&nbsp;</label>
				<select class="form-control" name='style_group_id'>
					<option value='0'></option>
					<?php foreach($styleGroups as $styleGroup) : ?>
					<option value='<?=$styleGroup->id; ?>' <?=$styleGroup->id == $item->style_group_id ? 'selected' : ''; ?>><?=$styleGroup->title; ?></option>
					<?php endforeach; ?>
				</select>
			 <label for="inputEmail3"> Name:&nbsp;</label><input type="text" name="name" class="form-control"  placeholder="Name" value="<?=$item->name; ?>">
		  <button type="submit" class="btn btn-default">Save</button>
		  </div>
		</form>
	</div>
<?php endforeach; ?>
</div>
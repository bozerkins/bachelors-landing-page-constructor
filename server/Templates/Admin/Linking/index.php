<div class="page-header">
  <h2>Element &nbsp;&nbsp;&nbsp;<small><?=$element->title; ?>&nbsp(ID: <?=$element->id; ?>)</small></h2>
</div>
<div class="panel panel-default">
	<form role="form" class="form-inline form-padding"  method="post" action="<?=$base_url_segment_add . $element->id; ?>">
		<div class="panel-body text-center">
			<label for="inputEmail3"> Attributes:&nbsp;</label>
				<select multiple  class="form-control form-high-select" name='attributes[]'>
					<?php foreach($attributes as $attribute) : ?>
					<option value='<?=$attribute->id; ?>' <?=in_array($attribute->id, $listAttributeIds) ? 'selected' : ''; ?>><?=$attribute->title; ?></option>
					<?php endforeach; ?>
				</select>
			<label for="inputEmail3"> Styles:&nbsp;</label>
				<select multiple  class="form-control form-high-select" name='styles[]'>
					<?php foreach($styles as $style) : ?>
					<option value='<?=$style->id; ?>' <?=in_array($style->id, $listStyleIds) ? 'selected' : ''; ?>><?=$style->title; ?></option>
					<?php endforeach; ?>
				</select>
			<button type="submit" class="btn btn-default">Save</button>
		 </div>
	</form>
</div>
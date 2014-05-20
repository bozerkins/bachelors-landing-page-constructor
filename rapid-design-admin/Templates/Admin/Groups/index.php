<?php foreach($list as $item) : ?>
<div class="panel panel-default">
  <div class="panel-body">
    <?=$item->title; ?> <a href="<?=$base_url . $base_url_segment . $item->id; ?>" class="navbar-link groups-view-link">view</a>
  </div>
</div>
<?php endforeach; ?>

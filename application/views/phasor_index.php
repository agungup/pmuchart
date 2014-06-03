List Stasiun<br/>
<?php foreach($output as $item): ?>
<a href="<?php echo base_url()?>index.php/phasor/chart/<?php echo $item['PDC_ID'];?>/<?php echo $item['PMU_ID'];?>"><?php echo $item['STN'];?></a><br/>
<?php endforeach; ?>
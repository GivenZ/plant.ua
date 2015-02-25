<div class="post">
	<div class="author">
		автор: <?php echo $data->projectLink; ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->name;
			$this->endWidget();
		?>
	</div>
</div>

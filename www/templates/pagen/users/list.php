	<div>
		<?php foreach ($content as $item) {?>
			<div>
				<hr/>
				<div>E-mail: <strong><?= $item ['users_email'] ?></strong></div>
				<div>Name:   <strong><?= $item ['users_name'] ?> </strong></div>
			</div>
		<?php } ?>
	</div>
<div class="apiKeys form">
<?php echo $this->Form->create('ApiKey'); ?>
	<fieldset>
		<legend><?php echo __('Edit Api Key'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('merchant_id');
		echo $this->Form->input('active');
		echo $this->Form->input('ccd_enabled');
		echo $this->Form->input('ppd_enabled');
		echo $this->Form->input('web_enabled');
		echo $this->Form->input('tel_enabled');
		echo $this->Form->input('rck_enabled');
		echo $this->Form->input('boc_enabled');
		echo $this->Form->input('icl_enabled');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ApiKey.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ApiKey.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>

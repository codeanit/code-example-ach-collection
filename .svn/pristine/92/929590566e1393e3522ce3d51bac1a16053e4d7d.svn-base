<div class="apiKeys index">
	<h2><?php echo __('Api Keys'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('merchant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('ccd_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('ppd_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('web_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('tel_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('rck_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('boc_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('icl_enabled'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($apiKeys as $apiKey): ?>
	<tr>
		<td><?php echo h($apiKey['ApiKey']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($apiKey['Merchant']['id'], array('controller' => 'merchants', 'action' => 'view', $apiKey['Merchant']['id'])); ?>
		</td>
		<td><?php echo h($apiKey['ApiKey']['active']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['ccd_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['ppd_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['web_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['tel_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['rck_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['boc_enabled']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['icl_enabled']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $apiKey['ApiKey']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $apiKey['ApiKey']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $apiKey['ApiKey']['id']), null, __('Are you sure you want to delete # %s?', $apiKey['ApiKey']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Api Key'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>

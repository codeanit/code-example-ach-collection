<div class="apiKeys view">
<h2><?php echo __('Api Key'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Merchant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($apiKey['Merchant']['id'], array('controller' => 'merchants', 'action' => 'view', $apiKey['Merchant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ccd Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['ccd_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ppd Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['ppd_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Web Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['web_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['tel_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rck Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['rck_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Boc Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['boc_enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icl Enabled'); ?></dt>
		<dd>
			<?php echo h($apiKey['ApiKey']['icl_enabled']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Api Key'), array('action' => 'edit', $apiKey['ApiKey']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Api Key'), array('action' => 'delete', $apiKey['ApiKey']['id']), null, __('Are you sure you want to delete # %s?', $apiKey['ApiKey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api Key'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Merchants'), array('controller' => 'merchants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Merchant'), array('controller' => 'merchants', 'action' => 'add')); ?> </li>
	</ul>
</div>

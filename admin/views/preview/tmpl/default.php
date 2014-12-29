<?php
defined('_JEXEC') or die;
?>

<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		<div class="clearfix"> </div>

		<div class="mypreview">
			<?php foreach ($this->items as $i => $item) : ?>
				<div class="mytutorial">
					<div class="tutorial_title">
						<?php echo $item->title; ?>
					</div>

					<div class="tutorial_element">
						<strong><?php echo JText::_('COM_TUTORIAL_COMPANY');?></strong><?php echo $item->company; ?>
					</div>
					
					<div class="tutorial_element">
						<?php echo $item->description; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</form>
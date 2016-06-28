<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="Group form">
<?php echo $this->Form->create('Group'); ?>
    <fieldset>
        <legend><?php echo __('Add Group'); ?></legend>
        <?php echo $this->Form->input('name');
        
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


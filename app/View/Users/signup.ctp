<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        //echo $this->Form->input('group_id',array(1,2,3));
       echo $this->Form->input('group_id', array(
            'options' => array('1' => 'admin', '2' => 'provider','3'=>'consumer','4'=>'patient')
         ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


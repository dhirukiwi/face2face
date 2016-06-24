<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo $this->Form->create('User'); ?>
    <fieldset>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    <?php echo $this->Form->submit(__('Login'));?>
    </fieldset>
<?php echo $this->Form->end(); ?>

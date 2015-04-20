<div class="page page-region">
    <div class="page-region-content">
        <div class="row">
        <div class="span6" style="margin:auto;">
        <?php
        echo form_open();
        echo form_fieldset($this->lang->line('login_title'));
        echo lang('login_username', 'username');
        echo form_input(array('id'=>'username','name'=>'username','placeholder'=>$this->lang->line('login_username_placeholder')));
        echo lang('login_password', 'password');
        echo form_password(array('id'=>'password','name'=>'password','placeholder'=>$this->lang->line('login_password_placeholder')));
        echo '<div class="grid fluid">';
        echo '<div class="row">';
        echo '<div class="span2 offset3">';
        echo form_submit('',$this->lang->line('common_submit'));
        echo '</div>';
        echo '<div class="span2 offset2">';
        echo form_reset('',$this->lang->line('common_reset'));
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo form_fieldset_close();
        echo form_close();
        ?>
        </div>
        </div>
    </div>
</div>


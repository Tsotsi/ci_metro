<div class="page secondary">
    <div class="page-header">
        <div class="page-header-content">
            Welcome to CodeIgniter1!
        </div>
    </div>

    <div class="page-region">
        <div class="page-region-content">
		<img src="//localhost/index/welcome/getCaptcha"/>
        </div>
	</div>
    <?php
    echo form_open('email/send', 'class="email" id="myform"');
    echo form_input();
    echo form_password();
    echo form_upload();
    echo form_textarea();
    $options = array(
        'small'         => 'Small Shirt',
        'med'           => 'Medium Shirt',
        'large'         => 'Large Shirt',
        'xlarge'        => 'Extra Large Shirt',
);

$shirts_on_sale = array('small', 'large');
echo form_dropdown('shirts', $options, 'large');
echo form_multiselect('shirt', $options,array('large'));
echo form_checkbox(array('label'=>'你好'));
echo form_radio(array('label'=>'你好','name'=>'a'));
echo form_radio(array('label'=>'你好','name'=>'a'));
echo form_switch(array('label'=>'你好','name'=>'a'));
echo form_button(array('name'=>'a','class'=>'warning'),'haha');
echo form_button_icon('','sds','','left');
echo form_submit();echo form_reset();
    echo form_close();
    ?>
    <?php echo $table;?>
    <?php echo $v;?>
      </div>
<?php
    $tab_index = 0;

    $current_tab_value = $this->uri->segment(4);

    if($current_tab_value == '' || $current_tab_value == 'index')
    {
        $tab_index = 1;
    }
    else if($current_tab_value == 'role_index')
    {
        $tab_index = 2;
    }
    else if($current_tab_value == 'popups')
    {
        $tab_index = 3;
    }
    else if($current_tab_value == 'abbreviations')
    {
        $tab_index = 4;
    }
    else if($current_tab_value == 'definitions')
    {
        $tab_index = 5;
    }
?>

<ul class="nav nav-pills">
    <li <?php echo $tab_index == 1 ? 'class="active"' : '' ?>><a href="<?php echo site_url(SITE_AREA .'/content/ems/') ?>"><?php echo lang('ems_content'); ?></a></li>
    <li <?php echo $tab_index == 2 ? 'class="active"' : '' ?>><a href="<?php echo site_url(SITE_AREA .'/content/ems/role_index') ?>"><?php echo lang('ems_content_roles'); ?></a></li>
    <li <?php echo $tab_index == 3 ? 'class="active"' : '' ?>><a href="<?php echo site_url(SITE_AREA .'/content/ems/popups') ?>"><?php echo lang('ems_content_popups'); ?></a></li>
    <li <?php echo $tab_index == 4 ? 'class="active"' : '' ?>><a href="<?php echo site_url(SITE_AREA .'/content/ems/abbreviations') ?>"><?php echo lang('ems_content_abbreviations'); ?></a></li>
    <li <?php echo $tab_index == 5 ? 'class="active"' : '' ?>><a href="<?php echo site_url(SITE_AREA .'/content/ems/definitions') ?>"><?php echo lang('ems_content_definitions'); ?></a></li>
</ul>
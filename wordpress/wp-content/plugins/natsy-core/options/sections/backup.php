<?php
$opt_name = NOVA_FRAMEWORK_VAR;

CSF::createSection( $opt_name, array(
    'title'       => 'Backup',
    'icon'        => 'fa fa-cloud-download',
    'description' => __('Remember to backup your Theme Options&nbsp;<b>before update the theme.</b>', 'natsy-core'),
    'fields'      => array(
        array(
            'type' => 'backup',
        ),
    )
) );

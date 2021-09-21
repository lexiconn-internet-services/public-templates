<?php

$replacements = [
    'max_execution_time' => 30,
    'expose_php' => 'Off',
    'max_input_time' => 1200,
    'max_input_vars' => 20000,
    'memory_limit' => '4096M',
    'post_max_size' => '2048M',
    'enable_dl' => 'On',
    'upload_max_filesize' => '2048M',
    'allow_url_include' => 'On',
    'date.timezone' => 'America/New_York',
    'session.use_strict_mode' => '1',
    'opcache.enable' => '1',
    'opcache.enable_cli' => '1',
    'opcache.memory_consumption' => '768',
    'opcache.interned_strings_buffer' => '8',
    'opcache.max_accelerated_files' => '32768',
    'opcache.use_cwd' => '1',
    'opcache.validate_timestamps' => '1',
    'opcache.revalidate_freq' => '60',
    'opcache.blacklist_filename' => '/usr/local/etc/opcache-blacklist.txt'
];


foreach ($replacements as $key => $value){
    printf("sed -i 's#^%1\$s .*#%1\$s = %2\$s#g' php*.ini;\n", $key, $value);
}

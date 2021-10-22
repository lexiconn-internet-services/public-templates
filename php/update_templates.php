<?php

$replacements = [
    'allow_url_include'               => 'On',
    'date.timezone'                   => 'America/New_York',
    'enable_dl'                       => 'On',
    'error_reporting'                 => 'E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE',
    'expose_php'                      => 'Off',
    'max_execution_time'              => '18000',
    'max_input_time'                  => '1200',
    'max_input_vars'                  => '20000',
    'memory_limit'                    => '4096M',
    'opcache.blacklist_filename'      => '/usr/local/etc/opcache-blacklist.txt',
    'opcache.enable'                  => '1',
    'opcache.enable_cli'              => '1',
    'opcache.fast_shutdown'           => '1',
    'opcache.interned_strings_buffer' => '8',
    'opcache.max_accelerated_files'   => '32768',
    'opcache.memory_consumption'      => '768',
    'opcache.revalidate_freq'         => '60',
    'opcache.use_cwd'                 => '1',
    'opcache.validate_timestamps'     => '1',
    'post_max_size'                   => '2048M',
    'realpath_cache_size'             => '4096k',
    'realpath_cache_ttl'              => '7200',
    'serialize_precision'             => '100',
    'session.gc_maxlifetime'          => '28800',
    'session.use_strict_mode'         => '1',
    'short_open_tag'                  => 'Off',
    'track_errors'                    => 'Off',
    'upload_max_filesize'             => '2048M',
    'zlib.output_compression'         => 'On',
];


foreach( glob("*.ini") as $file){
    $contents = file_get_contents($file);
    foreach ($replacements as $key => $value) {
        $key_regex = preg_quote($key);
        $value_regex = preg_quote($value);
        
        // language=RegExp
        $find = "/^(;|; )?{$key_regex}(\s+)?=.*\$/m";
        $replace = "$key = $value";
        
        if(! preg_match($find, $contents) && !preg_match("/^;;{$key_regex}(\s+)?=.*\$/m", $contents)) {
            $contents .= PHP_EOL.";;$replace - Not valid for this PHP version.";
            continue;
        }
        $contents = preg_replace($find, $replace, $contents);
    }
    file_put_contents($file, $contents);
}

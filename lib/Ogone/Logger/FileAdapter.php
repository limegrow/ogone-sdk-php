<?php

namespace Ogone\Logger;

class FileAdapter implements AdapterInterface
{
    private $file;

    /**
     * Constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (isset($options['file'])) {
            $this->file = $options['file'];
        } else {
            $this->file = sys_get_temp_dir() . '/ingenico_sdk.log';
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        if ($this->file) {
            $message = sprintf(
                '[%s] %s %s %s',
                date('Y-m-d H:i:s'),
                $level,
                $message,
                count($context) > 0 ? var_export($context, true) : ''
            );

            file_put_contents($this->file, $message . "\n", FILE_APPEND);
        }
    }
}

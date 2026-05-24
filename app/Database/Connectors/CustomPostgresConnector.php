<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector as BasePostgresConnector;

class CustomPostgresConnector extends BasePostgresConnector
{
    /**
     * Get the default PDO connection options.
     *
     * @param  array  $config
     * @return array
     */
    public function getOptions(array $config)
    {
        $options = $config['options'] ?? [];

        if (is_string($options)) {
            $options = [];
        }

        return parent::getOptions(array_merge($config, ['options' => $options]));
    }

    /**
     * Add the SSL and endpoint options to the DSN.
     *
     * @param  string  $dsn
     * @param  array  $config
     * @return string
     */
    protected function addSslOptions($dsn, array $config)
    {
        $dsn = parent::addSslOptions($dsn, $config);

        if (isset($config['options']) && is_string($config['options'])) {
            $dsn .= ";options={$config['options']}";
        }

        return $dsn;
    }
}

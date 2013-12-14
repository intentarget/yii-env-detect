<?php

class Environment {
    const DEVEL = 0;
    const TEST  = 1;
    const STAGE = 2;
    const PRODUCTION = 3;

    public static $env;

    public static $debug;
    public static $trace;
    public static $config;

    protected static $dict = array(
        array( /* DEVEL */
            'debug' => true,
            'trace' => 3,
            'config' => 'devel.php',
        ),
        array( /* TEST */
            'debug' => true,
            'trace' => 3,
            'config' => 'test.php',
        ),
        array( /* STAGE */
            'debug' => true,
            'trace' => 3,
            'config' => 'stage.php',
        ),
        array( /* PRODUCTION */
            'debug' => true,
            'trace' => 3,
            'config' => 'main.php'
        ),
    );

    public static function detect() {
        if (self::$env == null) {
            // detect
            self::$env = self::PRODUCTION;
            if (isset($_SERVER['APPLICATION_ENV'])) {
                $env = strtoupper($_SERVER['APPLICATION_ENV']);
                if (defined("self::$env")) {
                    self::$env = constant("self::$env");
                }
            }

            foreach(self::$dict[self::$env] as $property => $value) {
                self::$$property = $value;
            }

            // clean
            self::$dict = null;
        }
    }
}

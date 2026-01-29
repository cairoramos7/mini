<?php

class EventManager {
    private static $listeners = [];

    public static function listen($event, $callback) {
        if (!isset(self::$listeners[$event])) {
            self::$listeners[$event] = [];
        }
        self::$listeners[$event][] = $callback;
    }

    public static function dispatch($event, $data = null) {
        if (isset(self::$listeners[$event])) {
            foreach (self::$listeners[$event] as $callback) {
                call_user_func($callback, $data);
            }
        }
    }
}

<?php

namespace Config;

class Route
{
    const CONTROLLER_NAMESPACE = 'Controller\\';
    private static $url;

    public function __construct($request)
    {
        self::$url = $this->formataRequest($request);
    }

    public function view($param)
    {
        $view = self::formataCaminhoView($param);
        require(WWW_ROOT.'/layout/header.php');
        include_once $view;
        require(WWW_ROOT.'/layout/footer.php');
    }

    public function controller($url, $controller, $action = 'index', $params = array())
    {
        if (self::$url == $url) {
            $controller = self::formataNomeController($controller);
            $action = self::formataNomeAction($action);

            if (class_exists($controller)) {
                $objController = new $controller();

                if (method_exists($objController, $action)) {
                    $objController->$action();
                }
            }
        }
    }

    public static function add($url, $callback)
    {
        if (self::$url == $url) {
            call_user_func($callback);
        }
    }

    public static function addController($url, $callback)
    {
        if (self::$url == $url) {
            call_user_func($callback);
        }
    }

    private function formataCaminhoView($view)
    {
        return sprintf(
            '%s%s%s%s%s',
            WWW_ROOT,
            DIRECTORY_SEPARATOR,
            'views',
            DIRECTORY_SEPARATOR,
            "{$view}.html"
        );
    }

    private function formataNomeController($controller)
    {
        $controller = ucwords($controller);

        return sprintf(
            '%s%s',
            self::CONTROLLER_NAMESPACE,
            "{$controller}Controller"
        );
    }

    private function formataNomeAction($action)
    {
        return sprintf(
            '%s%s',
            $action,
            "Action"
        );
    }

    private function formataRequest($request)
    {
        $request = explode("=", $request);
        if (empty($request[1])) {
            return '/';
        }
        return $request[1];
    }
}

<?php

namespace Zbara\Framework\Controller;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Zbara\Framework\Exception\NotFoundHttpException;
use Zbara\Framework\Mysqli\ManagerRegistry;

class Controller
{
    /**
     * @var
     */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->container->$key;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {

        $this->container->$key = $value;
    }



    protected function getConnection(): ManagerRegistry
    {
        return $this->Connection;
    }



    /**
     * Returns a RedirectResponse to the given URL.
     */
    protected function redirect(string $url, int $status = 302): RedirectResponse
    {
        return new RedirectResponse($url, $status);
    }

    protected function createNotFoundException(string $message = 'Not Found', \Throwable $previous = null): NotFoundHttpException
    {
        return new NotFoundHttpException($message, $previous);
    }

}
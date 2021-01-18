<?php
namespace Config;

use Config\RestApi;

class AutoRoutes
{

	private $uris;
	private $methods;
	private $finder;
	private $views;
	private $restApi;
	private $dataMenu;
	private $dataFind;

	public function __construct($uri, $method)
	{

      $this->uris = $uri;
      $this->method = $method;
			$this->finder = "";
			$this->views = "";
			$this->restApi = new RestApi();
			$this->dataMenu = "";
			$this->dataFind ="";
	}

	public function toRoute() {

    // print_r($this->uris);
    // exit();
			if ($this->uris === '/') {
					$this->dataMenu = $this->restApi->loadMenu("");
					// print_r("uyee");
          // exit();
					$this->views = "welcome_message";
					return $this->toRoutes();
			} else {
					$this->dataMenu = $this->restApi->loadMenu("");
					$this->uris = str_replace("/", "", $this->uris);

					$this->finder = $this->findURL($this->uris);
					// print_r($this->uris. $this->finder); exit();
					if ($this->finder == 'false') {
							$this->views = "error\\404";
							return $this->toRoutes();
					} else {
							$this->views = "pages\\".$this->uris."\\index";
							return $this->toRoutes();
					}
			}

	}

	private function toRoutes() {

    $route = Services::routes();
    $route->setDefaultNamespace('App\Controllers');
    // $route->setDefaultController('Home');
    // $route->setDefaultMethod('index');
    $route->setTranslateURIDashes(false);
    // $routes->set404Override();
    $route->setAutoRoute(true);
    // print_r($menu);
    // $jsonData ="{\"pages\": "."\"".$this->views."\""."}";
    // $this->views = json_encode($jsonData);
    // print_r($this->views);
		// exit();
		return $route->get($this->uris, 'Home::index/'.$this->dataMenu. '/'.$this->views.'/');

	}

	private function findURL($urlFind) {

			return $this->dataFind = $this->restApi->findUrls($urlFind);
	}

}

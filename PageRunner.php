<?php

interface Pages {
    const HOME = "home";
    const ADMIN = "admin";
    const WINNERS = "winners";
    const WELCOME = "welcome";
    const NOTREADY = "notready";
    const P404 = "404";
    const ABOUT = "about";
}

class PageRunner {
    private $TO_WIN = "ENTER OUR RAFFLE TO WIN!";
    private $WINNERS = "RAFFLE WINNERS";
    private $DEMO = "CDBU Modern Software Factory Demo For The Central Region";
    private $BUILD = "40";

    private $page;

    function __construct() {
        $path = trim(parse_url(urldecode($_SERVER["REQUEST_URI"]), PHP_URL_PATH), '/');
        // clear file name from path start (it optional in the URL)
        $path = str_ireplace("index.php", "", $path);
        // clear last left slash(es)
        $path = ltrim($path, "/");
        // extract the first path chunk as a page
        list($this->page) = explode('/', $path);
        if (!$this->page) {
            $this->page = Pages::HOME;
        }
    }

    /** loads template */
    function run() {
        include 'template/template.php';
    }

    function buildVersion() {
        // todo: bind it to Jenkins build id
        echo isset($GLOBALS["BUILD"]) ? $GLOBALS["BUILD"] : $this->BUILD;
    }

    function siteName() {
        echo "Raffle";
    }

    function headerText() {
        echo $this->page === Pages::WINNERS ? $this->WINNERS : $this->TO_WIN;
    }

    function subHeaderText() {
        echo $this->DEMO;
    }

    function pageTitle() {
        $title = $this->page;
        echo ucwords(str_replace('-', ' ', $title));
    }

    function axaSnippet() {
        if ($this->page === Pages::HOME || $this->page === Pages::ADMIN) {
            include "plugins/axa.php";
        }
    }

    function pageContent() {
        $content_path = 'content';
        $path = $content_path . '/' . $this->page . '.php';

        if (!file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
            $path = $content_path . '/404.php';
        }

        include $path;
    }
}

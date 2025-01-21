<?php

declare(strict_types = 1);

class ArticleController
{
    private PDO $connexion;

    function __construct()
    {
        try {
            $this->connexion = new PDO('mysql:host=localhost;dbname=becode', 'root', '');
        } catch(PDOException $exception) {
            echo $exception->getMessage();
            sleep(30);
            $this->__construct();
        }
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();
        // Used in the page below

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        $rawArticles = $this->connexion->query('SELECT * FROM articles')->fetchAll();

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
        }

        return $articles;
    }

    public function show()
    {
        // TODO: this can be used for a detail page
    }
}
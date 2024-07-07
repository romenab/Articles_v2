<?php

namespace Articles\Controller;

use Articles\RedirectResponse;
use Articles\Response;
use Articles\Database\Sqlite;

class ArticleController
{
    private Sqlite $db;

    public function __construct(Sqlite $db)
    {
        $this->db = $db;
    }

    public function index(): Response
    {
        $articles = $this->db->getArticles();
        return new Response('index', ['articles' => $articles]);
    }

    public function createView(): Response
    {
        return new Response('create');
    }

    public function createArticle(): RedirectResponse
    {
        $this->db->createArticle($_POST['headline'], $_POST['body']);
        return new RedirectResponse('/');
    }

    public function display(): Response
    {
        $uuid = $_GET['uuid'];
        $article = $this->db->getByUuidArticle($uuid);
        $comments = $this->db->getByUuidComment($uuid);

        return new Response('display', ['articles' => $article, 'comments' => $comments]);
    }

    public function createComment(): RedirectResponse
    {
        $this->db->createComment($_POST['comment'], $_POST['author'], $_POST['uuid']);
        return new RedirectResponse('/display?uuid=' . $_POST['uuid']);
    }

    public function updateView(): Response
    {
        $article = $this->db->getByUuidArticle($_GET['uuid']);
        return new Response('update', ['article' => $article]);
    }

    public function update(): RedirectResponse
    {
        $this->db->updateArticle($_POST['uuid'], $_POST['headline'], $_POST['body']);
        return new RedirectResponse('/');
    }

    public function like(): RedirectResponse
    {
        $this->db->likeArticle($_POST['uuid']);
        return new RedirectResponse('/');
    }

    public function likeComment(): RedirectResponse
    {
        $this->db->likeComment($_POST['comment_uuid']);
        return new RedirectResponse('/display?uuid=' . $_POST['uuid']);
    }

    public function delete(): RedirectResponse
    {
        $this->db->deleteArticle($_POST['uuid']);
        return new RedirectResponse('/');
    }

    public function deleteComment(): RedirectResponse
    {
        $this->db->deleteComment($_POST['comment_uuid']);
        return new RedirectResponse('/display?uuid=' . $_POST['uuid']);
    }
}
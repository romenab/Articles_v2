<?php

use Articles\Controller\ArticleController;

return [
    ['GET', '/', [ArticleController::class, 'index']],
    ['POST', '/', [ArticleController::class, 'delete']],

    ['GET', '/create', [ArticleController::class, 'createView']],
    ['POST', '/create', [ArticleController::class, 'createArticle']],

    ['GET', '/display', [ArticleController::class, 'display']],
    ['POST', '/display', [ArticleController::class, 'createComment']],

    ['GET', '/update', [ArticleController::class, 'updateView']],
    ['POST', '/update', [ArticleController::class, 'update']],

    ['POST', '/like/article', [ArticleController::class, 'like']],
    ['POST', '/delete/comment', [ArticleController::class, 'deleteComment']],
    ['POST', '/like/comment', [ArticleController::class, 'likeComment']],

];
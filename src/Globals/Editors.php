<?php

namespace App\Globals;

use App\Repository\EditorRepository;

class Editors
{
    private $licenceRepository;

    public function __construct(EditorRepository $editorRepository)
    {
        $this->editorRepository = $editorRepository;
    }

    public function getAll() {
        $editors = $this->editorRepository->findAll();
        return $editors;
    }
}
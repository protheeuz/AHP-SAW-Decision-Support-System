<?php

namespace app\components;

use Dompdf\Dompdf;
use Yii;

class Pdf extends Dompdf
{
    public $filename;

    public function __construct()
    {
        parent::__construct();
        $this->filename = "laporan.pdf";
    }

    /**
     * Load a Yii2 view into DomPDF
     *
     * @param string $view The view to load
     * @param array $data The view data
     * @return void
     */
    public function loadView($view, $data = [])
    {
        $html = Yii::$app->view->render($view, $data);
        $this->loadHtml($html);
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream($this->filename, ['Attachment' => false]);
    }
}
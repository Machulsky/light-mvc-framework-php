<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 27.03.2019
 * Time: 16:40
 */
class ErrorController extends Controller
{
    public function showError()
    {
        switch ($this->request->id){
            case 404:
                ob_start();
                $this->view->render('404.php');
                $page = ob_get_contents();
                ob_end_clean();

                if($this->ajax){
                    $ajax['html'] = $page;
                    $ajax['title'] = 'Error 404 title';
                    echo json_encode($ajax);
                    exit();
                }

                $vars = [
                    'content' => $page,
                    'title' => 'Error 404 title',
                    'includes' => $this->includes()
                ];
                $this->view->render('app.php', $vars);
            break;
        }

    }

}
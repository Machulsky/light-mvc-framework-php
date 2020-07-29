<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 26.03.2019
 * Time: 12:39
 */
class PageController extends Controller
{
    public function showPage()
    {
        $content = $this->request->page;
        $pageTitle = 'Static title';

        ob_start();
        $this->view->render('page.php', ['content' => $content]);
        $page = ob_get_contents();
        ob_end_clean();

        if(!$this->ajax)
        {
            $vars = [
                'title' => 'PageTitle',
                'content' => $page,
                'includes' => $this->includes()
            ];

            $this->view->render('app.php', $vars);
        }else{
            $ajax['html'] = $page;
            $ajax['title'] = $pageTitle;
            echo json_encode($ajax);
        }

    }

}
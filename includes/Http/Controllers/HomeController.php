<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 25.03.2019
 * Time: 19:37
 */
class HomeController extends Controller
{

    public function index(){

        $vars = [
            'title' => 'PageTitle',
            'content' => 'PageContent',
            'isMain' => true,
            'includes' => $this->includes()
        ];
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) or empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
        {
            $this->view->render('app.php', $vars);
        }else{

            $ajax['html'] = $vars['content'];
            $ajax['title'] = $vars['title'];

            echo json_encode($ajax);

        }



    }


}
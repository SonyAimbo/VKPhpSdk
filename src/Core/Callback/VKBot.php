<?php


namespace VKSdk\Core\Callback;


class VKBot {

    /**
     * Отправляет Ok для callback
     * https://ru.stackoverflow.com/questions/646326/vk-callback-api-на-один-запрос-много-ответов
     */
    static function sayOk() {
        set_time_limit(0);
        ini_set('display_errors', 'Off');

        // Nginx
        if (is_callable('fastcgi_finish_request')) {
            session_write_close();
            fastcgi_finish_request();
            return True;
        }
        // Apache
        ignore_user_abort(true);

        ob_start();
        header("HTTP/1.1 200 OK");
        header('Content-Encoding: none');
        header('Content-Length: 2');
        header('Connection: close');
        echo 'ok';
        ob_end_flush();
        flush();
        return True;
    }

}
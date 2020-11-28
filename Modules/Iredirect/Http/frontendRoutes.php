<?php

use Illuminate\Routing\Router;
use Modules\Iredirect\Entities\Redirect as Redirect;


try{
    $uri = Request::path();

    $redirect = Redirect::where('from', urldecode($uri))->first();
    if (isset($redirect->from) && !empty($redirect->from)) {

        Route::redirect($redirect->from, '/'.$redirect->to, $redirect->redirect_type);

    }
    Route::any('find-redirect/{url}', function ($url) {
        $redirect = Redirect::where('from', urldecode($url))->first();

        if (isset($redirect->from) && !empty($redirect->from)) {

            try {
                return \Redirect::to('/'.$redirect->to, $redirect->redirect_type);

            } catch (\Throwable $t) {
                Log::error($t->getMessage());
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

        }else{
            return abort(404);
        }
    })->where('url', '.*');
}
catch (Exception $e){
    \Log::error($e->getMessage());
}


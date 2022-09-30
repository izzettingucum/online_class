<?php  
class logout extends controller
{
    public function index()
    {
        session_destroy();
        helper::redirect(SITE_URL);
    }
}

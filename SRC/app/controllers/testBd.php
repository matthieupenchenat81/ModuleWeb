<?php
class testBd extends BaseController {
    public function getS()
    {
        $r = DB::select('select s from test where id = 1');
        return View::make('testBd', array('s' => $r[0]->s));
    }

}
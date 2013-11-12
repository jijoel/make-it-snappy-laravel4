<?php 

use Illuminate\Routing\Redirector as LaravelRedirector;


class Redirector extends LaravelRedirector
{

   /**
     * Create a new redirect response to the previous location.
     *
     * @param  string  $fallback
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\RedirectResponse;
     */
    public function back($fallback = null, $status = 302, $headers = array())
    {
        $back = $this->generator->getRequest()->headers->get('referer');
  
        if (is_null($back))
        {
          $back = $fallback;
        }
    
        return $this->createRedirect($back, $status, $headers);
    }
}

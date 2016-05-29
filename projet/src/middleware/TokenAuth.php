<?php

class TokenAuth extends \Slim\Middleware {

    public function __construct() {
        // Les urls qu'on veut protéger
        $this->protectedUrls = array(
            '\/api\/users\/[0-9]+'      // .../api/users/{idUser}(...)
        );
    }

    /**
     * Deny Access
     *
     */
    public function deny_access() {
        $res = $this->app->response();
        $res->status(401);
    }

    /**
     * Vérifie que le token pour cet utilisateur est valide.
     *
     * @param string $token
     * @return bool
     */
    public function authenticate($idUser, $token) {
       // return true;
        if (!isset($idUser) || !isset($token))
            return false;
        return \app\controller\UtilisateurController::validateToken($idUser, $token);
    }

    /**
     * Cette fonction compare la liste des routes à protéger et vérifie si l'url est protégé.
     *
     * @param string $url
     * @return bool
     */
    public function isProtectedUrl($url) {
        $patterns_flattened = implode('|', $this->protectedUrls);
        $matches = null;
        preg_match('/' . $patterns_flattened . '/', $url, $matches);
        return (count($matches) > 0);
    }

    /**
     * Call
     */
    public function call() {
        // On récupère la route
        $path = $this->app->request->getPathInfo();
        // On regarde si l'url est protégé ou non
        if ($this->isProtectedUrl($path)) {
            // On récupère le token
            $tokenAuth = $this->app->request->headers->get('Auth'); /* 'Auth' */
            // On récupère l'idUser
            preg_match('/\/([0-9]*)\//s', $path, $matches);
            $idUser = $matches[1];
            // Si l'url est protégé, on vérifie le token
            if ($this->authenticate($idUser, $tokenAuth)) {
                //Continue with execution
                $this->next->call();
            } else {
                $this->deny_access();
            }
        }
        else {
            // si public, on continue tout simplement
            $this->next->call();
        }
    }

}
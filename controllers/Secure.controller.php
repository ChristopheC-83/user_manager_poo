<?php

class Secure
{

    public function secureHTML($chaine)
    {
        return htmlentities($chaine);
    }

    public function estConnecte()
    {
        return (!empty($_SESSION['profil']['login']));
    }
}

<?php

class Secure
{

    public function secureHTML($chaine)
    {
        return htmlentities($chaine);
    }

    public function isConnected()
    {
        return (!empty($_SESSION['profil']['login']));
    }
}

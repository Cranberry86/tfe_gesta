<?php

namespace Repository;

class Controller_Repository extends \Controller_Main
{
    protected $dir = 'repository/';
    public $title = 'Repository';
    public $data = array();
    
    /**
     * Redirige toute personne non membre du groupe "100"
     */
    public function before()
    {
        parent::before();

        if (!\Auth::member(100)) {
            \Session::set('direction', '/repository');
            \Response::redirect('users/login');
        }
    }
    
    /**
     * Affiche le statut du repository Github
     */
    public function action_status()
    {
        $this->data['title'] = $this->title;
        
        \Config::load('repository');
        $path = \Config::get('path');
        $portal = array();
        $error = null;
        
        if(!isset($path))
            $error = "Le chemin vers le repository Github n'est pas défini. Veuillez vous référer au document app/config/repository.php.";
        else
        {
            $portal['incoming_changes'] = shell_exec("cd $path && git fetch && git log ..origin/master");
            $portal['modified_files'] = shell_exec("cd $path && git status -s");
        }
        
        $this->data['portal'] = $portal;
        $this->data['error'] = $error;
        return $this->theme->view($this->dir.'index', $this->data);
    }
    
    /**
     * Met à jour l'application s'il n'y a aucune modification locale
     */
    public function action_update()
    {
        \Config::load('repository');
        $path = \Config::get('path');
        
        $local_changes = shell_exec("cd $path && git status -s");
        if(empty($local_changes))
        {
            // Pour que la commande suivante fonctionne, le dossier
            // doit être en +rw pour le groupe (www-data)
            shell_exec("cd $path && git pull");
        }
        
        \Response::redirect($this->dir . 'status');
    }

}

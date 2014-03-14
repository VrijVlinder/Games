<?php if(!defined('APPLICATION')) die();

$PluginInfo['Games'] = array(
   'Name' => 'Games',
   'Description' => "Adds a Games Pages for you to put any games you want.Based on peregrine's ExtraPage",
   'Version' => '1.2',
   'Author' => "VrijVlinder"
);

class GamesPlugin extends Gdn_Plugin {

    public function Base_Render_Before($Sender) {
        
        $Session = Gdn::Session();
       if ($Sender->Menu) {
           $Sender->Menu->AddLink(T('Games'), T('Games'), 'games');
         }
    }

   

    public function PluginController_Games_Create($Sender) {
   
        $Session = Gdn::Session();

        if ($Sender->Menu)  {
            $Sender->ClearCssFiles();
            $Sender->AddCssFile('style.css');
            $Sender->RemoveCssFile('admin.css');
            $Sender->RemoveCssFile('customadmin.css');
            $Sender->AddCssFile('games.css', 'plugins/Games');
            $Sender->MasterView = 'default';

            $Sender->Render('Games', '', 'plugins/Games');
        }
    
   
    }

    public function OnDisable() {
            $matchroute = '^games(/.*)?$';
             
             Gdn::Router()-> DeleteRoute($matchroute); 
  
  }
 
    public function Setup() {
  
             $matchroute = '^games(/.*)?$';
             $target = 'plugin/Games$1';
        
             if(!Gdn::Router()->MatchRoute($matchroute))
                  Gdn::Router()->SetRoute($matchroute,$target,'Internal'); 
          
    }

}

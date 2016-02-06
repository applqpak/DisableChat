<?php

  namespace DisableChat;
  
  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\event\player\PlayerChatEvent;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;
  
  class Main extends PluginBase implements Listener {
  
    public $disableChat = false;
  
    public function onEnable() {
    
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
    
    }
    
    public function onChat(PlayerChatEvent $event) {
    
      if(!($event->getPlayer()->hasPermission("disablechat.chat"))) {
      
        if($this->disableChat) {
        
          $event->setCancelled(true);
          
          $event->getPlayer()->sendMessage(TF::YELLOW . "The Chat Is Disabled.");
          
        }
        
      }
      
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    
      if(strtolower($cmd->getName()) === "disablechat") {
      
        if($this->disableChat) {
        
          $this->disableChat = false;
          
          $sender->sendMessage(TF::GREEN . "Enabled Chat.");
          
          return true;
          
        }
        
        $this->disableChat = true;
        
        $sender->sendMessage(TF::GREEN . "Disabled Chat.");
        
        return true;
        
      }
      
    }
    
  }
  
?>

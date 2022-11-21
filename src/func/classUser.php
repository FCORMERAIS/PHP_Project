<?php
class User {
    public $name;
    public $id;
    public $idGroup;
    public $invitationGroups;
    public function __construct(string $name, int $id, int $idGroup, string $invitationGroups){
        $this->name = $name;
        $this->id = $id;
        $this->idGroup = $idGroup;
        $this->invitationGroups = $invitationGroups;
    }
}
?>
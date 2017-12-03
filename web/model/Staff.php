<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.26.0-b05b57321 modeling language!*/

class Staff
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static $nextId = 1;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Staff Attributes
  private $name;
  private $progress;

  //Autounique Attributes
  private $id;

  //Staff State Machines
  private static $RoleResearcher = 1;
  private static $RoleResearchAssistant = 2;
  private $Role;

  //Staff Associations
  private $lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aName, $aProgress, $aLab)
  {
    $this->name = $aName;
    $this->progress = $aProgress;
    $this->id = self::$nextId++;
    $didAddLab = $this->setLab($aLab);
    if (!$didAddLab)
    {
      throw new Exception("Unable to create staff due to lab");
    }
    $this->setRole(self::$RoleResearcher);
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setName($aName)
  {
    $wasSet = false;
    $this->name = $aName;
    $wasSet = true;
    return $wasSet;
  }

  public function setProgress($aProgress)
  {
    $wasSet = false;
    $this->progress = $aProgress;
    $wasSet = true;
    return $wasSet;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getProgress()
  {
    return $this->progress;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getRoleFullName()
  {
    $answer = $this->getRole();
    return $answer;
  }

  public function getRole()
  {
    if ($this->Role == self::$RoleResearcher) { return "RoleResearcher"; }
    elseif ($this->Role == self::$RoleResearchAssistant) { return "RoleResearchAssistant"; }
    return null;
  }

  public function setRole($aRole)
  {
    if ($aRole == "RoleResearcher" || $aRole == self::$RoleResearcher)
    {
      $this->Role = self::$RoleResearcher;
      return true;
    }
    elseif ($aRole == "RoleResearchAssistant" || $aRole == self::$RoleResearchAssistant)
    {
      $this->Role = self::$RoleResearchAssistant;
      return true;
    }
    else
    {
      return false;
    }
  }

  public function getLab()
  {
    return $this->lab;
  }

  public function setLab($aLab)
  {
    $wasSet = false;
    if ($aLab == null)
    {
      return $wasSet;
    }
    
    $existingLab = $this->lab;
    $this->lab = $aLab;
    if ($existingLab != null && $existingLab != $aLab)
    {
      $existingLab->removeStaff($this);
    }
    $this->lab->addStaff($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $placeholderLab = $this->lab;
    $this->lab = null;
    $placeholderLab->removeStaff($this);
  }

}
?>
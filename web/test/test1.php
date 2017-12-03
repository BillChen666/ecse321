<?php
$my_dir = dirname(__FILE__);
require_once $my_dir . '/../model/URLMS.php';
require_once $my_dir . '/../model/Lab.php';
require_once $my_dir . '/../persistence/PersistenceLabManagement.php';

class PersistenceLabManagementTest extends PHPUnit_Framework_TestCase
{
    protected $pm;
    
    protected function setUp()
    {
        $this->pm = new PersistenceLabManagement();
    }
    
    protected function tearDown()
    {
    }
    
    public function testPersistence()
    {
        // 1. Create test data
        $Lm = URLMS::getInstance();
        $lab = new Lab("Frank","123","123","1");
        $Lm->addLab($lab);
        
        // 2. Write all of the data
        $this->pm->writeDataToStore($Lm);
        
        // 3. Clear the data from memory
        $Lm->delete();
        
        $this->assertEquals(0, count($Lm->getLab()));
        
        // 4. Load it back in
        $Lm = $this->pm->loadDataFromStore();
        
        // 5. Check that we got it back
        $this->assertEquals(1, count($Lm-> getLab()));
        $myLab = $Lm->getLab_index(0);
        $this->assertEquals("Frank", $myLab->getUsername());
    }
    
}
?>

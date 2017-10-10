/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.25.0-9e8af9e modeling language!*/

package ca.mcgill.ecse321.model;
import java.util.*;

// line 32 "../../../../../main.ump"
public class URLMS
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static URLMS theInstance = null;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //URLMS Associations
  private List<Lab> lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  private URLMS()
  {
    lab = new ArrayList<Lab>();
  }

  public static URLMS getInstance()
  {
    if(theInstance == null)
    {
      theInstance = new URLMS();
    }
    return theInstance;
  }

  //------------------------
  // INTERFACE
  //------------------------

  public Lab getLab(int index)
  {
    Lab aLab = lab.get(index);
    return aLab;
  }

  public List<Lab> getLab()
  {
    List<Lab> newLab = Collections.unmodifiableList(lab);
    return newLab;
  }

  public int numberOfLab()
  {
    int number = lab.size();
    return number;
  }

  public boolean hasLab()
  {
    boolean has = lab.size() > 0;
    return has;
  }

  public int indexOfLab(Lab aLab)
  {
    int index = lab.indexOf(aLab);
    return index;
  }

  public static int minimumNumberOfLab()
  {
    return 0;
  }

  public Lab addLab(String aUsername, String aPassword, double aAccountBalance)
  {
    return new Lab(aUsername, aPassword, aAccountBalance, this);
  }

  public boolean addLab(Lab aLab)
  {
    boolean wasAdded = false;
    if (lab.contains(aLab)) { return false; }
    URLMS existingURLMS = aLab.getURLMS();
    boolean isNewURLMS = existingURLMS != null && !this.equals(existingURLMS);
    if (isNewURLMS)
    {
      aLab.setURLMS(this);
    }
    else
    {
      lab.add(aLab);
    }
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeLab(Lab aLab)
  {
    boolean wasRemoved = false;
    //Unable to remove aLab, as it must always have a uRLMS
    if (!this.equals(aLab.getURLMS()))
    {
      lab.remove(aLab);
      wasRemoved = true;
    }
    return wasRemoved;
  }

  public boolean addLabAt(Lab aLab, int index)
  {  
    boolean wasAdded = false;
    if(addLab(aLab))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfLab()) { index = numberOfLab() - 1; }
      lab.remove(aLab);
      lab.add(index, aLab);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveLabAt(Lab aLab, int index)
  {
    boolean wasAdded = false;
    if(lab.contains(aLab))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfLab()) { index = numberOfLab() - 1; }
      lab.remove(aLab);
      lab.add(index, aLab);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addLabAt(aLab, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    while (lab.size() > 0)
    {
      Lab aLab = lab.get(lab.size() - 1);
      aLab.delete();
      lab.remove(aLab);
    }
    
  }

}
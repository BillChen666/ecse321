/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.25.0-9e8af9e modeling language!*/

package ca.mcgill.ecse321.model;

// line 7 "../../../../../main.ump"
public class Staff
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static int nextId = 1;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Staff Attributes
  private String name;
  private String progress;

  //Autounique Attributes
  private int id;

  //Staff State Machines
  public enum Role { researcher, researchAssistant }
  private Role role;

  //Staff Associations
  private Lab lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Staff(String aName, String aProgress, Lab aLab)
  {
    name = aName;
    progress = aProgress;
    id = nextId++;
    boolean didAddLab = setLab(aLab);
    if (!didAddLab)
    {
      throw new RuntimeException("Unable to create staff due to lab");
    }
    setRole(Role.researcher);
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setName(String aName)
  {
    boolean wasSet = false;
    name = aName;
    wasSet = true;
    return wasSet;
  }

  public boolean setProgress(String aProgress)
  {
    boolean wasSet = false;
    progress = aProgress;
    wasSet = true;
    return wasSet;
  }

  public String getName()
  {
    return name;
  }

  public String getProgress()
  {
    return progress;
  }

  public int getId()
  {
    return id;
  }

  public String getRoleFullName()
  {
    String answer = role.toString();
    return answer;
  }

  public Role getRole()
  {
    return role;
  }

  public boolean setRole(Role aRole)
  {
    role = aRole;
    return true;
  }

  public Lab getLab()
  {
    return lab;
  }

  public boolean setLab(Lab aLab)
  {
    boolean wasSet = false;
    if (aLab == null)
    {
      return wasSet;
    }

    Lab existingLab = lab;
    lab = aLab;
    if (existingLab != null && !existingLab.equals(aLab))
    {
      existingLab.removeStaff(this);
    }
    lab.addStaff(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Lab placeholderLab = lab;
    this.lab = null;
    placeholderLab.removeStaff(this);
  }


  public String toString()
  {
    String outputString = "";
    return super.toString() + "["+
            "id" + ":" + getId()+ "," +
            "name" + ":" + getName()+ "," +
            "progress" + ":" + getProgress()+ "]" + System.getProperties().getProperty("line.separator") +
            "  " + "lab = "+(getLab()!=null?Integer.toHexString(System.identityHashCode(getLab())):"null")
     + outputString;
  }
}
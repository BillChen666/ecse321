/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.25.0-9e8af9e modeling language!*/

package ca.mcgill.ecse321.managementSystem.model;

// line 27 "../../../../../main.ump"
public class Expense
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Expense Attributes
  private String reason;
  private double amountPaid;

  //Expense Associations
  private Lab lab;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Expense(String aReason, double aAmountPaid, Lab aLab)
  {
    reason = aReason;
    amountPaid = aAmountPaid;
    boolean didAddLab = setLab(aLab);
    if (!didAddLab)
    {
      throw new RuntimeException("Unable to create expense due to lab");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setReason(String aReason)
  {
    boolean wasSet = false;
    reason = aReason;
    wasSet = true;
    return wasSet;
  }

  public boolean setAmountPaid(double aAmountPaid)
  {
    boolean wasSet = false;
    amountPaid = aAmountPaid;
    wasSet = true;
    return wasSet;
  }

  public String getReason()
  {
    return reason;
  }

  public double getAmountPaid()
  {
    return amountPaid;
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
      existingLab.removeExpense(this);
    }
    lab.addExpense(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Lab placeholderLab = lab;
    this.lab = null;
    placeholderLab.removeExpense(this);
  }


  public String toString()
  {
    String outputString = "";
    return super.toString() + "["+
            "reason" + ":" + getReason()+ "," +
            "amountPaid" + ":" + getAmountPaid()+ "]" + System.getProperties().getProperty("line.separator") +
            "  " + "lab = "+(getLab()!=null?Integer.toHexString(System.identityHashCode(getLab())):"null")
     + outputString;
  }
}
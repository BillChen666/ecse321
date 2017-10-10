package ca.mcgill.ecse321.managementSystem.persistence;

import java.util.Iterator;
import java.util.List;

import ca.mcgill.ecse321.managementSystem.model.Equipment;
import ca.mcgill.ecse321.managementSystem.model.Expense;
import ca.mcgill.ecse321.managementSystem.model.Lab;
import ca.mcgill.ecse321.managementSystem.model.Staff;
import ca.mcgill.ecse321.managementSystem.model.Supply;
import ca.mcgill.ecse321.managementSystem.model.URLMS;



public class PersistenceLab {
private static String filename = "ManagementSystem.xml";
	
	public static void setFilename(String name) {
		filename = name;
	}
	
	/**
	 * Initializes variables so that XStream can work.
	 */
	
	private static void initializeXStream() {
		PersistenceXStream.setFilename(filename);
		PersistenceXStream.setAlias("equipment", Equipment.class);
		PersistenceXStream.setAlias("lab", Lab.class);
		PersistenceXStream.setAlias("supply", Supply.class);
		PersistenceXStream.setAlias("expense", Expense.class);
		PersistenceXStream.setAlias("staff", Staff.class);
		PersistenceXStream.setAlias("systemProgram", URLMS.class);
	}
	
	public static void loadModel() {
		URLMS systemProgram= URLMS.getInstance();
		PersistenceLab.initializeXStream();
		URLMS systemProgram2 = (URLMS) PersistenceXStream.loadFromXMLwithXStream();
		
		if (systemProgram2 != null) {
			
			//copy loaded model into system
		 	Iterator<Lab> labIterator = systemProgram2.getLab().iterator();
			while (labIterator.hasNext()) {
				Lab thisLab2=labIterator.next();
				Lab thisLab=new Lab(thisLab2.getUsername(),thisLab2.getPassword(),thisLab2.getAccountBalance(),systemProgram);
				
		  		 Iterator<Staff> staffIterator = thisLab2.getStaffs().iterator();
				 while (staffIterator.hasNext()) {
					    Staff thisStaff2=staffIterator.next();
					    Staff thisStaff=new Staff(thisStaff2.getName(),thisStaff2.getProgress(),thisLab);
						thisLab.addStaff(thisStaff);
					  }
				
				 Iterator<Supply> supplyIterator = thisLab2.getSupplies().iterator();
				  while (supplyIterator.hasNext()) {
					  Supply thisSupply2=supplyIterator.next();
					  Supply thisSupply=new Supply(thisSupply2.getName(),thisSupply2.getQuantity(),thisLab);
					  thisLab.addSupply(thisSupply);
				  }
				  
				  Iterator<Equipment> equipmentIterator = thisLab2.getEquipments().iterator();
				  while (equipmentIterator.hasNext()) {
					  Equipment thisEqui2=equipmentIterator.next();
					  Equipment thisEqui=new Equipment(thisEqui2.getName(),thisEqui2.getQuantity(),thisLab);
					  thisLab.addEquipment(thisEqui);
				  }
				  
				  Iterator<Expense> expenseIterator = thisLab2.getExpenses().iterator();
				  while (expenseIterator.hasNext()) {
					 Expense thisex2=expenseIterator.next();
					 Expense thisex=new Expense(thisex2.getReason(),thisex2.getAmountPaid(),thisLab);
					thisLab.addExpense(thisex);
				  }
								
				
				
				systemProgram.addLab(thisLab);
	
			}
			
			
		}
		
		
	}
	
	
	
	
	
}

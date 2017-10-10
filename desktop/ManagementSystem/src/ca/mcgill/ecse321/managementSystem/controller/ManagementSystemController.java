package ca.mcgill.ecse321.managementSystem.controller;

import ca.mcgill.ecse321.managementSystem.model.Staff;
import ca.mcgill.ecse321.managementSystem.model.Staff.Role;
import ca.mcgill.ecse321.managementSystem.model.Equipment;
import ca.mcgill.ecse321.managementSystem.model.Expense;
import ca.mcgill.ecse321.managementSystem.model.Lab;
import ca.mcgill.ecse321.managementSystem.model.Supply;
import ca.mcgill.ecse321.managementSystem.model.URLMS;
import ca.mcgill.ecse321.managementSystem.persistence.*;


import java.util.List;
import ca.mcgill.ecse321.managementSystem.controller.InvalidInputException;



public class ManagementSystemController {
	private Lab currentLab;
	
	//constructor
	public ManagementSystemController(){
		
	}
	
	public boolean register(String username, String password) throws InvalidInputException{
		URLMS systemProgram= URLMS.getInstance();
		boolean success=true;
		//check if username is valid
		if(isEmpty(username)){
			success=false;
			throw new InvalidInputException("The username is empty!");
		}
		//check if username is duplicated
		List<Lab> lablist = systemProgram.getLab();
		for(Lab lab:lablist){
	    	if((lab.getUsername()).equals(username)){
	    		success=false;
	    	 throw new InvalidInputException("The lab username is duplicated!");
	    	}
	    }
		
		//check if password is valid
		if(isEmpty(password)){
			success=false;
			throw new InvalidInputException("The password is empty!");
		}
	   
		//create a new lab account
		Lab newLab= new Lab(username, password,0, systemProgram);
		systemProgram.addLab(newLab);
		PersistenceXStream.saveToXMLwithXStream(systemProgram);
		return success;
	}
	
	
	
	public boolean Login(String username, String password){
		URLMS systemProgram= URLMS.getInstance();
		
		//check if username is valid
		if(isEmpty(username)){
		   return false;
			}
		
		//check if username exists
		List<Lab> lablist = systemProgram.getLab();
		for(Lab lab:lablist){
	    	if((lab.getUsername()).equals(username)){
	    	  //check the password
	    		if((lab.getPassword()).equals(password)){
	    			currentLab=lab;
	    			PersistenceXStream.saveToXMLwithXStream(systemProgram);
	    			return true;
	    		}
	    		else break;
	    	}
	    }		
		PersistenceXStream.saveToXMLwithXStream(systemProgram);
		return false;
	}

	
	public void Logout(){
		URLMS systemProgram= URLMS.getInstance();
	    PersistenceXStream.saveToXMLwithXStream(systemProgram);
		currentLab=null;
		return;
	}
	
	
	
	public void createStuff(String staffName, String roleType)throws InvalidInputException{
		URLMS systemProgram= URLMS.getInstance();
		Lab lab=currentLab;
		
		//check if staffName is valid 
		if(isEmpty(staffName)){
			throw new InvalidInputException("The staff name is empty!");
		}
		
		//check if the roleType is valid
		if((!roleType.equals("researcher")) && (!roleType.equals("researchAssistant"))){
			throw new InvalidInputException("The role type is not valid!");
		}	
		
	    List<Staff> stafflist= lab.getStaffs();	    
	    //check if the staff exist
	    for(Staff staff: stafflist){
	    	if((staff.getName()).equals(staffName)){
	    	 throw new InvalidInputException("The staff name is duplicated!");
	    	}
	    }
	    
	    //add staff to the system
	    Staff newStaff= new Staff(staffName, "", lab);
	    if(roleType.equals("researcher"))
	       newStaff.setRole(Role.researcher);
	    else
	       newStaff.setRole(Role.researchAssistant);
	    
	    lab.addStaff(newStaff);	 
	    PersistenceXStream.saveToXMLwithXStream(systemProgram);
	    return;
	    
	    
    }
	
	
   public void addEquipments(String equipmentName, int quantity)throws InvalidInputException{
	    Lab lab=currentLab;
		
		//check if equipmentName is valid 
		if(isEmpty(equipmentName)){
			throw new InvalidInputException("The equipment name is empty!");
		}
		
		//check if the quantity is valid 
		if(quantity<=0){
			throw new InvalidInputException("Invalid quantity!");
		}
			
	    List<Equipment> equipmentlist= lab.getEquipments();    
	    //check if the equipment exist
	    for(Equipment equipment: equipmentlist){
	    	if((equipment.getName()).equals(equipmentName)){
	    	 int count=equipment.getQuantity();
	    	 equipment.setQuantity(count+quantity);
	    	 return;
	    	}
	    }
	    
	    //if not exist, add equipment to the system	   
	    	Equipment newEquip=new Equipment(equipmentName, quantity, lab);
	    	lab.addEquipment(newEquip);
	    	URLMS systemProgram= URLMS.getInstance();
	    	PersistenceXStream.saveToXMLwithXStream(systemProgram);
	    return;
	    
    }
   
   
   public void addSupplies(String supplyname, int quantity )throws InvalidInputException{
	    Lab lab=currentLab;
		
		//check if supply name is valid 
		if(isEmpty(supplyname)){
			throw new InvalidInputException("The supplyname is empty!");
		}
		
		//check if the quantity is valid 
		if(quantity<=0){
			throw new InvalidInputException("Invalid quantity!");
		}
			
	    List<Supply> supplylist= lab.getSupplies();    
	    //check if the supply exist
	    for(Supply supply: supplylist){
	    	if((supply.getName()).equals(supplyname)){
	    	 int count=supply.getQuantity();
	    	 supply.setQuantity(count+quantity);
	    	 URLMS systemProgram= URLMS.getInstance();
		     PersistenceXStream.saveToXMLwithXStream(systemProgram);
	    	 return;
	    	}
	    }	    
	    //if not exist, add supply to the system	    
	    	Supply newSupply=new Supply(supplyname, quantity, lab);
	    	lab.addSupply(newSupply);	
	    	URLMS systemProgram= URLMS.getInstance();
	    	PersistenceXStream.saveToXMLwithXStream(systemProgram);
	        return;
   }
   
   
   public void addExpense(String reason, double amount) throws InvalidInputException{
	   Lab lab=currentLab;
		
		//check if the amount is valid 
		if(amount<0){
			throw new InvalidInputException("amount should be positive!");
		}
		
		// add expense to lab account
		Expense newExpense=new Expense(reason, amount, lab);
		lab.addExpense(newExpense);
		lab.setAccountBalance(lab.getAccountBalance()+amount);
		
		URLMS systemProgram= URLMS.getInstance();
    	PersistenceXStream.saveToXMLwithXStream(systemProgram);
		return;		
   }
   
   
   
   public List<Staff> checkStaffs(){
	   List<Staff> staffs=currentLab.getStaffs();
	return staffs;
	   
   }
   
   public List<Equipment> checkEquipments(){
	   List<Equipment> equipments=currentLab.getEquipments();
	return equipments;
	   
   }
   
   
   public List<Supply> checkSupplies(){
	   List<Supply> supplies=currentLab.getSupplies();
	return supplies;
	   
   }
   
   
   public List<Expense> checkExpenses(){
	   List<Expense> expenses=currentLab.getExpenses();
	   return expenses;
   }
   
   public double getBalance(){
	  return currentLab.getAccountBalance();
	  
   }
   
   
   private boolean isEmpty(String text) {
		
		if (text == null || text.trim().length() == 0) {
			return true;
		}
		return false;
	}
   
   
   
   
	
}
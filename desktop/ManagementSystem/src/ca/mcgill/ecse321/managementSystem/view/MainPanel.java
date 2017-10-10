package ca.mcgill.ecse321.managementSystem.view;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import ca.mcgill.ecse321.managementSystem.controller.InvalidInputException;
import ca.mcgill.ecse321.managementSystem.controller.ManagementSystemController;
import ca.mcgill.ecse321.managementSystem.model.Equipment;
import ca.mcgill.ecse321.managementSystem.model.Expense;
import ca.mcgill.ecse321.managementSystem.model.Staff;
import ca.mcgill.ecse321.managementSystem.model.Staff.Role;
import ca.mcgill.ecse321.managementSystem.model.Supply;

import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JButton;
import javax.swing.JComboBox;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.text.NumberFormat;
import java.util.Iterator;
import java.util.List;

import javax.swing.JFormattedTextField;
import javax.swing.JSeparator;
import java.awt.Color;
import javax.swing.SwingConstants;
import javax.swing.JTable;
import javax.swing.JCheckBox;
import javax.swing.JTextArea;

public class MainPanel extends JFrame {

	
	private ManagementSystemController controller;
	private JPanel contentPane;
	
	//name
	private JTextField textField;
	private JTextField textField_1;
	private JTextField textField_2;
	private JTextField textField_3;
	
	private JCheckBox chckbxResearcher;
	private JCheckBox chckbxResearchAssistant;
    private JFormattedTextField formattedTextField;
    private JFormattedTextField formattedTextField_1;
    private JFormattedTextField formattedTextField_2;
    
   //confirm
    private JButton btnConfirm;
    private JButton btnConfirm_1;
    private JButton btnConfirm_2;
    private JButton btnConfirm_3;
    private JButton btnUpdateStuff;
    private JButton btnUpdateEquipment;
    private JButton btnUpdateSupply;
    private JButton btnUpdateExpense;
  
    //display data
    private JTable table;
    private Object[][] data;
    private String[] columns;
    private JTextArea textArea;
    
     //logout
    private JButton btnLogOut;
    
    //others
    private String role="";
   
	/** 
	 * Create the frame.
	 */
	public MainPanel(ManagementSystemController controller) {
		       this.controller=controller;
		       setting();	             		      	        
		       listen();
		        
	}
	
	private void listen() {
		
		
		 btnLogOut.addActionListener(new ActionListener() {

				public void actionPerformed(ActionEvent e) {
					try {
						
						   controller.Logout();
						   Login frame = new Login(controller);
						   frame.setVisible(true);
						   dispose();
						
							
						}
						
					 catch (Exception e1) {
                             Exceptions frame = new Exceptions("log out fails");
							frame.setVisible(true);
					}
				}
			});
		
		//create staff
		btnConfirm.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					String name=textField.getText();
					if (chckbxResearcher.isSelected() && chckbxResearchAssistant.isSelected()){
						Exceptions frame = new Exceptions("You cannot have 2 roles.");
						frame.setVisible(true);
						
					}
					else if(chckbxResearcher.isSelected()){
						String role="researcher";
						controller.createStuff(name, role);
						Exceptions frame1 = new Exceptions("create success! name:"+name+" role:"+role);
						frame1.setVisible(true);
					}
					else if(chckbxResearchAssistant.isSelected()){
						String role="researchAssistant";
						controller.createStuff(name, role);
						Exceptions frame1 = new Exceptions("create success! name:"+name+" role:"+role);
						frame1.setVisible(true);
					}
					else{
						Exceptions frame = new Exceptions("You must select one role.");
						frame.setVisible(true);						
					}									   
				} catch (Exception e1) {
				}
			}
		});
		
		
		btnUpdateStuff.addActionListener(new ActionListener() {

				public void actionPerformed(ActionEvent e) {
					try {
						
						displayStaffTable();
						
					} catch (Exception e1) {

					}
				}
				
				public void displayStaffTable(){
					
					 List<Staff> stafflist=controller.checkStaffs();	
					 Iterator<Staff> staffIterator = stafflist.iterator();
					 String content="";
					 for(int i=0; i<stafflist.size();i++){
					   if (staffIterator.hasNext()) {
						Staff staff=staffIterator.next();
						content=content+staff.getName()+" "+staff.getRoleFullName()+""+staff.getProgress()+"\n";
						System.out.print(content);
					  }
					 }		 						   
						DisplayTable table=new DisplayTable(controller,content);
					    table.setVisible(true);
					 	 contentPane.repaint();
				}
				
				
			});
		
		
		
		//create equipment
				btnConfirm_1.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {
							String name=textField_1.getText();
							int quantity= ((Number)formattedTextField.getValue()).intValue();
							System.out.print(quantity);
							
							try{
							controller.addEquipments(name, quantity);
							Exceptions frame1 = new Exceptions("add success! name:"+name+" quantity:"+quantity);
						    frame1.setVisible(true);
							}
							catch(Exception e1){
								Exceptions frame1 = new Exceptions("add fail! name:"+name+" quantity:"+quantity);
							    frame1.setVisible(true);
							}
								
														   
						} catch (Exception e1) {
							System.out.print(e1);
						}
					}
				});
		
				
			//get equipment table	
				btnUpdateEquipment.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {						
							displayEquipmentTable();
							
						} catch (Exception e1) {

						}
					}

					private void displayEquipmentTable() {
												   
						List<Equipment> equipmentlist= controller.checkEquipments();  
						 String content="";
						for(Equipment equipment: equipmentlist){
					    	 String name=equipment.getName();
					    	 int count=equipment.getQuantity();				    	
					    	 content=content+name+" "+count+"\n";
								System.out.print(content);
					    	 
					    	}
						
							DisplayTable table=new DisplayTable(controller,content);
						    table.setVisible(true);
						 	 contentPane.repaint();						
						
					    }					
					
				});	
				
				
				//create supply
				btnConfirm_2.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {
							String name=textField_2.getText();
							int quantity= ((Number)formattedTextField_1.getValue()).intValue();
							System.out.print(quantity);
							
							try{
							controller.addSupplies(name, quantity);
							Exceptions frame1 = new Exceptions("add success! name:"+name+" quantity:"+quantity);
						    frame1.setVisible(true);
							}
							catch(Exception e1){
								Exceptions frame1 = new Exceptions("add fail! name:"+name+" quantity:"+quantity);
							    frame1.setVisible(true);
							}
								
														   
						} catch (Exception e1) {
							System.out.print(e1);
						}
					}
				});
		
				
				//get supply table	
				btnUpdateSupply.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {						
							displaySupplyTable();
							
						} catch (Exception e1) {
							
						}
					}

					private void displaySupplyTable() {
						System.out.print("nooo");						   
						List<Supply> supplylist= controller.checkSupplies();  
						 String content="";
						for(Supply supply: supplylist){
					    	 String name=supply.getName();
					    	 int count=supply.getQuantity();				    	
					    	 content=content+name+" "+count+"\n";
								System.out.print(content);
					    	 
					    	}
						
							DisplayTable table=new DisplayTable(controller,content);
						    table.setVisible(true);
						 	 contentPane.repaint();						
						
					    }					
					
				});		
		
				
				
				//create expense
				btnConfirm_3.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {
							String name=textField_3.getText();
							double amount= ((Number)formattedTextField_2.getValue()).doubleValue();
							System.out.print(amount);
							
							try{
							controller.addExpense(name, amount);
							Exceptions frame1 = new Exceptions("add success! reason:"+name+" amount:"+amount);
						    frame1.setVisible(true);
							}
							catch(Exception e1){
								Exceptions frame1 = new Exceptions("add fail! reason:"+name+" amount:"+amount);
							    frame1.setVisible(true);
							}
								
														   
						} catch (Exception e1) {
							System.out.print(e1);
						}
					}
				});
				
				
				//get expense table	
				btnUpdateExpense.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						try {						
							displayExpenseTable();
							
						} catch (Exception e1) {
							System.out.print(e1);
						}
					}

					private void displayExpenseTable() {
						System.out.print("111");						   
						List<Expense> expenselist= controller.checkExpenses(); 
						 String content="account balance:"+controller.getBalance()+"\n";
						for(Expense expense: expenselist){
					    	 String reason=expense.getReason();
					    	 double amount=expense.getAmountPaid();				    	
					    	 content=content+reason+" "+amount+"\n";
								System.out.print(content);
					    	 
					    	}
						
							DisplayTable table=new DisplayTable(controller,content);
						    table.setVisible(true);
						 	 contentPane.repaint();						
						
					    }					
					
				});		
		
	}

	
	
	
	
	public void setting(){
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 846, 603);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		
		    chckbxResearcher = new JCheckBox("researcher");
	        chckbxResearcher.setBounds(99, 117, 139, 29);
	        contentPane.add(chckbxResearcher);
	        
	        chckbxResearchAssistant = new JCheckBox("research assistant");
	        chckbxResearchAssistant.setBounds(99, 154, 166, 29);
	        contentPane.add(chckbxResearchAssistant);
	        
	        
        btnUpdateStuff = new JButton("get stuff list");
        btnUpdateStuff.setBounds(612, 95, 144, 29);
        contentPane.add(btnUpdateStuff);
        
        btnUpdateEquipment = new JButton("get equipment list");
        btnUpdateEquipment.addActionListener(new ActionListener() {
        	public void actionPerformed(ActionEvent e) {
        	}
        });
        btnUpdateEquipment.setBounds(595, 192, 161, 29);
        contentPane.add(btnUpdateEquipment);
        
        btnUpdateSupply = new JButton("get supply list");
        btnUpdateSupply.setBounds(608, 329, 162, 29);
        contentPane.add(btnUpdateSupply);
        
        btnUpdateExpense = new JButton("get expense list");
        btnUpdateExpense.setBounds(609, 434, 162, 29);
        contentPane.add(btnUpdateExpense);
        
        
        textField = new JTextField();
		textField.setBounds(39, 79, 166, 26);
		textField.setColumns(10);
		contentPane.add(textField);
        
		
		JLabel lblAddStuff = new JLabel("add stuff ");
		lblAddStuff.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblAddStuff.setBounds(39, 16, 84, 20);
		contentPane.add(lblAddStuff);
		
		JLabel lblName = new JLabel("name");
		lblName.setBounds(28, 52, 69, 20);
		contentPane.add(lblName);
		
		btnLogOut = new JButton("log out");
		btnLogOut.setBounds(15, 502, 115, 29);
		contentPane.add(btnLogOut);
		
		JLabel lblNewLabel = new JLabel("role type");
		lblNewLabel.setBounds(28, 121, 69, 20);
		contentPane.add(lblNewLabel);
		
		JLabel lblAddEquipment = new JLabel("add equipment");
		lblAddEquipment.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblAddEquipment.setBounds(300, 12, 149, 29);
		contentPane.add(lblAddEquipment);
		
		JLabel label = new JLabel("name");
		label.setBounds(286, 52, 69, 20);
		contentPane.add(label);
		
		textField_1 = new JTextField();
		textField_1.setColumns(10);
		textField_1.setBounds(300, 79, 166, 26);
		contentPane.add(textField_1);
		
		JLabel lblQuantity = new JLabel("quantity");
		lblQuantity.setBounds(286, 117, 69, 20);
		contentPane.add(lblQuantity);
		
	    formattedTextField = new JFormattedTextField(NumberFormat.getIntegerInstance());
		formattedTextField.setBounds(300, 142, 79, 26);
		contentPane.add(formattedTextField);
		
		JLabel lblAddSupply = new JLabel("add supply");
		lblAddSupply.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblAddSupply.setBounds(57, 254, 149, 29);
		contentPane.add(lblAddSupply);
		
		JLabel label_1 = new JLabel("name");
		label_1.setBounds(78, 296, 69, 20);
		contentPane.add(label_1);
		
		textField_2 = new JTextField();
		textField_2.setColumns(10);
		textField_2.setBounds(60, 332, 166, 26);
		contentPane.add(textField_2);
		
		JLabel label_2 = new JLabel("quantity");
		label_2.setBounds(54, 374, 69, 20);
		contentPane.add(label_2);
		
		formattedTextField_1 = new JFormattedTextField(NumberFormat.getIntegerInstance());
		formattedTextField_1.setBounds(60, 405, 79, 26);
		contentPane.add(formattedTextField_1);
		
		JLabel lblAddExpense = new JLabel("add expense");
		lblAddExpense.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblAddExpense.setBounds(300, 246, 129, 44);
		contentPane.add(lblAddExpense);
		
		btnConfirm = new JButton("confirm");
		btnConfirm.setBounds(30, 181, 100, 29);
		contentPane.add(btnConfirm);
		
		btnConfirm_1 = new JButton("confirm");
		btnConfirm_1.setBounds(329, 181, 115, 29);
		contentPane.add(btnConfirm_1);
		
		btnConfirm_2 = new JButton("confirm");
		btnConfirm_2.setBounds(61, 447, 115, 29);
		contentPane.add(btnConfirm_2);
		
		JLabel lblReasonName = new JLabel("reason name");
		lblReasonName.setBounds(329, 296, 100, 20);
		contentPane.add(lblReasonName);
		
		textField_3 = new JTextField();
		textField_3.setColumns(10);
		textField_3.setBounds(324, 332, 166, 26);
		contentPane.add(textField_3);
		
		JLabel lblAmount = new JLabel("amount");
		lblAmount.setBounds(318, 374, 69, 20);
		contentPane.add(lblAmount);
		
	    formattedTextField_2 = new JFormattedTextField(NumberFormat.getNumberInstance());
		formattedTextField_2.setBounds(336, 405, 79, 26);
		contentPane.add(formattedTextField_2);
		
		JSeparator separator = new JSeparator();
		separator.setForeground(Color.BLACK);
		separator.setBounds(15, 236, 530, 26);
		contentPane.add(separator);
		
		btnConfirm_3 = new JButton("confirm");
		btnConfirm_3.setBounds(334, 447, 115, 29);
		contentPane.add(btnConfirm_3);
		
		JSeparator separator_1 = new JSeparator();
		separator_1.setForeground(Color.BLACK);
		separator_1.setOrientation(SwingConstants.VERTICAL);
		separator_1.setBounds(574, 27, 10, 491);
		contentPane.add(separator_1);
		
		
	}
}

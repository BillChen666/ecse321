package ca.mcgill.ecse321.managementSystem.application;

import java.awt.EventQueue;

import ca.mcgill.ecse321.managementSystem.controller.ManagementSystemController;
import ca.mcgill.ecse321.managementSystem.persistence.PersistenceLab;
import ca.mcgill.ecse321.managementSystem.view.Login;

public class ManagementSystem {
	
	public ManagementSystem(){
		
	}

	
	
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					PersistenceLab.loadModel();
					ManagementSystemController controller=new ManagementSystemController();
					Login frame = new Login(controller);
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}
}

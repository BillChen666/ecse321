package ca.mcgill.ecse321.managementSystem.view;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import ca.mcgill.ecse321.managementSystem.application.ManagementSystem;
import ca.mcgill.ecse321.managementSystem.controller.ManagementSystemController;

import javax.swing.JLabel;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.Color;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;
import javax.swing.JSeparator;
import javax.swing.SwingConstants;

public class Login extends JFrame {

	private ManagementSystemController controller;
	private JPanel contentPane;
	private JTextField textField;
	private JPasswordField passwordField;
	private JTextField textField_1;
	private JTextField textField_2;


	/**
	 * Create the frame.
	 */
	public Login(ManagementSystemController controller1) {
		
		this.controller=controller1;
		//initial setting
		setting();		
		
		
		//useful components
		textField = new JTextField();
		textField.setBounds(210, 205, 146, 26);
		contentPane.add(textField);
		textField.setColumns(10);
		
		passwordField = new JPasswordField();
		passwordField.setBounds(210, 256, 146, 26);
		contentPane.add(passwordField);
		
		JButton btnLogin = new JButton("login");
		btnLogin.setFont(new Font("Tahoma", Font.PLAIN, 23));
		btnLogin.setBounds(165, 314, 115, 37);
		contentPane.add(btnLogin);
	
		textField_1 = new JTextField();
		textField_1.setColumns(10);
		textField_1.setBounds(581, 205, 146, 26);
		contentPane.add(textField_1);
		
		textField_2 = new JTextField();
		textField_2.setColumns(10);
		textField_2.setBounds(581, 256, 146, 26);
		contentPane.add(textField_2);
		
		JButton btnRegister = new JButton("register");
		btnRegister.setFont(new Font("Tahoma", Font.PLAIN, 23));
		btnRegister.setBounds(555, 314, 115, 37);
		contentPane.add(btnRegister);
		
		
	     btnLogin.addActionListener(new ActionListener() {

			public void actionPerformed(ActionEvent e) {
				try {
					String username=textField.getText();
					String password=new String(passwordField.getPassword());
					if(controller.Login(username, password)){
					   MainPanel frame = new MainPanel(controller);
					   frame.setVisible(true);
					   dispose();
					}
					else{
						Exceptions frame = new Exceptions("log in fails.name:"+username+"  password:"+password);
						frame.setVisible(true);
					}
					
				} catch (Exception e1) {

				}
			}
		});
	     
	     
	     btnRegister.addActionListener(new ActionListener() {

				public void actionPerformed(ActionEvent e) {
					try {
						String newname=textField_1.getText();
						String newpassword=textField_2.getText();
						if(controller.register(newname, newpassword)){
							Exceptions frame1 = new Exceptions("register success! name:"+newname+"  password:"+newpassword);
							frame1.setVisible(true);
						}
						else{
							Exceptions frame2 = new Exceptions("register fails :(");
							frame2.setVisible(true);
						}
					} catch (Exception e1) {

					}
				}
			});
		
	
}
	
	
	
	public void setting(){
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 846, 603);
		contentPane = new JPanel();
		contentPane.setForeground(Color.PINK);
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		
		//static components
		
		JLabel lblWelcomeTo = new JLabel("Welcome to University Lab Research System ");
		lblWelcomeTo.setForeground(Color.DARK_GRAY);
		lblWelcomeTo.setFont(new Font("Times New Roman", Font.PLAIN, 39));
		lblWelcomeTo.setBounds(50, 70, 738, 61);
		contentPane.add(lblWelcomeTo);		
		
		JLabel lblUsername = new JLabel("username");
		lblUsername.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblUsername.setBounds(96, 199, 99, 35);
		contentPane.add(lblUsername);
				
		JLabel lblPassword = new JLabel("password");
		lblPassword.setFont(new Font("Tahoma", Font.PLAIN, 20));
		lblPassword.setBounds(96, 250, 86, 35);
		contentPane.add(lblPassword);		
		
		JLabel label = new JLabel("username");
		label.setFont(new Font("Tahoma", Font.PLAIN, 20));
		label.setBounds(480, 199, 99, 35);
		contentPane.add(label);
		
		JLabel label_1 = new JLabel("password");
		label_1.setFont(new Font("Tahoma", Font.PLAIN, 20));
		label_1.setBounds(480, 250, 86, 35);
		contentPane.add(label_1);		
		
		JSeparator separator = new JSeparator();
		separator.setOrientation(SwingConstants.VERTICAL);
		separator.setForeground(Color.BLACK);
		separator.setBackground(Color.BLACK);
		separator.setBounds(420, 161, 13, 342);
		contentPane.add(separator);
	
	}
}

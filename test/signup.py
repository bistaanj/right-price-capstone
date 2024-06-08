from selenium import webdriver
from selenium.webdriver.common.by import By
import time
import unittest

class SignupTest(unittest.TestCase):
    

    def setUp(self):
        self.driver = webdriver.Chrome()
    
    def test_form_success(self):
        driver = self.driver
        driver.implicitly_wait(5)
        driver.get('http://localhost:3000/pages/signup.php')

        # the list for test cases.. Add True if you want the result to be accepted. Add False if you want result to be not accepted.
        # Please Note that the system sends email so please use your own email to avoid sending mails to anonymous. 

        data_list = [["Anuj","Bista","bistaanj@gmail.com","Admin@aa",False],
                     ["Anuj","Bista","atsibanj@gmail.com","Admin123",False],
                     ["Anuj","Bista","atsibanj@gmail.com","admin@123",False],
                     ["Anuj","Bista","atsibanj@gmail.com","A@123",False],
                     ["","Bista","atsibanj@gmail.com","Admin@123",False],
                     ["Anuj","Bista","atsibanj@gmail.com","Admin@123",True]
                     ]

        for value in data_list:
            fname_input = driver.find_element(By.NAME, 'fname')
            lname_input = driver.find_element(By.NAME, "lname")
            email_input = driver.find_element(By.NAME, "email")
            password_input = driver.find_element(By.NAME, "password")
            signup_btn = driver.find_element(By.NAME, "signup_btn")
            fname_input.send_keys(value[0])
            lname_input.send_keys(value[1])
            email_input.send_keys(value[2])
            password_input.send_keys(value[3])
            expected_result = value[4]
            signup_btn.click()
            time.sleep(5)
            driver.implicitly_wait(5)
            if (expected_result):
                next_title = driver.title
                self.assertEqual("Login Page", next_title,"Test Failed")
                driver.get('http://localhost:3000/pages/signup.php')
                
            else:
                self.assertEqual("Sign Up Page", driver.title,"Test Failed")
                driver.get('http://localhost:3000/pages/signup.php')



    def tearDown(self):
        self.driver.quit()

unittest.main()

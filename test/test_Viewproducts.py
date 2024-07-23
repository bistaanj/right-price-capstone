import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
import time

class ViewProductTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.maximize_window()
        self.driver.get("http://localhost/capstone_project/pages/login.php")

    def test_view_product(self):
        driver = self.driver

        # Log in
        email_input = driver.find_element(By.ID, "email")
        email_input.send_keys("anuragturke24@gmail.com")
        time.sleep(1)  

        password_input = driver.find_element(By.ID, "password")
        password_input.send_keys("Turkeboy@007")
        time.sleep(1) 

        login_button = driver.find_element(By.XPATH, "//button[@type='submit']")
        login_button.click()
        time.sleep(2)  

        # Navigate to the Market page
        driver.get("http://localhost/capstone_project/pages/market.php")
        time.sleep(2) 

        self.assertIn("Market Products", driver.title)

        # Click on the first product to view details
        first_product = driver.find_element(By.XPATH, "//div[@class='product-card']/a")
        first_product.click()
        time.sleep(2)  

        # Verify the product detail 
        self.assertIn("Product Detail", driver.title)

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

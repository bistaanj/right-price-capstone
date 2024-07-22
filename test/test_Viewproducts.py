import time
import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By

class ViewProductDetailsTest(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost:8888/capstone_project/pages/login.php")  
        self.driver.maximize_window()

    def test_view_product_details(self):
        driver = self.driver

        # Log in
        email_input = driver.find_element(By.ID, "email")
        password_input = driver.find_element(By.ID, "password")
        login_button = driver.find_element(By.XPATH, "//button[@type='submit']")
         time.sleep(2)

        email_input.send_keys("anuragturke24@gmail.com")
        password_input.send_keys("Turkeboy@007")
        login_button.click()
        time.sleep(2)

        self.assertIn("Right Price Dashboard", driver.title)

        # Navigate to the market page
        market_link = driver.find_element(By.LINK_TEXT, "Market")
        market_link.click()
        time.sleep(2)

        self.assertIn("Right Price Dashboard", driver.title)

        view_product_buttons = driver.find_elements(By.XPATH, "//a[contains(@href, 'getProductinfo.php')]")
        if view_product_buttons:
            view_product_buttons[0].click()
            time.sleep(2)

            self.assertIn("Right Price Dashboard", driver.title) 
            product_name = driver.find_element(By.XPATH, "//span[contains(@class, 'h2')]")
            self.assertTrue(product_name.is_displayed(), "Product name is not displayed")

            # Verify other product details (adjust as per your page structure)
            product_price = driver.find_element(By.XPATH, "//div[contains(text(), 'Price:')]")
            self.assertTrue(product_price.is_displayed(), "Product price is not displayed")
        else:
            self.fail("No 'View Product' buttons found on the page")

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

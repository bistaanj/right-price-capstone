import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
import time

class SellProductTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.maximize_window()
        self.driver.get("http://localhost/capstone_project/pages/login.php")

    def test_sell_product(self):
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

        # Navigate to the Sell Product page
        driver.get("http://localhost/capstone_project/pages/sell_product.php")
        time.sleep(2) 

        # Fill in the sell product form
        sales_type_sale = driver.find_element(By.ID, "sale")
        sales_type_sale.click()
        time.sleep(1)

        product_name_input = driver.find_element(By.ID, "product_name")
        product_name_input.send_keys("Test Product")
        time.sleep(1)

        product_category_select = driver.find_element(By.ID, "product_category")
        for option in product_category_select.find_elements(By.TAG_NAME, "option"):
            if option.text == "Seeds":
                option.click()
                break
        time.sleep(1)

        price_input = driver.find_element(By.ID, "price")
        price_input.send_keys("100")
        time.sleep(1)

        unit_input = driver.find_element(By.ID, "unit")
        unit_input.send_keys("kg")
        time.sleep(1)

        image_input = driver.find_element(By.ID, "product_image")
        image_input.send_keys("/path/to/your/TestImage.jpg")
        time.sleep(1)

        description_textarea = driver.find_element(By.ID, "description")
        description_textarea.send_keys("This is a test product description.")
        time.sleep(1)

        # Submit the form
        submit_button = driver.find_element(By.XPATH, "//button[@type='submit']")
        submit_button.click()
        time.sleep(2)  

        # Verify that the product was successfully posted
        driver.get("http://localhost/capstone_project/pages/MyProducts.php")
        time.sleep(2)  

        # Check if the new product appears on the My Products page
        products = driver.find_elements(By.CLASS_NAME, "product-name")
        product_names = [product.text for product in products]
        self.assertIn("Test Product", product_names)

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

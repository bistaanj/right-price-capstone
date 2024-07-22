import unittest
import time
import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.action_chains import ActionChains

class SellProductTestCase(unittest.TestCase):

    def setUp(self):
        # Set up the webdriver, for example, using Chrome
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/capstone_project/pages/sell_product.php")

    def test_sell_product(self):
        driver = self.driver

        # Verify the title of the page
        self.assertIn("Sell a Product", driver.title)

        # Locate and fill in the product name input
        product_name_input = driver.find_element(By.ID, "product_name")
        product_name_input.send_keys("Organic Apples")
        time.sleep(2)  

        # Locate and select a product category from the dropdown
        product_category_select = driver.find_element(By.ID, "product_category")
        product_category_select.click()
        time.sleep(1)  # Small wait to allow the dropdown to be visible
        product_category_option = driver.find_element(By.XPATH, "//option[@value='1']")
        product_category_option.click()
        time.sleep(5)  

        # Locate and fill in the price input
        price_input = driver.find_element(By.ID, "price")
        price_input.send_keys("10")
        time.sleep(5)  

        # Locate and fill in the unit input
        unit_input = driver.find_element(By.ID, "unit")
        unit_input.send_keys("kg")
        time.sleep(2)  

        # Locate and fill in the product image input
        #product_image_input = driver.find_element(By.ID, "product_image")
        #image_path = os.path.abspath("/Users/anuragturke/Downloads/yourpegasus-41-road-running-shoes-tqZxCM.png")
        #product_image_input.send_keys(image_path)
        #time.sleep(2)

        # Locate and fill in the description textarea
        description_textarea = driver.find_element(By.ID, "description")
        description_textarea.send_keys("Fresh organic apples from the farm.")
        time.sleep(2)  

        # Locate and click the submit button
        submit_button = driver.find_element(By.XPATH, "//button[@type='submit']")
        actions = ActionChains(driver)
        actions.move_to_element(submit_button).click().perform()

        # Wait for the response page to load and display the result
        WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.TAG_NAME, "body"))
        )

        # Verify successful product submission (Assuming the success message or redirection)
        self.assertIn("Product listed successfully", driver.page_source)

    def tearDown(self):
        # Close the browser window
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

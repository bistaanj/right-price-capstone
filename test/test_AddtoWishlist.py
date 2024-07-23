import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By

class TestAddToWishlist:
    def setup_method(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/capstone_project/pages/login.php")
        self.driver.maximize_window()

    def teardown_method(self):
        self.driver.quit()

    def test_add_to_wishlist(self):
        driver = self.driver

        # Log in
        email_input = driver.find_element(By.ID, "email")
        email_input.send_keys("anuragturke24@gmail.com")
        time.sleep(2)  

        password_input = driver.find_element(By.ID, "password")
        password_input.send_keys("Turkeboy@007")
        time.sleep(2)  

        login_button = driver.find_element(By.XPATH, "//button[@type='submit']")
        login_button.click()
        time.sleep(2)

        # Navigate to the Market page
        driver.get("http://localhost/capstone_project/pages/market.php")
        time.sleep(2) 

        # Find the first product and add it to the wishlist
        add_to_wishlist_button = driver.find_element(By.XPATH, "//button[contains(text(),'Add to Wishlist')]")
        add_to_wishlist_button.click()
        time.sleep(2)

        # Verify that the product was added to the wishlist by navigating to the Wishlist page
        driver.get("http://localhost/capstone_project/pages/wishlist.php")
        time.sleep(2) 

        # Check if the product is listed in the wishlist
        wishlist_items = driver.find_elements(By.CLASS_NAME, "wishlist-item")
        assert len(wishlist_items) > 0, "No items found in the wishlist"

        # Print wishlist items for debugging
        for item in wishlist_items:
            print(item.text)

if __name__ == "__main__":
    pytest.main()

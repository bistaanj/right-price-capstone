import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
import time

class NavigationAfterLoginTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.maximize_window()
        self.driver.get("http://localhost/capstone_project/pages/login.php")

    def test_navigation_after_login(self):
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

        # Define the navigation links 
        nav_links = [
            {"link_text": "Dashboard", "expected_title": "Right Price Dashboard", "url": "http://localhost/capstone_project/pages/dashboard.php"},
            {"link_text": "Wishlist", "expected_title": "Wishlist", "url": "http://localhost/capstone_project/pages/wishlist.php"},
            {"link_text": "Market", "expected_title": "Market Products", "url": "http://localhost/capstone_project/pages/market.php"},
            {"link_text": "Blogs", "expected_title": "Blogs", "url": "http://localhost/capstone_project/pages/blogs.php"},
            {"link_text": "Logout", "expected_title": "Login", "url": "http://localhost/capstone_project/pages/login.php"}
        ]

        for link in nav_links:
            # Find the link by link text and click it
            nav_link = driver.find_element(By.LINK_TEXT, link["link_text"])
            nav_link.click()
            time.sleep(2)  

           
            self.assertIn(link["expected_title"], driver.title)

           
            self.assertEqual(driver.current_url, link["url"])

            # Navigate back to the dashboard for the next iteration (except for logout)
            if link["link_text"] != "Logout":
                driver.get("http://localhost/capstone_project/pages/dashboard.php")
                time.sleep(2)  

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

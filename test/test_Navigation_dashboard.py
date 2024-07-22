import time
import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By

class NavbarNavigationTest(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost:8888/capstone_project/pages/login.php")  # Adjust the URL to your setup
        self.driver.maximize_window()

    def test_navbar_navigation(self):
        driver = self.driver

        # Log in
        email_input = driver.find_element(By.ID, "email")
        password_input = driver.find_element(By.ID, "password")
        login_button = driver.find_element(By.XPATH, "//button[@type='submit']")

        email_input.send_keys("anuragturke24@gmail.com")
         time.sleep(2)
        password_input.send_keys("Turkeboy@007")
         time.sleep(2)
        login_button.click()

        # Wait for login to complete
        time.sleep(2)

        # Verify that login was successful by checking for the dashboard title
        self.assertIn("Right Price Dashboard", driver.title)

        # Define the navbar links and the expected titles after navigation
        nav_links = [
            {"link_text": "Dashboard", "expected_title": "Right Price Dashboard"},
            {"link_text": "Wishlist", "expected_title": "Wishlist"},
            {"link_text": "Market", "expected_title": "Market Products"},
            {"link_text": "Blogs", "expected_title": "Blogs"},
            {"link_text": "Logout", "expected_title": "Login"}
        ]

        for link in nav_links:
            # Find the link by link text and click it
            nav_link = driver.find_element(By.LINK_TEXT, link["link_text"])
            nav_link.click()
            time.sleep(2)  # Wait for the page to load

            # Verify the title of the new page
            self.assertIn(link["expected_title"], driver.title)

            # Navigate back to the dashboard for the next iteration
            if link["link_text"] != "Dashboard":
                driver.get("http://localhost:8888/capstone_project/pages/dashboard.php")
                time.sleep(2)  # Wait for the dashboard to load

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
import time

class PostBlogTest(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Chrome()
        self.driver.maximize_window()
        self.driver.get("http://localhost/capstone_project/pages/login.php")

    def test_post_blog(self):
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

        # Navigate to the Post a Blog page
        driver.get("http://localhost/capstone_project/pages/postblog.php")
        time.sleep(2) 

       
        title_input = driver.find_element(By.NAME, "title")
        title_input.send_keys("My Test Blog")
        time.sleep(1)

        #Use correct path of image
        image_input = driver.find_element(By.NAME, "image")
        image_input.send_keys("users/downloads/TestImage.jpg")
        time.sleep(1)

        content_textarea = driver.find_element(By.NAME, "blog_content")
        content_textarea.send_keys("This is a test blog post content.")
        time.sleep(1)

        # Submit the form
        post_button = driver.find_element(By.NAME, "post-button")
        post_button.click()
        time.sleep(2) 

        # Verify 
        driver.get("http://localhost/capstone_project/pages/blogs.php")
        time.sleep(2)  # Wait for the page to load

        
        blogs = driver.find_elements(By.CLASS_NAME, "blog-title")
        blog_titles = [blog.text for blog in blogs]
        self.assertIn("My Test Blog", blog_titles)

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

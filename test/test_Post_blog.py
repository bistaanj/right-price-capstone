import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import  time

class PostBlogTestCase(unittest.TestCase):

    def setUp(self):
        # Set up the webdriver, for example, using Chrome
        self.driver = webdriver.Chrome()
        self.driver.get("http://localhost/capstone_project/pages/postblog.php")

    def test_post_blog(self):
        driver = self.driver

        # Verify the title of the page
        self.assertIn("Right Price - Post a Blog", driver.title)

        # Locate and fill in the title input
        title_input = driver.find_element(By.NAME, "title")
        title_input.send_keys("My First Blog Post")
        time.sleep(5)

        # Locate and fill in the cover picture input
        image_input = driver.find_element(By.NAME, "image")
        image_input.send_keys("http://example.com/image.jpg")

        # Locate and fill in the blog content textarea
        blog_content_textarea = driver.find_element(By.NAME, "blog_content")
        blog_content_textarea.send_keys("This is the content of my first blog post.")

        # Locate and click the post button
        post_button = driver.find_element(By.NAME, "post-button")
        post_button.click()

        # Wait for the response page to load and display the result
        WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.TAG_NAME, "body"))
        )

        # Verify successful post submission (Assuming the success message or redirection)
        self.assertIn("Blog posted successfully", driver.page_source)

    def tearDown(self):
        # Close the browser window
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()

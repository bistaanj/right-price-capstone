from selenium import webdriver
from selenium.webdriver.common.by import By
import time
import unittest

driver= webdriver.Chrome()
driver.get('http://localhost:3000/pages/login.php')
print(driver.title)

link = driver.find_element(By.NAME, "signup_link")
link.click()

driver.implicitly_wait(5)
time.sleep(3)
print(driver.title)

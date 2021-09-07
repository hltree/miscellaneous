from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
import chromedriver_binary
from webdriver_manager.chrome import ChromeDriverManager

driver = webdriver.Chrome(ChromeDriverManager().install())
driver.get('https://tabelog.com/kyoto/A2601/A260202/R2811/rstLst/')

WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'rstlst-calendar__date-day')))

reserve_days = driver.findElements(By.xpath('//*[@data-svd="20210919"]')

if reserve_days:
    for reserve_day in reserve_days:
        print(reserve_day.text)

driver.quit()

exit()

array = []

for tag in target_day:
    try:
        array.append(tag)
    except:
        pass
       
print(array)
exit()

for val in array:
    val = val + '\n'
    file = open('./result.txt', 'a')
    file.write(val)
    file.close
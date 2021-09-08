from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.common.action_chains import ActionChains
import chromedriver_binary
from webdriver_manager.chrome import ChromeDriverManager
import time

driver = webdriver.Chrome(ChromeDriverManager().install())

# 16時予約できるお店のリスト
driver.get('https://tabelog.com/rstLst/?utf8=%E2%9C%93&utf8=%E2%9C%93&Srt=D&SrtT=rt&sort_mode=1&pal=kyoto&LstPrf=A2601&LstAre=A260202&station_id=2811&hfc=0&commit=%E7%B5%9E%E3%82%8A%E8%BE%BC%E3%82%80&trailing_slash=true&srchTg=1&lid=yoyaku-search_leftcolumn&RdoCosTp=2&LstCos=0&LstCosT=0&search_date=2021%2F9%2F19%28%E6%97%A5%29&svd=20210919&svps=2&svt=1600&vac_net=1&LstRev=0&commit=%E7%B5%9E%E3%82%8A%E8%BE%BC%E3%82%80&LstSitu=0&LstSmoking=0')

# 要素取得できるようになるまでsleepする関数
# WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'rstlst-calendar__date-day')))

time.sleep(3)

array = []

def scrape_shop_cards():
    global array
    shop_cards = driver.find_elements_by_class_name('list-rst')
    for shop_card in shop_cards:
        try:
            shop_name = shop_card.find_element_by_class_name('list-rst__rst-name-target').text
            shop_link = shop_card.find_element_by_class_name('list-rst__rst-name-target').get_attribute('href')
            
            reserve_buttons = shop_card.find_elements_by_class_name('flexible-bookable-time__btn')
            for reserve_button in reserve_buttons:
                if reserve_button.get_attribute('href') is None:
                    continue
                if '16:00' == reserve_button.text:
                    dic = {'name': shop_name, 'url': shop_link}
                    array.append(dic.copy())
                    break
        except:
            pass
    
    try:
        now_page = driver.find_element_by_css_selector('.c-pagination__num.is-current')
        now_page_text = now_page.get_attribute('textContent')
        next_page_number = int(now_page_text) + 1
        
        pagers = driver.find_elements_by_class_name('c-pagination__num')
        for pager in pagers:
            try:
                if int(pager.get_attribute('textContent')) == next_page_number:
                    driver.get(pager.get_attribute('href'))
                    time.sleep(5)
                    scrape_shop_cards()
            except Exception as e:
                print(e)
                pass
    except:
        pass

scrape_shop_cards()

driver.quit()

for dic in array:
    file_1 = open('./site_names.txt', 'a')
    file_1.write(dic['name'] + '\n')
    file_1.close
    
    file_2 = open('./site_urls.txt', 'a')
    file_2.write(dic['url'] + '\n')
    file_2.close
#필요한 패키지
import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.action_chains import ActionChains
import csv


filename = "movie information db.csv"
f = open(filename, 'w', encoding='utf-8-sig', newline='')
writer = csv.writer(f)

driver = webdriver.Chrome('C:/Users/edaily_user/Desktop/Computer/chromedriver')
driver.implicitly_wait(3)
driver.get("https://www.kobis.or.kr/kobis/business/mast/mvie/searchMovieList.do")

driver.find_element(By.CLASS_NAME,"btn_more").click()
Select(driver.find_element(By.ID,"sPrdtYearS")).select_by_value("2020")

driver.find_element(By.ID,"sGenreStr").click()

ac=ActionChains(driver)
all = driver.find_element(By.ID,"chkAllChkBox")
ero = driver.find_element(By.ID,"mul_chk_det18")

ac.click(all)
ac.click(ero)

ac.perform()

driver.find_element(By.ID,"layerConfirmChk").click()
driver.implicitly_wait(1)

driver.find_element(By.CLASS_NAME,"btn_blue").click()

data =[]
i=1
while i in range(1,1017):
    time.sleep(10)
    if i<720:
        driver.find_element(By.CLASS_NAME,"btn.next").send_keys(Keys.ENTER)
        i=i+10
        time.sleep(15)
        continue

    table = driver.find_element(By.CLASS_NAME,"tbl_comm")
    tbody = table.find_element(By.TAG_NAME,"tbody")
    rows = tbody.find_elements(By.TAG_NAME, "tr")

    for index, value in enumerate(rows):

        kor_name = value.find_elements(By.TAG_NAME, "td")[0]
        eng_name = value.find_elements(By.TAG_NAME, "td")[1]
        movie_id = value.find_elements(By.TAG_NAME, "td")[2]
        date = value.find_elements(By.TAG_NAME, "td")[3]
        country = value.find_elements(By.TAG_NAME, "td")[4]
        director = value.find_elements(By.TAG_NAME, "td")[8]
        time.sleep(1)

        writer.writerow([movie_id.text, kor_name.text, eng_name.text, country.text, date.text, director.text])


    if i<1016:
        if i%10 == 0:
            driver.find_element(By.CLASS_NAME,"btn.next").send_keys(Keys.ENTER)
        else:
            page_num = i + 1
            driver.find_element(By.LINK_TEXT,str(page_num)).click()
    else:
        break;

    i=i+1

print("완료!")
f.close()
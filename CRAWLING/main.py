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

driver = webdriver.Chrome('./chromedriver_win32/chromedriver.exe')
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

for i in range(1,9280):
    time.sleep(5)

    table = driver.find_element(By.CLASS_NAME,"tbl_comm")
    tbody = table.find_element(By.TAG_NAME,"tbody")
    rows = tbody.find_elements(By.TAG_NAME, "tr")

    for index, value in enumerate(rows):

        kor_name = value.find_elements(By.TAG_NAME, "td")[0].text
        eng_name = value.find_elements(By.TAG_NAME, "td")[1].text
        movie_id = value.find_elements(By.TAG_NAME, "td")[2].text
        date = value.find_elements(By.TAG_NAME, "td")[3].text
        country = value.find_elements(By.TAG_NAME, "td")[4].text
        director = value.find_elements(By.TAG_NAME, "td")[8].text
        print(str(kor_name) + eng_name + movie_id + date + country + director)

        writer.writerow([movie_id, kor_name, eng_name, country, date, director])


    if i<9280:
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
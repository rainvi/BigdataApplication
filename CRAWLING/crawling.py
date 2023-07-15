'''
실행 방법 :
pip install selenium
*********************** : 컴퓨터 환경에 맞게 변경 필요한 부분
1. selenium 설치하고
2. chrome driver 버전에 맞게 변경하고
3. movie 데이터 있는 csv 파일 (kor_name / eng_name / movie_id / ... 순서로 column이 있다고 가정)의 이름을 별표 친 부분에 넣고
4. 그냥 실행하심 됩니다!!

review.csv : 평점 선호도
age_pr.csv : 연령 별 선호도
gender_pr.csv : 성별 별 선호도
'''
#! /usr/bin/env python3

# 터미널에서 설치 필요
import MySQLdb  #pip install mysqlclient
from bs4 import BeautifulSoup   #pip install beautifulsoup4
from selenium import webdriver  #pip install selenium
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.common.by import By
import time
import os
import shutil
import pandas as pd
import csv
import pyperclip

# https://chromedriver.chromium.org/downloads
url = 'https://movie.naver.com/'    #크롤링할 사이트 url
path = './chromedriver_win32/chromedriver.exe' #chrome driver 설치된 곳으로 변경 필요(chrome 버전에 맞춰서!)*********************************************************
op = Options()

driver = webdriver.Chrome(path, chrome_options=op)
driver.get(url) #드라이버 실행
driver.set_window_position(0, 0)    #창을 0,0 위치에 두기
driver.set_window_size(1920, 1080)  #창 사이즈 결정

movie = []
movie_id = []
def load_csv(filename):
    filename = filename
    f = open(filename, 'r', encoding='utf-8-sig')
    reader = csv.reader(f)
    for line in reader:
        movie.append(line[1])
        movie_id.append(line[0])

def save_csv(filename, data):
    filename = filename
    f = open(filename, 'a', encoding='utf-8-sig', newline='')
    writer = csv.writer(f)
    writer.writerow(data)

load_csv("movie information db2.csv")    #작은 부분 table로 테스트

#평론 테이블
#null 값은 -1로 저장

AR = [] #관객 평점
CR = [] #평론가 평점

A1 = [] #연령대 10대
A2 = []
A3 = []
A4 = []
A5 = []

FP = [] #성별 여자
MP = []

time.sleep(2)   #오류 안나도록 대기시간 줌

#로그인
uid = "g0119" #네이버 아이디 **************************************************
upwd = "naver3815246790" #네이버 패스워드 ************************************************
driver.find_element('xpath', '//*[@id="gnb_login_button"]/span[3]').click()
tag_id = driver.find_element('name', 'id')
tag_pwd = driver.find_element('name', 'pw')
tag_id.click()
pyperclip.copy(uid)
tag_id.send_keys(Keys.CONTROL, 'v')
time.sleep(1)
tag_pwd.click()
pyperclip.copy(upwd)
tag_pwd.send_keys(Keys.CONTROL, 'v')
time.sleep(1)
login_btn = driver.find_element('id', 'log.login')
login_btn.click()
time.sleep(2)
driver.find_element('xpath', '//*[@id="new.save"]').click()

#영화 개수만큼 데이터 긁어오기를 반복
for i in range (0, len(movie)):

    value = movie[i]    #검색창에 입력할 영화 이름

    driver.find_element('xpath', '/html/body/div/div[2]/div/div/fieldset/div/span/input').click() #검색창 클릭
    driver.find_element('xpath', '/html/body/div/div[2]/div/div/fieldset/div/span/input').send_keys(value) #검색창에 영화이름 넣기
    driver.find_element('xpath', '/html/body/div/div[2]/div/div/fieldset/div/button').click()   #검색버튼 클릭
    try:
        driver.find_element('xpath', '/html/body/div/div[4]/div/div/div/div/div[1]/ul[2]/li/dl/dt/a').click()   #영화 목록 클릭
    except NoSuchElementException:
        print("<"+ value + ">의 영화 제목에 해당하는 데이터를 찾을 수 없음")
        AR.append(-1)
        CR.append(-1)
        A1.append(-1)
        A2.append(-1)
        A3.append(-1)
        A4.append(-1)
        A5.append(-1)
        FP.append(-1)
        MP.append(-1)
        continue

    n1, n2, n3, n4, n5 = -1, -1, -1, -1, -1   #평점을 자릿수 단위로 저장하기 위한 변수
    n10, n20, n30, n40, n50 = -1, -1, -1, -1, -1 #나잇대 별 변수
    fp, mp = -1, -1 #성별별 변수
    num = 0.00

    # 관객 평점 AR
    # NoSuchElementException : 가져오려는 부분의 html이 실제로는 존재하지 않을 경우 에러가 날 수 있는데, 에러가 안나도록 예외처리해주는 코드
    try:
        # 원하는 평점 부분에서 text를 가져옴
        n1 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[1]/a/div/em[1]').text
        try:
            n2 = driver.find_element('xpath',
                                     '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[1]/a/div/em[2]').text
            try:
                n3 = driver.find_element('xpath',
                                         '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[1]/a/div/em[3]').text
                try:
                    n4 = driver.find_element('xpath',
                                             '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[1]/a/div/em[4]').text
                    if n2 != "." :
                        num = 10.0
                    else:
                        n1, n3, n4 = int(n1), int(n3), int(n4)
                        n3 *= 0.1
                        n4 *= 0.01
                        num = n1 + n3 + n4
                    print("<" + value + ">의 관객 평점 : " + str(num))

                except NoSuchElementException:
                    print("<"+ value + ">의 관객 평점을 불러오는 데 문제가 발생했습니다.")
            except NoSuchElementException:
                print("<"+ value + ">의 관객 평점을 불러오는 데 문제가 발생했습니다.")

        except NoSuchElementException:
            print("<"+value + ">의 관객 평점을 불러오는 데 문제가 발생했습니다.")

    except NoSuchElementException:
        print("<"+ value + ">의 관객 평점이 존재하지 않음")


    if num <= 0:
        AR.append(-1)
    else:
        AR.append(num)  # 리스트 넣기

    n1, n2, n3, n4, n5 = -1, -1, -1, -1, -1
    num = 0

    #기자, 평론가 평점 CR
    try:
        n1 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[2]/div/a/div/em[1]').text

        try:
            n2 = driver.find_element('xpath',
                                     '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[2]/div/a/div/em[2]').text

            try:
                n3 = driver.find_element('xpath',
                                         '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[2]/div/a/div/em[3]').text

                try:
                    n4 = driver.find_element('xpath',
                                             '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[1]/div[2]/div/a/div/em[4]').text
                    if n2 != ".":
                        num = 10.0
                    else:
                        n1, n3, n4 = int(n1), int(n3), int(n4)
                        n3 *= 0.1
                        n4 *= 0.01
                        num = n1 + n3 + n4

                    print("<" + value + ">의 평론가 평점 : " + str(num))

                except NoSuchElementException:
                    print("<"+value + ">의 평론가 평점을 불러오는 데 문제가 발생했습니다.")

            except NoSuchElementException:
                print("<"+value + ">의 평론가 평점을 불러오는 데 문제가 발생했습니다.")

        except NoSuchElementException:
            print("<"+value + ">의 평론가 평점을 불러오는 데 문제가 발생했습니다.")


    except NoSuchElementException:
        print("<"+value + ">의 평론가 평점이 존재하지 않음")

    if num <= 0:
        CR.append(-1)
    else:
        CR.append(num)  #리스트 넣기


    #10대 선호도 A10
    try:
        n10 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[2]/div/div[2]/div[1]/strong[1]').text
        n10 = n10[0:len(n10)-1]

    except NoSuchElementException:
        print("<"+value + ">의 10대 선호도 데이터가 존재하지 않음")

    #20대 선호도 A20
    try:
        n20 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[2]/div/div[2]/div[2]/strong[1]').text
        n20 = n20[0:len(n20)-1]
    except NoSuchElementException:
        print("<"+value + ">의 20대 선호도 데이터가 존재하지 않음")

    #30대 선호도 A30
    try:
        n30 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[2]/div/div[2]/div[3]/strong[1]').text
        n30 = n30[0:len(n30) - 1]
    except NoSuchElementException:
        print("<"+value + ">의 30대 선호도 데이터가 존재하지 않음")

    #40대 선호도 A40
    try:
        n40 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[2]/div/div[2]/div[4]/strong[1]').text
        n40 = n40[0:len(n40) - 1]
    except NoSuchElementException:
        print("<"+value + ">의 40대 선호도 데이터가 존재하지 않음")

    #50대 선호도 A50
    try:
        n50 = driver.find_element('xpath', '/html/body/div/div[4]/div[3]/div[1]/div[2]/div[1]/div[2]/div/div[2]/div[5]/strong[1]').text
        n50 = n50[0:len(n50) - 1]
    except NoSuchElementException:
        print("<"+value + ">의 50대선호도 데이터가 존재하지 않음")

    n10, n20, n30, n40, n50 = int(n10)*0.01, int(n20)*0.01, int(n30)*0.01, int(n40)*0.01, int(n50)*0.01

    if (n10<0):
        A1.append(-1)
    else:
        A1.append(n10)
        print("<" + value + ">의 10대 선호도 : " + str(n10))

    if (n20 < 0):
        A2.append(-1)
    else:
        A2.append(n20)
        print("<" + value + ">의 20대 선호도 : " + str(n20))

    if (n30 < 0):
        A3.append(-1)
    else:
        A3.append(n30)
        print("<" + value + ">의 30대 선호도 : " + str(n30))

    if (n40 < 0):
        A4.append(-1)
    else:
        A4.append(n40)
        print("<" + value + ">의 40대 선호도 : " + str(n40))

    if (n50 < 0):
        A5.append(-1)
    else:
        A5.append(n50)
        print("<" + value + ">의 50대 선호도 : " +str(n50))


    # 성별 선호도 파트는 계속 수정중............................
    #여성 선호도 FP
    try:
        p = driver.find_elements(By.TAG_NAME, 'tspan')
        if fp==None:
            print("<" + value + ">의 성별 선호도 데이터가 존재하지 않음")
            continue
        if len(p) > 1: #여성, 남성 모두 데이터가 존재함
            fp = p[1].text
            print("<" + value + ">의 여성 선호도 : " + fp)
            mp = p[0].text
            print("<" + value + ">의 남성 선호도 : " + mp)
            fp = int(fp[0:len(fp) - 1])
            mp = int(mp[0:len(mp) - 1])
        elif len(p) == 1:
            cc = driver.find_element(By.TAG_NAME, 'circle').get_attribute("fill")
            if (cc == "#ff7e5a"):
                fp = "100%"
                mp = "0%"
                print("<" + value + ">의 여성 선호도 : " + fp)
                print("<" + value + ">의 남성 선호도 : " + mp)
            elif (cc == "#86c8fc"):
                mp = "100%"
                fp = "0%"
                print("<" + value + ">의 여성 선호도 : " + fp)
                print("<" + value + ">의 남성 선호도 : " + mp)
            else:
                print("<" + value + ">에서 성별 원그래프 컬러코드 에러 발생")
                continue
            fp = int(fp[0:len(fp) - 1])
            mp = int(mp[0:len(mp) - 1])

    except NoSuchElementException:
        print("<" + value + ">의 성별 선호도 데이터가 존재하지 않음")

    fp, mp = fp * 0.01, mp * 0.01
    if (int(fp) < 0):
        FP.append(-1)
    else:
        FP.append(fp)

    if (int(mp) < 0):
        MP.append(-1)
    else:
        MP.append(mp)





    # csv 파일로 저장

    data = []
    #review table
    #영화 id, Crate, Arate
    data = [movie_id[i], CR[i], AR[i]]
    save_csv("review.csv", data)


    #age_pr table
    #영화_id, A10, A20, ...
    data = [movie_id[i], A1[i], A2[i], A3[i], A4[i], A5[i]]
    save_csv("age_pr.csv", data)

    #gender_pr table
    #영화 id, f, m
    data = [movie_id[i], FP[i], MP[i]]
    save_csv("gender_pr.csv", data)

print("끄읕")












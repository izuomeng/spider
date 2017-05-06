# -*- coding=UTF-8 -*-
import MySQLdb
import requests
from bs4 import BeautifulSoup
import re
import sys
import time
reload(sys)
sys.setdefaultencoding('utf-8')
# 打开数据库
db2 = MySQLdb.connect(host="localhost",
                      user="myuser",
                      passwd="321427",
                      db="myNews",
                      charset='utf8')
cursor = db2.cursor()
# 获取当日日期
gettime=time.time()
now_time = time.strftime("%Y-%m-%d",time.localtime(gettime))
db_nowtime=int(now_time[8:])
db_beftime=int(time.strftime("%Y-%m-%d",time.localtime(gettime-24*60*60*10))[8:])# 十天前日期去0
cursor.execute("DELETE FROM news WHERE date = %d"%(db_beftime))
session = requests.Session()


# 科技新闻
url = "http://tech.163.com/internet/"
s = session.get(url)
soup = BeautifulSoup(s.content, 'html.parser')
out =soup.find_all("a",class_="newsList-img")
soup2 = BeautifulSoup(s.content, 'html.parser')
out2 = soup.find_all('img',src=re.compile("http://cms-bucket.nosdn.127.net"))
cursor=db2.cursor()
delete = "DELETE FROM TechNews WHERE date = %d"%(db_beftime)
cursor.execute(delete)
db2.commit()

for i in out:
    s = str(i.get('href'))
    s2 = str(out2[0].get('alt'))
    if s != "None":
        s3 = str(out2[0].get('src'))
        del out2[0]
        print(s, s2, s3)
        cursor.execute('INSERT INTO TechNews(url,title,image,date) VALUES (%s, %s, %s, %s)', (s, s2, s3, str(db_nowtime)))
        cursor.execute('DELETE FROM TechNews WHERE title IS NULL ;')
        db2.commit()

#CNET科技资讯网
CNETurl="http://www.cnetnews.com.cn/list-7-1-0-0-1-0.htm"
CNETs=session.get(CNETurl)
CNETsoup=BeautifulSoup(CNETs.content,"html.parser")
CNETout=CNETsoup.find_all(class_=re.compile("^qu_loop$"))
for one in CNETout:
    CNETdivs=one.find_all('div')
    if CNETdivs is not None:
        CNETHref=''
        CNETTitle=''
        CNETPic=''
        for CNETdiv in CNETdivs:
            if CNETdiv['class']==[u'qu_ims']:
                CNETa=CNETdiv.a
                if CNETa is not None:
                    CNETHref=CNETa['href']
                    CNETTitle=CNETa['title']
                    CNETimg=CNETa.img
                    if CNETimg is not None:
                        CNETPic=CNETimg['src']
        if CNETHref != '' and CNETTitle != '' and CNETPic != '':
            cursor.execute('INSERT INTO TechNews(url,title,image,date) VALUES (%s, %s, %s, %s)',
                           (CNETHref, CNETTitle, CNETPic, str(db_nowtime)))
            cursor.execute('DELETE FROM TechNews WHERE title IS NULL ;')
            db2.commit()


cursor.close()
db2.close()
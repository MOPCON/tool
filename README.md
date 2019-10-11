# command list

## Notifier

+ `notify:infoteam` \
    每個禮拜五上午九點發送訊息到資訊組頻道，提醒組員回報工作進度。
+ `notify:leaders` \
    每個禮拜天零點複製 Google 雲端硬碟上的會議記錄並發送訊息到組長頻道，提醒各組組長回報。


## Converter

+ `pure_php/conver_list.php` \
    轉檔前先將所有從 kktix 匯出的 xlsx 檔存放至 `storage/email`，程式會讀取所有的 xlsx 後轉換成發送 email 用的 csv
+ `pure_php/conver_speaker.php` \
    將 ems 匯出的講者資料轉換成官網用的 json 檔
+ `pure_php/conver_sponsor.php` \
    將 ems 匯出的贊助商資料轉換成官網用的 json 檔

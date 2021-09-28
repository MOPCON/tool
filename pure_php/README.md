# pure_php

### convert_sponsor.php

轉換從 EMS 匯出的贊助商資料．

```bash
$ php convert_sponsor.php sponsors-${timestamps}.tsv sponsors.json
```

### convert_speaker.php

轉換從 EMS 匯出的講者資料．

```bash
$ php convert_speaker.php speakers-${timestamps}.tsv speakers.json
```

### schedule.php

將 convert_speaker.php 產生的 speakers.json 檔放在目錄，並透過以下命令產生議程表，並將議程表的相關資料對應回 speakers.json

```bash
$ php schedule.php speakers.json
```

### schedule_unconf.php

產生 unconference 議程表

```bash
$ php schedule.php speakers.json
```

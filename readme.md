## **注意!!**
*運用の際には著作権等の侵害にはご注意ください*

問題が発生致しましても、こちらは責任を負いません

## 使い方
<https://api.mcbe.tokyo/mrpm/>  こちらを利用する場合 music_list.ymlには  
  
 `music.(.oggを抜いた名前)` を書くことになります
 
 例: 
   
 test.ogg => music.test
 
 
music_list.yml  
  
```yml
---
music.test:
  button: §aテスト
music.sample:
  button: 複数の場合
...
```

## API
```php
<?php

use soradore\playmusic\api;

api::playMusic("music name");
api::stopMusic("music name");
api::stopMusic();

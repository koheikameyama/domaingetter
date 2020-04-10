<?php


//DBに接続する。
$USER= 'manabou_list';
$PW= 'amo22726';
$dnsinfo= "mysql:dbname=manabou_list;host=mysql2105.xserver.jp;charset=utf8";



try{
  $pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "SELECT * FROM TABLE1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(null);
	$res = "";
	$i=1;


    ?>
<?php include('./head.php');?>


<div class="container-fluid">
<div class="row">
            <div class="col-md">
                <form>
                    <div class="form-group">
                        <label>部署</label>
                        <select class="form-control">
                            <option>さくらサーバー</option>
                            <option>忍者サーバー</option>
                            <option>スターサーバー</option>
                            <option>エックスサーバー</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
<label>メインドメイン</label>  
<div class="form-group">
  <label for="text1">ドメイン</label>
  <input type="text" id="text1" class="form-control" >sakura.ne.jp
</div>
<label>取得候補エラーコード</label>
<div class="form-check">

  <input class="form-check-input" type="radio" name="radio1" id="radio1a" checked>
  <label class="form-check-label" for="radio1a">0</label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radio1" id="radio1b">
  <label class="form-check-label" for="radio1b">404</label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radio1" id="radio1b">
  <label class="form-check-label" for="radio1c">403</label>
</div>

<div class="form-group">
  <label for="textarea1">サブドメイン</label>
  <textarea id="textarea1" class="form-control">army.jp
guy.jp
powerful.jp
shenron.jp
survival.jp
apples.jp
carrots.jp
frypan.jp
marble.jp
ponytail.jp
exp.jp
xxxx.jp
capture.jp
echo.jp
fever.jp
hits.jp
pleasure.jp
softdrink.jp
trivia.jp
another.jp
designers.jp
everyday.jp
lady.jp
repeat.jp
speaker.jp
academy.jp
change.jp
edition.jp
graph.jp
hydrogen.jp
information.jp
mars.jp
nation.jp
practice.jp
unison.jp
ajax.jp
devel.jp
gif.jp
mpeg4.jp
programming.jp
thread.jp
ape.jp
bomber.jp
cipher.jp
material.jp
psycho.jp
sauce.jp
spider.jp
berserk.jp
hammer.jp
reloaded.jp
soldier.jp
thunderbird.jp
butter.jp
couple.jp
halloween.jp
milkshake.jp
riceball.jp
wwww.jp
coloring.jp
emanga.jp
gradation.jp
icons.jp
robots.jp
stadium.jp
vitamin.jp
bookmarks.jp
episode.jp
honeymoon.jp
monologue.jp
snowdrop.jp
anyone.jp
college.jp
essay.jp
hexagon.jp
hyphen.jp
knowhow.jp
meter.jp
official.jp
premier.jp
universal.jp
byte.jp
encoder.jp
hardware.jp
mydocument.jp
session.jp
webmaster.jp
back.jp
campfire.jp
cocoon.jp
mosquito.jp
rage.jp
sauna.jp
taboo.jp
guardian.jp
jailbreak.jp
requiem.jp
stamina.jp
cacao.jp
dolphin.jp
handmade.jp
pigtail.jp
topping.jp
www2.jp
deejay.jp
feeling.jp
guidebook.jp
nickname.jp
singsong.jp
teen.jp
boots.jp
ever.jp
illust.jp
ready.jp
sometime.jp
beginner.jp
course.jp
evolution.jp
holding.jp
inch.jp
lifecycle.jp
month.jp
percent.jp
trial.jp
year.jp
conf.jp
folder.jp
keyboard.jp
processor.jp
thumbnail.jp
widget.jp
beet.jp
cheat.jp
damage.jp
paddock.jp
salary.jp
skull.jp
torrent.jp
</textarea>
</div>
	
<div class="form-group">
  <label for="textarea2">ブラックリスト</label>
  <textarea id="textarea2" class="form-control">army.jp
guy.jp
powerful.jp
shenron.jp
survival.jp
apples.jp
carrots.jp
frypan.jp
marble.jp
ponytail.jp
exp.jp
xxxx.jp
capture.jp
echo.jp
fever.jp
hits.jp
pleasure.jp
softdrink.jp
trivia.jp
another.jp
designers.jp
everyday.jp
lady.jp
repeat.jp
speaker.jp
academy.jp
change.jp
edition.jp
graph.jp
hydrogen.jp
information.jp
mars.jp
nation.jp
practice.jp
unison.jp
ajax.jp
devel.jp
gif.jp
mpeg4.jp
programming.jp
thread.jp
ape.jp
bomber.jp
cipher.jp
material.jp
psycho.jp
sauce.jp
spider.jp
berserk.jp
hammer.jp
reloaded.jp
soldier.jp
thunderbird.jp
butter.jp
couple.jp
halloween.jp
milkshake.jp
riceball.jp
wwww.jp
coloring.jp
emanga.jp
gradation.jp
icons.jp
robots.jp
stadium.jp
vitamin.jp
bookmarks.jp
episode.jp
honeymoon.jp
monologue.jp
snowdrop.jp
anyone.jp
college.jp
essay.jp
hexagon.jp
hyphen.jp
knowhow.jp
meter.jp
official.jp
premier.jp
universal.jp
byte.jp
encoder.jp
hardware.jp
mydocument.jp
session.jp
webmaster.jp
back.jp
campfire.jp
cocoon.jp
mosquito.jp
rage.jp
sauna.jp
taboo.jp
guardian.jp
jailbreak.jp
requiem.jp
stamina.jp
cacao.jp
dolphin.jp
handmade.jp
pigtail.jp
topping.jp
www2.jp
deejay.jp
feeling.jp
guidebook.jp
nickname.jp
singsong.jp
teen.jp
boots.jp
ever.jp
illust.jp
ready.jp
sometime.jp
beginner.jp
course.jp
evolution.jp
holding.jp
inch.jp
lifecycle.jp
month.jp
percent.jp
trial.jp
year.jp
conf.jp
folder.jp
keyboard.jp
processor.jp
thumbnail.jp
widget.jp
beet.jp
cheat.jp
damage.jp
paddock.jp
salary.jp
skull.jp
torrent.jp
</textarea>
</div>
	
	
	
	
</div>

<div class="row center-block text-center">
            <div class="col-1">
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-outline-secondary btn-block">閉じる</button>
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-outline-primary btn-block">新規登録</button>
            </div>
        </div>




</div>

</div>
</div>
<?php include("./footer.php");?>
<?php
}catch(Exception $e){
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, height=device-height" />
    <title>Color Symbols</title>

    <style id="template-themes">
     :root {
       --GameSymSize:    calc(2vw + 2vh + 2ex);
       font-size:        calc(1vw + 1vh + 1ex);
     }
    </style>

    <style id="template-defs">
     body {
       display:          flex;
       justify-content:  center;
       align-items:      center;

       position:         relative;
       width:            100vw;
       height:           100vh;
       margin:           0;
       background-image: linear-gradient(#283848, #304050);
     }

     div#GameHier {
       display:          flex;
       flex-flow:        column;
       justify-content:  center;
       align-items:      start;
       color:            #C0FFFF;
     }

     div#GameHier > hr {
       align-self:       stretch;
       border-bottom:    dashed medium silver;
       margin:           1pc 0pc;
     }

     div#GameHier > div {
       display:          block;
       text-align:       center;
       margin:           1pc 0pc;
     }

     div#GameHier > div * {
       display:          inline-block;
       line-height:      var(--GameSymSize);
       vertical-align:   middle;
     }

     img.GameSymbol {
       width:            var(--GameSymSize);
       height:           var(--GameSymSize);
     }

     img.GameSymbol:hover {
       transform:        scale(114%);
     }

     img.GameSymbol {
       transition:       all 0.5s;
     }

     div#Sect-Challenge #ChallengeQuestion {
       width:            20rem;
     }

     div#Sect-Answer {
       align-self:       end;
     }

     div#Sect-Answer #AnswerResult {
       position:         relative;
       width:            10rem;
       overflow:         visible;
     }

     div#Sect-Answer .score-float {
       position:             absolute;
       right:                0;
       animation-name:       floataway;
       animation-fill-mode:  forwards;
       animation-duration:   1.5s;
     }

     @keyframes floataway {
       from {
         transform:      translateX(0pc);
         color:          rgba(255,224,128,100%);
       }

       to {
         transform:      translateX(-3pc);
         color:          rgba(192,192,192,0%);
       }
     }

     div#Sect-Stats {
       align-self:       stretch;
     }

     div#Sect-Stats progress#HealthPoints {
       border:           solid thin cyan;
       border-radius:    2mm;
       width:            100%;
       height:           3mm;
       color:            #E0FFC0; /* not well-supported */
       background-color: #400000;
     }

     div.overlay {
       position:         fixed;
       left:             0;
       top:              0;
       width:            100vw;
       height:           100vh;

       background-color: rgba(255,255,255,25%);
       backdrop-filter:  blur(1ch);
     }

     div#StartPage {
       display:          flex;
       justify-content:  center;
       align-items:      center;
       color:            #203040;
     }

     div#StartPage[hidden] {
       display:          none;
     }

     div#StartPage > div#StartMenu {
       position:         relative;
       display:          flex;
       flex-flow:        column;
       justify-content:  center;
       align-items:      center;

       background-color: rgba(255,255,255,75%);
       padding:          1ex;
       border-radius:    1em;
     }

     div#StartPage div.Title {
       font-family:      sans-serif;
       font-size:        2rem;
       font-weight:      bold;
       text-shadow:      white 4px 6px 8pt;
     }

     div#StartPage div#GameResult {
       color:            red;
     }

     div#StartPage a.ui-flat {
       text-align:       center;
       font-size:        0.78rem;
       width:            8em;
       margin:           1pc;
       padding:          0.5em;
       border-radius:    1.5em;

       border:           solid medium black;
       background-color: #F0E0C0;
     }

     div#StartPage a.ui-flat:hover {
       color:            #C0A040;
       background-color: #FFF8E0;
     }

     div#StartPage div.corner-lower-right {
       position:         absolute;
       right:            1pc;
       bottom:           1pc;
     }

     div#StartPage a#DownloadMe {
       font-family:      serif;
       font-size:        calc(10pt + 0.25em);
       color:            #203040;
       text-shadow:      white 1px 1px 1pt;
     }
    </style>

    <script id="xml-preproc">
     // The XML pre-processing is implemented using the
     // "xpp" pre-processing start tag. Such tag sets the
     // variable that must match in order for a section of
     // the XML document to be output, thereby realizing
     // conditional inclusion. As a special case, an
     // xpp value of ``null'' matches any value, thereby
     // by-passing condition check.
     // The name "xpp" stands for "XML Pre-Processing".

     function xpp(doc, dict)
     {
       var stag = "<?xpp";
       var etag = "?>";
       var pp = {}; // pp stands for preprocessing predicates.

       function pred()
       {
         for( var k in dict )
         {
           if( pp[k] && pp[k] != dict[k] )
             return false;
         }
         return true;
       }

       var ret = "";
       var i = 0;
       var j = 0;
       var k = 0;
       var x = "";

       doc = String(doc);
       for(;;)
       {
         i = doc.indexOf(stag, k);
         if( pred() ) ret += doc.substring(k, i >= 0 ? i : doc.length);
         if( i < 0 ) break;

         j = doc.indexOf(etag, i);
         x = doc.substring(i + stag.length, j);
         eval(x);
         k = j + etag.length;
       }

       return ret;
     }
    </script>

    <script id="res-img-sym" type="image/x.svg-preproc">
     <?= file_get_contents("assets/sym-meta.xml"); ?>
    </script>

    <script id="game-assets">
     var res_img_sym_ajax = "assets/sym-ajax.svg";

     function image_sym(color, shape)
     {
       var svgdoc = document.getElementById("res-img-sym").text;
       svgimg = xpp(svgdoc, { "color": color, "shape": shape, });
       return "data:image/svg+xml;base64," + btoa(svgimg);
     }
    </script>

    <script id="i18n-l10n">
     var lang_en = {
       "title":          "Welcome to ColorSymbols",
       "intro":          "~ Choose difficulty to start ~",
       "easy":           "Easy",
       "medium":         "Medium",
       "difficult":      "Difficult",
       "downloadme":     "Download This Game",
       "correct":        "Correct",
       "wrong":          "Wrong!",
       "timeout":        "Timeout",
       "chooseSymbol":   "Choose the Matching *-Symbol-*",
       "chooseColor":    "Choose the Matching *-Color-*",
       "lost":           "Game Over, You Lost!",
       "won":            "!!You Won!!",
       "ready":          "Are you ready for a game?",
     };

     var lang_zh = {
       "title":          "欢迎来到《彩符》",
       "intro":          "～选择难度～",
       "easy":           "容易",
       "medium":         "普通",
       "difficult":      "较难",
       "downloadme":     "下载这个游戏",
       "correct":        "正确",
       "wrong":          "错误！",
       "timeout":        "超时",
       "chooseSymbol":   "选择匹配的*-符号-*",
       "chooseColor":    "选择匹配的*-颜色-*",
       "lost":           "游戏结束，败北。",
       "won":            "!!胜利!!",
       "ready":          "准备好来一局游戏了吗？",
     };

     var langs = {
       "en":        lang_en,
       "zh":        lang_zh,
     };

     var lang = langs["en"];

     function lang_autoselect()
     {
       var lang_ua = String(navigator.langauge).toLowerCase();
       var mlen = 0;
       var mlang = null;

       for( var k in langs )
       {
         k = String(k).toLowerCase();
         var minl = Math.min(k.length, lang_ua.length);

         if( k.substring(0, minl) === lang_ua.substring(0, minl) )
         {
           if( mlen >= minl )
             continue;
         }

         mlen = minl;
         mlang = k;
       }

       lang = langs[mlang];
     }
    </script>

    <script id="game-settings">
     var setting_current = null;
     var settings = {};
     settings.easy = { "hp_start": 75, "timeout": 7, };
     settings.medium = { "hp_start": 50, "timeout": 5, };
     settings.difficult = { "hp_start": 25, "timeout": 3, };
     settings.extortion = { "hp_start": 10, "timeout": 2, };
     var score = {
       "correct": 2, "wrong": -2, "timeout": -2,
       "max": 100, "hp": 50,
     };

     function StartGame(difficulty)
     {
       ielem_startpage.hidden = true;
       clearInterval(timer_sparkle);
       setting_current = settings[difficulty];

       score.hp = setting_current.hp_start;
       ielem_hp_bar.value = score.hp;
       ielem_hp_bar.max = score.max;

       NewChallenge();
     }
    </script>

    <script id="game-rules">
     // Initializations.

     var ielem_startpage;
     var ielem_gameresult;

     var ielem_challenge;
     var ielem_question;
     var velem_answers;
     var colors = [ "red", "yellow", "green", "blue", ];
     var shapes = [ "triangle", "cross", "circle", "box", ];
     var questions = [ "Symbol", "Color", ];
     var ans_verify = null;

     var ielem_answer_result;
     var ielem_hp_bar;

     window.onload = function()
     {
       //
       // language auto-select.

       try { lang_autoselect(); } catch(e) {};
       
       //
       // initialize variables for holding elements.

       ielem_startpage = document.getElementById("StartPage");
       ielem_gameresult = document.getElementById("GameResult");

       ielem_challenge = document.getElementById("ChallengeSymbol");
       ielem_question = document.getElementById("ChallengeQuestion");
       velem_answers = [];
       for(var i=1; i<=4; i++)
       {
         var elem_ans = document.getElementById("ans" + String(i));
         elem_ans.onclick = VerifyAnswer(velem_answers.length);
         velem_answers.push(elem_ans);
       }

       ielem_answer_result =
         document.getElementById("AnswerResult");
       ielem_answer_result.textContent = "";

       ielem_hp_bar = document.getElementById("HealthPoints");

       //
       // setup download link as well as other static UI localizations.

       var elem;
       elem = document.getElementById("DownloadMe");
       elem.href = document.location.href;
       elem.textContent = lang["downloadme"];

       document.getElementById("Title").textContent = lang["title"];
       document.getElementById("Intro").textContent = lang["intro"];

       elem = document.querySelectorAll("div#StartPage a.ui-flat");
       for(var i=0; i<elem.length; i++)
         elem[i].textContent = lang[elem[i].textContent];
       console.log(elem);

       //
       // start opening animation.

       timer_sparkle = setInterval(sparkle, 500);
     }

     // ``NewChallenge'' and related functions.

     function dice24()
     {
       // Better PRNG is being considered.
       return Math.floor(Math.random() * 24);
     }

     function permute4(d)
     {
       var ret = [ 0, 1, 2, 3, ];

       for(var i=4; i>1; i--)
       {
         var p = d % i;
         var j = 4 - i;
         var t = ret[p+j];
         ret[p+j] = ret[j];
         ret[j] = t;
         d = (d - p) / i;
       }

       return ret;
     }

     var timer_sparkle;

     function sparkle()
     {
       var csym = dice24() % 4;
       var cclr = dice24() % 4;
       var asym = dice24();
       var aclr = dice24();

       ielem_challenge.src = image_sym(colors[cclr], shapes[csym]);
       ielem_question.textContent = lang["ready"];

       var vsym = permute4(asym);
       var vclr = permute4(aclr);
       for(var i=0; i<4; i++)
       {
         velem_answers[i].src = image_sym(colors[vclr[i]], shapes[vsym[i]]);
       }
     }

     var timer_timeout;

     function NewChallenge()
     {
       var csym = dice24() % 4;
       var cclr = dice24() % 4;
       var mode = dice24() % 2;
       var asym = dice24();
       var aclr = dice24();

       ielem_challenge.src = image_sym(colors[cclr], shapes[csym]);
       ielem_question.textContent = lang["choose" + questions[mode]];

       var vsym = permute4(asym);
       var vclr = permute4(aclr);
       for(var i=0; i<4; i++)
       {
         velem_answers[i].src = image_sym(colors[vclr[i]], shapes[vsym[i]]);

         if( ([ vsym[i], vclr[i], ])[mode] == ([ csym, cclr, ])[mode] )
           ans_verify = i;
       }

       timer_timeout = setTimeout(
         AddScore("timeout"),
         setting_current.timeout * 1000);
     }

     // Response.

     function AddScore(a)
     {
       // a is one of "correct", "wrong", and "timeout".
       return function()
       {
         score.hp += score[a];
         ielem_hp_bar.value = score.hp;
         ielem_hp_bar.max = score.max;
         if( score.hp < 0 ) GameOver();
         if( score.hp >= score.max ) GameWon();


         var span = document.createElement("span");
         span.textContent = lang[a];
         span.className = "score-float";
         ielem_answer_result.appendChild(span);
         setTimeout(
           function(parent, elem){ parent.removeChild(elem); },
           1725, ielem_answer_result, span);

         if( score.hp >= 0 && score.hp < score.max )
           NewChallenge();
       }
     }

     function VerifyAnswer(d)
     {
       return function()
       {
         clearInterval(timer_timeout);
         ( d == ans_verify ? AddScore("correct") : AddScore("wrong"))();
       }
     }

     function GameOver()
     {
       ielem_startpage.hidden = false;
       ielem_gameresult.textContent = lang["lost"];
       timer_sparkle = setInterval(sparkle, 500);
     }

     function GameWon()
     {
       ielem_startpage.hidden = false;
       ielem_gameresult.textContent = lang["won"];
       timer_sparkle = setInterval(sparkle, 500);
     }
    </script>
  </head>
  <body>

    <div id="GameHier">
      <div id="Sect-Challenge">
        <img id="ChallengeSymbol" class="GameSymbol" src="data:image/png,"/>
        <span id="ChallengeQuestion">
          Choose the Matching Symbol/Color
        </span>
      </div>

      <hr/>

      <div id="Sect-Answer">

        <span id="AnswerResult"> ? / Correct / Wrong </span>
        <span id="Answer">
          <img id="ans1" class="GameSymbol" src="data:image/png,"/>
          <img id="ans2" class="GameSymbol" src="data:image/png,"/>
          <img id="ans3" class="GameSymbol" src="data:image/png,"/>
          <img id="ans4" class="GameSymbol" src="data:image/png,"/>
        </span>
      </div>

      <div id="Sect-Stats">
        <progress id="HealthPoints" value=0.5></progress>
      </div>
    </div>

    <div id="StartPage" class="overlay">
      <div id="StartMenu">
        <div id="Title" class="Title">
          Welcome to ColorSymbols
        </div>
        <div id="GameResult" class="Title"></div>

        <div id="Intro">~ Choose difficulty to start ~</div>
        <a class="ui-flat" onclick="StartGame('easy');">easy</a>
        <a class="ui-flat" onclick="StartGame('medium');">medium</a>
        <a class="ui-flat" onclick="StartGame('difficult');">difficult</a>

        <div class="corner-lower-right">
          <a id="DownloadMe" download>Download This Game</a>
        </div>
      </div>
    </div>

  </body>
</html>

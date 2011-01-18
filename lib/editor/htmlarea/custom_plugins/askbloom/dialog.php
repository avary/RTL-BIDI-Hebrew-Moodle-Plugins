<?php // $Id: insert_table.php,v 1.4 2007/01/27 23:23:44 skodak Exp $
    require_once("../../../../../config.php");

    $id = optional_param('id', SITEID, PARAM_INT);

    require_course_login($id);
    @header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title><?php echo get_string('windowtitle','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?></title>
    <link rel="stylesheet" type="text/css" href="TheDifferentiator/jqueryui.css">
<style>
body{direction:rtl;margin:5px;padding:5px;font:1em"Trebuchet MS",verdana,arial,sans-serif;font-size:100%;}
div.container{}
cite{font-size:0.75em;}
h2{text-align:center;font-size:1em;color:#333;font-weight:normal;margin:0;background:#eee;border:1px solid#aaa;padding:2px;}
h3{font-size:1em;color:#333;margin:0;}
#objective{color:#333;padding:10px 0;margin:15px 0;border:1px solid#ccc;background:#eee;}
.innerTabs{color:#666;font-size:.9em line-height:1.2em;}
.innerTabs li ul li{border:1px solid#ccc;padding:10px 5px;margin:5px 0;}
ul{list-style:none;padding:0;}
div#tabs-1 ul li.innerTab{width:15%;}
div#tabs-2 ul li.innerTab{width:23%;}
div#tabs-3 ul li.innerTab{width:23%;}
div#tabs-4 ul li.innerTab{width:18%;}
div#tabs-5 ul li.innerTab{width:50%;}
.innerTab{float:right;padding:0 5px;padding-bottom:0pt;}
.drawer-content UL{float:none;padding-top:7px;}
.drawer-content LI A{display:block;overflow:hidden;}
li.hover{color:#000;background:#fdd;border:1px solid#333;}
.editable{border-bottom:1px dashed#000;}
#menu{list-style-type:none;margin:0;padding:0;font-size:0.8em;}
#menu li{margin:0 3px 3px 3px;padding:0.4em;padding-left:1.5em;font-size:1.4em;height:18px;}
#menu li span{position:absolute;margin-left:-1.3em;}
h1{text-align:center;}
#objective{text-align:right;}
#objective a{margin-right:5px;border:1px solid green;padding:5px;color:green;text-decoration:none;background:#afa;}
div.bottom{clear:both;}
p{font-size:.7em;padding:0;margin:0;color:#777;}
#help{display:none;color:#f00;background:#fcc;padding:5px;border:1px solid#f00;width:500px;margin:0 auto;}
#pop{z-index:100;background:#eef;border:5px solid#66f;padding:10px;display:none;position:absolute;top:100px;left:0;margin:0 0 0 320px;width:640px;text-align:center;}
#pop p{padding:5px 0;color:#444;font-size:0.9em;}
#pop h2, #pop h3{font-weight:bold;color:#000;background:transparent;border:none;padding-bottom:5px;font-size:1.4em;font-family:Arial,Verdana,Helvetica,sans-serif;text-transform:uppercase;}
#pop h3{font-weight:normal;text-transform:none;font-size:1.1em;color:#555;text-align:center;}
#pop input{border:1px solid #00c;font-size:14px;padding:5px;margin:0;}
#pop input#submit{padding:5px;border:none;background:#00c;color:#fff;margin:0;font-size:14px;}
#pop form{padding:10px 0;}
#pop #nope{font-size:12px;border-top:1px solid #ccc;text-align:left;}
#pop a{color:#00f;}
</style>

<script type="text/javascript">
//<![CDATA[

function Init() {
  var param = window.dialogArguments;
  /*
  if (param) {
      var alt = param["f_url"].substring(param["f_url"].lastIndexOf('/') + 1);
      document.getElementById("f_url").value = param["f_url"];
      document.getElementById("f_alt").value = param["f_alt"] ? param["f_alt"] : alt;
      document.getElementById("f_border").value = parseInt(param["f_border"] || 0);
      window.ipreview.location.replace('preview.php?id='+ <?php print($course->id);?> +'&imageurl='+ param.f_url);
  }
*/
  document.getElementById('objective').focus();
};

function onOK() {
  var required = {
    "objective": "You should better make up a nice sentence, before we move on..."
  };
  for (var i in required) {
    var el = document.getElementById(i);
    if (!el.innerHTML) {
      alert(required[i]);
      el.focus();
      return false;
    }
  }
  var fields = ["objective"];
  var param = new Object();
  for (var i in fields) {
    var id = fields[i];
    var el = document.getElementById(id);
    param[id] = el.innerHTML;
    //alert(document.getElementById('objective').innerHTML);
  }

  opener.nbWin.retFunc(param);
  window.close();
  return false;
};

function onCancel() {
//  if (preview_window) {
//    preview_window.close();
//  }
  window.close();
  return false;
};
//[[>
</script>

<script src="TheDifferentiator/jsapi"></script>
<script type="text/javascript">
    google.load("jquery", "1.3.2");
    google.load("jqueryui", "1.7.2");
</script>

<script src="TheDifferentiator/jquery_002.js" type="text/javascript"></script>
<script src="TheDifferentiator/jquery-ui.js" type="text/javascript"></script>
<script src="TheDifferentiator/jquery_004.js" type="text/javascript"></script>
<script src="TheDifferentiator/jquery_005.js" type="text/javascript"></script>
<script src="TheDifferentiator/jquery_003.js" type="text/javascript"></script>
<script src="TheDifferentiator/jquery.js" type="text/javascript"></script>

    <script type="text/javascript">
    <!--
  google.setOnLoadCallback(function() {

		$("#hidePop").click(function(){$('#pop').slideUp();});
		$("#submit").click(function(){$('#pop').slideUp();});
		$("#tabs").tabs();
        $("#menu").sortable();
		$("#menu").disableSelection();
		$(".editable").editInPlace({callback:function(){return true}});

        $('ul#ts li ul li').click(function () {
        	$('#thinking_skill').html($(this).html().toLowerCase() );
        	$('#thinking_skill').effect("highlight", {}, 1500);

        });
        $('ul#r li ul li').click(function () {
        	$('#resource').html(" השתמשו ב" + $(this).html().toLowerCase() + " ");
        	$('#resource').effect("highlight", {}, 1500);
        });
     	$('ul#c li ul li').click(function () {
        	$('#content').html(" את " + $(this).html().toLowerCase() + " בנושא ");
        	$('#content').effect("highlight", {}, 1500);
        });
        $('ul#p li ul li').click(function () {
        	$('#product').html(" ליצירת " + $(this).html().toLowerCase());
        	$('#product').effect("highlight", {}, 1500);
        });
		$('ul#g li ul li').click(function () {
        	$('#groups').html(" עבדו בקבוצות של " + $(this).html().toLowerCase() + ".");
        	$('#groups').effect("highlight", {}, 1500);
        });
		$('#submit').click(function(){$('#pop').slideUp();});
		$('#add').click(function(){
			var clone = $("h1#obj").clone();
    		clone.find('span').removeAttr("id");
			$('ul#menu').append('<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + clone.text() + '</li>');
			$('ul#menu li:last').effect("highlight", {}, 1500);
		});

	   $('li.innerTab ul li').hover(
      function () {
        $(this).addClass("hover");
      },
      function () {
        $(this).removeClass("hover")
      }
    );

    $('div#help a').click(function(){$('div#help').slideUp()});
	$('a#showHelp').click(function(){$('div#help').slideDown()});
	if ($.cookie('40080523') != '1')
	{
  		$('#pop').animate({opacity: 1.0}, 60001).slideDown('slow');
  		$.cookie('40080523', '1', { expires: 60 });
    }
});


    //-->
    </script>
</head>
<body id="page" onload="Init()">
<span style="float: right;"><a style="color: red; font-decoration:none;" id="showHelp" href="#"><?php echo get_string('needhelp','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?></a></span><br/>

<div id="help"><object id='stU0hcQkxIR15eSFleXlldUVZQ' width='500' height='344' type='application/x-shockwave-flash' data='http://www.screentoaster.com/swf/STPlayer.swf'  codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0'><param name='movie' value='http://www.screentoaster.com/swf/STPlayer.swf'/><param name='allowFullScreen' value='true'/><param name='allowScriptAccess' value='always'/><param name='flashvars' value='video=stU0hcQkxIR15eSFleXlldUVZQ'/></object>
<p style="text-align: center; color: blue;">צרכים עזרה? צפו בסרטון זה. כאשר סיימתם , <a href="#">[<?php echo get_string('clicktohide','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?>]</a>.</p></div>

<div id="objective">
<h1 id="obj"><?php echo get_string('dearstudents','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?><span style="" id="thinking_skill"></span><span style="" id="content"></span>
<span style="background:none repeat scroll 0% 0% transparent;" class="editable" id="your_content">
<?php echo get_string('clicktoentersubject','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?></span>
<span id="resource"></span><span id="product"></span><span id="groups"></span></h1>
</div>

<button type="button" name="ok" onclick="return onOK();"><?php echo get_string('okimdone','askbloom','',$CFG->dirroot.'/lib/editor/htmlarea/custom_plugins/askbloom/lang/'); ?></button>
<button type="button" name="cancel" onclick="return onCancel();"><?php print_string("cancel","editor") ?></button>

<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
	<li class="ui-corner-top ui-tabs-selected ui-state-active ui-state-focus"><a href="#tabs-1">כישוריי חשיבה</a></li>
	<li class="ui-corner-top ui-state-default"><a href="#tabs-2">תוכן</a></li>
	<li class="ui-corner-top ui-state-default"><a href="#tabs-3">משאבים</a></li>
	<li class="ui-corner-top ui-state-default"><a href="#tabs-4">תוצר</a></li>
	<li class="ui-corner-top ui-state-default"><a href="#tabs-5">קבוצות</a></li>
</ul>
	<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1">
	<h3> בשלב הראשון, בחרו כישור חשיבה אחד מתוך רשימות רמות החשיבה השונות...</h3>
	<cite>כלי זה מתבסס על הטקסונומיה המעודכנת של בלום אשר נמצאת ב: <a href="http://www.amazon.com/Taxonomy-Learning-Teaching-Assessing-Educational/dp/080131903X">"A
 Taxonomy for Learning,Teaching, and Assessing: A Revision of Bloom's
Taxonomy of Educational Objectives</a>" by Anderson and Krathwohl</cite>
		<ul id="ts" class="innerTabs">
		<li class="innerTab">
            <h2><span title="<? print_string('Remembering_en','askbloom'); ?>">זכירה</span></h2>
            <ul>
                <li><span title="<? print_string('remember_en','askbloom'); ?>"><? print_string('remember','askbloom'); ?></span></li>
                <li><span title="<? print_string('list_en','askbloom'); ?>">הכינו רשימה</span></li>
                <li><span title="<? print_string('define_en','askbloom'); ?>">הגדירו</span></li>
                <li class="hover"><span title="<? print_string('state_en','askbloom'); ?>">ציינו</span></li>
                <li><span title="<? print_string('repeat_en','askbloom'); ?>">חזרו</span></li>
                <li class="last"><span title="<? print_string('duplicate_en','askbloom'); ?>">צרו העתק</span></li>
            </ul>
        </li>
        <li class="innerTab">
            <h2>הבנה</h2>
            <ul>
				<li><span title="<? print_string('classify_en','askbloom'); ?>">מיינו</span></li>
				<li><span title="<? print_string('describe_en','askbloom'); ?>">תארו</span></li>
				<li><span title="<? print_string('discuss_en','askbloom'); ?>">התיידנו</span></li>
				<li><span title="<? print_string('explain_en','askbloom'); ?>">הסבירו</span></li>
				<li><span title="<? print_string('identify_en','askbloom'); ?>">זההו</span></li>
				<li><span title="<? print_string('locate_en','askbloom'); ?>">אתרו</span></li>
				<li><span title="<? print_string('recognize_en','askbloom'); ?>">הכירו ב</span></li>
				<li><span title="<? print_string('report_en','askbloom'); ?>">דווחו</span></li>
				<li><span title="<? print_string('select_en','askbloom'); ?>">בחרו</span></li>
				<li><span title="<? print_string('translate_en','askbloom'); ?>">תרגמו</span></li>
				<li class="last"><span title="<? print_string('paraphrase_en','askbloom'); ?>">תארו במילים שלכם</span></li>
			</ul>
		</li>
		<li class="innerTab">
           <h2>יישום</h2>
            <ul>
				<li><span title="<? print_string('choose_en','askbloom'); ?>">בחרו</span></li>
				<li><span title="<? print_string('demonstrate_en','askbloom'); ?>">הדגימו</span></li>
				<li><span title="<? print_string('employ_en','askbloom'); ?>">השתמשו</span></li>
				<li><span title="<? print_string('illustrate_en','askbloom'); ?>">ציירו</span></li>
				<li><span title="<? print_string('interpert_en','askbloom'); ?>">פרשו</span></li>
				<li><span title="<? print_string('operate_en','askbloom'); ?>">פעלו על פי</span></li>
				<li><span title="<? print_string('sketch_en','askbloom'); ?>">רישמו</span></li>
				<li><span title="<? print_string('solve_en','askbloom'); ?>">פתרו</span></li>
				<li><span title="<? print_string('use_en','askbloom'); ?>">השתמשו</span></li>
				<li class="last"><span title="<? print_string('scheduale_en','askbloom'); ?>">תזמנו</span></li>
			</ul>
		</li>
		<li class="innerTab">
           <h2>ניתוח</h2>
            <ul>
				<li><span title="<? print_string('apprise_en','askbloom'); ?>">שבחו</span></li>
				<li><span title="<? print_string('compare_en','askbloom'); ?>">השוו</span></li>
				<li><span title="<? print_string('contrast_en','askbloom'); ?>">סיתרו</span></li>
				<li><span title="<? print_string('criticise_en','askbloom'); ?>">בקרו</span></li>
				<li><span title="<? print_string('differentiate_en','askbloom'); ?>">הבדילו</span></li>
				<li><span title="<? print_string('disciminate_en','askbloom'); ?>">הבחינו</span></li>
				<li><span title="<? print_string('distinguish_en','askbloom'); ?>">ייחדו</span></li>
				<li><span title="<? print_string('examine_en','askbloom'); ?>">בחנו</span></li>
				<li><span title="<? print_string('experiment_en','askbloom'); ?>">התנסו</span></li>
				<li><span title="<? print_string('question_en','askbloom'); ?>">שאלו שאלות</span></li>
				<li class="last"><span title="<? print_string('test_en','askbloom'); ?>">בחנו</span></li>
			</ul>
		</li>
		<li class="innerTab">
           <h2>הערכה</h2>
            <ul>
				<li><span title="<? print_string('apprise_en','askbloom'); ?>">הללו</span></li>
				<li><span title="<? print_string('argu_en','askbloom'); ?>">התווכחו</span></li>
				<li><span title="<? print_string('contrast_en','askbloom'); ?>">סיתרו</span></li>
				<li><span title="<? print_string('defend_en','askbloom'); ?>">הגנו</span></li>
				<li><span title="<? print_string('judge_en','askbloom'); ?>">שיפטו</span></li>
				<li><span title="<? print_string('select_en','askbloom'); ?>">בחרו</span></li>
				<li><span title="<? print_string('support_en','askbloom'); ?>">תמכו</span></li>
				<li><span title="<? print_string('value_en','askbloom'); ?>">העריכו</span></li>
				<li class="last"><span title="<? print_string('evaluate_en','askbloom'); ?>">בחנו מחדש</span></li>
			</ul>
		</li>
		<li class="innerTab">
           <h2>יצירה</h2>
            <ul>
				<li><span title="<? print_string('assemble_en','askbloom'); ?>">הרכיבו</span></li>
				<li><span title="<? print_string('construct_en','askbloom'); ?>">בנו</span></li>
				<li><span title="<? print_string('create_en','askbloom'); ?>">צרו</span></li>
				<li><span title="<? print_string('design_en','askbloom'); ?>">התכוננו</span></li>
				<li><span title="<? print_string('develop_en','askbloom'); ?>">פתחו</span></li>
				<li><span title="<? print_string('formulate_en','askbloom'); ?>">נסחו</span></li>
				<li class="last"><span title="<? print_string('write_en','askbloom'); ?>">כתבו</span></li>
			</ul>
		</li>

        </ul>
        <div class="bottom"></div>
	</div>
	<div class="ui-tabs-panel ui-widget-content ui-corner-bottom
ui-tabs-hide" id="tabs-2">
	<h3>בשלב השני, בחרו עומק או מורכבות להנחיה...</h3>
	<cite><em>עומק ומורכבות</em> כפי שהוצגו בספר <a
href="http://www.jtayloreducation.com/the-flip-book">The Flip Book</a>
by Sandra N. Kaplan, Bette Gould &amp; Victoria Siegel. <em>Content
Imperatives</em> adapted from <a
href="http://www.jtayloreducation.com/the-flip-book-too/">The Flip Book,
 Too</a> by Sandra Kaplan &amp; Bette Gould.</cite>
		<ul id="c" class="innerTabs">
        <li class="innerTab">
            <h2>עומק</h2>
            <ul>
                <li class="">הרעיון המרכזי</li>
                <li>השאלות שלא נענו</li>
                <li>כללי אתיקה</li>
                <li>התבניות</li>
                <li>הכללים</li>
                <li>השפה או הסמלים</li>
                <li>הפרטים החשובים</li>
                <li class="last">המגמות</li>
            </ul>
        </li>
        <li class="innerTab">
           <h2>מורכבות</h2>
            <ul>
                <li>מספר נקודות המבט</li>
                <li>השינוי לאורך זמן</li>
                <li class="last">המאפיינים המשותפים</li>
            </ul>
        </li>
        <li class="innerTab">
         <h2>תהליכים</h2>
            <ul>
                <li>מקור</li>
                <li>התלכדות</li>
                <li>מקבילים</li>
                <li>סותרים</li>
                <li class="last">תורמים</li>
            </ul>
        </li>
        </ul>
        <div class="bottom"></div>
	</div>
	<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-3">
 	<h3>בשלב השלישי, בחרו משאב (בו התלמידים יתבקשו להעזר לצורך הכנת המשימה)...</h3>
	<ul id="r" class="innerTabs">
		<li class="innerTab">
            <h2>קולי</h2>
            <ul>
                <li>הקלטה</li>
                <li>דיסק מוזיקה</li>
                <li>תוכנית טלביזה</li>
                <li>רעיון אם אדם</li>
                <li class="last">תוכנית רדיו</li>
            </ul>
        </li>
        <li class="innerTab">
            <h2>לא דיגיטלי</h2>
            <ul>
                <li>ספר</li>
                <li>ירחון</li>
                <li>מאמר</li>
                <li>עיתון</li>
                <li class="last">אנציקלופדיה</li>
            </ul>
        </li>
        <li class="innerTab">
            <h2>דיגיטלי</h2>
            <ul>
				<li>אתר אינטרנט</li>
				<li>ויקיפדיה</li>
				<li>אינציקלופדיה מקוונת</li>
				<li>יומן רשת</li>
				<li class="last">מאמר</li>
			</ul>
		</li>
        </ul>
        <div class="bottom"></div>
	</div>
	<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-4">
	<h3>בשלב הרביעי, בחרו סוג של תוצר אותו יצטרכו התלמידים להכין...</h3>
	<cite>Adapted from <a href="http://davidnchung.googlepages.com/">David
Chung</a> and <a
href="http://www.jtayloreducation.com/the-flip-book-too/">The Flip Book</a>
 by Sandra N. Kaplan, Bette Gould &amp; Victoria Siegel</cite>
	<ul id="p" class="innerTabs">
		<li class="innerTab">
            <h2>חזותי</h2>
            <ul>
                <li>תרשים עמודות</li>
                <li>ציור</li>
                <li>ציר זמן</li>
				<li>דיאגרמה</li>
				<li>סידור חזותי</li>
				<li>מפה</li>
				<li>קומיקס</li>
				<li>כריכה לספר</li>
                <li class="last">כרזה</li>
            </ul>
        </li>
        <li class="innerTab">
            <h2>מבנה</h2>
            <ul>
                <li>דגם</li>
                <li>פסל</li>
                <li>דיורמה</li>
                <li>דגם מוקטן</li>
                <li>גלריית אומנות</li>
                <li>מיצג מוזאוני</li>
                <li>קולאז</li>
                <li>פסיפס</li>
                <li class="last">מובייל</li>
			</ul>
		</li>
		<li class="innerTab">
		<h2>קולי</h2>
            <ul>
            <li>ויכוח</li>
            <li>מושב התדיינות</li>
            <li>שיעור</li>
            <li>דוח</li>
            <li>הצגה</li>
            <li>תאטרון קוראים</li>
            <li>הודעה לעיתונות</li>
            <li>תוכנית רעיונות</li>
            <li class="last">הרצאת יחיד</li>
            </ul>
		</li>
		<li class="innerTab">
		<h2>מולטימדיה</h2>
            <ul>
            <li>שיר</li>
            <li>ספר מאוייר</li>
            <li>עיתון חדשות</li>
            <li>תוכנית טלביזיה</li>
            <li>מצגת</li>
            <li>שיר וידאו - קליפ</li>
            <li>חיבור בתמונות</li>
            <li>יומן מסע בסרט</li>
            <li>דוח חדשות</li>
            <li>דף אינטרנט</li>
            </ul>
		</li>
		<li class="innerTab">
		<h2>כתוב</h2>
		<ul>
			<li>ביקורת ספרותית</li>
			<li>דוח</li>
			<li>מאמר</li>
			<li>מאמר שכנוע</li>
			<li>סרטון המשך</li>
			<li>מכתב</li>
			<li>ספר ילדים</li>
			<li>שיר</li>
			<li>הספד</li>
            <li>סיכום</li>
			<li>יומן</li>
			<li>ביקורת</li>
            <li>פסקה</li>
			<li>סיפור</li>

		</ul>
		</li>
        </ul>
             <div class="bottom"></div>
                </div>
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom
ui-tabs-hide" id="tabs-5">
	<ul id="g" class="innerTabs">
		<li class="innerTab">
		<h3>לבסוף, בחרו את גודל הקבוצה בה תתבצעה המשימה...</h3>
            <h2>קבוצה של</h2>
            <ul>
            <li class="">אחד</li>
            <li class="">שניים</li>
            <li class="">שלושה</li>
            <li class="">ארבעה</li>
            </ul>
            </li>
    </ul>
             <div class="bottom"></div>


	</div>
</div> <!--End Of Tabs-->


</body></html>
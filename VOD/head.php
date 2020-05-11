<!doctype html>
<html lang="en">
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Title</title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
<script src="./js/bootstrap.min.js"></script>
<script src="./js/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="js/popper.min.js"></script>
    <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <style type="text/css">
  .bs-component + .bs-component {
    margin-top: 1rem;
  }
  @media (min-width: 768px) {
    .bs-docs-section {
      margin-top: 8em;
    }
    .bs-component {
      position: relative;
    }
    .bs-component .modal {
      position: relative;
      top: auto;
      right: auto;
      bottom: auto;
      left: auto;
      z-index: 1;
      display: block;
    }
    .bs-component .modal-dialog {
      width: 90%;
    }
    .bs-component .popover {
      position: relative;
      display: inline-block;
      width: 220px;
      margin: 20px;
    }
    .nav-tabs {
      margin-bottom: 15px;
    }
    .progress {
      margin-bottom: 10px;
    }
  }
  </style>
<script>
$(function(){
    $('.sort-table').tablesorter({
        textExtraction: function(node){
            var attr = $(node).attr('data-value');
            if(typeof attr !== 'undefined' && attr !== false){
                return attr;
            }
            return $(node).text();
        }
    });
});
	

function onButtonClick(nos) {
	
	var customSwitch = document.getElementById("customSwitch"+ nos);
	var element = document.getElementById( "output"+ nos ) ;


if (customSwitch.checked == false) {

	element.classList.toggle( "toto" ) ;
	console.log('.result'+ nos);

    //.sampleをクリックしてajax通信を行う
    $('.sample_btn').change(function(){
        $.ajax({
            url: '/tool/ajax2.php',
            type: 'GET',
            dataType: 'text',
            data : {
                no : nos
            }
			
        }).done(function(data){
            /* 通信成功時 */
            $('.result'+ nos).text(data); //取得したHTMLを.resultに反映
            
        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });

			  
	}//if
else if (customSwitch.checked == true){
                
	element.classList.toggle( "toto" ) ;
	console.log(100);
	
    //.sampleをクリックしてajax通信を行う
    $('.sample_btn').change(function(){
        $.ajax({
            url: '/tool/ajax.php',
            type: 'GET',
            dataType: 'text',
            data : {
                no : nos
            }
        }).done(function(data){
            /* 通信成功時 */
            $('.result'+ nos).text(data); //取得したHTMLを.resultに反映
            
        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信失敗！');
                    
        });
    });

 }//elseif

}//endif
    </script>
</head>
  <body>
  <div id="wrapper">


<div class="container-fluid">
	<div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="navbars">VODサイト管理ツール</h1>
        </div>

        <div class="bs-component">
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">取得済みリスト</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">

	  <li class="nav-item">
        <a class="nav-link" href="pre_list.php">映画リスト</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="imp.php">CSVアップロード</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="db.php">Database</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="config.php">設定</a>
      </li>
    </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>
        </div>


      </div>
    </div>
<div class="col-sm-12">




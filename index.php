<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="style.css">

</style>
<div class="container">
  <h1 class="title text-center"> News API</h1>
  <hr>
  <div class="list-wrapper">
    <?php
      if(file_exists('news.json')){
        $api_url = 'news.json';
        $newslist = json_decode(file_get_contents($api_url));
      }else{
        $news_keyword = 'politics'; // tipo de noticias a mostrar
        $api_url = 'http://newsapi.org/v2/everything?q'.$news_keyword.'&from=2020-05-05&sortBy=publishedAt&apiKey=c3e75fbd85ba4087b03c3ce0e29db162';
        $newslist = file_get_contents($api_url);
        file_put_contents('news.json', $newslist);
        $newslist = json_decode($newslist);
      }
      foreach($newslist->articles as $news){?>
      <div class="row single-news">
        <div class="col-md-4">
          <img style="width:100%;" src="<?php echo $news->urlToImage;?>">
        </div>
        <div class="col-md-8">
          <h2><?php echo $news->title;?></h2>
          <small><?php echo $news->source->name;?></small>
          <?php if($news->author && $news->author!=''){ ?>
            <small>| <?php echo $news->author;?></small>
          <?php } ?>
          <p><?php echo $news->description;?></p>
          <a href="<?php echo $news->url;?>" class="btn btn-sm btn-primary" style="float:right;" target="_blank">Read More >></a>
        </div>
      </div>
    <?php } ?>
  </div>

    <?php
     
    #Include Libraries
    include("/root/library/LIB_parse.php");
    include("/root/library/LIB_http.php");
     
    #Variables
    $title_array = array();
    $link_array = array();
    $pub_date_array = array();
    $SlickDealsURL = "http://www.slickdeals.net/";

    #Download the page
    $web_page = http_get($target="http://feeds.feedburner.com/SlickdealsnetFP", $referrer="");
     
    #Parse the Title Tags
    $title_excl = parse_array($web_page['FILE'], "<title>", "</title>");
    $link_excl = parse_array($web_page['FILE'], "<link>", "</link>");
    $pub_date_excl = parse_array($web_page['FILE'], "<pubDate>", "</pubDate>");
     
    for($x=0; $x < count($title_excl); $x++)
    {
    #Array Titles
    $title_array = $title_excl[$x];

    #Remove Title Tags
    $remove = strip_tags($title_array);
    $removeSpace = str_replace("&amp", "", $remove);
    $removeAnd = str_replace(";amp;", "", $removeSpace);
    $removeMore = str_replace("More", "", $removeAnd);
    $removeMuchMore = str_replace("Much more", "", $removeMore);

    #Remove Slick Deals URL
    $removeSlick = str_replace("SlickDeals.net", "", $removeMuchMore);
    $removeSlickURL = str_replace($SlickDealsURL, "", $removeSlick);

    #Array Links
    $link_array = $link_excl[$x];
    $removeLinkTags = strip_tags($link_array);

    #Array Publication Date
    $pub_date_array = $pub_date_excl[$x-1];
    $removePubDateTags = strip_tags($pub_date_array);

    #Print Publication Date
    #Print URL and Links
    echo $removeSlickURL."\n".$removeLinkTags."\n".$removePubDateTags."\n"."\n";;
    }
    ?>


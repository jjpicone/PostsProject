<?php 
// Load posts API
$url = "https://api.crowdtangle.com/posts?token=2xpyFYUqGbuNPzkbhmGVYHMiskH6A46kTL5bSkg8";
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://api.crowdtangle.com/posts?token=2xpyFYUqGbuNPzkbhmGVYHMiskH6A46kTL5bSkg8",
    CURLOPT_CONNECTTIMEOUT => 10,
    ));
$output = curl_exec($curl);
curl_close($curl);

// Connect to database server, create posts database, and locate posts database
$link = mysqli_connect('localhost', 'root', 'asdfasdf.0'); 

if (!$link) 
{ 
  $put = 'Unable to connect to the database server.'; 
  echo $put; 
  exit(); 
} 

if (!mysqli_set_charset($link, 'utf8')) 
{ 
  $put = 'Unable to set database connection encoding.'; 
  echo $put; 
  exit(); 
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS posting";
if (!mysqli_query($link, $sql))  
{  
  $put = 'Error creating posting database: ' . mysqli_error($link);  
  echo $put; 
  exit();  
}  

if (!mysqli_select_db($link, 'posting')) 
{ 
  $put = 'Unable to locate the posts database.'; 
  echo $put;
  exit(); 
}

// Create posts database
$sql = 'CREATE TABLE IF NOT EXISTS postDB (  
      post INT NOT NULL PRIMARY KEY,
      id TEXT,  
      platform TEXT,  
      date TEXT,
      updated TEXT,
      type TEXT,
      title TEXT,
      caption TEXT,
      description TEXT,
      message TEXT,
      original TEXT,
      expanded TEXT,
      links TEXT,
      score TEXT,
      mtype TEXT,
      murl TEXT,
      mheight TEXT,
      mwidth TEXT,
      mfull TEXT,
      alikecount TEXT,
      asharecount TEXT,
      acommentcount TEXT,
      elikecount TEXT,
      esharecount TEXT,
      ecommentcount TEXT,
      accid TEXT,
      accname TEXT,
      acchandle TEXT,
      accprofimage TEXT,
      accsubscriberCount TEXT,
      accurl TEXT,
      accplatform TEXT,
      accplatformid TEXT,
      accverified TEXT

    )'; 

if (!mysqli_query($link, $sql))  
{  
  $put = 'Error creating posts table: ' . mysqli_error($link);  
  echo $put; 
  exit();  
}  

//If refresh post link is pressed, load posts and input into database
if (isset($_GET['refreshpost']))   
{
  $obj = json_decode($output, true);
  $j=0;
  $k=0;
  
  foreach ($obj['result']['posts'] as $key => $var) {
    $i = $key;
    $post = $key + 1;
    $id = $obj['result']['posts'][$i]['id'];
      $id = mysqli_real_escape_string($link, $id);
      $platform = $obj['result']['posts'][$i]['platform'];
      $platform = mysqli_real_escape_string($link, $platform);
      $date = $obj['result']['posts'][$i]['date'];
      $date = mysqli_real_escape_string($link, $date);
      $updated = $obj['result']['posts'][$i]['updated'];
      $updated = mysqli_real_escape_string($link, $updated);
      $type = $obj['result']['posts'][$i]['type'];
      $type = mysqli_real_escape_string($link, $type);
      $title = $obj['result']['posts'][$i]['title'];
      $title = mysqli_real_escape_string($link, $title);
      $caption = $obj['result']['posts'][$i]['caption'];
      $caption = mysqli_real_escape_string($link, $caption);
      $description = $obj['result']['posts'][$i]['description'];
      $description = mysqli_real_escape_string($link, $description);
      $message = $obj['result']['posts'][$i]['message'];
      $message = mysqli_real_escape_string($link, $message);
      $original=$obj['result']['posts'][$i]['expandedLinks'][$j]['original'];
      $original = mysqli_real_escape_string($link, $original);
      $expanded=$obj['result']['posts'][$i]['expandedLinks'][$j]['expanded'];
      $expanded = mysqli_real_escape_string($link, $expanded);
      $links=$obj['result']['posts'][$i]['expandedLinks'][$j]['link'];
      $links = mysqli_real_escape_string($link, $links);
      $score = $obj['result']['posts'][$i]['score'];
      $score = mysqli_real_escape_string($link, $score);
      $mtype=$obj['result']['posts'][$i]['media'][$k]['type'];
      $mtype = mysqli_real_escape_string($link, $mtype);
      $murl=$obj['result']['posts'][$i]['media'][$k]['url'];
      $murl = mysqli_real_escape_string($link, $murl);
      $mheight=$obj['result']['posts'][$i]['media'][$k]['height'];
      $mheight = mysqli_real_escape_string($link, $mheight);
      $mwidth=$obj['result']['posts'][$i]['media'][$k]['width'];
      $mwidth = mysqli_real_escape_string($link, $mwidth);
      $mfull=$obj['result']['posts'][$i]['media'][$k]['full'];
      $mfull = mysqli_real_escape_string($link, $mfull);
      $alikecount = $obj['result']['posts'][$i]['statistics']['actual']['likeCount'];
      $alikecount = mysqli_real_escape_string($link, $alikecount);
      $asharecount = $obj['result']['posts'][$i]['statistics']['actual']['shareCount'];
      $asharecount = mysqli_real_escape_string($link, $asharecount);
      $acommentcount = $obj['result']['posts'][$i]['statistics']['actual']['commentCount'];
      $acommentcount = mysqli_real_escape_string($link, $acommentcount);
      $elikecount = $obj['result']['posts'][$i]['statistics']['expected']['likeCount'];
      $elikecount = mysqli_real_escape_string($link, $elikecount);
      $esharecount = $obj['result']['posts'][$i]['statistics']['expected']['shareCount'];
      $esharecount = mysqli_real_escape_string($link, $esharecount);
      $ecommentcount = $obj['result']['posts'][$i]['statistics']['expected']['commentCount'];
      $ecommentcount = mysqli_real_escape_string($link, $ecommentcount);
      $accid=$obj['result']['posts'][$i]['account']['id'];
      $accid = mysqli_real_escape_string($link, $accid);
      $accname=$obj['result']['posts'][$i]['account']['name'];
      $accname = mysqli_real_escape_string($link, $accname);
      $acchandle=$obj['result']['posts'][$i]['account']['handle'];
      $acchandle = mysqli_real_escape_string($link, $acchandle);
      $accprofimage=$obj['result']['posts'][$i]['account']['profileImage'];
      $accprofileimage = mysqli_real_escape_string($link, $accprofileimage);
      $accsubscriberCount=$obj['result']['posts'][$i]['account']['subscriberCount'];
      $accsubscriberCount = mysqli_real_escape_string($link, $accsubscriberCount);
      $accurl=$obj['result']['posts'][$i]['account']['url'];
      $accurl = mysqli_real_escape_string($link, $accurl);
      $accplatform=$obj['result']['posts'][$i]['account']['platform'];
      $accplatform = mysqli_real_escape_string($link, $accplatform);
      $accplatformid=$obj['result']['posts'][$i]['account']['platformId'];
      $accplatformid = mysqli_real_escape_string($link, $accplatformid);
      $accverified=$obj['result']['posts'][$i]['account']['verified'];
      $accverified = mysqli_real_escape_string($link, $accverified);
      $query = 'REPLACE postDB
      SET post = "' . $post . '",
      id="' . $id . '",  
      platform="' . $platform . '",  
      date="' . $date . '",
      updated="' . $updated . '",
      type="' . $type . '",
      title="' . $title . '",
      caption="' . $caption . '",
      description="' . $description . '",
      message="' . $message . '",
      original="' . $original . '",
      expanded="' . $expanded . '",
      links="' . $links . '",
      score="' . $score . '",
      mtype="' . $mtype . '",
      murl="' . $murl . '",
      mheight="' . $mheight . '",
      mwidth="' . $mwidth . '",
      mfull="' . $mfull. '",
      alikecount="' . $alikecount . '",
      asharecount="' . $asharecount . '",
      acommentcount="' . $acommentcount . '",
      elikecount="' . $elikecount . '",
      esharecount="' . $esharecount . '",
      ecommentcount="' . $ecommentcount . '",
      accid="' . $accid . '",
      accname="' . $accname . '",
      acchandle="' . $acchandle . '",
      accprofimage="' . $accprofimage . '",
      accsubscriberCount="' . $accsubscriberCount . '",
      accurl="' . $accurl . '",
      accplatform="' . $accplatform . '",
      accplatformid="' . $accplatformid . '",
      accverified="' . $accverified . '"';

    if(!mysqli_query($link, $query))
    {
        $put = 'Unable to input data into database';
        echo $put;
        var_dump($link);
        exit();
    }
  } //end of foreach  
  header('Location: .');   
  exit();   
} // end of ISSET

// If delete button is pressed, delete post from database
if (isset($_GET['deletepost']))    
{    
  $postid = mysqli_real_escape_string($link, $_POST['postid']);    
  $sql = 'DELETE FROM postDB WHERE id="' . $postid . '"';    
  if (!mysqli_query($link, $sql))    
  {    
    $error = 'Error deleting post: ' . mysqli_error($link);        
    exit();    
  }    
  header('Location: .');    
  exit();    
}

// Query posts from database
$data = mysqli_query($link,"SELECT * FROM postDB");
if (!$data)    
{    
  $error = 'Error fetching jokes: ' . mysqli_error($link);
}

// Include file that outputs posts on database
include 'posts.html.php'; 

?>
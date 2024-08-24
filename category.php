<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
    <div class="container-fluid top">
        <?php include "includes/navigation.php";?>

        <div class="main ">
            <div class="container-fluid col-md-10 col-md-offset-1">
                <div class="col-xs-12 row">
                    <div class="content  col-lg-8">
                        <!-- showing the post data -->
                        <?php
                            if(isset($_GET['category_id'])){
                                $category_id=$_GET['category_id'];
                            }
                            $query="select * from posts where post_category_id=$category_id";
                            $re=mysqli_query($connection,$query);
                            if(!$re){
                                die('query fail'.mysqli_error($connection));
                            }
                            else{
                                // count the avalible post in this specific category
                                $number_of_availible_rows=mysqli_num_rows($re);
                                if($number_of_availible_rows==0){
                                    echo "No Post Added In This Category yet";
                                }
                            
                                while($rows=mysqli_fetch_assoc($re)){
                                    $post_id=$rows['post_id'];
                                    $post_title=$rows['post_title'];
                                    $post_author=$rows['post_author'];
                                    $post_date=$rows['post_date'];
                                    $post_image=$rows['post_image'];
                                    $post_content=$rows['post_content'];
                                    
                            ?>
                            <h1>
                                <a href="./post.php?post_id=<?php echo $post_id  ?>"><?php echo $post_title;?></a>
                            </h1>
                            <h5>by <?php echo $post_author;?></h5>
                            <small><span class="fa fa-clock-o"></span> <?php echo $post_date;?></small>
                            <hr>
                            <div class="image col-xs-12" style="background-color: blue; height: 250px;">
                                <img src="images/<?php echo $post_image;?>" alt="" width="100%" height="100%">
                            </div>
                            <hr>
                            <p><?php echo $post_content;?></p>
                            <button class="btn btn-primary">Read More <span class="fa fa-caret-right"></span></button>
                            <hr>

                            <?php            
                                }
                            }
                        ?>

                        
                    </div>
                    
                    <?php include "includes/sidebar.php";?>
                </div>
            </div>
        </div>
    </div>
<?php include "includes/footer.php";?>
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
                            if(isset($_GET['post_id'])){
                                $post_id=$_GET['post_id'];
                             
                            $query="select * from posts where post_id =$post_id";
                            $re=mysqli_query($connection,$query);
                            if(!$re){
                                die('query fail'.mysqli_error($connection));
                            }
                            else{
                                while($rows=mysqli_fetch_assoc($re)){
                                    $post_title=$rows['post_title'];
                                    $post_author=$rows['post_author'];
                                    $post_date=$rows['post_date'];
                                    $post_image=$rows['post_image'];
                                    $post_content=$rows['post_content'];
                                    
                            ?>
                            <h1>
                                <a href="#"><?php echo $post_title;?></a>
                            </h1>
                            <h5>by <?php echo $post_author;?></h5>
                            <small><span class="fa fa-clock-o"></span> <?php echo $post_date;?></small>
                            <hr>
                            <div class="image col-xs-12" style="background-color: blue; height: 250px;">
                                <img src="images/<?php echo $post_image;?>" alt="" width="100%" height="100%">
                            </div>
                            <hr>
                            <p><?php echo $post_content;?></p>
                            <!-- <button class="btn btn-primary">Read More <span class="fa fa-caret-right"></span></button> -->
                            <hr>

                            <?php            
                                }
                            }
                        }
                        ?>
                        <!-- adding comments -->
                        <?php
                            if(isset($_POST['add_comment'])){
                                $comment_author=$_POST['comment_author'];
                                $comment_author_email=$_POST['comment_author_email'];
                                $comment_content=$_POST['comment_content'];
                                $query="INSERT INTO comments VALUES(null,'$post_id','$comment_author',
                                '$comment_author_email','$comment_content','draft',now())";
                                $re=mysqli_query($connection,$query);
                                if(!$re){
                                    die('query fail'.mysqli_error($connection));
                                }
                                
                            $add_comment="UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id=$post_id";
                            $result=mysqli_query($connection,$add_comment);

                            }
                        ?>
                        <div class="comment col-xs-12">
                            <div class="addComment col-xs-12">
                                <form action="" method="post">
                                    <br><h4>Leave Comment</h4>
                                    <div class="mb-3 mt-3">
                                        <label for="author" class="form-label"><b>Author</b></label>
                                        <input type="text" class="form-control" name="comment_author" id="author" ></input>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email" class="form-label"><b>Email</b></label>
                                        <input type="email" class="form-control" name="comment_author_email" id="email" ></input>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="comment" class="form-label"><b>Your Comment</b></label>
                                        <textarea class="form-control" name="comment_content" id="comment" ></textarea>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <input type="submit" class="btn btn-primary"  name="add_comment" value="Submit">
                                    </div>
                                </form>
                            </div><hr>
                            <div class="viewAllComments row" style="padding:0 12px">
                                    <!-- retreving comments of the post -->
                                    <?php
                                        $post_id=$_GET['post_id'];
                                        $query="select * from comments where comment_post_id=$post_id and comment_status='approved'";
                                        $re=mysqli_query($connection,$query);
                                        if(!$re){
                                            die('query fail'.mysqli_error($connection));
                                        }
                                        else{
                                        while($rows=mysqli_fetch_assoc($re)){
                                            $comment_author=$rows['comment_author'];
                                            $comment_content=$rows['comment_content'];
                                            $comment_date=$rows['comment_date'];
                                    ?>
                                        <div class="comment_image col-2" style="padding:0">
                                            <div>
                                               
                                            </div>
                                        </div>
                                        <div class="commment_content col-10">
                                            <div style="margin-top:-5px">    
                                                <b><?php echo $comment_author;?></b> <small><?php echo $comment_date;?></small>
                                                <p><?php echo $comment_content;?></p>
                                            </div><br>
                                        </div>    
                                    <?php }} ?>   
                            </div><hr>
                        </div>  <!--comment div-->
                    </div>   <!--content div -->
                    
                    <?php include "includes/sidebar.php";?>
                </div>
            </div>
        </div>
    </div>
<?php include "includes/footer.php";?>
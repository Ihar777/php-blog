<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
    <!-- Navigation -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
        <?php 
                
            
     if(isset($_POST['submit'])) {
     $search = $_POST['search'];
         
         $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
         $search_query = mysqli_query($connection, $query);
         
         if(!$search_query) {
             
             die("QUERY FAILED" . mysqli_error($connection));
             
         }
         
         $count = mysqli_num_rows($search_query);
         
         if($count == 0) {
             
             echo "<h1 class='text-center'> NO RESULTS </h1><p class='text-center'>Try searching for another post</p>";
             
         } else {            

            while($row = mysqli_fetch_assoc($search_query)) {
            	$post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100) . "...";
                
                ?>
        
                <!-- First Blog Post -->
                <h2 class="text-center">
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?post_author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span>&nbsp;<?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>     
                
     <?php } 

             
         }
     }
     ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"; ?>  


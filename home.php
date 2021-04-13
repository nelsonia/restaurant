<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <header class="hero flex items-center">
        <div class="container">
            <div class="welcome flex items-center">
                <span>Welcome to</span>
                <img src="./icons/logo-2.svg" alt="">
            </div>
            <h1>The World Best <span>Shoping</span> Website</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                been the
                industry's standard dummy.</p>
            <div>
                <button class="btn btn-primary">Read More</button>
                <button class="btn btn-secondary">Shop Now</button>
            </div>
            <div class="hero-image">
                <img src="./images/straw.png" alt="">
            </div>
        </div>
    </header>


    <!-- <section class="page-section" id="menu" style="text-align: center;"> -->
    <section class="top-products" id="product" style="text-align: center;">
        <div class="container">
            <h1 class="section-heading">Top products</h1>
            <div class="slider">
                <button class="slider-btn prev-btn"><img src="./icons/pre.svg" alt=""></button>
                <button class="slider-btn next-btn"><img src="./icons/next.svg" alt=""></button>
                <div class="food-slider">
                    <div class="food-card magic-shadow-sm">
                        <div class="product-image flex items-center justify-center">
                            <div id="menu-field" class="card-deck">
                                <?php
                                include 'admin/db_connect.php';
                                $qry = $conn->query("SELECT * FROM  product_list order by rand() ");
                                while ($row = $qry->fetch_assoc()) :
                                ?>
                                    <div class="col-lg-3">
                                        <div class="card menu-item ">
                                            <img src="assets/img/<?php echo $row['img_path'] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['name'] ?></h5>
                                                <p class="card-text truncate"><?php echo $row['description'] ?></p>
                                                <div class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary view_prod btn-block" data-id=<?php echo $row['id'] ?>><i class="fa fa-eye"></i> View</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('.view_prod').click(function() {
            uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
        })
    </script>


</body>
<script src="./js/app.js"></script>

</html>
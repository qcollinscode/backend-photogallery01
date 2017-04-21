<?php include "includes/admin_header.php"; ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Visitor</small>
                        </h1>


                            <?php

                                if(isset($_GET['source'])) {
                                    $source = $_GET['source'];
                                } else {
                                    $source = '';
                                }

                                switch($source) {
                                    case "add_photo";
                                        include "includes/add_photo.php";
                                    break;
                                    case "update_photo";
                                        include "includes/update_photo.php";
                                    break;
                                    case "200";
                                        echo "";
                                    break;
                                    default:
                                        include "includes/view_all_photos.php";
                                    break;
                                }

                            ?>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>

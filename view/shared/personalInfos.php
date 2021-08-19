<?php
    ob_start();
    require_once("view/shared/navbarConnected.php");
    extract($personalInfos);
    if(!$path_to_picture){
        if($civilite == "male") $imgSrc = "public/images/maleIcon.png";
        else $imgSrc = "public/images/annonces/femaleIcon.png";
    }
    else $imgSrc = $path_to_picture;
?>
<div class="containter-fluid">
    <div class="row">
        <div class="col-lg-3 border-end">
            <?php
            if($_SESSION['type'] == "transporteur"){
                require_once("view/carrier/profileSideNav.php");
            }
            else if($_SESSION['type'] == "client"){
                require_once("view/client/profileSideNav.php");
            }
            ?>
        </div>
        <div class="col-lg-9">
            <form action="index.php?action=changeProfilePicture" method="POST" enctype="multipart/form-data">
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <img src="<?= $imgSrc ?>" class="medium-image" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <input type="file" name="profilePicture" value="<?= $imgSrc ?>" accept="image/png, image/gif, image/jpeg" />
                    </div>
                </div>
                <div class="col-12 text-center my-2">
                    <button type="submit" class="btn btn-primary">Changer la photo de profil</button>
                </div>
            </form>
            <form action="index.php?action=<?= $action ?>" method="POST">
                <?php if($_SESSION['type'] == "transporteur") require_once("view/carrier/myInfos.php");
                else if($_SESSION['type'] == "client") require_once("view/client/myInfos.php") ?>
            </form>
        </div>
    </div>
</div>
<?php
    require_once("view/footer.php");
    $content = ob_get_clean();
    require_once("view/template.php");
?>
    
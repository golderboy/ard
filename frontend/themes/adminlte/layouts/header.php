<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ADR</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            <?php 
                            if(!\Yii::$app->user->isGuest){
                                echo \Yii::$app->user->identity->username;
                            }else{
                                echo "Guest";
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="golderboy@gmail.com" class="img-circle" alt="User Image"/>

                            <p>
                                <?php 
                            if(!\Yii::$app->user->isGuest){
                                echo \Yii::$app->user->identity->username;
                            }else{
                                echo "Guest";
                            }
                            ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
			<?php
			if (Yii::$app->user->isGuest) {
				echo 	"
				        <li class='user-footer'>
                            <div class='pull-left'>
                                ".Html::a('สมัครสมาชิก',['/user/registration/register'],
                                    ['class' => 'btn btn-default btn-flat']
                                )."
                            </div>
                            <div class='pull-right'>
                                ".Html::a('เข้าสู่ระบบ',
                                    ['/user/security/login'],
                                    ['class' => 'btn btn-default btn-flat']
                                )." 
                            </div>
						</li>
						";
						
            }else{
				echo 	"
				        <li class='user-footer'>
                            <div class='pull-left'>
                                ".Html::a('แก้ไขข้อมูลส่วนตัว',['/user/settings/profile'],
                                    ['class' => 'btn btn-default btn-flat']
                                )."
                            </div>
                            <div class='pull-right'>
                                ".Html::a('ออกจากระบบ',
                                    ['/user/security/logout'],
                                    ['data-method' => 'POST','class' => 'btn btn-default btn-flat']
                                )." 
                            </div>
						</li>
						";
			}
			?>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<i class="glyphicon glyphicon-qrcode"></i>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
            ]);
            $guestItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Array', 'url' => ['/site/about']],
          /*      [
                    'label' => 'Dropdown',
                    'items' => [
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Dropdown Header</li>',
                        ['label' => 'Level 2 - Dropdown B','url' => '#'],
                    ],
                ],*/
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'สมัครสมาชิก', 'url' => ['/user/registration/register']];
                $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']];
            } else{
                $menuItems = [
                    ['label' => 'DATA', 'url' => ['/orm/data']],
                    ['label' => 'Pcc', 'url' => ['/pcc/person']],
                  ];
				if(Yii::$app->user->identity->id ==1){
					  $adminItems[] = [
						  'label' => 'จัดการระบบ Admin',
						  'items' => [
							  '<li class="divider"></li>',
							  ['label' => 'จัดการผู้ใช้','url' => ['/user/admin']],
							  ['label' => 'Role','url' => ['/rbac/role']],
							  ['label' => 'Permission','url' => ['/rbac/permission']],
							  ['label' => 'Rule','url' => ['/rbac/rule']],
							  ['label' => 'Assignment','url' => ['/rbac/assignment']],
							  '<li class="dropdown-header"></li>',
							  [
							  'label' => '<span class="glyphicon glyphicon-off"></span> Logout',
							  'url' => ['/user/security/logout'],
							  'linkOptions' => ['data-method' => 'post']
							],
						  ],
						];
					echo Nav::widget([
						'options' => ['class' => 'navbar-nav navbar-right'],
						'items' => $adminItems,
						'encodeLabels' => false,
					]);
				  }else{		 
					$menuItems[] = [
						'label' => '<span class="glyphicon glyphicon-user"></span> ' . \Yii::$app->user->identity->username,
						'items' => [
							'<li class="divider"></li>',
							'<li class="dropdown-header">menu header</li>',
							[
							  'label' => '<span class="glyphicon glyphicon-off"></span> Logout',
							  'url' => ['/user/security/logout'],
							  'linkOptions' => ['data-method' => 'post']
							],
						],
					];
				}
			}
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);

            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $guestItems,
                'encodeLabels' => false,
            ]);
           echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => [['label' => 'Yii2 Phayao']],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; You <?= date('Y') ?></p>

                <p class="pull-right"><?php echo "โดย...."; ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

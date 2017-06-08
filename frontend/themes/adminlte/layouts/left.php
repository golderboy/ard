<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                    <?php 
                        if(!\Yii::$app->user->isGuest){
                            echo '<p>'.\Yii::$app->user->identity->username.'</p>';
							echo '<i class="fa fa-circle text-success"></i> Online</a>';
                        }else{
                            echo "<p>Guest</p>";
							echo '<i class="fa fa-circle"></i> Offline</a>';
                        }
                    ?>

                
            </div>
        </div>
	
		<?php
		if (Yii::$app->user->isGuest) {
			echo dmstr\widgets\Menu::widget(
					[
						'options' => ['class' => 'sidebar-menu'],
						'items' => [
							['label' => 'Main Menu', 'options' => ['class' => 'header']],
							['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login'], 
										'visible' => Yii::$app->user->isGuest
							],
						],
					]
				);
		}else{
			if(Yii::$app->user->id == 1){
				echo dmstr\widgets\Menu::widget(
					[
						'options' => ['class' => 'sidebar-menu'],
						'items' => [
							['label' => 'Menu Admin', 'options' => ['class' => 'header']],
							['label' => 'เมนู Admin',
								'items' => [
									['label' => 'จัดการผู้ใช้','url' => ['/user/admin']],
									//['label' => 'Role','url' => ['/rbac/role']],
									//['label' => 'Permission','url' => ['/rbac/permission']],
									//['label' => 'Rule','url' => ['/rbac/rule']],
									['label' => 'กำหนดสิทธิ์ User','url' => ['/rbac/assignment']],
									//['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
									['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
								],
							],						
							['label' => 'Menu User', 'options' => ['class' => 'header']],
							['label' => 'เมนู User',
								'items' => [
									['label' => 'นำเข้าไฟล์ Excel','url' => ['/import/excel/index']],
									['label' => 'ค้นหาข้อมูลผู้แพ้ยา','url' => ['/drugdata/drugdata/index']],
									['label' => 'รายงานจำนวนผู้ป่วยแพ้ยา','url' => ['/drugdata/report/report1']],
									['label' => 'รายงานผู้ป่วยแพ้ยา','url' => ['/drugdata/report/report2']],
								],
							],
						],
					]
				);
			}else{
				echo dmstr\widgets\Menu::widget(
					[
						'options' => ['class' => 'sidebar-menu'],
						'items' => [
							['label' => 'Menu User', 'options' => ['class' => 'header']],
							['label' => 'นำเข้าไฟล์ Excel','url' => ['/import/excel/index']],
							['label' => 'ค้นหาข้อมูลผู้แพ้ยา','url' => ['/drugdata/drugdata/index']],
							['label' => 'รายงานจำนวนผู้ป่วยแพ้ยา','url' => ['/drugdata/report/report1']],
							['label' => 'รายงานผู้ป่วยแพ้ยา','url' => ['/drugdata/report/report2']],
							
						]
					]
				);			
			}
			
			echo dmstr\widgets\Menu::widget(
					[
						'options' => ['class' => 'sidebar-menu'],
						'items' => [
							['label' => 'Main Menu', 'options' => ['class' => 'header']],
							['label' => 'ออกจากระบบ',
										'url' => '?r=user/security/logout',
											['data-method' => 'POST'],
								'visible' => !Yii::$app->user->isGuest
							],
						],
					]
				);
		}
		?>


    </section>

</aside>

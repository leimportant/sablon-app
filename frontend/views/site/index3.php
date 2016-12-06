<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<body>
    <style>
        .navbar {
            border-radius: 0px;
        }
    </style>

    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar container navbar-inverse',
        ],
    ]);
    $leftItems[] = ['label' => ('Program and Services'),
        'items' => [
                ['label' => ('Policy and Procedure'), 'url' => ['/policy-and-procedure']],
        ],
    ];
   
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftItems,
    ]);
    NavBar::end();
    ?>

    <section id="content_area" class="container">  
        <h3> 
            Policy and Procedure
            <?php
//                if (Yii::app()->user->checkAccess('Group.PolicyandprocedureServices.Index')) :
//                    echo '' . CHtml::link('Policy and Procedure', array('/group/policyandprocedureServices'));
//                endif;
            ?>  
        </h3> 
        <h3> 
            <?php
//                if (Yii::app()->user->checkAccess('Group.FinancialServices.Index')) :
//                    echo '' . CHtml::link('Financial services', array('/group/financialservices'), array('class' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-2132'));
//                endif;
            ?>  
        </h3> 
        <?php
//            if (Yii::app()->user->checkAccess('Group.FinancialServices.Index')) :
//                echo '<p> Tujuan dari bagian ini adalah untuk memberikan pedoman dan informasi tentang semua kegiatan operasional yang berhubungan dengan keuangan bagi seluruh karyawan PT. Stanli</p>';
//            endif;
        ?>  
        <h3>  
            <?php
//                if (Yii::app()->user->checkAccess('Group.HumanResourceServices.Index')) :
//                    echo '' . CHtml::link('Human resources information system', array('/group/humanresourceservices'));
//                endif;
            ?>   
        </h3> 
        <?php
//            if (Yii::app()->user->checkAccess('Group.HumanResourceServices.Index')) :
//                echo '<p> Tujuan dari bagian ini adalah untuk memberikan pedoman dan informasi mengenai semua kegiatan yang berhubungan dengan kebijakan tentang proses di departemen Human Resources </p>';
//            endif;
        ?>  
        <h3>
            <?php
//                if (Yii::app()->user->checkAccess('Group.ProcurementServices.Index')) :
//                    echo '' . CHtml::link('Procurement services', array('/group/procurementservices'));
//                endif;
            ?>   
        </h3> 
        <?php
//            if (Yii::app()->user->checkAccess('Group.ProcurementServices.Index')) :
//                echo '<p> Tujuan dari bagian ini adalah untuk memberikan pedoman dan informasi mengenai semua kegiatan operasional yang berhubungan dengan pembelian atau penjualan barang</p>';
//            endif;
        ?>  
        <h3>  
            <?php
//                if (Yii::app()->user->checkAccess('Group.InformationTechnologyservices.Index')) :
//                    echo '' . CHtml::link('Information and technology services', array('/group/informationtechnologyservices'));
//                endif;
            ?>   
        </h3> 
        <?php
//            if (Yii::app()->user->checkAccess('Group.InformationTechnologyservices.Index')) :
//                echo '<p>Tujuan dari bagian ini adalah untuk memberikan pedoman dan informasi mengenai seluruh aktifitas yang berhubungan dengan informasi dan teknologi </p>';
//            endif;
        ?> 

    </section>
</body>


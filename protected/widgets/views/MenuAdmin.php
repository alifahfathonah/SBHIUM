  <!-- sidebar menu -->

  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">

      <h3>||</h3>

      <ul class="nav side-menu">

        <li><a href="<?= Yii::App()->createUrl('/admin/dashboard')?>"><i class="fa fa-home"></i> Home </a>

        </li>

        <?php if(Yii::app()->user->getState('role')==1):?>

          <li><a href="<?= Yii::App()->createUrl('/admin/users')?>"><i class="fa fa-users"></i> Daftar Investor </a></li>

        <?php endif;?>

        <li><a href="<?= Yii::App()->createUrl('/admin/penjualan')?>"><i class="fa fa-tags"></i> Daftar Penjualan </a>

        </li>

        <li><a href="<?= Yii::App()->createUrl('/admin/pengeluaran')?>"><i class="fa fa-minus-square"></i> Daftar Pengeluaran </a>

        </li>

        <li><a href="<?= Yii::App()->createUrl('/admin/barang')?>"><i class="fa fa-th-list"></i> Daftar Barang </a>

        </li>
        <?php if(Yii::app()->user->getState('role')==1):?>
          <li><a href="<?= Yii::App()->createUrl('/admin/slot')?>"><i class="fa fa-th-list"></i> Slot Investor </a>
        <?php endif;?>
        </li>

        <li><a><i class="fa fa-book"></i> Laporan <span class="fa fa-chevron-down"></span></a>

          <ul class="nav child_menu">

            <li><a href="<?= Yii::App()->createUrl('/admin/report/laporan_penjualan/laporan_investor')?>">Laporan Penjualan Investor</a></li>

            <li><a href="<?= Yii::App()->createUrl('/admin/report/laporan/laporan_penjualan')?>">Laporan Penjualan</a></li>

            <li><a href="<?= Yii::App()->createUrl('/admin/report/laporan/laporan_pengeluaran')?>">Laporan Pengeluaran</a></li>
            <?php if(Yii::app()->user->getState('role')==1):?>

              <li><a href="<?= Yii::App()->createUrl('/admin/report/laporan/laporan_slot')?>">Laporan Slot </a></li>

            <?php endif;?>

          </ul>

        </li>

      </ul>

    </div>

  </div>

  <!-- /sidebar menu -->
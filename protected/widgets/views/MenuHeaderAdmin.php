        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid" style="background-color: #F0EDF6;">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><img style="height: 60px;" src="<?= Yii::app()->theme->baseUrl ?>/images/mncam.png"></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> Hi, <?php echo Yii::app()->user->getState('username') ?> ! <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?= Yii::app()->createUrl('/user_profil/profil/profil') ?>">Profile</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?= Yii::app()->createUrl('/user_profil/profil/change_password') ?>">Change Password</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?= Yii::app()->createUrl('/login/bye')?>">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
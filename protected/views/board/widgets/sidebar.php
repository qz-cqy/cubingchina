<!-- begin SIDE NAVIGATION -->
<nav class="navbar-side" role="navigation">
  <div class="navbar-collapse sidebar-collapse collapse">
    <?php $this->widget('zii.widgets.CMenu', array(
      'htmlOptions'=>array(
        'class'=>'nav navbar-nav side-nav',
        'id'=>'side',
      ),
      'submenuHtmlOptions'=>array(
      ),
      'encodeLabel'=>false,
      'items'=>array(
        array(
          'label'=>'<i class="fa fa-table"></i> 比赛 <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'competition',
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#competition',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'competition',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 比赛管理',
              'url'=>array('/board/competition/index'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 新增比赛',
              'url'=>array('/board/competition/add'),
            ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-group"></i> 报名 <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'registration',
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#registration',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'registration',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 报名管理',
              'url'=>array('/board/registration/index'),
            ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-group"></i> 用户 <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'user',
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#user',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'user',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 用户管理',
              'url'=>array('/board/user/index'),
              'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMINISTRATOR),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 数据统计',
              'url'=>array('/board/user/statistics'),
            ),
            // array(
            //  'label'=>'<i class="fa fa-angle-double-right"></i> 新增用户',
            //  'url'=>array('/board/user/add'),
            // ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-money"></i> 财务 <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'pay',
          'visible'=>Yii::app()->user->checkAccess(User::ROLE_ORGANIZER),
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#pay',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'pay',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 支付流水',
              'url'=>array('/board/pay/index'),
              'visible'=>Yii::app()->user->checkAccess(User::ROLE_ORGANIZER),
            ),
            // array(
            //  'label'=>'<i class="fa fa-angle-double-right"></i> 财务报表',
            //  'url'=>array('/board/pay/statistics'),
            //  'visible'=>Yii::app()->user->checkAccess(User::ROLE_ORGANIZER),
            // ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-bullhorn"></i> 新闻 <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'news',
          'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMINISTRATOR),
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#news',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'news',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 新闻管理',
              'url'=>array('/board/news/index'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 发布新闻',
              'url'=>array('/board/news/add'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 新闻模板',
              'url'=>array('/board/news/template'),
            ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-bullhorn"></i> 评价<i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'review',
          'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMINISTRATOR),
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#review',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'review',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 评价管理',
              'url'=>array('/board/review/index'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 发布评价',
              'url'=>array('/board/review/add'),
            ),
          ),
        ),
        array(
          'label'=>'<i class="fa fa-bullhorn"></i> FAQ <i class="fa fa-caret-down"></i>',
          'url'=>'javascript:;',
          'active'=>$this->controller->id == 'faq',
          'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMINISTRATOR),
          'linkOptions'=>array(
            'data-parent'=>'#side',
            'data-toggle'=>'collapse',
            'class'=>'accordion-toggle',
            'data-target'=>'#faq',
          ),
          'itemOptions'=>array(
            'class'=>'panel',
          ),
          'submenuOptions'=>array(
            'class'=>'collapse nav in',
            'id'=>'faq',
          ),
          'items'=>array(
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> FAQ管理',
              'url'=>array('/board/faq/index'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> 新增FAQ',
              'url'=>array('/board/faq/add'),
            ),
            array(
              'label'=>'<i class="fa fa-angle-double-right"></i> FAQ分类',
              'url'=>array('/board/faq/category'),
            ),
          ),
        ),
      )
    ));?>
  </div>
  <!-- /.navbar-collapse -->
</nav>
<!-- /.navbar-side -->
<!-- end SIDE NAVIGATION -->
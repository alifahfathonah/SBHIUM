<div class="row-fluid">
    <div class="span3">
    </div>
    <div class="span9" style="margin-left:-25px; margin-top: -480px;">
     <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Menu</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <?php
                        $Hierarchy=Menuutama::model()->findAll(array('condition'=>'parentid = 0','order'=>' Sort ASC'));                 
                        foreach ($Hierarchy as $Hierarchy){                     
                            $models = Menuutama::model()->findBypk($Hierarchy->id);
                            $items[] = $models->getListed();
                        }
                        
                        $this->widget('zii.widgets.CMenu',array(        
                                        'items'=>$items,
                                        'htmlOptions'=>array('id'=>'listCat')
                                    ));
                    ?>
                </div>   
               <a class="btn btn-primary" href="<?= Yii::app()->createUrl('/admin/menu/add_main') ?>"><i class="icon-list"></i> Add Menu</a>
            </div>
        </div>
    </div>
</div>  
<script type="text/javascript">
    function deleteCurrent(id) {
        var ask = confirm('Delete current menu ?');
        if (ask) {
            $.post('<?= $this->createUrl('/admin/menu/delete') ?>',{i:id},function(r){
                var data = $.parseJSON(r);
                if (data.success==1) {
                    alert('Successfully deleted');
                    window.location.reload();
                }else{
                    alert('An error occured. '+e.htmlEror);
                }
            });
        }
    }
    $(function(){
        $('ul[id="listCat"] li a').on('click',function(e){
            //alert('tetew');
            e.preventDefault();
            var id = $(this).attr('href').replace('#','');
            parent.$.fancybox.open([
            {      
                content : '<p>Please select an action :</p><br /><a class="btn btn-primary" href="<?= $this->createUrl('/admin/menu/add') ?>?p='+id+'"><i class="icon-list"></i> Add items</a>&nbsp;<a class="btn btn-warning" href="<?= $this->createUrl('/admin/menu/edit') ?>?i='+id+'"><i class="icon-pencil"></i> Edit current</a>&nbsp;<a class="btn btn-danger" onclick="deleteCurrent('+id+')"><i class="icon-trash"></i> Delete current</a>',
            }])
        })
    })
</script>
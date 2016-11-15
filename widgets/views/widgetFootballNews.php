<?php
use yii\helpers\Html;

$this->registerJs('
function show(block,id) 
{ 
	$("#"+block+"_"+id).slideToggle({ opacity: "show" }, "slow");
}
	', yii\web\View::POS_HEAD);
?>


	<div class="sidebarbox-title"><h3><?= \Yii::t('main', 'Football news')?></h3></div>

	<div class="footNews" style="padding:8px">	
		<table class="table table-striped table-condensed">
		<?php if(isset($footballNews)) foreach ($footballNews as $var) : ?>
		<tr>
			<td>
				<i class="fa fa-futbol-o"></i>
				 <?= Html::a($var['title'], 'javascript:show("newsid", ' . $var['id'] . ')') ?> 
			</td>
			<tr>
				<td>
					<div style="display:none" id="newsid_<?= $var['id'] ?>">
						<?= $var['description'] ?>

						<?= Html::a(Yii::t('main', 'More'), ['/site/default/footballnews', 'id' => $var['id']], 
						[
							'onclick' => 'getFnews(' . $var['id'] . '); return false',
							'id' => 'link_' . $var['id'],
							'class' => 'button next-prev',
						]
						)?>
						<i class="fa fa-angle-double-right"></i>

					</div>
				</td>
			</tr>
		<?php endforeach; ?>					
		</table>
	</div>	



<script type="text/javascript">
function getFnews(id)
{
	$('#link_' +id).html('<i class="fa fa-spinner fa-pulse"></i>');
	var link = $('#link_' +id).attr('href');
	$.post
    (
       link, 
        
        	function(data)
        	{
        		$('#link_' +id).html('');
        		$('#newsid_'+id).append(data) 
        	}
    );
}
</script>

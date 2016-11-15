<?php
use yii\helpers\Html;
?>

<div class="news radius_block"> 
						<div class="header_line news_header">
							<span class="left">&nbsp;</span><span class="right">&nbsp;</span>
							<div class="header_text">
								<span><?php echo \Yii::t('main', 'News')?></span>
							</div>
							<div class="link_text">
								<a href="/post"><span><?php echo \Yii::t('main', 'More')?></span></a>	
							</div>
							<div style="clear:both"></div>
							<table>
								<tr>
									<Td class="newsleft">
										<div class="top_news round_down">
											<div class="news_content">
												<?= Html::a(substr($post[0]->title, 0, 70), ['/post/default/view', 'slug' => $post[0]->slug, 'id' => $post[0]->id])?>
												
											
												<?= $post[0]->short?>
											</div>
										</div> 
									</Td>
									<td class="newsleft">
										<div class="top_news round_down">
											<div>
												<?= Html::a(substr($post[1]->title, 0, 70), ['/post/default/view', 'slug' => $post[1]->slug, 'id' => $post[1]->id])?>
											</div>
											<?= $post[1]->short?>
										</div>
									</td>
								</tr>
							</table>
						</div> 
					</div> <!-- news radius_block -->
<style type="text/css">
.news_content input[type=image] {
	width: 125px !important;
	height: 125px !important;
	float:left;
	margin:5px;
}
</style>
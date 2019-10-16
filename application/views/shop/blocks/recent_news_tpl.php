<?php
    $recent_news = $this->news_model->get_recent_news();
    $recent_news_text = $this->news_model->get_news_text(@$recent_news['news_id']);
?>
				<div class="box_top">
					<h2><?php echo $this->lang->line('main_news'); ?></h2>
				</div>	
					<div class="box">
                        <p class="highlight"><?php echo @$recent_news_text['title_'.$lang]; ?></p>
						<p>
                            <?php echo mb_substr(strip_tags(@$recent_news_text['description_'.$lang]), 0, 250, 'UTF-8').'...'; ?><br />
                        </p>
                        <p style="text-align:right;"><a href="<?php echo site_url('/shop/news'); ?>" title="<?php echo $this->lang->line('main_news'); ?>"><?php echo $this->lang->line('main_news'); ?></a></p>
					</div>
				<div class="box_bottom"></div>
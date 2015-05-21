<?php the_field('study_summary');
		$attachment_id = get_field('study_pdf');
		$url = $attachment_id['url'];
		$title = $attachment_id['title'];
		$subtext = $attachment_id['description'];
		if( get_field('study_pdf') ):
			echo '<div class="clearfix pad-half-b">';
			echo '<h4>View The Study</h4>';
			echo '<a class="btn btn-download" href="';
			echo $url;
			echo '" target="_blank"><i class="icon-download icon-2x pull-right"></i>';
			echo $title;
			echo ' <br/>';
			echo '<small><em>';
			echo $subtext;
			echo '</em></small></a></div>';
		endif;
		?>
        
        <div class="clearfix">
          <h3>Study Details</h3>
          <? if( get_field('study_president')): 
				echo '<p><strong>Board President: </strong>';
				echo get_field('study_president');
				echo '</p>';
			endif;
            if( get_field('study_chair')): 
				$chairs = get_field('study_chair');
				$result = count($chairs);
				$count = "0";
				echo '<p>';
				if ($result == 1){
					echo '<strong>Study Chairperson: </strong>';
					foreach($chairs as $chair){
						echo $chair['chair_name'];
					}
				} else {
					echo '<strong>Study Co-Chairs: </strong>';
					foreach($chairs as $chair){
						$count++;
						echo $chair['chair_name'];
						if($count != $result){
							echo ', ';
						}
					}
				}
				echo '</p>';
			endif; ?>
          </div>
        <div class="clearfix">
          
          <? $links = get_field('study_links');
		if( $links ): ?>
        <h3>More On The Study:</h3>
          <ul class="list-unstyled">
            <?php foreach( $links as $link): ?>
            <li> <a href="<?php echo get_permalink($link->ID); ?>" class="btn-default"><?php echo get_the_title($link->ID); ?> <i class="icon-chevron-right"></i></a> </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
          
          <? $blogs = get_field('study_blog');
		if( $blogs ): ?>
        <div class="camel-bg"></div>
        <h4>Study Topic Blog:</h4>
          <ul class="list-unstyled">
            <?php foreach( $blogs as $blog): ?>
            <li> <a href="<?php echo get_permalink($blog->ID); ?>" class="btn-default"><?php echo get_the_title($blog->ID); ?> <i class="icon-chevron-right"></i></a> </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
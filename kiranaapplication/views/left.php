<div id="left">
					<h1 class="bar">Categories</h1>
                      <?php if($categories=='empty')
					echo " Sorry - No category found";
					else
					{
						
						?>
					<ul id="cats">
                    
                    <?php foreach($categories as $category){?>
						<li><a href="<?php echo base_url();?>index.php/category/<?php echo $category->cat_id;?>/<?php echo url_title(strtolower($category->cat_name));?>"><?php echo $category->cat_name;?></a></li>
                      <?php } ?>  
					</ul>
                    <?php } ?>
				</div>
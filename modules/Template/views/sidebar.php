
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-border" data-scroll-to-active="true">
      <div class="main-menu-content">
        
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="navigation-header">
                    <span class="uppercase">Umum</span>
            </li>      
          
            <?php  foreach ($this->menu as $keys => $s): $active = '';?>
                <?php 
                if ($this->uri->segment(1) == $s['url']|| $this->uri->segment(1).'/'.$this->uri->segment(2) == $s['url']):
                    $active = 'active';
                endif 
                ?>
            
            <li class="nav-item <?=$active?>">
              <a href="<?=site_url($s['url'])?>"><i class="<?=$s['icon']?>"></i>
                <span class="menu-title" >
                  <?=$s['title']?>
                </span>
              </a>
            </li>
          <?php endforeach ?>
          
          
        </ul>
      </div>
    </div>
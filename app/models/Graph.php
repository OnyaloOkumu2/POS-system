<?php
   class Graph {
      public  $canvasX=1000;
      public  $canvasY=400;
      public  $font_size=16;
      public  $styles ="";
      public  $title ="Graph Title";
      public  $xTitle= "Title X";

      public function display($data){
         if(!is_array($data)||empty($data)){
            echo "No Data found";
            return;
         }
         $canvasX = $this->canvasX;
         $canvasY = $this->canvasY;
         $xText = array_keys($data);
         $maxY = max($data);
         $multiplierY =$canvasY/$maxY;
         $maxX=count($data);
         $multiplierX = $canvasX/$maxX;
         $num =1;
         $points ="0,$canvasY ";
            foreach ($data as $key=>$value){
            $points .= $multiplierX*$num .",".$canvasY-$value*$multiplierY." ";
            $num ++;
            }
            $points .= "$canvasX,$canvasY";
            $extraX = 100;
            $extraY = 50;
         ?>
         <svg viewBox="0 -<?=$extraY?> <?=$canvasX + $extraX?> <?=$canvasY + ($extraY*2.5)?>" class="border mb-2" style="width:80%;<?=$this->styles?>">
            <!-- top to bottom lines -->
            <?php
               for($i=0;$i<$maxX;$i++) {
                  $x1=$i*$multiplierX;
                  $y1=0;
                  $x2=$x1;
                  $y2=$canvasY;
                  ?>
                  <polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>"  style="stroke-width:1;stroke:#eee;fill:#ccc"/>
                  <?php
               }
            ?>
            <!-- left to right Lines -->
            <?php
               $max_lines =count($data);
               $Y_segment=floor($canvasY/$max_lines);
               for($i=0;$i<$maxY;$i++) {
                  $x1=0;
                  $y1=$i*$Y_segment;
                  $x2=$canvasX;
                  $y2=$y1;
                  
                  ?>
                  <polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>"  style="stroke-width:1;stroke:#eee;fill:#ccc"/>
                  <?php
      
               }
            ?>
            <polyline points="<?=$points?>"  style="stroke-width:2px;stroke:white;fill:#cccccc"/>
            <?php
            $num =1;
            $points ="0,$canvasY ";
            foreach ($data as $key=>$value){
               ?>
               <circle cx="<?=$multiplierX*$num?>" cy="<?=$canvasY-($value*$multiplierY)?>" r="6" style="fill:grey;stroke:white;stroke-width:2;"/>
               <?php if($value !=0):?>
               <text x="<?=$multiplierX*$num?>" y="<?=$canvasY-($value*$multiplierY)+20?>" style="font-size:14px"><?=$value?></text>
               <?php endif;?>
               <?php
               $num ++;
            }
            ?>
         
            <!-- x Text values -->
            <?php
            $num =0;
            ?>
            <?php foreach($xText as $value): $num++?>
            <text x="<?=($num*$multiplierX)-($multiplierX/4)?>" y="<?=$canvasY+($extraY/1.5)?>" style="fill:blue;font-size:<?=$this->font_size?>px"><?=$value?></text>
            <?php endforeach;?>
            <!-- Y values Text -->
            <?php
               $max_lines =count($data);
               $Y_segment=floor($canvasY/$max_lines);
               $num=$maxY;
               for($i=0;$i<$maxY;$i++) {    
                  $x=$canvasX;
                  $y=$i*$Y_segment;
                  if(round($num)<1){
                  break;
                  }
                  ?>
                  <text x="<?=$x+($multiplierX/6)?>" y="<?=$y?>" style="fill:orange;font-size:<?=$this->font_size?>px"><?=round($num)?></text>
                  <?php
                  $max_lines = $max_lines ? $max_lines:1;
                  $num -=($maxY/$max_lines);
               }
            ?>
            <!-- Graph Title -->
               <text x="10" y="-<?=($extraY/2.5)?>">
                  <?=$this->title?>
               </text>
               <!-- x axis  title -->
                  <?php
                     $textOffset = strlen($this->xTitle)/2*8;
                  ?>
               <text x="<?=($canvasX/2)-$textOffset?>" y="<?=($canvasY+$extraY+10)?>" style="font: size 16px;">
                  <?=$this->xTitle?>
               </text>
         </svg>
         <?php
      }
   }
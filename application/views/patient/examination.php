<?php
//if(@$comments){
//foreach ($comments as $comment) {
echo "<div id='examination" . $examination->examination_id . "' class='well well-md'>";
echo "<div class='commentBody'>OFC: " . $examination->ofc . '</div>';
echo "<div class='commentBody'>Height: " . $examination->height . '</div>';
echo "<div class='commentBody'>Weight: " . $examination->weight . '</div>';
echo "<div class='commentBody'>Temperature: " . $examination->temperature . '</div>';
echo "<div class='commentBody'>BP: " . $examination->bp . '</div>';
echo "<div class='commentBody'>oxygen saturation O2: " . $examination->oxygen_sat . '</div>';
echo "<div class='commentBody'>X-Ray results: " . $examination->xrayr . '</div>';
echo "<div class='commentBody'>Lab Test results: " . $examination->labr . '</div>';
echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($examination->create_date, 'UP45')) . "</div>";
echo "</div>";
  //}
//}

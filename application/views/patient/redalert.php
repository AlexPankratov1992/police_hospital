<?php
// echo "<div id='redalertmsg" . $redalert->redalert_id . "' class='well well-md'>";
// echo "<div class='redalertBody' style='color:red;    font-size: larger;'>" . $redalert->redalert . '</div>';
// echo "<div style='float:right; margin-left:5px;'>| <a href='#redalertGroup' id='delete-redalert' onclick='deleteRedAlert(" . $redalert->redalert_id . ")'>Delete</a></div>"; //<span class='close'>&times;</span>
// echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($redalert->create_date, 'UP45')) . "</div>";
// echo "</div>";

echo "<li id='timelineitem" . $redalert->redalert_id . "'>";
echo '<a target="_blank" href="#">Red Alert</a>';
echo '<a href="#" class="float-right"> | ' . date('M d, Y', gmt_to_local($redalert->create_date, 'UP45')) . '</a>';
echo "<a href='#redalertGroup' id='delete-redalert' onclick='deleteRedAlert(" . $redalert->redalert_id . ")'>| <span class='glyphicon glyphicon-remove-circle'></span></a>";
echo '<p style="color:red;    font-size: larger;">' . $redalert->redalert . '</p>';
echo "</li>";

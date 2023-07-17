<script>
  $(document).ready(function() {
    $('.symtoms').click(function(e) {
      if (document.querySelector("#comment").textLength === 0) {
        document.querySelector("#comment").append($(this).val());
      } else {
        document.querySelector("#comment").append("\n" + $(this).val());
      }
    })

  });
</script>

<div class="tab-pane" id="comments">
  <style>
    .symtoms {
      border: 0;
      margin-top: 13px;
      margin-bottom: 13px;
    }

    .symtoms:hover {
      transform: scale(1.3);
      /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
  </style>

  <input type="button" value="Fever" class="symtoms">
  <input type="button" value="Cough" class="symtoms">
  <input type="button" value="Flu" class="symtoms">
  <input type="button" value="L.M" class="symtoms">
  <input type="button" value="Vomiting" class="symtoms">
  <input type="button" value="Rashes" class="symtoms">
  <input type="button" value="Throat Pain" class="symtoms">
  <input type="button" value="Abd. Pain" class="symtoms">
  <input type="button" value="Leg Pain" class="symtoms">
  <br>

  <script>
    $(document).ready(function() {
      //script of this section
      $('#commentsave').click(function(e) {
        console.log(e.which);
        // if (e.which == 43) { // insert button
        $.post($('#commentBox').attr('action'), $('#commentBox').serialize(),
          function(data) {
            $('#commentGroup').prepend(data);
            $('#comment').val('');
          });
        return false;
        // }
      });
    });
  </script>
  <?php
  if ($this->session->userdata('ba_user_id') == $doctor->user_id && $status_code > 1) {
    echo form_open('comment/add/' . $doctor->patient_doctor_id, array('id' => 'commentBox'));
    echo form_hidden('patient_doctor_id', $doctor->patient_doctor_id);
    echo form_textarea('comment', '', 'class="form-control" id="comment" placeholder="Write your comment about this patient..." required');
    echo form_button('commentsave', 'Save', 'class="form-control" style="margin-top:10px; background: #428bca;color: white;" id="commentsave" placeholder="Save" required');
    echo form_close();
    echo "<p></p>";
  }
  if (@$comments != 'unauthorized') {
    echo "<div id='commentGroup'>";
    foreach ($comments as $comment) {
      echo "<div id='comment" . $comment->comment_id . "' class='well well-md'>";
      echo "<div class='commentBody'>" . $comment->comment . '</div>';
      echo "<div class='pull-right'>Create Date: " . date('M d, Y', gmt_to_local($comment->create_date, 'UP45')) . "</div>"; //<span class='close'>&times;</span>
      echo "</div>";
    }
    echo "</div>";
  } else {
    echo "<div id='commentGroup'>";
    echo "<div class='alert alert-warning'>You are not authorized to view the comments.</div>";
    echo "</div>";
  }
  ?>
</div>
 <form method="post">
 <div class="form-group">
   <input type="text" name="title" id="title" class="form-control bg-light" placeholder="Title"
     value="<?php echo $currentNote["title"] ?>">
   <hr>
   <input type="date" name="date" id="date" class="form-control bg-light"
     value="<?php echo $currentNote["date"] ?>">
   <hr>
   <textarea name="content" id="content" rows="16" placeholder="Content"
     class="form-control bg-light"><?php echo $currentNote["content"] ?></textarea>
 </div>
</form>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php session_start();?>
<?php include 'header.php';?>
       <span class="panel_name">Teacher Panel [<?php echo $_SESSION['subject'];?>]</span>
     <div class="main-body">
              
            <div class="sidebar">
              <ul class="main_menu"> 
                <li><a class="menu" href="assigned_students.php">Assigned Students</a></li>
                <li><a class="menu" href="put_marks.php">Put Marks</a></li>
                <li><a class="menu" href="see_marks.php">See Marks</a></li>
              </ul>
            </div>

            <div class="content">
                   <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt consectetur culpa perferendis laboriosam. Ut saepe beatae voluptate, debitis veritatis, sunt eaque tempora hic at incidunt totam! Ipsam sunt, accusamus minima ab excepturi vel harum labore tempora eaque facere fugit pariatur in tenetur eum inventore laborum saepe quis totam, natus alias illum illo voluptates. Reiciendis modi quaerat labore porro? In, debitis?</p>
            </div>
     </div>

     <div class="footer">
     

     </div>
  

</body>
</html>

<span class="category-header">Loại Hàng <i class="fa fa-list"></i></span>
<ul class="category-list">
    <?php
        require_once('DataProvider.php');
        $gender=array("Nam","Nữ","Unisex");
        foreach($gender as $Gender)
        {
            //Execute Query
            $sql = "SELECT * FROM ProductType WHERE Gender='$Gender'";
            $rs=DataProvider::executeQuery($sql);
            //--Execute Query

            //show
            echo "<li class='dropdown side-dropdown'>";
            echo "<a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>$Gender <i class='fa fa-angle-right'></i></a>";
            echo "<div class='custom-menu'>";
            echo "<div class='row'>";
            $i=0; $Count=mysqli_num_rows($rs);
            while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
            {
                if($i==0)
                {
                    echo "<div class='col-md-4'>";
                    echo "<ul class='list-links'>";
                }
                echo "<li><a href='products.php?slcType=".$row['ProductTypeName']."&slcGender=$Gender'>".$row['ProductTypeName']."</a></li>";
                if($i==4)
                {
                    echo "</ul>";
                    echo "</div>";
                }
                else $i++;
            }
            if($Count==0)
                echo "<p>Không có loại hàng</p>";
            echo "</div>";
            echo "</div>";
            echo "</li>";
            //--show
        }
    ?>
</ul>
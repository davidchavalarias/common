<?php
// STAT ///////
pt('Stats');
    echo 'number of articles treated: '.$articles.'<br/>';
    echo 'number of abstracts treated: '.$nbAB.'<br/>';
    echo 'number of articles with p-values: '.$articleWithPvalues.'<br/>';

    $sql="INSERT INTO ".$count_table." (id,type,year,value) VALUES ('','nbArticles','".$name."','".$articles."')";
    echo $sql.'<br/>';
    mysql_query($sql) or die ("<b>data not inserted)</b>.");

    $sql="INSERT INTO ".$count_table." (id,type,year,value) VALUES ('','nbAbstracts','".$name."','".$nbAB."')";
    echo $sql.'<br/>';
    mysql_query($sql) or die ("<b>data not inserted)</b>.");


    $sql="INSERT INTO ".$count_table." (id,type,year,value) VALUES ('','nbArticlesWithPvalues','".$name."','".$articleWithPvalues."')";
    echo $sql.'<br/>';
    mysql_query($sql) or die ("<b>data not inserted)</b>.");



?>

<?php
require_once '../app/Mage.php';
Mage::app();
$read = Mage::getSingleton('core/resource')->getConnection('core_read');
$fp = fopen('createcategory.csv','r') or die("can't open file");
print "<table>\n";
while($csv_line = fgetcsv($fp,1024)) {
    print '<tr>';
	//echo "count=".count($csv_line);
    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
		echo "\nvalue=".$value=$read->fetchOne("select entity_id from catalog_category_entity_varchar where value ='".$csv_line[1]."'");
      if($value=="" && $i==1){
		  echo "catname".$categoryname=$csv_line[1];
		 echo "\nroot catid=". $parentId=$read->fetchOne("select entity_id from catalog_category_entity_varchar where value ='".$csv_line[2]."'");
echo "<br>";	

		$category = Mage::getModel('catalog/category');
$category->setName($categoryname)
->setIsActive(1)                       //activate your category
->setDisplayMode('PRODUCTS')
->setIsAnchor(1)
->setCustomDesignApply(1)
->setAttributeSetId($category->getDefaultAttributeSetId());
//$parentId=2;
$parentCategory = Mage::getModel('catalog/category')->load($parentId);
$category->setPath($parentCategory->getPath());

$category->save();
unset($category);



	
	  }
	  //print '<td>'.$i.$csv_line[$i].'</td>';
    }
    print "</tr>\n";
}
print '</table>';
fclose($fp) or die("can't close file");


/*$read = Mage::getSingleton('core/resource')->getConnection('core_read');
$write =Mage::getSingleton('core/resource')->getConnection('core_write');  	
$value=$read->fetchOne("select entity_id from catalog_category_entity_varchar where value =$excelcatvalue");
	
	




$category = Mage::getModel('catalog/category');
$category->setName('Service Providers')
->setIsActive(1)                       //activate your category
->setDisplayMode('PRODUCTS')
->setIsAnchor(1)
->setCustomDesignApply(1)
->setAttributeSetId($category->getDefaultAttributeSetId());
$parentId=2;
$parentCategory = Mage::getModel('catalog/category')->load($parentId);
$category->setPath($parentCategory->getPath());

$category->save();
unset($category);*/
?>
<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 ?>
 <a class="btn btn-success" href="<?php echo ossn_site_url("administrator/component/Categories?type=add");?>"><?php echo ossn_print('categories:add');?></a>
 <table class="table margin-top-10">
  <tr class="table-titles">
    <th scope="col"><?php echo ossn_print('category:title');?></th>
    <th scope="col"><?php echo ossn_print('category:description');?></th>
    <th scope="col"><?php echo ossn_print('delete');?></th>
  </tr>
 <?php
 $categories = new Categories;
 $categories = $categories->getAll();
 if($categories){
		foreach($categories as $item){
				$delete = ossn_plugin_view('output/url', array(
						'href' => ossn_site_url("action/category/delete?guid={$item->guid}", true),											   
						'text' => ossn_print('delete'),											   
				));
			?>
 		 <tr>
    			<td><?php echo $item->title;?></td>
    			<td><?php echo $item->description;?></td>
    			<td><?php echo $delete;?></td>
  		 </tr>            
            <?php
		}
 }?>
 </table>
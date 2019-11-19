<?php

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}

function stripUnicode($str){
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

function role_parent($data, $parent = 0, $str="--", $select = 0)
{
	foreach ($data as $key => $val) 
	{
		# code...
		$id = $val["id"];
		$name =  $val["name"];
		if($val['parent_id'] == $parent )
		{
			if($select != 0 && $id == $select)
			{
				echo "<option value='$id' selected='selected'>$str $name</option>";
			} else
			{
				echo "<option value='$id'>$str $name</option>";
			}
			role_parent($data, $id, $str."--", $select);
		}
		

	}
}


function get_roles($data, $parent = 0, $str="--")
{
	// echo $stt;
	global $stt;
	global $arr;
	// var_dump($arr);
	// exit();
	foreach ($data as $e) {
		# code...
		// var_dump($e->id);
		// exit();
		$id = $e->id;
		$name =  $str.$e->name;
		$description = $e->description;
		if($e->parent_id == $parent )
		{
			$stt++;
			// $arr
			// echo $stt."-".$id."-".$name."<br>";
			$e =  array('role_id' => $id, 'name' => $name, 'description' => $description);
			$arr[] = $e;
			get_roles($data, $id, $str."--");
			
		} 

	}
	return $arr;
	// return $arr;
	// echo "<pre>";
	// var_dump($arr);
}

function role_parent_elements($data, $parent = 0, $str="--")
	
{
	
	foreach ($data as $key => $val) 
	{
		# code...
		$id = $val["id"];
		$name =  $val["name"];
		$description = $val["description"];
		if($val['parent_id'] == $parent )
		{
			
			echo '<tr>';
            echo '<td>';
            echo $id;
            echo '</td>';  
            echo '        <td>';
            echo $str . $name;
            echo '        </td>';
            echo '        <td>';
            echo $description;         
            echo '        </td>';
            echo '        <td>';
                      
            echo '        </td>';
                    
            echo '        <td class="text-primary" style="text-align: center;">';
            echo '          <a rel="tooltip" class="btn btn-success btn-link" href="edit/'.$id.'" data-original-title="" title="">';
            echo '            <i class="material-icons">edit</i>';
            echo '            <div class="ripple-container"></div>';
            echo '            <a rel="tooltip" class="btn btn-success btn-link" href="delete/'.$id.'" data-original-title="" title="">';
            echo '            <i class="material-icons">delete</i>';
            echo '            <div class="ripple-container"></div>';
            echo '          </a>';
            echo '          </a>';
            echo '        </td>';
            echo '      </tr>';
			role_parent_elements($data, $id, $str."--");
		}
		

	}
	// return $elements;
}

function get_prioryties($priority) {

	$priorities = [
	    '1' => 'Thấp',
	    '2' => 'Vừa',
	    '3' => 'Cao',
	    '4' => 'Khẩn cấp',
	    '5' => 'Ngay lập tức'
	  ];
    foreach ($priorities as $key => $value) {
         # code...
       	
   		if($priority == $key) {
     
         	echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
         
        } else {
          
         	echo '<option value="'.$key.'">'.$value.'</option>';
          
       }
       	
        
    }
}

function get_status($status) {
	$statuses = [
	    '1' => 'Chờ',
	    '2' => 'Đang thực hiện',
	    '3' => 'Từ chối',
	    '4' => 'Hủy',
	    '5' => 'Hoàn thành',
	    '6' => 'Kết thúc'
	];
  	foreach ($statuses as $key => $value) {
    	if($status == $key) {
    	
      		echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
     
    	} else {
    
      		echo '<option value="'.$key.'">'.$value.'</option>';
    
    	}  
  	}
  
}

function get_priority_name($priority) {
	$priorities = [
	    '1' => 'Thấp',
	    '2' => 'Vừa',
	    '3' => 'Cao',
	    '4' => 'Khẩn cấp',
	    '5' => 'Ngay lập tức'
	  ];
  	foreach ($priorities as $key => $value) {
    	if($priority == $key) {
      		return $value;
    	} 
  	}
  
}

function get_status_name($status) {
	$statuses = [
	    '1' => 'Chờ',
	    '2' => 'Đang thực hiện',
	    '3' => 'Từ chối',
	    '4' => 'Hủy',
	    '5' => 'Hoàn thành',
	    '6' => 'Kết thúc'
	 ];
  	foreach ($statuses as $key => $value) {
    	if($status == $key) {
    	
      		
      		return $value;
     
    	} 
  	}
  
}

function sendViberNotify()
{

}

// function saveRequestLog($RequestModel, $username, $description){
//     $RequestLog = new RequestLog;
//     $RequestLog->request_id = $RequestModel->id;
//     $RequestLog->support_user = $RequestModel->support_user;
//     $RequestLog->support_manager = $RequestModel->support_manager;
//     $RequestLog->description = $description;
//     $RequestLog->status = $RequestModel->status;
//     $RequestLog->owner = $username;
//     $RequestLog->save();
// }
?>
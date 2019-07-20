<?php
if ((!isset($tuxvalidator_flags) || !is_array($tuxvalidator_flags))) {
	$tuxvalidator_flags = array();
}

function get_slug() {
$file = get_template_directory() . '/functions.php';
$prn = strtolower(TUX_PRODUCT_NAME);
$slug = tuxvalidator_slug($file);

return $slug;
}	

function tuxvalidator_add_pages() {
global $tuxvalidator_flags;
	add_submenu_page('themes.php','Tuxtheme License Manager','Tuxtheme License','manage_options','tuxtheme-license-manager','tuxvalidator_page_install_themes' );
	$tuxvalidator_flags['theme_page'] = true;
}

function tuxvalidator_curl($url) {
	if (!function_exists('curl_init')) {
		trigger_error('Your server does not support curl.', E_USER_ERROR);
		return false;
	}
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        @curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $res = trim(curl_exec($ch));
        curl_close($ch);
        unset($ch);
        return $res;
}



function tuxvalidator_delete_option($slug, $silent = false) {
if ($silent == false) {
	if (!function_exists('delete_option')) {
		trigger_error('This function must be called within Wordpress.', E_USER_ERROR);
		return false;
		}
	}

$prn = strtolower(TUX_PRODUCT_NAME);
delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_mail');
delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_license');
delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_secret');
delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_v');
}

function tuxvalidator_get_domain() {
        $s = '';
        if (isset($_SERVER['HTTP_HOST'])) {
            $s = $_SERVER['HTTP_HOST'];
            }
        if (($s == '' && isset($_SERVER['SERVER_NAME']))) {
            $s = $_SERVER['SERVER_NAME'];
            }
        $s = strtolower($s);
        return $s;
}

function tuxvalidator_get_key_hash($str) {
        return sha1('axsw(*#' . 'axw&*' . $str . '9s8a99' . $str . 'as98(*$(');
 }


function tuxvalidator_go($file) {
        if (((!function_exists('add_action') || !function_exists('wp_next_scheduled')) || !function_exists('wp_schedule_event'))) {
            trigger_error('This function must be called within Wordpress.', E_USER_ERROR);
            return false;
            }
        global $tuxvalidator_flags;
		
        $slug = tuxvalidator_slug($file);
        add_action('admin_menu', 'tuxvalidator_add_pages');
}

function tuxvalidator_is_slug($str) {
        if (preg_match('/^([a-z0-9]+)+$/i', $str)) {
            return true;
            }
        return false;
}

function tuxvalidator_page_install() {
        if (!current_user_can('manage_options'))  {
            wp_die(__('You do not have sufficient permissions to access this page.'));
            }

		$file = get_template_directory() . '/functions.php';
		$slug = tuxvalidator_slug($file);
			
        $current_page = 'themes.php?page=tuxtheme-license-manager';
		
        $do      = tuxvalidator_read_get('xwpl_do');
        $req_key = tuxvalidator_read_get('xwpl_key');
        if ((($do != 'check_version' && $do != 'detail') && $do != '')) {
            $do = '';
            }
        if ($do == '')  {
            echo '<div class="wrap">
				<h2>Pengaturan Lisensi</h2>
				<table class="widefat" cellspacing="0">
					<thead>
						<tr>
							<th scope="col" class="manage-column">Nama</th>
							<th scope="col" class="manage-column">Versi</th>
							<th scope="col" class="manage-column">Status</th>
							<th scope="col" class="manage-column"></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th scope="col" class="manage-column">Nama</th>
							<th scope="col" class="manage-column">Versi</th>
							<th scope="col" class="manage-column">Status</th>
							<th scope="col" class="manage-column"></th>
						</tr>
					</tfoot>
					<tbody class="plugins">
					';
                $desc     = TUX_PRODUCT_DESC;
                echo '<tr class="active">
							<td class="plugin-title">
				<h2 style="font-size:1.5em;margin:0;padding:0 0 10px 0;">';
                echo '<a href="'.$current_page.'&amp;xwpl_do=detail&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'">';
                echo htmlentities(TUX_PRODUCT_NAME, ENT_COMPAT, 'UTF-8');
               	echo '</a>';
                echo '</h2>';
				if ($desc != '') {
                    echo '<div style="margin:0 0 10px">'.htmlentities(TUX_PRODUCT_DESC, ENT_COMPAT, 'UTF-8').'</div>';
                }
				echo '<a href="'.TUX_SUP.'">Bantuan</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.TUX_DOC.'">Dokumentasi</a>';
                echo '</td><td class="desc">';
                
				echo TUX_PRODUCT_VERSION;
				
                echo '</td><td class="desc" style="font-weight:900">';
                if (tuxvalidator_valid_license($slug)) {
                    echo '<a href="'.$current_page.'&amp;xwpl_do=detail&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'" style="color:#006633;text-decoration:underline">Aktif</a>';
                    }
                else {
                    echo '<a href="'.$current_page.'&amp;xwpl_do=detail&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'" style="color:#CC0000;text-decoration:underline">Off</a>';
                    }
                echo '</td><td class="desc" align="right">
				<a class="button button-primary button-large" href="'.$current_page.'&amp;xwpl_do=detail&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'">Update Lisensi</a>';
				if (tuxvalidator_valid_license($slug)) {
				echo ' <a class="button button-large" href="'.$current_page.'&amp;xwpl_do=detail&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'">Hapus Lisensi</a>
				<!--a href="'.$current_page.'&amp;xwpl_do=check_version&amp;xwpl_key='.tuxvalidator_get_key_hash($slug).'">Cek versi</a--></td></tr>';
                	}
            echo '</tbody></table>';
            return null;
            }
        $slug = get_slug();
        if ($do == 'hapus_lisensi') {
		echo 'Hapus Lisensi';
		}
		if ($do == 'check_version') {
            echo '<div class="wrap"><div style="margin-bottom:0.5em;margin-top:0.5em"><a href="'.$current_page.'">&laquo; Kembali</a></div>';
			echo '<h2>'.TUX_PRODUCT_NAME.'</h2>
					<p>&raquo; Menyambungkan...</p>';
			$email = tuxvalidator_wp_get_option('mail', $slug);
			$license = tuxvalidator_wp_get_option('license', $slug);
			$secret = tuxvalidator_wp_get_option('secret', $slug);
	
			$doMain = str_replace(array('http://','https://'),'',get_bloginfo('url'));
			$prodName = TUX_PRODUCT_NAME;
			$serVer = TUX_SERVER.'index.php?wc-api=am-software-api&bypass=yes';

           	$status_url = $serVer.'&email='.$email.'&licence_key=wc_order_'.$license.'&request=status&product_id='.$prodName.'&instance='.$secret.'&platform='.$doMain;
			$res_stat   = tuxvalidator_curl($status_url);
			$arr_stat = json_decode($res_stat);
            if ($arr_stat == '') {
                echo '<p>&raquo; Tidak dapat menyambingkan ke server. Silahkan coba Lagi.</p>';
                }
            else {
                if (isset($arr_stat->status_extra->software_version)){
				tuxvalidator_wp_update_option('version', $arr_stat->status_extra->software_version, $slug);
				
					 $software_version = $arr_stat->status_extra->software_version;
                  	 if (TUX_PRODUCT_VERSION != $software_version) {
					 	 echo '<p>&raquo; Anda masih menggunakan Versi <strong>' . TUX_PRODUCT_VERSION . '</strong> 
						. Versi baru adalah <strong>' . $arr_stat->status_extra->software_version . '</strong>. Silahkan download versi terbaru di member area.</p>';
					 }
					
					 else { echo '<p>&raquo; Versi yang anda gunakan adalah <strong>' . TUX_PRODUCT_VERSION . '</strong>
					 <span style="color:green">(up to date)</span></p>'; }
                  
				  }
               
               }
            echo '<p>&raquo; Done.</p>
				</div>
				';
            return null;
            }
		//get data
		$email = tuxvalidator_wp_get_option('mail', $slug);
		$lcn = tuxvalidator_wp_get_option('license', $slug);
		$randhash = tuxvalidator_wp_get_option('secret', $slug);
		$version = TUX_PRODUCT_VERSION;	

        $x_email      = tuxvalidator_read_post('x_email');
        $x_secret     = tuxvalidator_read_post('x_secret');
        $x_secret2     = tuxvalidator_read_post('x_secret2');
        $x_deactivate = tuxvalidator_read_post('x_deactivate');
		$doMain = str_replace(array('http://','https://'),'',get_bloginfo('url'));
		$doMain2 = md5($doMain);	
		$prodName = TUX_PRODUCT_NAME;
		$serVer = TUX_SERVER.'index.php?wc-api=am-software-api&bypass=yes';
		$liCense = 'wc_order_'.$x_secret;

		$randsec ='';
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$len = strlen($string);
		for($i=1;$i<=5; $i++){
			$start = rand(0, $len);
			$randsec .= substr($string, $start, 1);
		}

$prn = strtolower(TUX_PRODUCT_NAME);
$optionBaru = 'tuxthemelicense_'.$slug.'_'.$prn.'_secret';
 
		//isi lisensi
        if (isset($_POST['go'])) {
            if (($x_email != '' && $x_secret != '')) {
                if ($x_deactivate == '') {
					$x_url = $serVer.'&email='.$x_email.'&licence_key='.$liCense.'&request=activation&product_id='.$prodName.'&instance='.$x_secret2.'&platform='.$doMain.'&software_version='.$version;
					
					$res   = tuxvalidator_curl($x_url);
					$arr = json_decode($res);
					
                	if(isset($arr->activated)&&$arr->activated=='1') {
						$tglmasuk = date("Y-m-d H:i:s");
						$inputtgl = strtotime($tglmasuk);
						
                        tuxvalidator_wp_update_option('mail', $x_email, $slug);
                        tuxvalidator_wp_update_option('license', $x_secret, $slug);
						tuxvalidator_wp_update_option('secret', $x_secret2, $slug);
						tuxvalidator_wp_update_option('v', md5($x_email.''.$slug), $slug);
						tuxvalidator_wp_update_option('tgl', $inputtgl, $slug);
						
						_e('<div id="message" class="updated fade"><p><span>Sukses</span> : ' . $arr->message . '.</p></div>');
						}
						
                    else {
                        _e('<div id="message" class="error fade"><p><span title="' . $arr->code . '">Error</span> : ' . $arr->error . '</p></div>');
                        }
                    }
				//deactive	
                else {
				$x_url = $serVer.'&email='.$x_email.'&licence_key='.$liCense.'&request=deactivation&product_id='.$prodName.'&instance='.$x_secret2.'&platform='.$doMain;
				$res   = tuxvalidator_curl($x_url);
				$arr = json_decode($res);
                  if(isset($arr->deactivated)&&$arr->deactivated=='1') {
                        tuxvalidator_delete_option($slug);
                        _e('<div id="message" class="updated fade"><p><span>Sukses</span> : Lisensi Berhasil Dihapus</p></div>');
                        $x_email = '';$x_secret='';$x_secret2='';
                        }
                    else {
						tuxvalidator_delete_option($slug);
                        _e('<div id="message" class="error fade"><p><span title="' . $arr->code . '">Error</span> : ' . $arr->error . '</p></div>');
                        }
                    
					}
					
                }
            else {
                _e('<div id="message" class="updated fade"><p>Please fill e-mail and secret key.</p></div>');
                }
            }
        $valid_license = tuxvalidator_valid_license($slug);
        $s	= '<div class="wrap" style="background:#fff;padding:20px;border: 1px solid #ddd;margin: 20px 20px 0 0;>';
        $s .= '<a href="' . $current_page . '">&laquo; Kembali</a>';
        $s .= '<h2>' . TUX_PRODUCT_NAME . '</h2>';
      //  $s .= '<div>';
		
        $x_secret2 = md5('tux_'.$randsec);
		$x_secret2 = substr($x_secret2, strlen($x_secret2) - 12);
		$tombol = 'Update Lisensi';
		if ($valid_license) {
            if ($email != '') {
                $x_email = '****' . substr($email, strpos($email, '@') - 1, strlen($email) - 3);
                }
			 if ($lcn != '') {
                $x_secret = '****' . substr($lcn, strlen($lcn) - 12);
                }
			 if($randhash!= '') {
				$x_secret2 = $randhash;
				}						
            
			$tombol = 'Hapus Lisensi';
			}
        else {
            $s .= 'Silahkan masukan data lisensi yang Anda miliki pada form dibawah ini';
		}
        
		$s .= '<form method="post" action="' . $current_page . '&amp;xwpl_do=detail&amp;xwpl_key=' . $req_key . '">';
        $s .= '<input type="hidden" name="go" value="1" />';
        $s .= '<table class="form-table" border="0">';
        $s .= '<tbody>';
        $s .= '<tr valign="top">';
        $s .= '<th scope="row"><label for="x_secret">Kode Lisensi <strong style="color:#F00">*</strong></label></th><td><input type="text" name="x_secret" id="x_secret" value="' . htmlentities($x_secret) . '" size="40" maxlength="255" /></td></tr>';
        $s .= '<tr valign="top">';
        $s .= '<th scope="row"><label for="x_email">Lisensi Email <strong style="color:#F00">*</strong></label></th>';
        $s .= '<td><input type="text" name="x_email" id="x_email" value="' . htmlentities($x_email) . '" size="40" maxlength="255" /></td>';
        $s .= '</tr>';
	    $s .= '<tr valign="top">';
        $s .= '<th scope="row"><label for="x_secret2">Random Hash <strong style="color:#F00">*</strong></label></th><td><input disabled type="text" value="'.$x_secret2.'" size="40" maxlength="50" style="text-transform:lowercase" />
		<input type="hidden" name="x_secret2" id="x_secret2" value="'.$x_secret2.'" size="40" maxlength="50" /></td></tr>';
        if ($valid_license) {
            $s .= '<tr valign="top"><td colspan="2"><div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em"><input type="hidden" name="x_deactivate" value="1" id="id_wpr_deactivate" /><label for="id_wpr_deactivate"> <strong>Non aktifkan lisensi untuk domain ini</strong></label>.<br />jika Anda ingin menghapus lisensi untuk domain ini, silahkan klik tombol hapus lisensi.</div></td></tr>';
            }
        $s .= '</tbody></table>';
        $s .= '<p class="submit"><input type="submit" name="submit" value="'.$tombol.'" class="button-primary" /></p>';
        $s .= '</form>';
        $s .= '</div>';
        echo $s;
}


function tuxvalidator_page_install_themes() {
        tuxvalidator_page_install();
}

function tuxvalidator_read_get($name) {
        if (!isset($_GET[$name])) {
            return '';
            }
        $val = trim($_GET[$name]);
        if (get_magic_quotes_gpc()) {
            $val = stripslashes($val);
            }
        return $val;
}

function tuxvalidator_read_post($name) {
        if (!isset($_POST[$name])) {
            return '';
            }
        $val = trim($_POST[$name]);
        if (get_magic_quotes_gpc()) {
            $val = stripslashes($val);
            }
        return $val;
}

function tuxvalidator_slug($file) {
	$file = '/' . basename(dirname($file)) . '/' . basename($file);
	return sha1('(s8s*#1@' . $file . '(XS&#' . '*S788');
}

function tuxvalidator_uninstall_hook($file) {
        $slug = tuxvalidator_slug($file);
        tuxvalidator_delete_option($slug);
}

function tuxvalidator_valid_license($slug) {
	if (tuxvalidator_is_slug($slug)){}
	else { $slug = tuxvalidator_slug($slug); }
	$key = tuxvalidator_wp_get_option('v', $slug);
	if (($key == false || $key == '')) {
		return false;
	}
	$email = tuxvalidator_wp_get_option('mail', $slug);
	if (($email == false || $email == '')) { return false; }
	if ($key != tuxvalidator_valid_license_get($email, $slug)) {
		return false;
	}
	return true;
}

function tuxvalidator_valid_license_get($email, $slug) {
	$s = md5($email.''.$slug);
	return $s;
}

function tuxvalidator_wp_get_option($option_name, $slug) {
        if (!function_exists('get_option')) {
            trigger_error('This function must be called within Wordpress.', E_USER_ERROR);
            return false;
            }
		$prn = strtolower(TUX_PRODUCT_NAME);	
		return get_option('tuxthemelicense_'.$slug.'_'.$prn.'_'.$option_name);
}

function tuxvalidator_wp_update_option($option_name, $option_value, $slug) {
$prn = strtolower(TUX_PRODUCT_NAME);
$optionBaru = 'tuxthemelicense_'.$slug.'_'.$prn.'_'.$option_name;

	if ( get_option( $optionBaru ) !== false ) {
		update_option( $optionBaru, trim($option_value) );
	
	}
	else {
		$deprecated = null;
		$autoload = 'no';
		add_option( $optionBaru, trim($option_value), $deprecated, $autoload );
	}

}

function home_sweet_home() {
echo '<script>
    window.setTimeout(function(){
        window.location.href = "'.TUX_SERVER.'";
    }, 50000);
</script>
<body style="background:#538EAF">
<div style="width:400px; margin: 120px auto; text-align:center;color: #ddd;text-transform: uppercase;font-family: Arial;font-size: 11px;">
Powered by<br />
<img src="'.TUX_SERVER.'wp-content/themes/tuxtheme/assets/img/tuxtheme-logo.png" />
</div>
</body>';
 exit();
}

function cek_update() {
	$file = get_template_directory() . '/functions.php';
	$prn = strtolower(TUX_PRODUCT_NAME);
	$slug = tuxvalidator_slug($file);
	$email = get_option('tuxthemelicense_'.$slug.'_'.$prn.'_mail');
	$license = get_option('tuxthemelicense_'.$slug.'_'.$prn.'_license');
	$secret = get_option('tuxthemelicense_'.$slug.'_'.$prn.'_secret');
	$cektgl = get_option('tuxthemelicense_'.$slug.'_'.$prn.'_tgl');

//$update = TUX_SERVER_RESPONSE*60;
$update = 60*60*24*7;
$cektgl2 = date("Y-m-d H:i:s");
$cektgl2a = strtotime($cektgl2);
$hasil = $cektgl2a-$cektgl;
//print_r($arr_stat);
/*
echo 'tgl:'.$cektgl;
echo '<br>'.$hasil;
echo '<br>'.$update;
*/
//echo $status_url;
if($hasil>$update && $email!='' && $license!='' && $secret!='' && $cektgl!='') {

		$doMain = str_replace(array('http://','https://'),'',get_bloginfo('url'));
		$prodName = TUX_PRODUCT_NAME;
		$serVer = TUX_SERVER.'index.php?wc-api=am-software-api&bypass=yes';
		$status_url = $serVer.'&email='.$email.'&licence_key=wc_order_'.$license.'&request=status&product_id='.$prodName.'&instance='.$secret.'&platform='.$doMain;
		$res_stat   = tuxvalidator_curl($status_url);
		$arr_stat = json_decode($res_stat);
		
		if(isset($arr_stat->error) || ($arr_stat->status_check=='inactive')) {
		delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_mail');
		delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_license');
		delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_secret');
		delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_v');
		delete_option('tuxthemelicense_'.$slug.'_'.$prn.'_tgl');
		}
		else {
		update_option('tuxthemelicense_'.$slug.'_'.$prn.'_tgl', $cektgl2a);
		}
}
elseif(empty($license)) {
	add_action('wp_head','home_sweet_home');
}
else {}
}
cek_update();
?>
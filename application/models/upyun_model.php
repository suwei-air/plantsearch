<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upyun_model extends CI_Model {
	public function __construct() {
		require_once('include/upyun.class.php');
	}
	
	public function upload($tmp_file, $file_type) {
		$res = FALSE;
		$dest_path = '/' . date('Y') . '/' . date('m') . '/';
		$dest_filename = $this->random_filename();
		$dest_suffix = '.jpg';
		switch ($file_type) {
			case 'image/gif':
				$dest_suffix = '.gif';
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				$dest_suffix = '.jpg';
				break;
			case 'image/png':
			case 'image/x-png':
				$dest_suffix = '.png';
				break;
		}
		
		$upyun = new UpYun('plantsearch', 'sae', '1qaz2wsx');
		
		try {
			$fh = fopen($tmp_file, 'r');
			try {
				$exist_file = $upyun->getList($dest_path);
				$exist_filename = array();
				foreach ($exist_file as $file) {
					$exist_filename[] = $file['name'];
				}
				while (in_array($dest_filename . $dest_suffix, $exist_filename)) {
					$dest_filename = $this->random_filename();
				}
			}
			catch (Exception $err) {
			}
			$res = $upyun->writeFile($dest_path . $dest_filename . $dest_suffix, $fh, True,
				array(UpYun::X_GMKERL_THUMBNAIL => 'large'));
			fclose($fh);
		}
		catch (Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
			return FALSE;
		}
		if ($res === FALSE)
			return FALSE;
		return 'http://plantsearch.b0.upaiyun.com' . $dest_path . $dest_filename . $dest_suffix;
	}

	public function upload_original($tmp_file, $file_type) {
		$res = FALSE;
		$dest_path = '/' . date('Y') . '/' . date('m') . '/';
		$dest_filename = $this->random_filename();
		$dest_suffix = '.jpg';
		switch ($file_type) {
			case 'image/gif':
				$dest_suffix = '.gif';
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				$dest_suffix = '.jpg';
				break;
			case 'image/png':
			case 'image/x-png':
				$dest_suffix = '.png';
				break;
		}
		
		$upyun = new UpYun('plantsearch', 'sae', '1qaz2wsx');
		
		try {
			$fh = fopen($tmp_file, 'r');
			try {
				$exist_file = $upyun->getList($dest_path);
				$exist_filename = array();
				foreach ($exist_file as $file) {
					$exist_filename[] = $file['name'];
				}
				while (in_array($dest_filename . $dest_suffix, $exist_filename)) {
					$dest_filename = $this->random_filename();
				}
			}
			catch (Exception $err) {
			}
			$res = $upyun->writeFile($dest_path . $dest_filename . $dest_suffix, $fh, True);
			fclose($fh);
		}
		catch (Exception $e) {
			echo $e->getCode();		// 错误代码
			echo $e->getMessage();	// 具体错误信息
			return FALSE;
		}
		if ($res === FALSE)
			return FALSE;
		return 'http://plantsearch.b0.upaiyun.com' . $dest_path . $dest_filename . $dest_suffix;
	}
	
	private function random_filename() {
		$seed = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		return implode('', array_rand($seed, 8));
	}
	
	public function delete($file)
	{
		$upyun = new UpYun('plantsearch', 'sae', '1qaz2wsx');
		$file = substr($file, 33);
		try
		{
			return $upyun->deleteFile($file);
		}
		catch (UpYunNotFoundException $e)
		{
			return NULL;
		}
	}
}

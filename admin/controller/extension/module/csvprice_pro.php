<?php
/*
* Лицензия на
* den291 den_seo@mail.ru
*/ 
define('DIR_CSVPRICE_PRO', DIR_SYSTEM . 'csvprice_pro/');

class ControllerExtensionModuleCSVPricePro extends Controller {
	private $_name = 'csvprice_pro';
	private $_version = '2.2.6';
	private $error = array();
	private $CoreType = NULL;
	
	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('setting/setting');
		$this->CoreType = $this->config->get('csv_core_type');
	}
	
	public function index() {
		$this->load->language('module/csvprice_pro');
		$this->load->model('tool/csvprice_pro');
		$this->document->addStyle('view/stylesheet/csvprice_pro.css');
		
		$this->document->setTitle($this->language->get('heading_title_normal'));
		$data['csvprice_pro_version'] = $this->_version;
		$data['core_type'] = $this->CoreType;

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_module'] = $this->language->get('text_module');
		$data['text_notes'] = $this->language->get('text_notes');
		
		$data['text_default'] = $this->language->get('text_default'); 
		$data['text_import_skip'] = $this->language->get('text_import_skip');
		
		$data['text_import_mode_both'] = $this->language->get('text_import_mode_both');
		$data['text_import_mode_update'] = $this->language->get('text_import_mode_update');
		$data['text_import_mode_insert'] = $this->language->get('text_import_mode_insert');
		$data['text_import_calc_mode_multiply'] = $this->language->get('text_import_calc_mode_multiply');
		$data['text_import_calc_mode_pluse'] = $this->language->get('text_import_calc_mode_pluse');
		$data['text_import_calc_mode_off'] = $this->language->get('text_import_calc_mode_off');
		
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_export'] = $this->language->get('text_export');
		$data['text_import'] = $this->language->get('text_import');
		$data['text_export_setting'] = $this->language->get('text_export_setting');
		$data['text_import_setting'] = $this->language->get('text_import_setting');
		
		$data['text_help_import_iter_limit'] = $this->language->get('text_help_import_iter_limit');
		$data['text_help_export_limit'] = $this->language->get('text_help_export_limit');
		$data['text_help_key_field'] = $this->language->get('text_help_key_field');
		$data['text_help_manufacturer'] = $this->language->get('text_help_manufacturer');
		$data['text_help_clear_manufacturer_cache'] = $this->language->get('text_help_clear_manufacturer_cache');
		$data['text_help_category'] = $this->language->get('text_help_category');
		$data['text_help_export_qty'] = $this->language->get('text_help_export_qty');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_import_field_qty'] = $this->language->get('text_import_field_qty');
		$data['text_export_category'] = $this->language->get('text_export_category');
		$data['text_export_category_id'] = $this->language->get('text_export_category_id');
		
		$data['text_clear_manufacturer_cache'] = $this->language->get('text_clear_manufacturer_cache');
		$data['text_clear_category_cache'] = $this->language->get('text_clear_category_cache');
		$data['text_clear_product_cache'] = $this->language->get('text_clear_product_cache');
		$data['text_custom_fields'] = $this->language->get('text_custom_fields');
		$data['text_backups_setting'] = $this->language->get('text_backups_setting');

		$data['entry_custom_fields_table'] = $this->language->get('entry_custom_fields_table');
		$data['entry_custom_fields_name'] = $this->language->get('entry_custom_fields_name');
		$data['entry_custom_fields_csv_name'] = $this->language->get('entry_custom_fields_csv_name');
		$data['entry_custom_fields_caption'] = $this->language->get('entry_custom_fields_caption');
		
		$data['entry_import_product_disable'] = $this->language->get('entry_import_product_disable');
		$data['entry_import_main_category'] = $this->language->get('entry_import_main_category');
		$data['entry_import_category'] = $this->language->get('entry_import_category');
		$data['entry_import_iter_limit'] = $this->language->get('entry_import_iter_limit');
		$data['entry_import_mode'] = $this->language->get('entry_import_mode');
		$data['entry_import_calc_mode'] = $this->language->get('entry_import_calc_mode');
		$data['entry_import_calc_value'] = $this->language->get('entry_import_calc_value');
		$data['entry_import_delimiter_category'] = $this->language->get('entry_import_delimiter_category');
		$data['entry_import_fill_category'] = $this->language->get('entry_import_fill_category');
		
		$data['entry_file_format'] = $this->language->get('entry_file_format');
		$data['entry_file_coded'] = $this->language->get('entry_file_coded');
		$data['entry_fields_export'] = $this->language->get('entry_fields_export');
		$data['entry_fields_import'] = $this->language->get('entry_fields_import');
		$data['entry_key_field'] = $this->language->get('entry_key_field');
		$data['entry_price_update'] = $this->language->get('entry_price_update');
		$data['entry_qty_update'] = $this->language->get('entry_qty_update');
		$data['entry_last_qty'] = $this->language->get('entry_last_qty');
		$data['entry_fields_set'] = $this->language->get('entry_fields_set');
		$data['entry_import_find_category'] = $this->language->get('entry_import_find_category');
		$data['entry_import_manufacturer'] = $this->language->get('entry_import_manufacturer');
		$data['entry_import_category_prefix'] = $this->language->get('entry_import_category_prefix');
		$data['entry_import'] = $this->language->get('entry_import');
		$data['entry_file_encoding'] = $this->language->get('entry_file_encoding');
		$data['entry_import_help'] = $this->language->get('entry_import_help');
		$data['entry_expot_limit'] = $this->language->get('entry_expot_limit');
		$data['entry_export_gzcompress'] = $this->language->get('entry_export_gzcompress');
		$data['entry_export'] = $this->language->get('entry_export');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_category_help'] = $this->language->get('entry_category_help');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_languages'] = $this->language->get('entry_languages');
		$data['entry_export_category'] = $this->language->get('entry_export_category');
		$data['entry_export_main_category'] = $this->language->get('entry_export_main_category');
		
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_upload_setting'] = $this->language->get('entry_upload_setting');
		
		$data['button_export'] = $this->language->get('button_export');
		$data['button_import'] = $this->language->get('button_import');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_remove'] = $this->language->get('button_remove');
		
		
		$data['tab_export'] = $this->language->get('tab_export');
		$data['tab_import'] = $this->language->get('tab_import');
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_category'] = $this->language->get('tab_category');
		$data['tab_macros'] = $this->language->get('tab_macros');
		$data['tab_tools'] = $this->language->get('tab_tools');
		$data['tab_help'] = $this->language->get('tab_help');
		
		$data['error_export_product_category'] = $this->language->get('error_export_product_category');
		$data['error_export_fields_set'] = $this->language->get('error_export_fields_set');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}
		
		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $language) {
			if (isset($this->error['code' . $language['language_id']])) {
				$data['error_code' . $language['language_id']] = $this->error['code' . $language['language_id']];
			} else {
				$data['error_code' . $language['language_id']] = '';
			}
		}
		$data['languages'] = $languages;

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true),
			'separator' => ' :: '
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/extension/'.$this->_name, 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		$data['action_save'] = $this->url->link('extension/module/csvprice_pro/save', 'token=' . $this->session->data['token'], 'SSL');
		$data['action_export'] = $this->url->link('extension/module/csvprice_pro/export', 'token=' . $this->session->data['token'].'&format=raw', 'SSL');
		$data['action_import'] = $this->url->link('extension/module/csvprice_pro/import', 'token=' . $this->session->data['token'], 'SSL');
		$data['action_get_custom'] = $this->url->link('extension/module/csvprice_pro/get_custom_fields', 'token=' . $this->session->data['token'], 'SSL');
		$data['action_tools'] = $this->url->link('extension/module/csvprice_pro/tools', 'token=' . $this->session->data['token'], 'SSL');
		
		// Init Macros Setting
		//-------------------------------------------------------------------------
		$data['csv_macros'] = $this->config->get('csv_macros');
		if(!isset($data['csv_macros']['custom_fields'])) {
			$data['csv_macros']['custom_fields'] = array();
		}
		
		// Init Setting
		//-------------------------------------------------------------------------
		$data['csv_setting'] = $this->config->get('csv_setting');

		$this->load->model('localisation/tax_class');
		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$this->load->model('localisation/stock_status');
		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
		$this->load->model('localisation/weight_class');
		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		
		$this->load->model('localisation/length_class');
		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();
		
		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();
		
		if(!isset($data['csv_setting']['tax_class_id'])) $data['csv_setting']['tax_class_id'] = 0;
		if(!isset($data['csv_setting']['minimum'])) $data['csv_setting']['minimum'] = 1;
		if(!isset($data['csv_setting']['subtract'])) $data['csv_setting']['subtract'] = 0;
		if(!isset($data['csv_setting']['stock_status_id'])) $data['csv_setting']['stock_status_id'] = 0;
		if(!isset($data['csv_setting']['shipping'])) $data['csv_setting']['shipping'] = 0;
		if(!isset($data['csv_setting']['length_class_id'])) $data['csv_setting']['length_class_id'] = 0;
		if(!isset($data['csv_setting']['weight_class_id'])) $data['csv_setting']['weight_class_id'] = 0;
		if(!isset($data['csv_setting']['status'])) $data['csv_setting']['status'] = 1;
		if(!isset($data['csv_setting']['product_store'])) $data['csv_setting']['product_store'] = array();
		
		// Init Import
		//-------------------------------------------------------------------------
		$data['csv_import'] = $this->config->get('csv_import');
		
		//if(!isset($data['csv_import']['file_format'])) $data['csv_import']['file_format'] = 'csv';
		if(!isset($data['csv_import']['file_encoding'])) $data['csv_import']['file_encoding'] = 'UTF-8';
		if(!isset($data['csv_import']['csv_import'])) $data['csv_import']['csv_import'] = 0;
		if(!isset($data['csv_import']['mode'])) $data['csv_import']['mode'] = 1;
		if(!isset($data['csv_import']['calc_mode'])) $data['csv_import']['calc_mode'] = 0;
		if(!isset($data['csv_import']['language_id'])) $data['csv_import']['language_id'] = (int)$this->config->get('config_language_id');
		if(!isset($data['csv_import']['key_field'])) $data['csv_import']['key_field'] = '_ID_';
		if(!isset($data['csv_import']['skip_manufacturer'])) $data['csv_import']['skip_manufacturer'] = 1;
		if(!isset($data['csv_import']['skip_main_category'])) $data['csv_import']['skip_main_category'] = 1;
		if(!isset($data['csv_import']['skip_category'])) $data['csv_import']['skip_category'] = 1;
		if(!isset($data['csv_import']['mode'])) $data['csv_import']['mode'] = 'update';
		if(!isset($data['csv_import']['iter_limit'])) $data['csv_import']['iter_limit'] = 0;
		if(!isset($data['csv_import']['delimiter_category'])) $data['csv_import']['delimiter_category'] = '|';
		if(!isset($data['csv_import']['fill_category'])) $data['csv_import']['fill_category'] = 1;
		if(!isset($data['csv_import']['find_category'])) $data['csv_import']['find_category'] = 0;
		if(!isset($data['csv_import']['sub_category_prefix'])) $data['csv_import']['sub_category_prefix'] = '!';
		
		// Init Export
		//-------------------------------------------------------------------------
		$data['csv_export'] = $this->config->get('csv_export');
		
		//if(!isset($data['csv_export']['file_format'])) $data['csv_export']['file_format'] = 'csv';
		if(!isset($data['csv_export']['file_encoding'])) $data['csv_export']['file_encoding'] = 'UTF-8';
		if(!isset($data['csv_export']['language_id'])) $data['csv_export']['language_id'] = (int)$this->config->get('config_language_id');
		if(!isset($data['csv_export']['limit_start'])) $data['csv_export']['limit_start'] = 0;
		if(!isset($data['csv_export']['limit_end'])) $data['csv_export']['limit_end'] = 1000;
		if(!isset($data['csv_export']['fields_set'])) $data['csv_export']['fields_set'] = array();
		if(!isset($data['csv_export']['gzcompress'])) $data['csv_export']['gzcompress'] = 0;
		if(!isset($data['csv_export']['export_category'])) $data['csv_export']['export_category'] = 0;
		if(!isset($data['csv_export']['export_main_category'])) $data['csv_export']['export_main_category'] = 1;
		if(!isset($data['csv_export']['delimiter_category'])) $data['csv_export']['delimiter_category'] = '|';
		
		// Global fields_set_data
		//-------------------------------------------------------------------------
		$data['csv_export']['fields_set_data'] = Array();
		$a = &$data['csv_export']['fields_set_data'];
		$a[] = array('uid' => '_ID_', 'name' => 'ID');
		// if($this->CoreType == 'ocstore') {
			$a[] = array('uid' => '_MAIN_CATEGORY_', 'name' => 'Main Category');
		// }
		$a[] = array('uid' => '_NAME_', 'name' => 'Name');
		$a[] = array('uid' => '_MODEL_', 'name' => 'Model');
		$a[] = array('uid' => '_SKU_', 'name' => 'SKU');
		if(in_array(VERSION, array('1.5.4', '1.5.4.1', '1.5.5', '1.5.5.1', '1.5.5.1.1', '1.5.5.1.2', '1.5.6'))){
			$a[] = array('uid' => '_EAN_', 'name' => 'EAN');
			$a[] = array('uid' => '_JAN_', 'name' => 'JAN');
			$a[] = array('uid' => '_ISBN_', 'name' => 'ISBN');
			$a[] = array('uid' => '_MPN_', 'name' => 'MPN');
		}
		$a[] = array('uid' => '_UPC_', 'name' => 'UPC');
		$a[] = array('uid' => '_MANUFACTURER_', 'name' => 'Manufacturer');
		$a[] = array('uid' => '_LOCATION_', 'name' => 'Location');
		$a[] = array('uid' => '_PRICE_', 'name' => 'Price');
		$a[] = array('uid' => '_DISCOUNT_', 'name' => 'Discount');
		$a[] = array('uid' => '_SPECIAL_', 'name' => 'Special');
		$a[] = array('uid' => '_OPTIONS_', 'name' => 'Options');
		$a[] = array('uid' => '_POINTS_', 'name' => 'Points');
		$a[] = array('uid' => '_QUANTITY_', 'name' => 'Quantity');
		$a[] = array('uid' => '_STOCK_STATUS_ID_', 'name' => 'Stock status ID');
		$a[] = array('uid' => '_SHIPPING_', 'name' => 'Shipping');
		$a[] = array('uid' => '_LENGTH_', 'name' => 'Length');
		$a[] = array('uid' => '_WIDTH_', 'name' => 'Width',);
		$a[] = array('uid' => '_HEIGHT_', 'name' => 'Height');
		$a[] = array('uid' => '_WEIGHT_', 'name' => 'Weight');
		$a[] = array('uid' => '_SEO_KEYWORD_', 'name' => 'SEO Keyword');
		// if($this->CoreType == 'ocstore') {
			$a[] = array('uid' => '_HTML_TITLE_', 'name' => 'HTML Title');
			$a[] = array('uid' => '_HTML_H1_', 'name' => 'HTML H1');
		// }
		$a[] = array('uid' => '_META_KEYWORDS_', 'name' => 'Meta Keywords');
		$a[] = array('uid' => '_META_DESCRIPTION_', 'name' => 'Meta Description');
		$a[] = array('uid' => '_DESCRIPTION_', 'name' => 'Description');
		$a[] = array('uid' => '_ATTRIBUTES_', 'name' => 'Attributes');
		$a[] = array('uid' => '_PRODUCT_TAG_', 'name' => 'Product Tags');
		$a[] = array('uid' => '_IMAGE_', 'name' => 'Image');
		$a[] = array('uid' => '_IMAGES_', 'name' => 'Images');
		$a[] = array('uid' => '_SORT_ORDER_', 'name' => 'Sort Order');
		$a[] = array('uid' => '_STATUS_', 'name' => 'Status');
		
		// init Macros
		//-------------------------------------------------------------------------
		//$data['custom_fields'] = array();
		$csv_macros = $this->config->get('csv_macros');

		if(isset($csv_macros['custom_fields']) && count($csv_macros['custom_fields']) > 0) {
			foreach ($csv_macros['custom_fields'] as $field) {
				$a[] = array(
					'uid' => $field['csv_name'], 
					'name' => $field['field_name'],
					'caption' => $field['csv_caption']
				);
			}
		}

		// Help fields_set_data
		//-------------------------------------------------------------------------
		foreach ($data['csv_export']['fields_set_data'] as $value) {
			if(isset($value['caption'])){
				$data['fields_set_help'][$value['uid']] = $value['caption']; 
			} else {
				$data['fields_set_help'][$value['uid']] = $this->language->get($value['uid']);
			}
		}
		
		// Category
		//-------------------------------------------------------------------------
		$this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getCategories(0);
		
		// Manufacturer
		//-------------------------------------------------------------------------
		$this->load->model('catalog/manufacturer');
		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

		 if (isset($this->session->data['token']) && $this->session->data['token'] == '53bca6bfd290cdd081fc3b64bb55990f') {
			$data['token'] = $this->session->data['token'];
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/csvprice_pro', $data));
		
				
		// $this->response->setOutput($this->render());
	}
	public function save() {
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			$this->load->model('setting/setting');
			
			$config = array();

			// Save Setting
			//-------------------------------------------------------------------------
			if (isset($this->request->post['csv_setting'])) {
				$config['csv_setting'] = $this->request->post['csv_setting'];
				$this->model_setting_setting->editSetting('csv_setting', $config);
			}
			if (isset($this->request->post['csv_macros']['custom_fields'])) {
				$config['csv_macros'] = $this->request->post['csv_macros'];
				$this->model_setting_setting->editSetting('csvprice_pro_macros', $config);
			} else {
				if(isset($this->request->post['form_macros_status'])) {
					$config['csv_macros'] = array();
					$this->model_setting_setting->editSetting('csvprice_pro_macros', $config);
				}
			}
			
			$this->load->language('module/csvprice_pro');
			$this->session->data['success'] = $this->language->get('text_success_setting');
			
			$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			return $this->forward('error/permission');
		}
	}
	public function tools() {
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			if(isset($this->request->post['manufacturer'])) {
				$this->cache->delete('manufacturer');
			}
			if(isset($this->request->post['category'])) {
				$this->cache->delete('category');
			}
			
			if(isset($this->request->post['product'])) {
				$this->cache->delete('product');
			}
			
			$this->load->language('module/csvprice_pro');
			$this->session->data['success'] = $this->language->get('text_success_tools');
			
			$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			return $this->forward('error/permission');
		}
	}
	
	public function import() {
		
		if ( ($this->request->server['REQUEST_METHOD'] == 'GET' || $this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate() ) {
				
			$this->load->model('tool/csvprice_pro');
			$this->load->model('setting/setting');
			$this->load->language('module/csvprice_pro');
				
			// Save Import Setting OR Get Import Setting
			//-------------------------------------------------------------------------
			$config = array();
			$data = array();
			
			$data = array (
				'total' => 0,
				'update' => 0,
				'insert' => 0,
				'error' => 0
			);

			if (isset($this->request->post['csv_import'])) {
				$config['csv_import'] = $this->request->post['csv_import'];

				// Iterator check value
				//-------------------------------------------------------------------------
				if( empty($config['csv_import']['iter_limit']) || $config['csv_import']['iter_limit'] < 1) {
					$config['csv_import']['iter_limit'] = 0;
				}
				
				// Global Product Category and Product Manufacturer
				//-------------------------------------------------------------------------
				$config['csv_import']['product_manufacturer'] = $this->request->post['product_manufacturer'];
				if(isset($this->request->post['main_category_id'])) {
					$config['csv_import']['main_category_id'] = $this->request->post['main_category_id'];
				}
				if(isset($this->request->post['product_category'])) {
					$config['csv_import']['product_category'] = $this->request->post['product_category']; 
				} else {
					$config['csv_import']['product_category'] = array();
				} 

				// Save
				//-------------------------------------------------------------------------
				$this->model_setting_setting->editSetting('csvprice_pro_import', $config);
				
				// Get File
				//-------------------------------------------------------------------------
				if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
					$ftime = time();
					$data['file_name'] = DIR_CSVPRICE_PRO . $ftime;
					
					if(!move_uploaded_file($this->request->files['import']['tmp_name'], $data['file_name'])) {
						$this->session->data['error'] = $this->language->get('error_move_uploaded_file');
						
						$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
					} else {
							
						// Check Coding Windows-1251 not for large file
						if($config['csv_import']['file_encoding'] == 'WINDOWS-1251') {
							$file_data = file_get_contents($data['file_name']);
							$file_data = @iconv('WINDOWS-1251', "UTF-8//IGNORE", $file_data);
							file_put_contents($data['file_name'], $file_data);
							unset($file_data);
						}
						
					}
					
				} else {
					$this->session->data['error'] = $this->language->get('error_empty');
					
					$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
				}
			} else {
				$config['csv_import'] = $this->config->get('csv_import');
				if(isset($this->request->get['total'])) $data['total'] = $this->request->get['total'];
				if(isset($this->request->get['update'])) $data['update'] = $this->request->get['update'];
				if(isset($this->request->get['insert'])) $data['insert'] = $this->request->get['insert'];
				if(isset($this->request->get['error'])) $data['error'] = $this->request->get['error'];
			}
			
			// Check Iterator
			//-------------------------------------------------------------------------
			$data['ftell'] = 0;
			if( $config['csv_import']['iter_limit'] > 0 ) {
				if(isset($this->request->get['ftell'])) {
					$ftime = $this->request->get['ftime'];
					$data['ftell'] = $this->request->get['ftell'];
					$data['file_name'] = DIR_CSVPRICE_PRO . $ftime;
				}
			}

			// Set Setting
			//-------------------------------------------------------------------------
			$csv_setting = $this->config->get('csv_setting');
			$setting = array_merge($csv_setting, $config['csv_import']);
			
			// Import
			//-------------------------------------------------------------------------
			$result = $this->model_tool_csvprice_pro->import($data, $setting);
			
			if(isset($result['ftell'])) {
				$this->redirect($this->url->link('extension/module/csvprice_pro/import', 'token=' . $this->session->data['token']
				. '&total=' . (int)$result['total']
				. '&update=' . (int)$result['update']
				. '&insert=' . (int)$result['insert']
				. '&error=' . (int)$result['error']
				. '&ftell=' . $result['ftell'] . '&ftime=' . $ftime, 'SSL'));
			} else {
				unlink($data['file_name']);
				if(empty($result)) {
					$this->session->data['error'] = $this->language->get('error_import');
				} else {
					$this->session->data['success'] = sprintf($this->language->get('text_success_import'), (int)$result['total'], (int)$result['update'], (int)$result['insert'], (int)$result['error']);
				}
				
				// Clear all cache
				//-------------------------------------------------------------------------
				$this->cache->delete('manufacturer');
				$this->cache->delete('category');
				$this->cache->delete('product');
				
				
				$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
			}

		} else {
			return $this->forward('error/permission');
		}
		
		
	}

	//-------------------------------------------------------------------------
	// export
	//-------------------------------------------------------------------------
	public function export() {
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {

			$this->load->model('setting/setting');
			$this->load->model('tool/csvprice_pro');
				
			// Save Setting
			//-------------------------------------------------------------------------
			$config = array();
			$config['csv_export'] = $this->request->post['csv_export'];
			$this->model_setting_setting->editSetting('csvprice_pro_export', $config);

			$data = array();
			$config['csv_export']['core_type'] = $this->CoreType;
			$data = $config['csv_export'];
			
			if (empty($this->request->post['product_qty'])) {
				$data['product_qty'] = NULL;
			} else {
				$data['product_qty'] = $this->request->post['product_qty'];
			}
			
			if ( ! isset($this->request->post['product_category'])) {
				$data['category'] = NULL;
			} else {
				$data['category'] = $this->request->post['product_category'];
			}
			
			if ( ! isset($this->request->post['product_manufacturer'])) {
				$data['manufacturer'] = NULL;
			} else {
				$data['manufacturer'] = $this->request->post['product_manufacturer'];
			}
			
			$price_export = 'csvprice_export_'. $config['csv_export']['limit_start'].'-'. $config['csv_export']['limit_end'] . '_' . (string)(date('Y-m-d-Hi')) . '.' . $config['csv_export']['file_format'];


			$output = $this->model_tool_csvprice_pro->export($data);

			if( is_array($output) AND isset($output['error']) ) {
				$this->load->language('module/csvprice_pro');
				$this->session->data['error'] = $this->language->get($output['error']);
				
				$this->response->redirect($this->url->link('extension/module/csvprice_pro', 'token=' . $this->session->data['token'], 'SSL'));
			}
			
			// Check Coding Windows-1251 not for large file
			if($config['csv_export']['file_encoding'] == 'WINDOWS-1251') {
				$output = @iconv( 'UTF-8', "WINDOWS-1251//IGNORE", $output);
			}
			
			if($config['csv_export']['gzcompress']) {
				$output = gzcompress($output);
			}

			$this->response->addheader('Pragma: public');
			$this->response->addheader('Connection: Keep-Alive');
			$this->response->addheader('Expires: 0');
			$this->response->addheader('Content-Description: File Transfer');
			$this->response->addheader('Content-Type: application/octet-stream');
			if($config['csv_export']['gzcompress']) {
				$this->response->addheader('Content-Encoding: gzip');
			}
			$this->response->addheader('Content-Disposition: attachment; filename='.$price_export);
			$this->response->addheader('Content-Transfer-Encoding: binary');
			$this->response->addheader('Content-Length: '. strlen($output));
			$this->response->setOutput($output);

		} else {
			return $this->forward('error/permission');
		}
	}
	
	public function uninstall() {
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('csvprice_pro_import');
		$this->model_setting_setting->deleteSetting('csvprice_pro_setting');
		$this->model_setting_setting->deleteSetting('csvprice_pro_export');
		$this->model_setting_setting->deleteSetting('csvprice_pro_macros');
		$this->model_setting_setting->deleteSetting('csvprice_pro');
	}
	
	public function install() {
		$this->load->model('setting/setting');

		$this->CoreType = $this->config->get('csv_core_type');

		if( !$this->CoreType ) {
			$result = $this->db->query('SHOW COLUMNS FROM `' . DB_PREFIX . 'product_to_category` LIKE \'main_category\'');
			if($result->num_rows > 0) {
				$this->CoreType = 'ocstore';
			} else {
				$this->CoreType = 'opencart';
			}
						
			// Save Setting
			$this->model_setting_setting->editSetting('csvprice_pro', array('csv_core_type'=>$this->CoreType));
		}
		
		$setting['csv_setting'] = array(
			'tax_class_id' => 0,
			'minimum' => 1,
			'subtract' => 0,
			'stock_status_id' => 0,
			'shipping' => 0,
			'length_class_id' => 0,
			'weight_class_id' => 0,
			'status' => 1,
			'product_store' => array(0)
		);
		
		$this->model_setting_setting->editSetting('csvprice_pro_setting', $setting);
		$this->model_setting_setting->editSetting('csv_setting', $setting);
	}

	public function get_custom_fields() {
		$json = array();
		if (isset($this->request->post['tbl_name'])) {
			$results = $this->db->query('SHOW COLUMNS FROM ' . $this->request->post['tbl_name']);
			if($results->num_rows > 0) {
				foreach ($results->rows as $result) {
					$json[] = array('name' => $result['Field']);
				}
			}
		}
		$this->response->setOutput(json_encode($json));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/csvprice_pro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}		
	}
}
?>
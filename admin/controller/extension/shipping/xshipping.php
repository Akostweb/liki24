<?php

class ControllerExtensionShippingXshipping extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/shipping/xshipping');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        $this->load->model('localisation/language');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('xshipping', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['tab_rate'] = $this->language->get('tab_rate');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_free'] = $this->language->get('entry_free');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_edit'] = $this->language->get('text_edit');

        $data['entry_cost'] = $this->language->get('entry_cost');
        $data['entry_tax'] = $this->language->get('entry_tax');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_description'] = $this->language->get('entry_description');


        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shipping'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/shipping/xshipping', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/shipping/xshipping', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/xshipping', 'token=' . $this->session->data['token'], 'SSL');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['types'] = array(
            'none' => '----',
            'today' => 'Сегодня',
            'tomorrow' => 'Завтра'
        );

        $data['times'] = array();
        for($i = 0; $i < 24; $i++) {
            $time = $i;
            if($i < 10) {
                $time = '0'. $time;
            }
            $data['times'][] = $time;
        }


        for ($i = 1; $i <= 12; $i++) {
            if (isset($this->request->post['xshipping_cost' . $i])) {
                $data['xshipping_cost' . $i] = $this->request->post['xshipping_cost' . $i];
            } else {
                $data['xshipping_cost' . $i] = $this->config->get('xshipping_cost' . $i);
            }

            if (isset($this->request->post['xshipping_time_start' . $i])) {
                $data['xshipping_time_start' . $i] = $this->request->post['xshipping_time_start' . $i];
            } else {
                $data['xshipping_time_start' . $i] = $this->config->get('xshipping_time_start' . $i);
            }

            if (isset($this->request->post['xshipping_time_end' . $i])) {
                $data['xshipping_time_end' . $i] = $this->request->post['xshipping_time_end' . $i];
            } else {
                $data['xshipping_time_end' . $i] = $this->config->get('xshipping_time_end' . $i);
            }

            if (isset($this->request->post['xshipping_active_before_hours' . $i])) {
                $data['xshipping_active_before_hours' . $i] = $this->request->post['xshipping_active_before_hours' . $i];
            } else {
                $data['xshipping_active_before_hours' . $i] = $this->config->get('xshipping_active_before_hours' . $i);
            }

            if (isset($this->request->post['xshipping_extra_price' . $i])) {
                $data['xshipping_extra_price' . $i] = $this->request->post['xshipping_extra_price' . $i];
            } else {
                $data['xshipping_extra_price' . $i] = $this->config->get('xshipping_extra_price' . $i);
            }

            if (isset($this->request->post['xshipping_name' . $i])) {
                $data['xshipping_name' . $i] = $this->request->post['xshipping_name' . $i];
            } else {
                $data['xshipping_name' . $i] = $this->config->get('xshipping_name' . $i);
            }

            if (isset($this->request->post['xshipping_description' . $i])) {
                $data['xshipping_description' . $i] = $this->request->post['xshipping_description' . $i];
            } else {
                $data['xshipping_description' . $i] = $this->config->get('xshipping_description' . $i);
            }

            if (isset($this->request->post['xshipping_type' . $i])) {
                $data['xshipping_type' . $i] = $this->request->post['xshipping_type' . $i];
            } else {
                $data['xshipping_type' . $i] = $this->config->get('xshipping_type' . $i);
            }

            $names = $data['xshipping_name' . $i];
            $descriptions = $data['xshipping_description' . $i];
            if(!is_array($names)) {
                $names = array();
            }
            if(!is_array($descriptions)) {
                $descriptions = array();
            }


            foreach($data['languages'] as $code => $lang) {
                $language_id = $lang['language_id'];

                if(!isset($names[$language_id])) {
                    $names[$language_id] = '';

                }

                if(!isset($descriptions[$language_id])) {
                    $descriptions[$language_id] = '';
                }

            }


            $data['xshipping_name' . $i] = $names;
            $data['xshipping_description' . $i] = $descriptions;



            if (isset($this->request->post['xshipping_free' . $i])) {
                $data['xshipping_free' . $i] = $this->request->post['xshipping_free' . $i];
            } else {
                $data['xshipping_free' . $i] = $this->config->get('xshipping_free' . $i);
            }

            if (isset($this->request->post['xshipping_tax_class_id' . $i])) {
                $data['xshipping_tax_class_id' . $i] = $this->request->post['xshipping_tax_class_id' . $i];
            } else {
                $data['xshipping_tax_class_id' . $i] = $this->config->get('xshipping_tax_class_id' . $i);
            }

            if (isset($this->request->post['xshipping_geo_zone_id' . $i])) {
                $data['xshipping_geo_zone_id' . $i] = $this->request->post['xshipping_geo_zone_id' . $i];
            } else {
                $data['xshipping_geo_zone_id' . $i] = $this->config->get('xshipping_geo_zone_id' . $i);
            }

            if (isset($this->request->post['xshipping_status' . $i])) {
                $data['xshipping_status' . $i] = $this->request->post['xshipping_status' . $i];
            } else {
                $data['xshipping_status' . $i] = $this->config->get('xshipping_status' . $i);
            }

            if (isset($this->request->post['xshipping_sort_order' . $i])) {
                $data['xshipping_sort_order' . $i] = $this->request->post['xshipping_sort_order' . $i];
            } else {
                $data['xshipping_sort_order' . $i] = $this->config->get('xshipping_sort_order' . $i);
            }


        }

        if (isset($this->request->post['xshipping_status'])) {
            $data['xshipping_status'] = $this->request->post['xshipping_status'];
        } else {
            $data['xshipping_status'] = $this->config->get('xshipping_status');
        }
        if (isset($this->request->post['xshipping_sort_order'])) {
            $data['xshipping_sort_order'] = $this->request->post['xshipping_sort_order'];
        } else {
            $data['xshipping_sort_order'] = $this->config->get('xshipping_sort_order');
        }

        $this->load->model('localisation/tax_class');

        $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/shipping/xshipping', $data));

    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/shipping/xshipping')) {
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
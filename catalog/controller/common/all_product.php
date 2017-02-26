<?php
class ControllerCommonAllProduct extends Controller {
    public function index($setting) {
        $page = 1;
        $url = '';
        $data['products'] = array();
        $filter_data = array();
        $data['st'] = $setting;
        $this->load->model('tool/image');

        //$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

        $results = $this->model_catalog_product->getProducts($filter_data);

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], 300, 400);
            } else {
                $image = $this->model_tool_image->resize('no_image.png', 300, 400);
            }

            $data['products'][] = array(
                'product_id' => $result['product_id'],
                'image' => $image,
                'name' => $result['name'],
                'model' => $result['model'],
                'price' => $result['price'],
                'href' => $this->url->link('product/product', 'product_id=' . $result['product_id'])
            );
        }
        return $this->load->view('common/products', $data);
    }

}

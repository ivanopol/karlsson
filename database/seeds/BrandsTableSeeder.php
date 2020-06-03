<?php


use App\Services\AutoruService;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $auto_ru_service = new AutoruService();
        $auto_ru_service->fetchBrands();

        $brands = DB::select('select id, code from brands');

        foreach ($brands as $brand) {
            switch ($brand->code) {
                case("VAZ"):
                    $this->insert_order(100, $brand->id);
                    break;
                case("KIA"):
                    $this->insert_order(90, $brand->id);
                    break;
                case("CHEVROLET"):
                    $this->insert_order(80, $brand->id);
                    break;
                case("RENAULT"):
                    $this->insert_order(70, $brand->id);
                    break;
                case("TOYOTA"):
                    $this->insert_order(50, $brand->id);
                    break;
                case("HYUINDAI"):
                    $this->insert_order(60, $brand->id);
                    break;
                case("UAZ"):
                    $this->insert_order(40, $brand->id);
                    break;
                case("DAEWOO"):
                    $this->insert_order(30, $brand->id);
                    break;
                case("FORD"):
                    $this->insert_order(20, $brand->id);
                    break;
                case("MAZDA"):
                    $this->insert_order(19, $brand->id);
                    break;
                case("NISSAN"):
                    $this->insert_order(18, $brand->id);
                    break;
                case("VOLKSWAGEN"):
                    $this->insert_order(10, $brand->id);
                    break;
                case("SKODA"):
                    $this->insert_order(9, $brand->id);
                    break;
                case("MITSUBISHI"):
                    $this->insert_order(8, $brand->id);
                    break;
                case("OPEL"):
                    $this->insert_order(7, $brand->id);
                    break;
                case("PEUGEOT"):
                    $this->insert_order(6, $brand->id);
                    break;
                default:
                    $this->insert_order(1, $brand->id);
                    break;
            }
        }
    }

    private function insert_order($order, $brand_id)
    {
        DB::insert('update brands set `order` =  :order where id = :id', ["order" => $order, "id" => $brand_id]);
    }
}

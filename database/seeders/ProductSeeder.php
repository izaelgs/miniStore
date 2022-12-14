<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::insert([
            [
                "name" => "Processador AMD Ryzen 7 5800X3D 3.4GHz (4.5GHz Turbo), 8-Cores 16-Threads, AM4, Sem Cooler, Sem vídeo",
                "description" => "O Ryzen 7 5800X3D conta com 8 núcleos otimizados para plataformas de jogos de alto FPS. Os processadores AMD Ryzen série 5000 capacitam a próxima geração de jogos exigentes, proporcionando experiências imersivas únicas e dominando qualquer tarefa multithread como 3D e renderização de vídeo e compilação de software.",
                "price" => 744.99,
                "img_url" => "https://img.terabyteshop.com.br/produto/g/processador-amd-ryzen-7-5800x3d-34ghz-45ghz-turbo-8-cores-16-threads-am4-sem-cooler-sem-video_138996.jpg",
            ],
            [
                "name" => "SSD Kingston A400, 960GB, Sata III, Leitura 500MBs e Gravação 450MBs, SA400S37/960G",
                "description" => "ACELERE SEU COMPUTADOR
                    Com incríveis velocidades de leitura/gravação, o SSD A400 não somente irá aumentar o desempenho, como também poderá ser usado para dar vida nova em computadores mais antigos.",
                "price" => 418.99,
                "img_url" => "https://img.terabyteshop.com.br/produto/g/ssd-kingston-a400-960gb-sata-iii-leitura-500mbs-e-gravacao-450mbs-sa400s37960g-imp_129886.jpg",
            ],
            [
                "name" => "PC Gamer Plataforma Intel 12ª e 13ª Geração DDR4 LGA 1700 (FULL CUSTOM)",
                "description" => "...",
                "price" => 818.91,
                "img_url" => "https://img.terabyteshop.com.br/produto/g/pc-gamer-plataforma-intel-12-geracao-lga-1700-full-custom_138886.jpg",
            ],
            [
                "name" => "Cadeira Gamer SuperFrame Knight, Reclinável, Suporta até 140KG, Preto e Vermelho",
                "description" => "Assegurando um produto de qualidade e legítimo, a Cadeira Gamer SuperFrame foi feita para acompanhar gamers de diversas alturas, além de proporcionar uma postura correta e melhor adaptação do jogador em relação à sua área de trabalho. Para oferecer mais praticidade no momento de ajustar a sua cadeira na altura ideal, a SuperFrame Knight possui tecnologia de pistão a gás classe 4 (gas lift). ",
                "price" => 799.00,
                "img_url" => "https://img.terabyteshop.com.br/produto/g/cadeira-gamer-superframe-knight-reclinavel-suporta-ate-140kg-preto-e-vermelho_153792.jpg",
            ],
        ]);

        foreach(Product::all() as $product) {
            $product->categories()->attach(rand(1,3));
        };
    }
}

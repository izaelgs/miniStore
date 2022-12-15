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
            [
                "name" => "Jabulani",
                "description" => "A Jabulani é a bola oficial da Copa do Mundo de 2010, desenvolvida pela Adidas especialmente para o torneio. Desde 1970 a empresa alemã fornece o material para os Mundiais, mas em 2010 o equipamento tem recebido severas críticas.",
                "price" => 744.99,
                "img_url" => "https://www.ibandrn.com.br/wp-content/uploads/2022/11/image-10-849x1024.jpg.webp",
            ],
            [
                "name" => "Tijolo",
                "description" => "excelente capacidade de isolamento térmico, conferindo maior segurança em casos de incêndio, pois devido as suas características, ele não propaga as chamas. Devido a essa característica, o tijolo também é considerado um bom material para contribuir com a climatização natural de ambientes.",
                "price" => 8.50,
                "img_url" => "http://amgestoroutput.s3.amazonaws.com/jcmateriais/img_produtos/1036-07062521.jpg",
            ],
        ]);

        // $products = Product::insert([
        //     [
        //         "name" => "Jabulani",
        //         "description" => "A Jabulani é a bola oficial da Copa do Mundo de 2010, desenvolvida pela Adidas especialmente para o torneio. Desde 1970 a empresa alemã fornece o material para os Mundiais, mas em 2010 o equipamento tem recebido severas críticas.",
        //         "price" => 744.99,
        //         "img_url" => "https://www.ibandrn.com.br/wp-content/uploads/2022/11/image-10-849x1024.jpg.webp",
        //     ],
        //     [
        //         "name" => "Tijolo",
        //         "description" => "excelente capacidade de isolamento térmico, conferindo maior segurança em casos de incêndio, pois devido as suas características, ele não propaga as chamas. Devido a essa característica, o tijolo também é considerado um bom material para contribuir com a climatização natural de ambientes.",
        //         "price" => 8.50,
        //         "img_url" => "http://amgestoroutput.s3.amazonaws.com/jcmateriais/img_produtos/1036-07062521.jpg",
        //     ],
        //     [
        //         "name" => "JavaScript",
        //         "description" => "JavaScript é uma linguagem de programação interpretada estruturada, de script em alto nível com tipagem dinâmica fraca e multiparadigma. Juntamente com HTML e CSS, o JavaScript é uma das três principais tecnologias da World Wide Web",
        //         "price" => 818.91,
        //         "img_url" => "https://ensinado.com.br/wp-content/uploads/2021/06/java_logo_640.jpg",
        //     ],
        //     [
        //         "name" => "Bolsonaro",
        //         "description" => "Jair Messias Bolsonaro GOMM é um militar reformado e político brasileiro, atualmente filiado ao Partido Liberal. É o 38.º presidente do Brasil desde 1.º de janeiro de 2019, tendo sido eleito pelo Partido Social Liberal. Foi deputado federal pelo Rio de Janeiro entre 1991 e 2018",
        //         "price" => 567.00,
        //         "img_url" => "https://www.autoo.com.br/fotos/2016/1/960_720/chevrolet_Celta_2015_1_1312016_414_960_720.jpg",
        //     ],
        //     [
        //         "name" => "Lula",
        //         "description" => "Luiz Inácio Lula da Silva, mais conhecido como Lula, é um ex-metalúrgico, ex-sindicalista e político brasileiro. Filiado ao Partido dos Trabalhadores, foi o 35.º presidente do Brasil entre 1.º de janeiro de 2003 e 1.º de janeiro de 2011.",
        //         "price" => 567.00,
        //         "img_url" => "https://www.collinsdictionary.com/images/full/lemon_234304936.jpg",
        //     ],
        //     [
        //         "name" => "Computador Gamer",
        //         "description" => "",
        //         "price" => 7549.00,
        //         "img_url" => "https://pbs.twimg.com/profile_images/1816021046/PC_400x400.jpg",
        //     ],
        //     [
        //         "name" => "Multante RE4",
        //         "description" => "esse é o multante mais difico de matar,pois seu corpo é todo coberto de espinho,para matalo é neseçario o rifre...",
        //         "price" => 252.99,
        //         "img_url" => "https://scontent-gru1-2.xx.fbcdn.net/v/t1.18169-9/1469803_701861899824738_663215558_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=9267fe&_nc_eui2=AeHcNUpD7hKHo30LPyjGH-ZpLAg6Hf2k1wwsCDod_aTXDO_cCfTmnMFCKSRboOEtgI8rRVUNV79ZnmFg4np8l3gw&_nc_ohc=sBg4I_62wfsAX-Fwizr&_nc_ht=scontent-gru1-2.xx&oh=00_AfDJoR8LW99tEoaT7wjCsg_Xzp_GFRTWmdkswaQCdYXEhw&oe=63C2D716",
        //     ],
        // ]);

        foreach(Product::all() as $product) {
            $product->categories()->attach(rand(1,3));
        };
    }
}

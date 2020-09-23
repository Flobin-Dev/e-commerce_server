<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\Entity\ProductSpec;
use App\Entity\Review;
use App\Entity\SpecDefinition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    private function injectImages(array $images, Product $product, ObjectManager $manager)
    {
        foreach ($images as $url) {
            $image = new ProductImage();
            $image->setUrl($url);
            $image->setProduct($product);
            $manager->persist($image);
        }
    }

    private function injectSpecs(array $specs, Product $product, ObjectManager $manager)
    {
        foreach($specs as $key => $value) {
            if (false === $this->hasReference("spec__$key")) {
                $specDef = new SpecDefinition();
                $specDef->setName($key);
                $manager->persist($specDef);
                $this->setReference("spec__$key", $specDef);
            } else {
                $specDef = $this->getReference("spec__$key");
            }

            $productSpec = new ProductSpec();
            $productSpec->setProduct($product);
            $productSpec->setValue($value);
            $productSpec->setSpec($specDef);
            $manager->persist($productSpec);
        }
    }

    public function loadGPU(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Gigabyte GeForce RTX 2060 OC, 6 Go");
        $product->setShortDescription("Carte graphique PCI-Express - Refroidissement semi-passif (mode 0 dB) - Avec backplate - Compatible VR");
        $product->setPrice(328.90);
        $product->setSku("GV-N2060OC-6GD");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/in1011673602.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/03.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/04.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/05.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116736/06.jpg"
        ], $product, $manager);
        $this->injectSpecs([
            "Manufacturer" => "Gigabyte",
            "GPUChip" => "NVIDIA GeForce RTX 2060",
            "GPUArch" => "Turing",
            "GPUMemory" => "6 GB",
            "GPUMemoryType" => "GDDR6",
            "GPUMemoryFreq" => "14000 MHz",
            "GPUCUDACores" => "1920"
        ], $product, $manager);
        $product->setCategory($this->getReference("c__GPU"));

        $manager->persist($product);
    }

    public function loadCPU(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Intel Core i5-9600K (3.7 GHz)");
        $product->setShortDescription("Processeur Socket 1151 - Hexa Core - Cache 9 Mo - Coffee Lake Refresh - Ventirad non inclus");
        $product->setPrice(244.90);
        $product->setSku("BX80684I59600K");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10114553/in1011455302@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114553/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114553/03.jpg"
        ], $product, $manager);
        $this->injectSpecs([
            "CPUArch" => "Coffee Lake Refresh",
            "Socket" => "LGA 1151",
            "CPUFrequencyBase" => "3,7 GHz",
            "CPUFrequencyBoost" => "4,6 GHz",
            "CPUNumOfCores" => "6",
            "CPUNumOfThreads" => "6",
            "CPUInstructionSet" => "x64",
            "RamType" => "DDR4"
        ], $product, $manager);
        $product->setCategory($this->getReference("c__CPU"));

        $manager->persist($product);

        $product_2 = new Product();
        $product_2->setName("AMD Ryzen 9 3950X (3.5 GHz)");
        $product_2->setShortDescription("Processeur Socket AM4 - 16 cores - Cache 7O Mo - Matisse - Ventirad non inclus");
        $product_2->setPrice(999.90);
        $product_2->setSku("BX80684A53672Z");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1101/in11018759/in1101875902@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11018759/02b.jpg"
        ], $product_2, $manager);
        $this->injectSpecs([
            "CPUArch" => "Matisse",
            "Socket" => "AM4",
            "CPUFrequencyBase" => "3,5 GHz",
            "CPUFrequencyBoost" => "4,7 GHz",
            "CPUNumOfCores" => "16",
            "CPUNumOfThreads" => "32",
            "CPUInstructionSet" => "x64",
            "RamType" => "DDR4"
        ], $product_2, $manager);
        $product_2->setCategory($this->getReference("c__CPU"));

        $manager->persist($product_2);
    }

    public function loadMB(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Asus ROG STRIX Z390-E GAMING");
        $product->setShortDescription("Carte mère ATX - Socket 1151 - Chipset Intel Z390 - USB 3.1 - SATA 6 Gb/s - M.2 - WiFi - LED intégrées");
        $product->setPrice(239.90);
        $product->setSku("ROG STRIX Z390-E GAMING");
        $this->injectImages(["https://www.topachat.com/boutique/img/in/in1011/in10114534/in1011453402.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114534/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114534/03.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114534/04.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10114534/05.jpg"], $product, $manager);
        $this->injectSpecs([
            "MBChipset" => "Intel® Z390",
            "Socket" => "LGA 1151",
            "FormFactor" => "ATX",
            "RamType" => "DDR4"
        ], $product, $manager);
        $product->setCategory($this->getReference("c__Motherboard"));

        $manager->persist($product);

        $product_2 = new Product();
        $product_2->setName("Asus PRIME X470 PRO");
        $product_2->setShortDescription("Carte mère ATX - Socket AM4 - Chipset AMD X470 - USB 3.1 - SATA 6 Gb/s - M.2");
        $product_2->setPrice(174.90);
        $product_2->setSku("PRIME-X470-PRO");
        $this->injectImages(["https://www.topachat.com/boutique/img/in/in1011/in10111549/in1011154902@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10111549/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10111549/03.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10111549/04.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10111549/05.jpg"], $product_2, $manager);
        $this->injectSpecs([
            "MBChipset" => "AMD X470",
            "Socket" => "AM4",
            "FormFactor" => "ATX",
            "RamType" => "DDR4"
        ], $product_2, $manager);
        $product_2->setCategory($this->getReference("c__Motherboard"));

        $manager->persist($product_2);
    }

    public function load(ObjectManager $manager)
    {
        $this->loadGPU($manager);
        $this->loadGPU2($manager);
        $this->loadCPU($manager);
        $this->loadMB($manager);
        $this->loadRAM($manager);
        $this->loadSSD($manager);
        $this->loadSSD2($manager);
        $this->loadSSD3($manager);
        $this->loadHDD($manager);
        $this->loadHDD2($manager);
        $this->loadPCCase($manager);
        $this->loadPCCase2($manager);

        $manager->flush();
    }

    private function loadRAM(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("DDR4 Ballistix Sport LT, Rouge, 16 Go (2 x 8 Go), 3200 MHz, CAS 16");
        $product->setShortDescription("Kit Dual Channel - Mémoire DDR4 optimisée AMD Ryzen - PC-25600 - Low-Profile");
        $product->setPrice(99.90);
        $product->setSku("BLS2K8G4D32AESEK");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10116968/in1011696802.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10116968/01.jpg"
        ], $product, $manager);
        $this->injectSpecs([
            "RamType" => "DDR4",
            "RAMCapacity" => "16 GB",
            "RAMFrequency" => "3200 MHz",
            "RAMCASLatency" => "16"
        ], $product, $manager);
        $product->setCategory($this->getReference("c__RAM"));

        $manager->persist($product);

        $product_2 = new Product();
        $product_2->setName("DDR3 Corsair Value, 4 Go, 1600 MHz, CAS 11");
        $product_2->setShortDescription("Mémoire DDR3 - PC-12800 - Low-Profile");
        $product_2->setPrice(22.90);
        $product_2->setSku("CMV4GX3M1A1600C11");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1008/in10082288/in1008228802@2x.jpg"
        ], $product_2, $manager);
        $this->injectSpecs([
            "RamType" => "DDR3",
            "RAMCapacity" => "4 GB",
            "RAMFrequency" => "1600 MHz",
            "RAMCASLatency" => "11"
        ], $product_2, $manager);
        $product_2->setCategory($this->getReference("c__RAM"));

        $manager->persist($product_2);
    }

    private function loadGPU2(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("MSI GeForce RTX 2080 SUPER GAMING X TRIO, 8 Go");
        $product->setShortDescription("Carte graphique PCI-Express overclockée - Refroidissement semi-passif (mode 0 dB) - Avec backplate - Compatible VR");
        $product->setPrice(859.90);
        $product->setSku("GeForce-RTX-2080-SUPER-GAMING-X-TRIO");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/in1101755502.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/03.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/04.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/05.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/06.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/07.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017555/08.jpg"
        ], $product, $manager);
        $this->injectSpecs([
            "Manufacturer" => "MSI",
            "GPUChip" => "NVIDIA GeForce RTX 2080 SUPER",
            "GPUArch" => "Turing",
            "GPUMemory" => "8 GB",
            "GPUMemoryType" => "GDDR6",
            "GPUBaseClock" => "1650 MHz",
            "GPUBoostClock" => "1845 MHz",
            "GPUMemoryFreq" => "15500 MHz",
            "GPUCUDACores" => "3072",
            "GPUTensorCores" => "384",
            "GPURTCores" => "48"
        ], $product, $manager);
        $product->setCategory($this->getReference("c__GPU"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadSSD(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Corsair Force MP510, 240 Go, M.2");
        $product->setShortDescription("SSD - NVMe - Contrôleur Phison PS5012-E12 - Lecture max : 3100 Mo/s - Ecriture max : 1050 Mo/s - Mémoire TLC 3D");
        $product->setPrice(74.90);
        $product->setSku("CSSD-F240GBMP510");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10115015/in1011501502@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10115015/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10115015/03.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "SSDFormat" => "M.2 (Type 2280)",
            "SSDCapacity" => "240 Go",
            "SSDInterface" => "NVMe (PCI-E 3.0 4x)",
            "SSDMemory" => "TLC 3D",
            "SSDLectureDebit" => "3100 Mo/s",
            "SSDEcritureDebit" => "1050 Mo/s",
            "SSDDimensions" => "22 x 80 mm",
            "SSDTBW" => "400 To ou 1,8M d'heures",
        ], $product, $manager);
        $product->setCategory($this->getReference("c__SSD"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadSSD2(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Corsair Force MP510, 480 Go, M.2");
        $product->setShortDescription("SSD - NVMe - Contrôleur Phison PS5012-E12 - Lecture max : 3480 Mo/s - Ecriture max : 2000 Mo/s - Mémoire TLC 3D");
        $product->setPrice(109.90);
        $product->setSku("CSSD-F480GBMP510");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10115016/in1011501602@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10115016/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10115016/03.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "SSDFormat" => "M.2 (Type 2280)",
            "SSDCapacity" => "480 Go",
            "SSDInterface" => "NVMe (PCI-E 4.0 4x)",
            "SSDMemory" => "TLC 3D",
            "SSDLectureDebit" => "3480 Mo/s",
            "SSDEcritureDebit" => "2000 Mo/s",
            "SSDDimensions" => "22 x 80 mm",
            "SSDTBW" => "800 To ou 1,8M d'heures"            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__SSD"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadSSD3(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Aorus NVMe SSD, 1 To");
        $product->setShortDescription("SSD - NVMe - Contrôleur Phison PS5016-E16 - Lecture max : 5000 Mo/s - Ecriture max : 4400 Mo/s - Mémoire TLC 3D");
        $product->setPrice(329.90);
        $product->setSku("GP-ASM2NE6100TTTD");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1101/in11017752/in1101775202@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017752/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1101/in11017752/03.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "SSDFormat" => "M.2 (Type 2280)",
            "SSDCapacity" => "1 To",
            "SSDInterface" => "NVMe (PCI-E 4.0 4x)",
            "SSDMemory" => "TLC 3D",
            "SSDLectureDebit" => "5000 Mo/s",
            "SSDEcritureDebit" => "4400 Mo/s",
            "SSDDimensions" => "22 x 80 mm",            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__SSD"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadHDD(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Western Digital WD Blue, 500 Go");
        $product->setShortDescription("Disque dur 3.5 - 5400 tpm - 64 Mo - SATA III - Bulk");
        $product->setPrice(52.90);
        $product->setSku(" WD5000AZRZ");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1009/in10092720/in1009272002@2x.jpg",
            "https://www.topachat.com/boutique/img/in/in1009/in10092720/10.jpg",            
        ], $product, $manager);
        $this->injectSpecs([
            "HDDFormat" => "3.5",
            "HDDCapacity" => "500 Go",
            "HDDInterface" => "SATA III - 6.0 Gbps",
            "HDDSpeed" => "5 400 tpm",
            "HDDCacheMemory" => "64 Mo",            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__HDD"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadHDD2(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Seagate BarraCuda, 1 To");
        $product->setShortDescription("Disque dur 3.5 - 7200 tpm - 64 Mo - SATA III - Bulk");
        $product->setPrice(47.90);
        $product->setSku("ST1000DM010");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1010/in10100245/01.jpg",
            "https://www.topachat.com/boutique/img/in/in1010/in10100245/03.jpg",
            "https://www.topachat.com/boutique/img/in/in1010/in10100245/04.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "HDDFormat" => "3.5",
            "HDDCapacity" => "1 To",
            "HDDInterface" => "SATA III",
            "HDDSpeed" => "7200 tpm",
            "HDDCacheMemory" => "64 Mo",            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__HDD"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadPCCase(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Zalman T6, Noir");
        $product->setShortDescription("Boitier PC Moyen Tour - ATX / mATX / Mini-ITX - USB 3.0");
        $product->setPrice(33.90);
        $product->setSku("T6BK");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1011/in10119254/01.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10119254/02.jpg",
            "https://www.topachat.com/boutique/img/in/in1011/in10119254/03.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "PCCaseType" => "Boitier moyen tour",
            "PCCaseDimension" => "200 x 430 x 377 mm",
            "PCCaseGPU" => "Max 28O mm",
            "FormFactor" => "ATX / MicroATX / MiniATX",
            "PCCaseUSB" => "2x 2.0, 1x 3.0",
            "PCCaseWeight" => "2.3 Kg"            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__PC case"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }

    private function loadPCCase2(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("Aerocool CS-102, Noir");
        $product->setShortDescription("Boitier PC Mini Tour - mATX / Mini-ITX - USB 3.0");
        $product->setPrice(29.90);
        $product->setSku("EN51660");
        $this->injectImages([
            "https://www.topachat.com/boutique/img/in/in1010/in10105734/in1010573402.jpg",
            "https://www.topachat.com/boutique/img/in/in1010/in10105734/01.jpg",
            "https://www.topachat.com/boutique/img/in/in1010/in10105734/02.jpg",
        ], $product, $manager);
        $this->injectSpecs([
            "PCCaseType" => "Boitier mini tour",
            "PCCaseDimension" => "190 x 345 x 372 mm",
            "PCCaseGPU" => "Max 24O mm",
            "FormFactor" => "ATX/MiniATX",
            "PCCaseUSB" => "1x 2.0, 1x 3.0",
            "PCCaseWeight" => "1.9 Kg"            
        ], $product, $manager);
        $product->setCategory($this->getReference("c__PC case"));

        $review = new Review();
        $review->setUser($this->getReference("testuser"));
        $review->setComment("Je suis un Pangolin Malin !");
        $review->setRating(3.0);
        $manager->persist($review);

        $product->addReview($review);

        $manager->persist($product);
    }
}

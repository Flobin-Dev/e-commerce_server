<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $BASE_DATA = [
            [
                "name" => "CPU",
                "slug" => "cpu"
            ],
            [
                "name" => "GPU",
                "slug" => "graphics-card"
            ],
            [
                "name" => "Motherboard",
                "slug" => "motherboard",
                "specsList" =>
                    [
                        [
                            "specName" => "MBChipset",
                            "useAsDisplay" => true,
                            "useAsFilter" => true,
                            "useForCompatChecker" => true,
                            "required" => true
                        ]
                    ]
            ],
            [
                "name" => "SSD",
                "slug" => "ssd",
            ],
            [
                "name" => "HDD",
                "slug" => "hdd",
            ],
            [
                "name" => "RAM",
                "slug" => "memory",
            ],
            [
                "name" => "VENTIRAD",
                "slug" => "ventirad",
            ],
            [
                "name" => "PC case",
                "slug" => "pc_case",
            ],
            [
                "name" => "Power Supply",
                "slug" => "power_supply",
            ]
        ];

        foreach ($BASE_DATA as $c) {
            $category = new Category();
            $category->setSlug($c["slug"] ?? null);
            $category->setName($c["name"]);
            //$category->setSpecsList($c["specsList"] ?? []);
            $manager->persist($category);
            $this->addReference("c__" . $c["name"], $category);
        }

        $manager->flush();
    }
}

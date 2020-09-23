<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Entity\Product;

class ApiController extends AbstractController
{
    // Decodes the Request from Json to an array
    //
    public function jsonToArray(Request $request)
    {
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        return $parametersAsArray;
    }

    // After the normalization, loops through the Request
    // to see empty fields and returns errors as an array
    //
    public function errorsDetected(Request $request)
    {
        $errors = [];
        foreach($request as $key => $value) {
            if (empty($value)) {
                array_push($errors, "Please enter a value for " . $key);
            }
        }
    }

    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/categories/", name="categoriesList")
     */
    public function crudCategory()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/api/category/adding", name="addingCategory")
     */
    public function addingCategory(Request $request)
    {
        $request = $this->jsonToArray($request);
        $errors = $this->errorsDetected($request);

        if (!empty($errors)) {
            return $this->render('api/index.html.twig', [
                'controller_name' => 'ApiController',
                'errors' => $errors
            ]);
        } else {
            $category = new Category();
            $category->setName($request['name']);
            $newspec_list = [];
            foreach($request['spec_list'] as $key => $value) {
                array_push($newspec_list, $value);
            }
            $category->setSpecsList($newspec_list);

            $manager = $this->getDoctrine()->getManager();
    
            $manager->persist($category);
            $manager->flush();
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/category/{category}/edit", name="editCategory")
     */
    public function editCategory(Request $request, Category $category)
    {
        $manager = $this->getDoctrine()->getManager();
        $category = $manager->getRepository(Product::class)
            ->findOneBy([
                'name' => $category
            ]);
        $request = $this->jsonToArray($request);
        $errors = $this->errorsDetected($request);

        if (!empty($errors)) {
            return $this->render('api/index.html.twig', [
                'controller_name' => 'ApiController',
                'errors' => $errors
            ]);
        } else {
            $category->setName($request['name']);
            $newspec_list = [];
            foreach($request['spec_list'] as $key => $value) {
                array_push($newspec_list, $value);
            }
            $category->setSpecList($newspec_list);

            $manager->flush();
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{category}/deleting", name="deletingCategory")
     */
    public function deletingCategory(Category $category)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findOneBy([
            'name' => $category
        ]);

        $manager = $this->getDoctrine()->getManager();
    
        $manager->remove($category);
        $manager->flush();
        
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/product/{category}/add", name="addProduct")
     */
    public function addProduct(Request $request, Category $category)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $product_type = $repository->findOneBy([
            'name' => $category
        ]);
        $spec_list = $product_type->getSpecList();

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
            'spec_list' => $spec_list
        ]);
    }

    /**
     * @Route("/api/product/{id}/edit", name="editProduct")
     */
    public function editProduct(Request $request, Product $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository(Product::class)->find($id);
        
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
            'product' => $product
        ]);
    }

    /**
     * @Route("/api/product/{id}/editing", name="editingProduct")
     */
    public function editingProduct(Request $request, Category $category)
    {
        $request = $this->jsonToArray($request);
        $errors = $this->errorsDetected($request);
        
        if (!empty($errors)) {
            return $this->render('api/index.html.twig', [
                'controller_name' => 'ApiController',
                'errors' => $errors
            ]);
        } else {
            $manager = $this->getDoctrine()->getManager();
            $product = $manager->getRepository(Product::class)->find($id);
        
            $product->setName($request['name']);
            $product->setDescription($request['description']);
            $product->setPrice($request['price']);
            $product->setWeight($request['weight']);
            $product->setStock($request['stock']);
            $product->addImage($request['image']);
            $newspecs = [];
            foreach($request['specs'] as $key => $value) {
                array_push($newspecs, $value);
            }
            $product->setSpecs($newspecs);
            $product->setCategory($category);
    
            $manager->flush();
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/product/{category}/adding", name="addingProduct")
     */
    public function addingProduct(Request $request, Category $category)
    {
        $request = $this->jsonToArray($request);
        $errors = $this->errorsDetected($request);
        
        if (!empty($errors)) {
            return $this->render('api/index.html.twig', [
                'controller_name' => 'ApiController',
                'errors' => $errors
            ]);
        } else {
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $category = $repository->findOneBy([
                'name' => $category
            ]);
            $product = new Product();
            $product->setName($request['name']);
            $product->setDescription($request['description']);
            $product->setPrice($request['price']);
            $product->setWeight($request['weight']);
            $product->setStock($request['stock']);
            $product->addImage($request['image']);
            $newspecs = [];
            foreach($request['specs'] as $key => $value) {
                array_push($newspecs, $value);
            }
            $product->setSpecs($newspecs);
            $product->setCategory($category);

            $manager = $this->getDoctrine()->getManager();
    
            $manager->persist($product);
            $manager->flush();
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}

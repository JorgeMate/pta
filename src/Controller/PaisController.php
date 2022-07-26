<?php

namespace App\Controller;

use App\Controller\Admin\PaisCrudController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Pais;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class PaisController extends AbstractController
{

    private $adminUrlGenerator;
    private $em;
    private $repository;

    public function __construct(AdminUrlGenerator $adminUrlGenerator, ManagerRegistry $doctrine)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->em = $doctrine->getManager();
        $this->repository = $doctrine->getRepository(Pais::class);
    }

    
    #[Route('/api/country/{id}/{common}', name: 'oneCountry')]
    #-----------------------------------------------------------
    public function getOneCountry(Pais $pais, $common): Response

    {    
        $country = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com']);
        $response = $country->request('GET', '/v3.1/name/'.$common);
        $contents = (string) $response->getBody();
        $arrayObject = json_decode($contents);
        $object = $arrayObject[0];

        #dd($object);

        $common = $object->name->common;
        $official = $object->name->official;
        $tld = null;
        if(isset($object->tld[0])){
            $tld = $object->tld[0];
        }
        $capital = null;
        if(isset($object->capital[0])){
            $capital = $object->capital[0];
        }
        $region = $object->region;
        $subregion = null;
        if(isset($object->capital[0])){
            $subregion = $object->subregion;
        }
        $area = $object->area;
        $population = $object->population;
        $flag = null;
        if(isset($object->flag)){
            $flag = $object->flag;
        }

        $pais->setNameCommon($common);
        $pais->setNameOfficial($official);
        $pais->setTld($tld);
        $pais->setCapital($capital);
        $pais->setRegion($region);
        $pais->setSubregion($subregion);
        $pais->setArea($area);
        $pais->setPopulation($population);
        $pais->setFlag($flag);

        $this->em->persist($pais);
        $this->em->flush();

        $backUrl = $this->adminUrlGenerator
            ->setController(PaisCrudController::class)
            ->setAction(Action::EDIT)
            ->setEntityId($pais->getId())
            ->generateUrl();

       return $this->redirect($backUrl);
    }



    #[Route('/api/countries', name: 'allCountries')]
    #-----------------------------------------------
    public function getAllCountries(): Response
    {

        $countries = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com']);
        $response = $countries->request('GET', '/v3.1/all');

        $contents = (string) $response->getBody();

        $arrayObject = json_decode($contents, true);
        foreach($arrayObject as $key => $data){

            #---------------------------
            $this->getSetResults($data);
            #---------------------------
        }

        $backUrl = $this->adminUrlGenerator
            ->setController(PaisCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();
            
        return $this->redirect($backUrl);
    }

    #-------------------------------------
    private function getSetResults($data){       
        
        $common = $data["name"]["common"];
        $official = $data["name"]["official"];

        $tld = null;
        if(isset($data["tld"])){
            $tld = $data["tld"][0];
        }

        $capital = null;
        if(isset($data["capital"])){
            $capital = $data["capital"][0];
        }

        $region = $data["region"];

        $subregion = null;
        if(isset($data["subregion"])){
            $subregion = $data["subregion"];
        }

        $area = $data["area"];
        $population = $data["population"];

        $flag = null;
        if(isset($data["flag"])){
                $flag = $data["flag"];
        }

        # Existe ya un pais con ese nombre en nuestra BBDD ? (Por convenio, Solo importamos los que no existen)
        $pais = $this->repository->findOneBy(['name_common' => $common]);

        if(!isset($pais)){
      
            $pais = new Pais();
            $pais->setNameCommon($common);
            $pais->setNameOfficial($official);
            $pais->setTld($tld);
            $pais->setCapital($capital);
            $pais->setRegion($region);
            $pais->setSubregion($subregion);
            $pais->setArea($area);
            $pais->setPopulation($population);
            $pais->setFlag($flag);

            $this->em->persist($pais);
            $this->em->flush();
        }
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Pais;


class PaisController extends AbstractController
{
    #[Route('/api/countries', name: 'allCountries')]
    public function getAllCountries(ManagerRegistry $doctrine)
    {

        $countries = new \GuzzleHttp\Client(['base_uri' => 'https://restcountries.com']);
        
        $response = $countries->request('GET', '/v3.1/all');

        $contents = (string) $response->getBody();
        $contents = json_decode($contents, true);

        $this->getSetResultsAll($contents, $doctrine);

        return $this->redirectToRoute('admin_dashboard');

    }

    private function getSetResultsAll($arrayObject, ManagerRegistry $doctrine){

        foreach($arrayObject as $key=>$data) {

            $em = $doctrine->getManager();
            $repository = $em->getRepository(Pais::class);

            $capital = null;
            $tld = null;
            $subregion = null;

            $common = $data["name"]["common"];
            $official = $data["name"]["official"];
            if(isset($data["tld"])){
                $tld = $data["tld"][0];
            }
            if(isset($data["capital"])){
                $capital = $data["capital"][0];
            }
            $region = $data["region"];
            if(isset($data["subregion"])){
                $subregion = $data["subregion"];
            }
            $area = $data["area"];
            $population = $data["population"];

            # Existe ya un pais con ese nombre en nuestra BBDD ? (Por convenio, Solo importamos los que no existen)
            $pais = $repository->findOneBy(['name_common' => $common]);

            if(isset($pais)){
                #dd($pais->getNameCommon());
            } else {

                $pais = new Pais();
                $pais->setNameCommon($common);
                $pais->setNameOfficial($official);
                $pais->setTld($tld);
                $pais->setCapital($capital);
                $pais->setRegion($region);
                $pais->setSubregion($subregion);
                $pais->setArea($area);
                $pais->setPopulation($population);
                $em->persist($pais);
                $em->flush();

            }
        }
    }
}

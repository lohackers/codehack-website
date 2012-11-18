<?php

namespace CodeHack\Api\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CodeHack\CoreBundle\Entity\Emergency;
use CodeHack\CoreBundle\Entity\Offers;
use CodeHack\CoreBundle\Entity\Money;
use CodeHack\CoreBundle\Entity\People;
use CodeHack\CoreBundle\Entity\Material;

class DefaultController extends Controller
{
    /**
     * @Route("/emergencies")
     * @Method({"GET"})
     * @Template()
     */
    public function listEmergenciesAction()
    {
        $em = $this->getDoctrine()->getRepository("CodeHackCoreBundle:Emergency");
        $emergencies = $em->findAll();
        $emergencies_json = array();
        $i=0;
        foreach ($emergencies as $key => $emergency) {
          
          $date = $emergency->getTimestamp();
          $emergencies_json['emergencies'][] = array(
              "id" => (string)$emergency->getID(),
              "loc" => array(
                  "lon" => (int)$emergency->getLng(),
                  "lat" => (int)$emergency->getLat()
              ),
              "type" => $emergency->getType(),
              "level" => $emergency->getLevel(),
              "intensity" => (int)$emergency->getIntensity(),
              "timestamp" => $date->format("Y-m-d h:m:s"),
          );
        }
        
        $response = new Response(json_encode($emergencies_json));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/emergencies")
     * @Method({"POST"})
     * @Template()
     */
    public function addEmergencyAction()
    {
      //var_dump($this->getRequest()->getContent());die;
        $em  = $this->getDoctrine()->getEntityManager();
        $emergency_data = json_decode($this->getRequest()->getContent());
        $data = new \DateTime('now');
        $emergency = new Emergency();
        $emergency->setApproved(0);
        $emergency->setIntensity($emergency_data->intensity);
        $emergency->setLat($emergency_data->loc->lat);
        $emergency->setLng($emergency_data->loc->lon);
        $emergency->setLevel($emergency_data->level);
        $emergency->setTimestamp($data);
        $emergency->setType($emergency_data->type);
        $em->persist($emergency);
        
        switch ($emergency_data->type) {
          case "HQ":
          case "earthquake":
            $data_money = array(
                "title" => "Cibo",
                "description" => "beni di primo consumo",
                "quantity" => 100,
                "unitcost" => 2,
                "emergency" => $emergency
            );
            $this->addMoney($data_money);
            
            $data_material = array(
                "title" => "vestiti",
                "description" => "maglie per i bambini",
                "quantity" => 30,
                "emergency" => $emergency
            );
            $this->addMaterial($data_material);
            
            $data_people = array(
                "title" => "Spostare Massi",
                "description" => "ripulire le macerie",
                "quantity" => 2,
                "emergency" => $emergency
            );
            $this->addPeople($data_people);
            break;
          case "fire":
            $data_money = array(
                "title" => "Pasti",
                "description" => "beni di primo consumo",
                "quantity" => 100,
                "unitcost" => 5,
                "emergency" => $emergency
            );
            $this->addMoney($data_money);
            
            $data_material = array(
                "title" => "Coperte",
                "description" => "",
                "quantity" => 30,
                "emergency" => $emergency
            );
            $this->addMaterial($data_material);
            
            $data_people = array(
                "title" => "Pompieri",
                "description" => "ripulire le macerie",
                "quantity" => 2,
                "emergency" => $emergency
            );
            $this->addPeople($data_people);
            break;
          default:
        break;
        }
        
        $em->flush();
        $response = new Response(json_encode("status:ok"));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    //facciamo le cose fatte male, ma un po' meno ... fa ridere
    private function addMoney($data){
      
        $em  = $this->getDoctrine()->getEntityManager();
        $money = new Money();
        $money->setTitle($data['title']);
        $money->setDescription($data['description']);
        $money->setQuantity($data['quantity']);
        $money->setUnitcost($data['unitcost']);
        $money->setEmergency($data['emergency']);
        
        $em->persist($money);
        $em->flush();
    }
    
    private function addPeople($data){
        $em  = $this->getDoctrine()->getEntityManager();
        $pleone = new People();
        $pleone->setTitle($data['title']);
        $pleone->setDescription($data['description']);
        $pleone->setQuantity($data['quantity']);
        $pleone->setEmergency($data['emergency']);
        
        $em->persist($pleone);
        $em->flush();
    }
    
    private function addMaterial($data){
        $em  = $this->getDoctrine()->getEntityManager();
        $material = new Material();
        $material->setTitle($data['title']);
        $material->setDescription($data['description']);
        $material->setQuantity($data['quantity']);
        $material->setEmergency($data['emergency']);
        
        $em->persist($material);
        $em->flush();
    }

        
    /** 
     * @Route("/emergencies/{id}")
     * @Method({"GET"})
     * @Template()
     */
    public function emergencyDetailAction($id)
    {
        $people_json = array();
        $money_json = array();
        $material_json = array();
        
        $em = $this->getDoctrine()->getRepository("CodeHackCoreBundle:Emergency");
        $emergency = $em->find($id);
        $peoples = $emergency->getPeople(); //prendiamo tutte le richieste di persone
        foreach ($peoples as $key => $people) {
          $total  = rand(0, 90);
          $people_json[] = array(
              "total" => $total ,
              "remaining" => rand(0, $total),
              "description" => $people->getDescription() ,
              "title" => $people->getTitle()	//Primary key
          );
        }
        
        $materials = $emergency->getMaterial(); //prendiamo tutte le richieste di persone
        foreach ($materials as $key => $material) {
          $total  = rand(0, 90);
          $material_json[] = array(
              "total" => $total ,
              "remaining" => rand(0, $total),
              "description" => $material->getDescription() ,
              "title" => $material->getTitle()	//Primary key
          );
        }
        
        $moneys = $emergency->getMoney(); //prendiamo tutte le richieste di persone
        foreach ($moneys as $key => $money) {
          $total  = rand(0, 90);
          $money_json[] = array(
              "total" => $total ,
              "remaining" => rand(0, $total),
              "description" => $people->getDescription() ,
              "title" => $people->getTitle(),	//Primary key
              "unitcost" => $people->getUnitcost()
          );
        }
        
        $emergencies_json = array();  
          $date = $emergency->getTimestamp();
          $emergencies_json['emergencies'][] = array(
               "id" => $emergency->getID(),
              "loc" => array(
                  "lon" => $emergency->getLng(),
                  "lat" => $emergency->getLat()
              ),
              "type" => $emergency->getType(),
              "level" => $emergency->getLevel(),
              "intensity" => $emergency->getIntensity(),
              "timestamp" => $date->format("Y-m-d h:m:s"),
              "people" => $people_json,
              "money" => $money_json,
              "material" => $material_json
          );
        
        $response = new Response(json_encode($emergencies_json));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * @Route("/emergencies/{id}/offers")
     * @Method({"POST"})
     * @Template()
     */
    public function emergencyOfferAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $emergencyRepo = $this->getDoctrine()->getRepository("CodeHackCoreBundle:Emergency");
        $emergency = $emergencyRepo->find($id);
        
        $json = $this->getRequest()->getContent();
        $json_decode = json_decode($json, true);     
        
        foreach ($json_decode['offers'] as $offer) {
                $offers = new Offers();
                $offers->setEmergency($emergency);
                $offers->setType($offer['type']);
                $offers->setTitle($offer['title']);
                $offers->setQuantity($offer['quantity']);
                $offers->setMail($json_decode['email']);
                
                $em->persist($offers);
        }
        
        $em->flush();
        
        $response = new Response(json_encode(array('status' => 'ok')));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /** 
     * @Route("/fakehomepage")
     * @Method({"GET"})
     * @Template()
     */
    public function fakeHomepageAction()
    {
        return $this->render('CodeHackHomePageBundle:Default:fake.html.twig', array(
            
        ));
    } 
    
} 

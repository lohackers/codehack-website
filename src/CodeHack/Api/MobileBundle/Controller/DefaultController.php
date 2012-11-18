<?php

namespace CodeHack\Api\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CodeHack\CoreBundle\Entity\Emergency;

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
        foreach ($emergencies as $key => $emergency) {
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
          );
        }
        
        $response = new Response(json_encode($emergencies_json));
        return $response;
    }
    
    /**
     * @Route("/emergencies")
     * @Method({"POST"})
     * @Template()
     */
    public function addEmergencyAction()
    {
        $response = new Response(json_encode("caffelatte:bocchini"));
        return $response;
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
        return $response;
    }
    
    /**
     * @Route("/emergencies/:id/offers")
     * @Method({"POST"})
     * @Template()
     */
    public function emergencyOfferAction($id)
    {
        return array();
    }
    
} 

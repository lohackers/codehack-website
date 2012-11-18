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
        return array();
    }
    
    /** 
     * @Route("/emergencies/{id}")
     * @Method({"GET"})
     * @Template()
     */
    public function emergencyDetailAction($id)
    {
      
        $em = $this->getDoctrine()->getRepository("CodeHackCoreBundle:Emergency");
        $emergency = $em->find($id);
        $emergencies_json = array();
        var_dump($emergency->getRequirements());die;
          
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

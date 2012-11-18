<?php

namespace CodeHack\HomePageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CodeHack\CoreBundle\Entity\Emergency;
use CodeHack\CoreBundle\Entity\Offers;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/emergency/{id}/offer/people")
     * @Template()
     */
    public function emergencyAction($id)
    {
        $em = $this->getDoctrine()->getRepository("CodeHackCoreBundle:Emergency");
        $emergencies = $em->find($id);
        
        $offers = $emergencies->getOffers();
        
        $form = $this->createForm(new \CodeHack\CoreBundle\Form\OffersType());
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/thankyou", name="thankyou")
     * @Template()
     */
    public function thankyouAction()
    {
        return array();
    }    
    
}

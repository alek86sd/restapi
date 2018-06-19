<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Visits;


class visitsController extends Controller{
  /**
   * @Route("/insert", name="reading-data")
   * @Method("POST")
   */
  public function insertAction(Request $request){
    $entityManager = $this->getDoctrine()->getManager();
    
    $eventSrc = $request->query->get('event');
    $countrySrc = $request->query->get('country');
    $dateSrc = date('d.m.Y');
    
    $visits = new Visits();
    
    $searchCriteria = array(
      'event' => $eventSrc,
      'country' => $countrySrc,
      'datetime' => $dateSrc
    );
    $visitExist = $entityManager->getRepository(Visits::class)->findOneBy($searchCriteria);

    if(!$visitExist){
      $visits->setEvent($eventSrc);
      $visits->setCountry($countrySrc);
      $visits->setDatetime($dateSrc);
      $visits->setVisitsCount(1);

      $entityManager->persist($visits);
      $entityManager->flush();
      return new Response("sacuvano kao novi unos", 201);
    }else{
      $newCount = $visitExist->getVisitsCount() + 1;
      $visitExist->setVisitsCount($newCount);
      $entityManager->flush();
      return new Response("radim update za ID:".$visitExist->getId(), 201);
    }
  }

  /**
   * @Route("/retrieve/{format}/{event}")
   * @Method({"GET"})
   * @param $format
   */
  public function getAction($format, $event){
    $repository = $this->getDoctrine()->getManager()->getRepository(Visits::class);
    $arrVisitsViews = $repository->findBy(
            array('event' => $event),
            array('visitsCount' => 'DESC', 'datetime' => 'DESC'),
            5
    );
    
    $result = array();
    
    if($format == 'json'){
      foreach($arrVisitsViews as $key => $value){
        $result[$key] = array(
          'event' => $value->getEvent(),
          'country' => $value->getCountry(),
          'date' => $value->getDateTime(),
          'visitCount' => $value->getVisitsCount()
        );
      }
      return $this->json($result, 200);
    }elseif($format == 'csv'){
      $csv = '';
      foreach($arrVisitsViews as $key => $value){
        $csv .= $value->getEvent().'|'.$value->getCountry().'|'.$value->getDateTime().'|'.$value->getVisitsCount()."<br />\n";
        
      }
      return new Response($csv, 202);
    }else{
      return new Response('format not supported', 406);
    }
  }

}
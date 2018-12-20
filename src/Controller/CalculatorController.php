<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CalculatorType;
use App\Entity\Calculator;
use Symfony\Component\HttpFoundation\Request;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/calcul-des-droits", name="calculator")
     */
    public function index(Request $request)
    {
        $result = ['code' => null, 'ceil' => null, 'valid' => null];
        $calculator = new Calculator;
        $calculator->setFrench(1);
        $form = $this->createForm(CalculatorType::class, $calculator);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $result = $this->getCalculatorResult($contact);
        }
        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }

    /**
     * @param Calculator $contact
     * @return array
     */
    protected function getCalculatorResult(Calculator $contact): array
    {
        if ($contact->getAdult() == 1 && $contact->getChild() == 0) {
            if ($contact->getRevenue() > $this->getCeil(1)) {
                return $this->getResult(1, $this->getCeil(1), false);
            }
            return $this->getResult(1, $this->getCeil(1), true);
        }
        if ($contact->getAdult() == 2 && $contact->getChild() == 0) {
            if ($contact->getRevenue() > $this->getCeil(2)) {
                return $this->getResult(2, $this->getCeil(2), false);
            }
            return $this->getResult(2, $this->getCeil(2), true);
        }
        if (($contact->getAdult() == 3 && $contact->getChild() == 0) || ($contact->getAdult() == 1 && $contact->getChild() == 1)) {
            if ($contact->getRevenue() > $this->getCeil(3)) {
                return $this->getResult(3, $this->getCeil(3), false);
            }
            return $this->getResult(3, $this->getCeil(3), true);
        }
        if (($contact->getAdult() == 4 && $contact->getChild() == 0) || ($contact->getAdult() == 1 && $contact->getChild() == 2)) {
            if ($contact->getRevenue() > $this->getCeil(4)) {
                return $this->getResult(4, $this->getCeil(4), false);
            }
            return $this->getResult(4, $this->getCeil(4), true);
        }
        if (($contact->getAdult() == 5 && $contact->getChild() == 0) || ($contact->getAdult() == 1 && $contact->getChild() == 3)) {
            if ($contact->getRevenue() > $this->getCeil(5)) {
                return $this->getResult(5, $this->getCeil(5), false);
            }
            return $this->getResult(5, $this->getCeil(5), true);
        }
        if (($contact->getAdult() == 6 && $contact->getChild() == 0) || ($contact->getAdult() == 1 && $contact->getChild() == 4)) {
            if ($contact->getRevenue() > $this->getCeil(6)) {
                return $this->getResult(6, $this->getCeil(6), false);
            }
            return $this->getResult(6, $this->getCeil(6), true);
        }
        if (($contact->getAdult() > 6 && $contact->getChild() == 0)) {
            $ceil = ($this->getCeil(6) + (($contact->getAdult() - 6) * $this->getCeil(7)));
            if ($contact->getRevenue() > $ceil) {
                return $this->getResult(7, $ceil, false);
            }
            return $this->getResult(7, $ceil, true);
        }
        return $this->getResult(8, $this->getCeil(6), false);
    }

    /**
     * @param int $code
     * @param float $ceil
     * @param bool $isValid
     * @return array
     */
    protected function getResult(int $code, float $ceil, bool $isValid): array
    {
        return [
            'code' => $code,
            'ceil' => $ceil,
            'valid' => $isValid,
        ];
    }

    /**
     * @param int $case
     * @return float
     */
    protected function getCeil(int $case): float
    {
        switch ($case) {
            case 1:
                return 19417;
            case 2:
                return 25930;
            case 3:
                return 31183;
            case 4:
                return 37645;
            case 5:
                return 44284;
            case 6:
                return 49908;
            case 7:
                return 5567;
        }
    }
}

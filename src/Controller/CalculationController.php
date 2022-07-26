<?php

namespace App\Controller;

use App\DTO\CalculationDTO;
use App\Form\Type\CalculationDTOType;
use App\Service\CalculationService;
use App\Validator\ValidMathProblem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CalculationController extends AbstractController
{
    public function __construct(private ValidatorInterface $validator)
    {}

    #[Route('/calculate', name: 'calculator.page', methods: 'GET')]
    public function getPage(Request $request): Response
    {
        if ($solution = $request->query->get('solution')) {
            $dto = new CalculationDTO();
            $dto->setInput($solution);
        }
        $form = $this->createForm(CalculationDTOType::class, $dto ?? null);
    
        return $this->renderForm('calculate-page.html.twig', ['solution' => $request->query->get('solution'), 'form' => $form]);
    }

    #[Route('/calculate', name: 'calculator.doCalc', methods: 'POST')]
    public function doCalculation(Request $request, CalculationService $service)
    {
        $form = $this->createForm(CalculationDTOType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CalculationDto $dto */
            $dto = $form->getData();
            $solution = $service->calculate($dto->getInput());

            return $this->redirectToRoute('calculator.page', ['solution' => $solution]);
        }

        return $this->renderForm('calculate-page.html.twig', ['form' => $form]);
    }
}

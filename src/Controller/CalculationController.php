<?php

namespace App\Controller;

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
        return $this->render('calculate-page.html.twig', ['solution' => $request->query->get('solution')]);
    }

    #[Route('/calculate', name: 'calculator.doCalc', methods: 'POST')]
    public function doCalculation(Request $request, CalculationService $service)
    {
        $input = $request->request->get('input');
        $violations = $this->validator->validate(
            $input,
            new ValidMathProblem()
        );

        if ($violations->count()) {
            throw new BadRequestHttpException($violations);
        }

        $solution = $service->calculate($input);

        return $this->redirectToRoute('calculator.page', ['solution' => $solution]);
    }
}

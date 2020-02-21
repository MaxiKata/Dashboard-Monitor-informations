<?php


namespace App\Controller;


use App\Entity\Sheet;
use App\Form\SheetType;
use App\Repository\SheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em, SheetRepository $repository)
    {
        $this->em           =   $em         ;
        $this->repository   =   $repository ;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('Dashboard/mainView.html.twig');
    }

    /**
     * @Route("/dashboard/addsheet", name="addsheet")
     */
    public function newSheet(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(empty($this->getUser()->getSheet())){
            $sheet = new Sheet();

            $form = $this->createForm(SheetType::class, $sheet);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $sheet = $form->getData();
                $sheet->setUser($this->getUser());

                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                // $entityManager = $this->getDoctrine()->getManager();
                $this->em->persist($sheet);
                $this->em->flush();

                $this->addFlash(
                    'success',
                    'Connect To google now'
                );
                return $this->redirectToRoute('dashboard');
            }

            return $this->render('Dashboard/addSheet.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        $this->addFlash('danger', 'You already register a document');
        return $this->redirectToRoute('dashboard');
    }
}
<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DoctrineController extends AbstractController
{
    // Crear una propiedad privada para almacenar el EntityManager
    private $em;

    // Crear un constructor para inyectar el EntityManager 
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Controlador para mostrar los datos de la tabla usuario
    #[Route('/doctrine', name: 'doctrine_inicio')]
    public function index(): Response
    {
        // Obtener todos los datos de la tabla usuario y almacenarlos en la variable $datos
        $datos = $this->em->getRepository(Usuario::class)->findBy(array(), array('id' => 'asc'));
        // Renderizamos la plantilla doctrine/index.html.twig y pasarle la variable $datos
        return $this->render('doctrine/index.html.twig', ['datos' => $datos]);
    }

    // Controlador para crear nuevos usuarios
    #[Route('/doctrine/add', name: 'doctrine_add')]
    // Inyectar el Request y el ValidatorInterface para validar los datos del formulario
    public function user_add(Request $request, ValidatorInterface $validator): Response
    {
        // Creamos una instanvcia de la entidad Usuario
        $entity = new Usuario();
        // Creanos un formulario de tipo entidad de la entidad Usuario
        $form = $this->createForm(UsuarioFormType::class, $entity);
        // Manejar la petición del formulario
        $form->handleRequest($request);
        // Obtener el token del formulario
        $submittedToken = $request->request->get('token');
        // Verificar si el formulario ha sido enviado
        if ($form->isSubmitted()) {
            // Verificar si el token es válido
            if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                // Validamos los campos del formulario
                $errors = $validator->validate($entity);
                // Verificar si hay errores en los campos del formulario
                if (count($errors) > 0) {
                    // Renderizamos la pantalla de creación de usuarios y pasamos el formulario y los errores
                    return $this->render('doctrine/doctrine_add.html.twig', compact('form', 'errors'));
                } else {
                    // Obtenemos los campos del formulario
                    $campos = $form->getData();
                    // Asignamos los campos a la entidad Usuario
                    $entity->setNombre($campos->getNombre());
                    $entity->setCorreo($campos->getCorreo());
                    $entity->setTelefono($campos->getTelefono());
                    // Persistimos la entidad Usuario
                    $this->em->persist($entity);
                    // Guardamos los cambios en la base de datos
                    $this->em->flush();
                    // Mostramos un mensaje de éxito
                    $this->addFlash('css', 'success');
                    $this->addFlash('mensaje', 'Se creó el registro exitosamente');
                    // Redirigimos a la misma página
                    return $this->redirectToRoute('doctrine_add');
                }
            } else {
                // Mostramos un mensaje de error
                $this->addFlash('css', 'warning');
                $this->addFlash('mensaje', 'Ocurrió un error inesperado');
                // Redirigimos a la misma página
                return $this->redirectToRoute('doctrine_add');
            }
        }
        // Renderizamos la pantalla de creación de usuarios y pasamos el formulario y un array vacío de errores
        return $this->render('doctrine/doctrine_add.html.twig', ['form' => $form, 'errors' => array()]);
    }

    // Controlador para modificar los datos de la tabla usuario
    #[Route('/doctrine/edit/{id}', name: 'doctrine_edit')]
    public function user_edit(int $id, Request $request, ValidatorInterface $validator): Response
    {
        // Creamos una instancia de la entidad Usuario con una consulta a la base de datos
        // Select * from usuario where id = $id
        $entity = $this->em->getRepository(Usuario::class)->find($id);
        // Validar si la entidad es nula
        if (!$entity) {
            throw $this->createNotFoundException(
                'No se encontró el registro con el id: ' . $id
            );
        }
        $form = $this->createForm(UsuarioFormType::class, $entity);
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');
        if ($form->isSubmitted()) {
            if ($this->isCsrfTokenValid('generico', $submittedToken)) {
                $errors = $validator->validate($entity);
                if (count($errors) > 0) {
                    return $this->render('doctrine/doctrine_edit.html.twig', compact('form', 'errors', 'entity'));
                } else {
                    $campos = $form->getData();
                    $entity->setNombre($campos->getNombre());
                    $entity->setCorreo($campos->getCorreo());
                    $entity->setTelefono($campos->getTelefono());
                    // $this->em->persist($entity);
                    $this->em->flush();
                    $this->addFlash('css', 'success');
                    $this->addFlash('mensaje', 'Se modifico el registro exitosamente');
                    return $this->redirectToRoute('doctrine_edit', ['id' => $id]);
                }
            } else {
                $this->addFlash('css', 'warning');
                $this->addFlash('mensaje', 'Ocurrió un error inesperado');
                return $this->redirectToRoute('doctrine_edit', ['id' => $id]);
            }
        }
        return $this->render('doctrine/doctrine_edit.html.twig', ['form' => $form, 'errors' => array(), 'entity' => $entity]);
    }

    // Controlador para eliminar los datos de la tabla usuario
    #[Route('/doctrine/delete/{id}', name: 'doctrine_delete')]
    public function user_delete(int $id, Request $request)
    {
        $entity = $this->em->getRepository(Usuario::class)->find($id);
        // Validar si la entidad es nula
        if (!$entity) {
            throw $this->createNotFoundException(
                'No se encontró el registro con el id: ' . $id
            );
        }
        $this->em->remove($entity);
        $this->em->flush();
        $this->addFlash('css', 'success');
        $this->addFlash('mensaje', 'Se elimino el registro exitosamente');
        return $this->redirectToRoute('doctrine_inicio');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\ProjectConfig;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ProjectConfigCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectConfig::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', '#')
            ->hideOnForm();
        yield TextField::new('title', 'Название проекта');
        yield TextField::new('shorttext', 'Короткий текст')
            ->hideOnIndex();
        yield EmailField::new('email', 'Почта')
            ->hideOnIndex();
        yield TelephoneField::new('phone', 'Телефон')
            ->hideOnIndex();
        yield FormField::addPanel('Добавить логотип');
        yield ImageField::new('photo', 'Логотип')
            ->setColumns(3)
            ->onlyOnIndex()
            ->setBasePath($this->getParameter('app.logo_project'));
        yield TextareaField::new('imageFile', 'Логотип')
            ->hideOnIndex()
            ->setHelp('Фото обязательно')
            ->setFormTypeOptions([
                'allow_delete' => false
            ])
            ->setFormType(VichImageType::class);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('Информация проекта')
            ->setEntityLabelInPlural('Информация для сайта(телефон, почта, логотип...');
    }
}

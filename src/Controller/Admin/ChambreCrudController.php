<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('tarif', 'Tarif'),
            // TextField::new('superficie', 'Superficie'),
            // IntegerField::new('vueSurMer', 'Vue sur la mer'),
            // IntegerField::new('Chaines_à_laCarte', 'Chaînes à la carte'),
            // IntegerField::new('climatisation', 'Climatisation'),
            // IntegerField::new('television_à_ecranPlat', 'Télévision à écran plat'),
            // IntegerField::new('telephone', 'Téléphone'),
            // IntegerField::new('chainesSatellite', 'Chaînes satellite'),
            // IntegerField::new('chainesDuCable', 'Chaînes du câble'),
            // IntegerField::new('coffreFort', 'Coffre-fort'),
            // IntegerField::new('materielDeRepassage', 'Matériel de repassage'),
            // IntegerField::new('WiFiGratuit', 'Wi-Fi Gratuit'),
            BooleanField::new('etat', 'État'),
            TextField::new('libelle', 'Libellé'),

            
        ];
    }
}
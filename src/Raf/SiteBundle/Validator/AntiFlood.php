<?php
// src/Raf/SiteBundle/Validator/AntiFlood.php
 
namespace Raf\SiteBundle\Validator;
 
use Symfony\Component\Validator\Constraint;
 
/**
 * @Annotation
 */
class AntiFlood extends Constraint
{
    public $message = 'Vous avez déjà posté un message il y a moins de 15 secondes, merci d\'attendre un peu.';

	public function validatedBy()
  	{
    	return 'raf_site_antiflood'; // Ici, on fait appel à l'alias du service
  	}
}
<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 12:46
 */

namespace App\Service\Cap;


use App\Entity\Cap;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CapManager extends EntityManager
{
    private $typeManager;
    private $colorManager;
    private $patchManager;

    public function __construct(EntityManagerInterface $manager, CapTypeManager $typeManager, CapColorManager $colorManager, CapPatchManager $patchManager)
    {
        parent::__construct($manager);
        $this->typeManager = $typeManager;
        $this->colorManager = $colorManager;
        $this->patchManager = $patchManager;
    }

    /**
     * @param int $answer_type
     * @param int $answer_color
     * @param int $answer_patch
     * @return Cap
     */
    public function createCap(int $answer_type, int $answer_color, int $answer_patch)
    {
        $cap = new Cap();
        $type = $this->typeManager->getType($answer_type);
        $cap->setType($type);
        $color = $this->colorManager->getCapColor($answer_color);
        $cap->setColor($color);
        $patch = $this->patchManager->getCapPatch($answer_patch);
        $cap->setPatch($patch);
        $cap->setPricing((floatval($type->getPricing()) + floatval($color->getPricing()) + floatval($patch->getPricing())));
        $this->update($cap);
        return $cap;
    }
}

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
     * @param string $answer_type
     * @param string $answer_color
     * @param string $answer_patch
     * @return Cap
     */
    public function createCap(string $answer_type, string $answer_color, string $answer_patch)
    {
        $cap = new Cap();
        $cap->setType($this->typeManager->getType($answer_type));
        $cap->setColor($this->colorManager->getCapColor($answer_color));
        $cap->setPatch($this->patchManager->getCapPatch($answer_patch));
        $this->update($cap);
        return $cap;
    }
}

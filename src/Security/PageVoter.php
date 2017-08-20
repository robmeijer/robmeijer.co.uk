<?php

namespace App\Security;

use App\Entity\Page;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PageVoter extends Voter
{
    const EDIT = 'edit';
    const VIEW = 'view';

    protected $attributes = [self::EDIT, self::VIEW];

    /**
     * @var AccessDecisionManagerInterface
     */
    protected $decisionManager;

    /**
     * @param AccessDecisionManagerInterface $decisionManager
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }


    /**
     * {@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        return $subject instanceof Page && in_array($attribute, $this->attributes, true);
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // the user must be logged in; if not, deny access
        if (! $user instanceof User) {
            return false;
        }

        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($subject, $user);
            case self::VIEW:
                return $this->canView($subject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param Page $subject
     * @param Page $user
     * @return bool
     */
    private function canEdit($subject, $user)
    {
        return $user->getId() === $subject->getId();
    }

    /**
     * @param Page $subject
     * @param Page $user
     * @return bool
     */
    private function canView($subject, $user)
    {
        return true;
    }
}

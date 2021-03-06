<?php

namespace Pagekit\User\Entity;

use Pagekit\Database\ORM\ModelTrait;
use Pagekit\User\Model\Role as BaseRole;

/**
 * @Entity(tableClass="@system_role", eventPrefix="user.role")
 */
class Role extends BaseRole implements \JsonSerializable
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    protected $id;

    /** @Column(type="string") */
    protected $name;

    /** @Column(type="integer") */
    protected $priority = 0;

    /** @Column(type="simple_array") */
    protected $permissions = [];

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $role = $this->toJson();

        $role['isLocked'] = $this->isLocked();
        $role['isAnonymous'] = $this->isAnonymous();
        $role['isAuthenticated'] = $this->isAuthenticated();
        $role['isAdministrator'] = $this->isAdministrator();

        return $role;
    }

    /**
     * @PreSave
     */
    public function preSave()
    {
        if (!$this->id) {
            $this->setPriority(self::getConnection()->fetchColumn('SELECT MAX(priority) + 1 FROM @system_role'));
        }
    }
}

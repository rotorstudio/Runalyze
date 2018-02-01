<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Api\V1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/api/v1/activities")
 */
class ActivityController extends Controller
{
    /**
     * @Route("v1/activities/uploads", name="api-activity-upload")
     * @Security("has_role('ROLE_USER')")
     */
    public function activityUpload(Account $account)
    {
        //
    }
}

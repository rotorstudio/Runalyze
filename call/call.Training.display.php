<?php
/**
 * File for displaying a training.
 * Call:   call.Training.display.php?id=
 */
use Runalyze\Model\Activity;
use Runalyze\View\Activity\Context;

$Context = new Context(Request::sendId(), SessionAccountHandler::getId());

switch (Request::param('action')) {
    case 'changePrivacy':
        $oldActivity = clone $Context->activity();
        $Context->activity()->set(Activity\Entity::IS_PUBLIC, !$Context->activity()->isPublic());
        $Updater = new Activity\Updater(DB::getInstance(), $Context->activity(), $oldActivity);
        $Updater->setAccountID(SessionAccountHandler::getId());
        $Updater->update();
        break;
    case 'delete':
        $Factory = Runalyze\Context::Factory();
        $Deleter = new Activity\Deleter(DB::getInstance(), $Context->activity());
        $Deleter->setAccountID(SessionAccountHandler::getId());
        $Deleter->setEquipmentIDs($Factory->equipmentForActivity(Request::sendId(), true));
        $Deleter->delete();

        echo '<div class="panel-content"><p id="submit-info" class="error">'.__('The activity has been removed').'</p></div>';
        echo '<script>Runalyze.Statistics.resetUrl();Runalyze.reloadContent();</script>';
        exit();
        break;
}

if (!Request::param('silent')) {
    $View = new TrainingView($Context);
    $View->display();
}
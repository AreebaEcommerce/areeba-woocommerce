<?php

namespace WoocommerceModule\Client\Transaction\Base;

use WoocommerceModule\Client\Schedule\ScheduleData;

interface ScheduleInterface {

    /**
     * @return ScheduleData
     */
    public function getSchedule();

    /**
     * @param ScheduleData $schedule |null
     *
     * @return $this
     */
    public function setSchedule(ScheduleData $schedule = null);
}

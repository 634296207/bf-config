
#include <stdint.h>
#include "platform.h"

#include "fc/fc_msp_box.h"
#include "io/piniobox.h"
#include "sensors/boardalignment.h"
#include "sensors/barometer.h"
#include "sensors/compass.h"

void targetConfiguration(void)
{
    compassConfigMutable()->mag_align = CW90_DEG;

    boardAlignmentMutable()->yawDeciDegrees = 450;
}
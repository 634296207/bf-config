/*
 * @Author: g05047
 * @Date: 2023-02-28 14:51:37
 * @LastEditors: g05047
 * @LastEditTime: 2023-02-28 16:09:36
 * @Description: file content
 */
#include <stdbool.h>
#include <platform.h>
#include "drivers/io.h"
#include "drivers/pwm_mapping.h"
#include "drivers/timer.h"

timerHardware_t timerHardware[] = {
     DEF_TIM(TIM2, CH2, PA10,  TIM_USE_PPM, 0, 0),  // PPM
    
    DEF_TIM(TIM3, CH1, PC6,  TIM_USE_MC_MOTOR | TIM_USE_FW_MOTOR, 0, 0),  // S1
    DEF_TIM(TIM3, CH2, PC7,  TIM_USE_MC_MOTOR | TIM_USE_FW_MOTOR, 0, 0),  // S2
    DEF_TIM(TIM3, CH3, PC8,  TIM_USE_MC_MOTOR | TIM_USE_FW_SERVO, 0, 0),  // S3
    DEF_TIM(TIM3, CH4, PC9,  TIM_USE_MC_MOTOR | TIM_USE_FW_SERVO, 0, 0),  // S4

    DEF_TIM(TIM1, CH1, PB1,  TIM_USE_LED, 0, 0),     // FC CAM	
};

const int timerHardwareCount = sizeof(timerHardware) / sizeof(timerHardware[0]);
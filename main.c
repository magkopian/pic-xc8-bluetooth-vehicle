/**********************************************\
* Copyright (c) 2015 Manolis Agkopian          *
* See the file LICENCE for copying permission. *
\**********************************************/

#include <xc.h>
#include <plib.h>
#include "config_bits.h"

#define _XTAL_FREQ 12000000
#define USE_AND_MASKS

#define A1_TRIS TRISA0
#define A2_TRIS TRISA1
#define A3_TRIS TRISA2
#define A4_TRIS TRISA3

#define A1 LATA0
#define A2 LATA1
#define A3 LATA2
#define A4 LATA3

#define DC_0 0
#define DC_25 255
#define DC_50 511
#define DC_75 767
#define DC_100 1023

void usart_init ( void );
void pwm_init ( void );

int main(void) { 
    unsigned int duty1 = DC_50, duty2 = DC_50;

    usart_init();
    pwm_init();

    A1_TRIS = A2_TRIS = A3_TRIS = A4_TRIS = 0;
    
    for(;;) {
        char data;

        if (DataRdyUSART()) {
            data = ReadUSART();
            if (data == 'F' || data == 'f') {
                putrsUSART("Foward");
                A1 = A3 = 1;
                A2 = A4 = 0;
                SetDCPWM1(duty1);
                SetDCPWM2(duty2);
            }
            else if (data == 'B' || data == 'b') {
                putrsUSART("Backwards");
                A1 = A3 = 0;
                A2 = A4 = 1;
                SetDCPWM1(duty1);
                SetDCPWM2(duty2);
            }
            else if (data == 'L' || data == 'l') {
                putrsUSART("Left Turn");
                A1 = A4 = 1;
                A2 = A3 = 0;
                SetDCPWM1(duty1);
                SetDCPWM2(duty2);
            }
            else if (data == 'R' || data == 'r') {
                putrsUSART("Right Turn");
                A1 = A4 = 0;
                A2 = A3 = 1;
                SetDCPWM1(duty1);
                SetDCPWM2(duty2);
            }
            else if (data == 'S' || data == 's') {
                putrsUSART("Stop");
                SetDCPWM1(DC_0);
                SetDCPWM2(DC_0);
            }
            else if (data == '1') {
                putrsUSART("Duty Cycle 25%");
                duty1 = DC_25;
                duty2 = DC_25;
            }
            else if (data == '2') {
                putrsUSART("Duty Cycle 50%");
                duty1 = DC_50;
                duty2 = DC_50;
            }
            else if (data == '3') {
                putrsUSART("Duty Cycle 75%");
                duty1 = DC_75;
                duty2 = DC_75;
            }
            else if (data == '4') {
                putrsUSART("Duty Cycle 100%");
                duty1 = DC_100;
                duty2 = DC_100;
            }
        }
    }
    
}

void pwm_init () {
    ClosePWM1();
    ClosePWM2();
    CloseTimer2();

    TRISC2 = 0; // CCP1
    TRISC1 = 0; // CCP2

    OpenTimer2(TIMER_INT_ON & T2_PS_1_1 & T2_POST_1_1);

    OpenPWM1(255);
    OpenPWM2(255);
    
    SetDCPWM1(DC_0);
    SetDCPWM2(DC_0);
}

void usart_init () {
    unsigned char usart_config;
    unsigned int spbrg;

    CloseUSART();

    TRISC6 = 0; // Tx
    TRISC7 = 1; // Rx

    //USART Configuration Flags
    usart_config = USART_TX_INT_OFF & USART_RX_INT_OFF & USART_ASYNCH_MODE
       & USART_EIGHT_BIT & USART_CONT_RX & USART_BRGH_HIGH & USART_ADDEN_OFF;

    spbrg = 77;

    OpenUSART(usart_config, spbrg);
}

import {computed, isRef} from 'vue'

export const useMonthlyPayment = (total, intersetRate, duration) => {
    const monthlyPayment = computed(() => {
        const principle = isRef(total) ? total.value : total;
        const monthlyInterset  = (isRef(intersetRate) ? intersetRate.value : intersetRate) / 100 / 2;
        const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12;
        
        return principle * monthlyInterset * (Math.pow(1 + monthlyInterset, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterset, numberOfPaymentMonths) - 1);
    })

    const totalPaid = computed(() => {
        return (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value
    })

    const totalInterest = computed(() => totalPaid.value - (isRef(total) ? total.value : total))

    return { monthlyPayment, totalPaid, totalInterest }
}
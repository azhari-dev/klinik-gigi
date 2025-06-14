function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-btn');
    
    tabs.forEach(tab => tab.classList.add('hidden'));
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('text-gray-600', 'hover:bg-gray-100');
    });
    
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    event.target.classList.ad

    document.getElementById(tabName + '-tab').classList.remove('hidden');
        // Highlight the active tab button
        if (event && event.target.classList.contains('tab-btn')) {
            event.target.classList.add('bg-primary', 'text-white');
            event.target.classList.remove('text-gray-600', 'hover:bg-gray-100');
        }
}

// Optional: Set default tab on page load
document.addEventListener('DOMContentLoaded', function() {
    // Find the first tab button and trigger click
    const firstTabBtn = document.querySelector('.tab-btn');
    if (firstTabBtn) {
        firstTabBtn.click();
    }
});

// Example function for calling patient (from antrian.php)
function callPatient(name) {
    alert('Memanggil pasien: ' + name);
}

// Example function for showing payment form (from pembayaran.php)
function showPaymentForm(name) {
    const form = document.getElementById('paymentForm');
    const patientInput = document.getElementById('paymentPatient');
    if (form && patientInput) {
        form.classList.remove('hidden');
        patientInput.value = name;
        // Scroll to payment form
        form.scrollIntoView({ behavior: 'smooth' });
    }
}
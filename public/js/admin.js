function showTab(tabName) {
    const tabs = document.querySelectorAll('.tab-content');
    const buttons = document.querySelectorAll('.tab-btn');
    
    // Hide all tabs
    tabs.forEach(tab => tab.classList.add('hidden'));
    
    // Reset all button styles
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('text-gray-600', 'hover:bg-gray-100');
    });
    
    // Show selected tab
    const selectedTab = document.getElementById(tabName + '-tab');
    if (selectedTab) {
        selectedTab.classList.remove('hidden');
    }
    
    // Highlight the active tab button
    if (event && event.target.classList.contains('tab-btn')) {
        event.target.classList.add('bg-primary', 'text-white');
        event.target.classList.remove('text-gray-600', 'hover:bg-gray-100');
    }
}

// Set default tab on page load
document.addEventListener('DOMContentLoaded', function() {
    // Find the first tab button and trigger click
    const firstTabBtn = document.querySelector('.tab-btn');
    if (firstTabBtn) {
        firstTabBtn.click();
    }
});

// Function for calling patient (from antrian.php)
function callPatient(name) {
    if (confirm('Panggil pasien: ' + name + '?')) {
        alert('Pasien ' + name + ' sedang dipanggil!');
        // Here you can add AJAX call to update patient status
    }
}

// Function for showing payment form (from pembayaran.php)
function showPaymentForm(name) {
    const form = document.getElementById('paymentForm');
    const patientInput = document.getElementById('paymentPatient');
    
    if (form && patientInput) {
        form.classList.remove('hidden');
        patientInput.value = name;
        
        // Scroll to payment form smoothly
        form.scrollIntoView({ 
            behavior: 'smooth',
            block: 'center'
        });
    }
}

// Function to handle examination form submission
function submitExamination() {
    const form = document.getElementById('examinationForm');
    if (form) {
        if (confirm('Apakah Anda yakin data pemeriksaan sudah benar?')) {
            form.submit();
        }
    }
}

// Function to handle payment form submission
function submitPayment() {
    const form = document.getElementById('paymentForm');
    if (form) {
        if (confirm('Proses pembayaran ini?')) {
            form.submit();
        }
    }
}
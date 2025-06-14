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
    // Show antrian tab by default
    showTab('antrian');
    
    // Set first button as active
    const firstTabBtn = document.querySelector('.tab-btn');
    if (firstTabBtn) {
        firstTabBtn.classList.add('bg-primary', 'text-white');
        firstTabBtn.classList.remove('text-gray-600', 'hover:bg-gray-100');
    }
});

// Function for calling patient (from antrian.php)
function callPatient(name) {
    if (confirm('Panggil pasien: ' + name + '?')) {
        alert('Pasien ' + name + ' sedang dipanggil!');
        // Here you can add AJAX call to update patient status
        // Example:
        // updatePatientStatus(name, 'sedang_diperiksa');
    }
}

// Function for showing payment form (from pembayaran.php)
function showPaymentForm(name) {
    const form = document.getElementById('paymentForm');
    const patientInput = document.getElementById('paymentPatient');
    const amountInput = document.getElementById('paymentAmount');
    
    if (form && patientInput) {
        form.classList.remove('hidden');
        patientInput.value = name;
        
        // Set amount based on patient (this should come from database in real app)
        if (name === 'Budi Santoso') {
            amountInput.value = 'Rp 150.000';
        } else if (name === 'Siti Aminah') {
            amountInput.value = 'Rp 50.000';
        }
        
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
    const form = document.querySelector('#paymentForm form');
    if (form) {
        if (confirm('Proses pembayaran ini?')) {
            form.submit();
        }
    }
}

// Function to update patient status (placeholder for AJAX implementation)
function updatePatientStatus(patientName, status) {
    // This would typically make an AJAX call to update the database
    console.log('Updating patient status:', patientName, status);
    
    // Example AJAX implementation:
    /*
    fetch('/admin/updatePatientStatus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            patient: patientName,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Refresh the page to show updated data
        }
    });
    */
}
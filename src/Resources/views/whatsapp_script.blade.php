<script>
    document.addEventListener("DOMContentLoaded", function() {
        function addWhatsAppLinks() {
            // Select all phone links
            const phoneLinks = document.querySelectorAll('a[href^="callto:"]');

            phoneLinks.forEach(link => {
                // Check if already processed
                if (link.nextElementSibling && link.nextElementSibling.classList.contains('whatsapp-link')) {
                    return;
                }

                const phoneNumber = link.getAttribute('href').replace('callto:', '');
                
                // Clean number for validation
                const cleanNumber = phoneNumber.replace(/[\s\-\(\)]/g, '');
                
                let targetNumber = null;
                let isValid = false;

                // 1. International Format Validation (e.g. +595...)
                if (/^\+\d{8,15}$/.test(cleanNumber)) {
                    targetNumber = cleanNumber.replace('+', '');
                    isValid = true;
                }
                // 2. Paraguay Local Mobile Format (e.g. 0971374403 -> 595971374403)
                // Logic: Starts with '09', is 10 digits long.
                else if (/^09\d{8}$/.test(cleanNumber)) {
                    // Remove leading '0' and prepend '595'
                    targetNumber = '595' + cleanNumber.substring(1);
                    isValid = true;
                }

                if (isValid && targetNumber) {
                    const whatsappLink = document.createElement('a');
                    whatsappLink.href = `https://wa.me/${targetNumber}`;
                    whatsappLink.target = '_blank';
                    // Style adapted: Smaller (24px), uses icon-call class instead of SVG.
                    whatsappLink.className = 'whatsapp-link ml-2 flex h-6 min-h-6 w-6 min-w-6 items-center justify-center rounded-full text-base icon-call bg-green-200 text-green-800 dark:!text-green-800 hover:bg-green-300 transition-all';
                    whatsappLink.title = 'Chat on WhatsApp';
                    
                    // No inner HTML needed as icon-call is a font class
                    whatsappLink.innerHTML = '';


                    // Append after the link
                    link.parentNode.insertBefore(whatsappLink, link.nextSibling);

                    // Add click handler to prevent event bubbling if needed
                    whatsappLink.addEventListener('click', (e) => {
                         e.stopPropagation();
                    });
                }
            });
        }

        // Run initially
        addWhatsAppLinks();

        // Observer for dynamic content (modal loads, etc.)
        const observer = new MutationObserver((mutations) => {
            addWhatsAppLinks();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
</script>

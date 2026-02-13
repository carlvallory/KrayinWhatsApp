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
                
                // International Format Validation
                // Strict: Must start with + and have 8-15 digits.
                // Examples: +595981123456, +14155552671
                const internationalRegex = /^\+\d{8,15}$/;

                // Clean number for validation (remove spaces/dashes just in case they slipped in?)
                // But callto: usually contains raw number. If attribute had spaces, they might be in href.
                // Let's clean href first.
                const cleanNumber = phoneNumber.replace(/[\s\-\(\)]/g, '');

                if (internationalRegex.test(cleanNumber)) {
                    const whatsappLink = document.createElement('a');
                    whatsappLink.href = `https://wa.me/${cleanNumber.replace('+', '')}`;
                    whatsappLink.target = '_blank';
                    whatsappLink.className = 'whatsapp-link ml-2 inline-flex items-center justify-center rounded-md p-1 text-green-600 hover:bg-green-50 dark:text-green-400 dark:hover:bg-gray-800 transition-all';
                    whatsappLink.title = 'Chat on WhatsApp';
                    
                    // WhatsApp Icon SVG (Simple path)
                    whatsappLink.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.968.587 2.059.894 3.173.894h.004c3.192 0 5.867-2.673 5.869-5.918.001-3.235-2.617-5.863-5.255-5.928zm12.031 5.817c0 2.262-.898 4.382-2.38 5.865s-3.602 2.382-5.865 2.382c-2.261 0-4.382-.898-5.865-2.38-1.482-1.482-2.38-3.603-2.38-5.865 0-2.262.898-4.382 2.38-5.865s3.603-2.38 5.865-2.38c2.262 0 4.382.898 5.865 2.38s2.38 3.602 2.38 5.865z"/>
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    `;

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

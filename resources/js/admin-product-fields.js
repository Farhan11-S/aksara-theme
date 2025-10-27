document.addEventListener('DOMContentLoaded', function() {
    // Carousel images functionality
    const addImageButton = document.getElementById('add-carousel-image');
    const carouselImagesContainer = document.getElementById('product-carousel-images-container');
    const carouselImagesWrapper = carouselImagesContainer.querySelector('.carousel-images-wrapper');
    const hiddenInput = document.getElementById('product_carousel_images');
    
    if (addImageButton) {
        addImageButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create a new media frame
            const frame = wp.media({
                title: 'Select or Upload Images',
                button: {
                    text: 'Use these images'
                },
                multiple: true  // Allow multiple file selection
            });
            
            // When an image is selected in the media frame...
            frame.on('select', function() {
                // Get media attachment details from the frame state
                const attachments = frame.state().get('selection').toJSON();
                
                // Get existing image IDs
                let existingImageIds = hiddenInput.value ? hiddenInput.value.split(',') : [];
                
                // Add new image IDs
                attachments.forEach(function(attachment) {
                    if (!existingImageIds.includes(attachment.id.toString())) {
                        existingImageIds.push(attachment.id);
                        
                        // Create image preview
                        const imageItem = document.createElement('div');
                        imageItem.className = 'carousel-image-item';
                        imageItem.setAttribute('data-image-id', attachment.id);
                        
                        const img = document.createElement('img');
                        img.src = attachment.sizes.thumbnail.url;
                        img.alt = attachment.alt || attachment.title;
                        
                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.className = 'remove-carousel-image';
                        removeButton.textContent = '×';
                        removeButton.addEventListener('click', removeImage);
                        
                        imageItem.appendChild(img);
                        imageItem.appendChild(removeButton);
                        carouselImagesWrapper.appendChild(imageItem);
                    }
                });
                
                // Update hidden input
                hiddenInput.value = existingImageIds.join(',');
            });
            
            // Finally, open the modal
            frame.open();
        });
    }
    
    // Remove image functionality
    function removeImage(e) {
        e.preventDefault();
        const imageItem = e.target.closest('.carousel-image-item');
        const imageId = imageItem.getAttribute('data-image-id');
        
        // Remove from DOM
        imageItem.remove();
        
        // Update hidden input
        let existingImageIds = hiddenInput.value ? hiddenInput.value.split(',') : [];
        existingImageIds = existingImageIds.filter(id => id !== imageId);
        hiddenInput.value = existingImageIds.join(',');
    }
    
    // Add event listeners to existing remove buttons
    const existingRemoveButtons = document.querySelectorAll('.remove-carousel-image');
    existingRemoveButtons.forEach(button => {
        button.addEventListener('click', removeImage);
    });
});
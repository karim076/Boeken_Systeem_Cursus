// document.addEventListener("DOMContentLoaded", function() {


/* -- sidebar open menu -- */
// mobile show side navigation bar
    var left_nav_bar = document.querySelector("nav .navi-list"); // right side navbar
    var nav_hamburg = document.querySelector("#left-navbar-menu");

    nav_hamburg.addEventListener('click', (e) =>{
        nav_sidebar_mobile();
    })
    nav_sidebar_mobile();
    function nav_sidebar_mobile (){
        if(left_nav_bar.classList.contains('open') || !nav_hamburg.checked){
            left_nav_bar.classList.remove('open');
        }
        else if(!left_nav_bar.classList.contains('open') || nav_hamburg.checked){
            left_nav_bar.classList.add('open')
        }
    }
    /* -- end of sidebar open menu -- */

    /* library filters */
    document.querySelectorAll('#table-tb1').forEach(items => {
        let button = items.querySelector('#tb-name');
        let content = items.querySelector('#tb-content');

        // Initialize the content based on whether it's open or not
        if (button.classList.contains('isopen')) {
            content.classList.add('isopen');; // Show content by default if 'isopen' is present
        } else {
            content.classList.remove('isopen');; // Hide content if not open
        }

        button.addEventListener('click', (e) => {
            let btn = e.target;

            // Toggle the 'isopen' class on the button
            if (btn.classList.contains('isopen')) {
                btn.classList.remove('isopen');
                console.log('Button closed:', btn);

                // Hide the content when the button is closed
                if (content) {
                    content.classList.remove('isopen');; // Hide the content
                }
            } else {
                btn.classList.add('isopen');
                console.log('Button opened:', btn);

                // Show the content when the button is open
                if (content) {
                    content.classList.add('isopen'); // Show the content
                }
            }
        });
    });

    // open filter in mobile
    document.querySelector('#library_filters_open').addEventListener('click', (e) =>{
        e.preventDefault();
        const library = document.querySelector('.library_filters ');
        library.style.display = 'flex';

    })
    //
    // closse filter in mobile
    document.querySelector('#library_filters_close').addEventListener('click', (e) =>{
        e.preventDefault();
        const library = document.querySelector('.library_filters ');
        library.style.display = 'none';

    });
    /* end of library filters *?

    /* library slider d1 --- */
    // slider for library cards
   // Slider for library cards
    document.querySelectorAll('#slider_componts_d1').forEach(items => {
        var slider_show = items.querySelector('#slider_images');
        let max_slide = 3; // The total number of slides (images)
        let slider_images = slider_show.children.length; // Count the number of child images in slider

        // Create the slider buttons
        let btn = items.querySelector('#slider_btn');
        if (btn) {
            // Clear any existing buttons first (if any)
            btn.innerHTML = '';

            // Loop to create a button for each image
            for (let i = 0; i < slider_images; i++) {
                // Create a new button for each image in the slider
                let button = document.createElement('span');
                button.classList.add('slider-btn');

                // Attach a click event to each button
                button.addEventListener('click', () => {
                    // Hide all images
                    Array.from(slider_show.children).forEach((image, index) => {
                        image.style.display = 'none'; // Hide the image
                        // Reset button styling
                        btn.querySelectorAll('span').forEach((btn) => {
                            btn.classList.remove('slider_btn_active'); // Remove active class from all buttons
                        });
                    });

                    // Show the corresponding image
                    slider_show.children[i].style.display = 'block'; // Show the clicked image
                    button.classList.add('slider_btn_active'); // Mark the clicked button as active
                });

                // Append the button to the slider buttons container
                btn.appendChild(button);
            }

            // Initially show the first image and set the first button as active
            if (slider_images > 0) {
                slider_show.children[0].style.display = 'block'; // Show the first image
                btn.querySelector('span').classList.add('slider_btn_active'); // Set the first button as active
            }
        }
    });

    /* end of slider d1 --- */

// });

    /* library card set min */
    document.querySelectorAll('#change_library_card').forEach(item => {
        var cards = document.querySelectorAll('.bib_card');

        item.addEventListener('click', (e) => {
            e.preventDefault();
            let item_target = e.target;
            // Get current state of `data-add`
            let addState = item_target.dataset.add === 'true';

            // Toggle state based on current state
            if (addState === true) {
                item_target.dataset.add = 'false'; // Set to false
                cards.forEach(card => {
                    card.classList.add(item_target.dataset.type); // Remove class
                });
                localStorage.setItem('libraryCollumMini', item_target.dataset.type); // Clear local storage
                item_target.classList.remove('bx', 'bx-image'); // Change icon to bx-image
                item_target.classList.add('bx', 'bx-detail'); // Change icon to bx-detail
            }
            if(!addState){
                item_target.dataset.add = 'true'; // Set to true
                cards.forEach(card => {
                    card.classList.remove(item_target.dataset.type); // Add class
                });
                localStorage.removeItem('libraryCollumMini');

                // localStorage.setItem('libraryCollumMini', ''); // Save state
                item_target.classList.remove('bx', 'bx-detail'); // Change icon to bx-image
                item_target.classList.add('bx', 'bx-image'); // Change icon to bx-image
            }

            // Optional: disable button immediately after clicking
            // item_target.classList.add('btn-disabled');
        });

        // Retrieve state from localStorage
        let stored_state = localStorage.getItem('libraryCollumMini');
        if (stored_state) {
            cards.forEach(card => {
                if(stored_state === item.dataset.type){
                  item.dataset.add = 'false';
                  item.classList.remove('bx', 'bx-image'); // Change icon to bx-image
                  item.classList.add('bx', 'bx-detail'); // Change icon to bx-detail
                }else{
                    item.dataset.add = 'true';
                    item.classList.remove('bx', 'bx-detail'); // Change icon to bx-image
                    item.classList.add('bx', 'bx-image'); // Change icon to bx-image
                }
                card.classList.add(stored_state); // Add class based on stored type
            });
        }
    });

    /* end library card set min */

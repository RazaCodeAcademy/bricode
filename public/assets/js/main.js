$('.contacts-person').owlCarousel({
    loop: true,
    margin: 10,
    dots: false,
    responsiveClass: true,
    responsive: {
        // breakpoint from 0 up
        0: {
            items: 6,
            nav: true
        },
        600: {
            items: 10,
            nav: false
        },
        1000: {
            items: 12,
            nav: true,
            loop: false
        }
    }
})

$('.expo-sliders').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                nav: true
            },
            400: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            // breakpoint from 480 up
            768: {
                items: 3,
                nav: false
            },
            // breakpoint from 768 up
            1200: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    })
    // search box
const openSearchboxBtn = document.querySelector('.search-input')
const searchBox = document.querySelector('.dropdown-box');
const searchBoxOverlay = document.querySelector('.searchbox-overlay');

function openSearchBox() {
    searchBox.classList.toggle('show-box');
    searchBoxOverlay.style.display = "block";
}

function hideOverlay() {
    searchBox.classList.toggle('show-box');
    searchBoxOverlay.style.display = "none";
}
if (openSearchboxBtn) {
    openSearchboxBtn.addEventListener('click', openSearchBox);
}
if (searchBoxOverlay) {
    searchBoxOverlay.addEventListener('click', hideOverlay);
}




const addTag = () => {
    var tag = document.getElementById('tag-input');
    if (tag.value != '') {
        var html = `<p class="btn tag-btn ms-1">${tag.value}</p>`;
        document.getElementById('tags').innerHTML += html;
        tag.value = '';
        document.getElementById('close-modal-btn').click();
    } else {
        alert('please enter some value')
    }

}


const filter = document.querySelector('.filter-by');
const showBtn = document.querySelector('.filterbtn');
const crossbtn = document.querySelector('.hide-filter')

showBtn.addEventListener("click", function() {
    filter.classList.toggle('show')
});
crossbtn.addEventListener('click', function() {
    filter.classList.remove('show')
})

// comment

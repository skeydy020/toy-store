const buttonContainer = document.querySelector('.filter-buttons');
const brandList = document.getElementById("brand-list");

filterBrands = filterValues.slice(1);
var brandContainer = document.querySelector('.brand-container');


filterBrands.forEach(filterBrand => {

    brandContainer.innerHTML +=
        `
        <div class="brand brand-item-${filterBrand}">
            <div class="brand-item">
            <div class="brand-number">${filterBrand}</div>
            <div class="brand-logo brand-logo-${filterBrand}">
            </div>
            </div>
            <div class="brand-divider"></div>
        </div>
    `

    var brandLogo = brandContainer.querySelector(`.brand-logo-${filterBrand}`);

    brandData.forEach((brand) => {

        if (brand.char === filterBrand) {
            brandLogo.innerHTML +=
                `
                <a href="${brand.linkBrand}">
                    <img src="${brand.link}" alt="${brand.name}">
                </a>
            `
        }
    });

});

var brands = document.querySelectorAll('.brand');

filterValues.forEach(value => {
    const button = document.createElement("button");
    button.className = "btn-filter";
    button.textContent = value;
    button.addEventListener("click", () => displayBrands(value));
    buttonContainer.appendChild(button);
});

displayBrands("Tất Cả");

function displayBrands(filterChar) {
    var filterCharElement = document.querySelector(`.brand-item-${filterChar}`);

    if (filterChar === filterValues[0]) {
        brands.forEach(value => {
            value.style.display = 'block';
        });
        return;
    }

    brands.forEach(value => {
        if (filterCharElement != value) {
            value.style.display = 'none';
        }
        else {
            value.style.display = 'block';
        }
    });
}
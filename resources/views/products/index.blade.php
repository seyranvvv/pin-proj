@extends('layouts.app')
@section('title', 'Products')
@section('description', '')


@section('content')
    <div class="flex justify-between items-baseline w-full">
        <div class="w-[750px]">
            <div class="grid grid-cols-4 px-2 border-b border-[#C4C4C4]">
                <div class="p-2 px-2 align-text-bottom flex content-center">АРТИКУЛ</div>
                <div class="p-2 px-2 align-text-bottom flex content-center">НАЗВАНИЕ</div>
                <div class="p-2 px-2 align-text-bottom flex content-center">СТАТУС</div>
                <div class="p-2 px-2 align-text-bottom flex content-center">АТРИБУТЫ</div>
            </div>
            @foreach ($products as $product)
                <div data-product="{{ $product->id }}"
                    class="js-product-single grid grid-cols-4 px-2 text-sm bg-white border-b cursor-pointer border-[#C4C4C4]">
                    <div class="p-2 px-2 align-text-bottom flex flex-wrap items-center">{{ $product->article }}</div>
                    <div class="p-2 px-2 align-text-bottom flex flex-wrap items-center">{{ $product->name }}</div>
                    <div class="p-2 px-2 align-text-bottom flex flex-wrap items-center">{{ $product->status->name() }}</div>
                    <div class="p-2 px-2 align-text-bottom flex flex-col content-center">
                        @foreach ($product->data as $data)
                            <div>{{ $data['key'] }}: {{ $data['value'] }}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button id="create-product" class="bg-[#0FC5FF] m-4 px-[1.5rem] py-1 rounded-full text-white">Добавить</button>
    </div>
    @include('products.partials.modal')
@endsection

@push('js')
    <script>
        const productListEl = document.querySelectorAll('.js-product-single');
        const modalEditEl = document.querySelector('.js-modal-edit');
        const modalDeleteEl = document.querySelector('.js-modal-delete');
        const modalCloseEl = document.querySelector('.js-modal-close');
        const modalBackdrop = document.querySelector('#modal-backdrop');
        const modal = document.querySelector('#modal');
        const modalTitle = document.getElementById('modal-title');
        const productForm = document.getElementById('product-form');
        const createProductEl = document.getElementById('create-product');
        const adminRole = "{{ auth()->user()->role }}";
        var modalBody = document.getElementById('modal-body');
        var modalActions = document.getElementById('modal-actions');
        var fetchedProduct = {};

        function toggleClass(element, removeClass, addClass) {
            element.classList.remove(removeClass)
            element.classList.add(addClass)
        }

        async function fetchProduct(id) {
            let response = await fetch(`/product/${id}`).then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(userData => {
                    fetchedProduct = userData.product;
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });
        }

        async function createProduct(data) {
            let rawResponse = await fetch(`/product`, {
                    method: 'POST',
                    headers: {
                        "Accept": "application/json",
                    },
                    body: data
                }).then(response => {
                    if (!response.ok) {
                        alert('Form is not valid!')
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(userData => {
                    alert('successfully created')
                    window.location.reload()
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });
        }

        async function updateProduct(id, data) {
            let rawResponse = await fetch(`/product/${id}?_method=PUT`, {
                    method: 'POST',
                    headers: {
                        "Accept": "application/json",
                    },
                    body: data
                }).then(response => {
                    if (!response.ok) {
                        alert('Form is not valid!')
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(userData => {
                    alert('successfully edited')
                    window.location.reload()
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });
        }

        async function removeProduct() {
            let rawResponse = await fetch(`/product/${fetchedProduct.id}`, {
                    method: 'DELETE',
                    headers: {
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(userData => {
                    window.location.reload()
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });
        }

        async function productShow(id) {
            await fetchProduct(id);
            var modalBodyShow = document.getElementById('modal-body-show').cloneNode(true)
            modalTitle.innerHTML = fetchedProduct.name
            modalBodyShow.querySelector('#show-modal-article').innerHTML = fetchedProduct.article
            modalBodyShow.querySelector('#show-modal-name').innerHTML = fetchedProduct.name
            modalBodyShow.querySelector('#show-modal-status').innerHTML = fetchedProduct.status
            let attributeElement = "";
            for (const attribute of fetchedProduct.data) {
                attributeElement +=
                    `<div>${attribute['key']}: ${attribute['value']}</div>`;
            }
            modalBodyShow.querySelector('#show-modal-data').innerHTML = attributeElement;
            modalBody.innerHTML = '';
            modalBody.appendChild(modalBodyShow);
            toggleClass(modalBodyShow, 'hidden', 'block');
            toggleClass(modalActions, 'hidden', 'flex');
            toggleClass(modalBackdrop, 'hidden', 'absolute');
        }

        function emptyProductForm(form) {
            form.setAttribute('action', '');
            form.querySelector('.js-input-article').value = '';
            form.querySelector('.js-input-name').value = '';
            form.querySelector('.js-input-status').value = '';
            form.querySelector('.js-attributes').innerHTML = '';
        }

        function productCreateForm() {
            emptyProductForm(productForm);
            modalTitle.innerHTML = 'Добавить продукт';
            productForm.setAttribute('method', "POST");
            productForm.querySelector('.js-submit-form').innerHTML = "Добавить";
            productForm.querySelector('.js-input-article').readOnly = false;
            modalBody.innerHTML = "";
            modalBody.appendChild(productForm);
            toggleClass(productForm, 'hidden', 'block');
            toggleClass(modalBackdrop, 'hidden', 'absolute');
        }

        function productEditForm() {
            emptyProductForm(productForm);
            modalTitle.innerHTML = 'Редактировать ' + fetchedProduct.name;
            productForm.querySelector('.js-input-article').value = fetchedProduct.article;
            if (adminRole != 'ADMIN') {
                productForm.querySelector('.js-input-article').readOnly = true;
            }
            productForm.querySelector('.js-input-name').value = fetchedProduct.name;
            productForm.querySelector('.js-input-status').value = fetchedProduct.status;
            productForm.querySelector('.js-submit-form').innerHTML = "Сохранить";
            productForm.setAttribute('method', "PUT");
            productForm.setAttribute('data-product-id', fetchedProduct.id);
            for (const attribute of fetchedProduct.data) {
                addAttribute(attribute['key'], attribute['value']);
            }
            modalBody.innerHTML = "";
            modalBody.appendChild(productForm);
            toggleClass(modalActions, 'flex', 'hidden');
            toggleClass(productForm, 'hidden', 'block');
            toggleClass(modalBackdrop, 'hidden', 'absolute');
        }

        function addAttribute(key = '', value = '') {
            var attributesParent = productForm.querySelector('.js-attributes');
            let index = attributesParent.childElementCount;
            let attribute = `
                        <div class="flex my-2 w-full items-center text-sm">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex flex-col">
                                    <label for="data">Название</label>
                                    <input class="js-key-input form-input rounded h-8 text-gray-800" type="text" name="data[${index}][key]"
                                        value="${key}" id="data">
                                </div>
                                <div class="flex flex-col">
                                    <label for="data">Значение</label>
                                    <input class="js-value-input form-input rounded h-8 text-gray-800" type="text" name="data[${index}][value]"
                                    value="${value}" id="data">
                                </div>
                            </div>
                            <div class="js-remove-attribute cursor-pointer">
                                <img class="w-4 h-4 mx-1" src="/assets/img/remove.svg" alt="">
                            </div>
                        </div>
                `;
            let el = document.createElement('div');
            el.innerHTML = attribute;
            attributesParent.appendChild(el.firstElementChild);
            attributeAddRemoveEvent(attributesParent);
        }

        productListEl.forEach(element => {
            element.addEventListener('click', function() {
                let productId = this.getAttribute('data-product');
                productShow(productId);
            });
        });

        function removeAttribute(el) {
            el.parentNode.remove();
            changeAttributeIndexes();
        }

        function changeAttributeIndexes() {
            let attribute = productForm.querySelector('.js-attributes');
            let children = attribute.children;
            for (let i = 0; i < children.length; i++) {
                let el = children[i];
                el.querySelector('.js-key-input').setAttribute('name', `data[${i}][key]`);
                el.querySelector('.js-value-input').setAttribute('name', `data[${i}][value]`);
            }
        }

        function attributeAddRemoveEvent(element) {
            element.querySelectorAll('.js-remove-attribute').forEach(element => {
                element.addEventListener('click', function(e) {
                    removeAttribute(this);
                });
            });
        }



        productForm.querySelector('.add-attribute').addEventListener('click', function() {
            addAttribute();
        });

        createProductEl.addEventListener('click', function(e) {
            productCreateForm();
        });

        modalEditEl.addEventListener('click', function() {
            productEditForm();
        });

        modalDeleteEl.addEventListener('click', function() {
            removeProduct();
        });

        productForm.addEventListener('submit', function(e) {
            e.preventDefault()
            var formData = new FormData(this);
            let method = this.getAttribute('method');
            if (method == 'POST') {
                createProduct(formData);
            }
            if (method == 'PUT') {
                let productId = this.getAttribute('data-product-id')
                updateProduct(productId, formData);
            }

        });

        modalCloseEl.addEventListener('click', function() {
            toggleClass(modalActions, 'flex', 'hidden');
            toggleClass(modalBackdrop, 'absolute', 'hidden');
        });
    </script>
@endpush

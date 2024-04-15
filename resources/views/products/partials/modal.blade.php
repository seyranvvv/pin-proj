<div id="modal-backdrop" class="h-screen w-screen backdrop-blur-sm absolute top-0 left-0 hidden">
    <div id="modal"
        class="w-[700px] h-[70%] fixed inset-0 z-50 rounded overflow-hidden bg-[#374050] text-white mt-[6rem] mx-auto p-3">
        <div class="flex justify-between w-full">
            <div id="modal-title" class="py-2 text-3xl"></div>
            <div class="flex items-center">
                <div id="modal-actions" class="hidden">
                    <div class="mx-1 cursor-pointer js-modal-edit"><img class="w-8 h-8"
                            src="{{ asset('assets/img/edit.svg') }}" alt="product edit">
                    </div>
                    <div class="mx-1 cursor-pointer js-modal-delete"><img class="w-8 h-8"
                            src="{{ asset('assets/img/delete.svg') }}" alt="product delete">
                    </div>
                </div>
                <div class="mx-1 cursor-pointer js-modal-close"><img class="w-8 h-8"
                        src="{{ asset('assets/img/close.svg') }}" alt="close"></div>
            </div>
        </div>
        <div id="modal-body" class="mt-3">
            <form id="product-form" class="w-[70%]" method="POST" action="">
                @csrf
                <label class="text-sm" for="article">Артикул</label>
                <input class="js-input-article w-full mb-2 rounded form-input text-gray-800" type="text"
                    name="article" id="article">
                <label class="text-sm" for="name">Название</label>
                <input class="js-input-name w-full mb-2 rounded form-input text-gray-800" type="text" name="name"
                    id="name">
                <label class="text-sm" for="status">Статус</label>
                <select class="js-input-status w-full mb-2 rounded form-input text-gray-800" name="status"
                    id="status">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}">{{ $status->name() }}</option>
                    @endforeach
                </select>
                <br>
                <div class="mt-2 text-xl">Атрибуты</div>
                <div class="js-attributes">
                    <div class="flex w-full items-center text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col">
                                <label for="data">Название</label>
                                <input class="form-input rounded h-8 text-gray-800" type="text" name="data[0][key]"
                                    id="data">
                            </div>
                            <div class="flex flex-col">
                                <label for="data">Значение</label>
                                <input class="form-input rounded h-8 text-gray-800" type="text" name="data[0][value]"
                                    id="data">
                            </div>
                        </div>
                        <div class="cursor-pointer">
                            <img class="w-4 h-4 mx-1" src="{{ asset('assets/img/remove.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div id=""
                    class="text-[#5FC6F1] text-sm underline cursor-pointer decoration-solid my-2 add-attribute">
                    + Добавить атрибут
                </div>
                <button
                    class="js-submit-form bg-[#0FC5FF] px-[1.5rem] py-1 rounded-full text-white my-4">Добавить</button>
            </form>
        </div>
    </div>
</div>
<div id="modal-body-show" class="hidden">
    <div class="w-[350px] text-sm mt-4 grid grid-cols-2">
        <div class="text-white/75 my-1">Артикул</div>
        <div id="show-modal-article" class="my-1"></div>
        <div class="text-white/75 my-1">Название</div>
        <div id="show-modal-name" class="my-1"></div>
        <div class="text-white/75 my-1">Статус</div>
        <div id="show-modal-status" class="my-1"></div>
        <div class="text-white/75 my-1">Атрибуты</div>
        <div id="show-modal-data" class="flex flex-col my-1">
        </div>
    </div>
</div>

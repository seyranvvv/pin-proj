<div class="w-full h-16 bg-white flex justify-between">
    <div class="flex">

        <div class="mx-3 h-full text-[#ED1C24] border-b-4 border-[#ED1C24] flex flex-col content-center justify-center">
            <div class="p-1">ПРОДУКТЫ</div>
        </div>
    </div>
    <div class="text-[#A6AFB8] mx-3 h-full flex items-center">
        <a href="{{ route('logout') }}" class="mx-2 cursor-pointer text-[#0FC5FF]">Выйти</a>
        <div class='mx-2'>
            {{ auth()->user()->name }}
        </div>
    </div>
</div>

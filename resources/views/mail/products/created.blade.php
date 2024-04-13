<x-mail::message>
# Introduction

Product is created

<x-mail::table>
| Name          | Value  |
|:------------- | :--------|
| Article       | {{ $product->article }}      |
| Name          | {{ $product->name }}      |
| Status        | {{ $product->status }}      |
| Created at    | {{ $product->created_at->format('d-m-Y / H:i') }}      |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

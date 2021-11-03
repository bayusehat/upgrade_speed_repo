@include('mola.layout.head')
@if ($data)
    {{ view($data['content'],$data) }}
@endif
@include('mola.layout.foot')
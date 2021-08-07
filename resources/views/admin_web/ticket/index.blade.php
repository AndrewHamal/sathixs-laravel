@extends('admin_web.layouts.admin_layouts')

@section('admin_content')
<style>
    /*
    *
    * ==========================================
    * FOR DEMO PURPOSES
    * ==========================================
    *
    */
    body {
    background-color: #74EBD5;
    background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

    min-height: 100vh;
    }

    ::-webkit-scrollbar {
    width: 5px;
    }

    ::-webkit-scrollbar-track {
    width: 5px;
    background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
    width: 1em;
    background-color: #ddd;
    outline: 1px solid slategrey;
    border-radius: 1rem;
    }

    .text-small {
    font-size: 0.9rem;
    }

    .messages-box,
    .chat-box {
    height: 510px;
    overflow-y: scroll;
    }

    .rounded-lg {
    border-radius: 0.5rem;
    }

    input::placeholder {
    font-size: 0.9rem;
    color: #999;
    }

    body {
        height: 100vh;
        overflow-y: hidden;
    }

    .ant-notification-topRight {
        z-index: 9999999999!important;
    }

</style>

<div class="sl-mainpanel">

    <div class="sl-pagebody pt-5">
        <div class="pd-20 pd-sm-40 pt-5">

            @if(request()->type == 'closed')
                {!! $dataTable->table() !!}
            @else
                <div id='app'></div>
            @endif

        </div>
    </div>
</div>
<script src="{{ asset('js/index.js') }}"></script>

@endsection

@section('js')
    @if(request()->type == 'closed')
        {!! $dataTable->scripts() !!}
    @endif
@endsection




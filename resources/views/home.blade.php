@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Creating a responsive and visually engaging layout is a fundamental aspect of modern web design.
                            Leveraging Bootstrap, a popular front-end framework, allows designers and developers to
                            streamline this process. Bootstrap's utility classes provide a versatile toolkit for crafting
                            responsive designs with ease.

                            One key aspect is controlling font size, color, and style. Bootstrap offers fs-* classes to set
                            font sizes, and text-* classes for font colors, enabling dynamic adjustments for various content
                            types. For font style, classes like fw-bold and fw-normal provide control over text weight.

                        </p>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

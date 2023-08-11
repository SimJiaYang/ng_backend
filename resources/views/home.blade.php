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

                            Additionally, Bootstrap facilitates responsive columns through its grid system. Utilizing
                            classes like col-md-6 ensures proper column distribution across different screen sizes. To
                            maximize column height, h-100 and d-flex classes can be combined to create a flexible container
                            that adjusts to its content and viewport.

                            Furthermore, Bootstrap enables seamless sidebar creation with its layout components.
                            Incorporating bg-light for color and navigation icons from Bootstrap Icons enhances the
                            aesthetic appeal. For more personalized styling, custom CSS can be added to complement
                            Bootstrap's built-in classes.

                            In summary, Bootstrap 5's utility classes empower designers to establish consistent font styles,
                            responsive column layouts, and engaging sidebars. This framework's adaptability and ease of use
                        </p>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

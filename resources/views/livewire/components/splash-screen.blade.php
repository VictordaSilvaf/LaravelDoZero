@extends('layouts.base')

@section('body')
        
    <div x-data="splash()" x-init='initSplash'
        class="flex items-center justify-center w-screen h-screen bg-desicon-white">
        <div class="duration-1000 scale-0 opacity-0" x-ref="containerSplash">
            <img src={{ asset('imgs/logo.png') }} alt="Logo desicon" class="w-48 h-auto">
        </div>
    </div>

    <script>
        function splash() {
            return {
                initSplash() {
                    document.body.classList.add('overflow-hidden')
                    this.animate(this.$refs.containerSplash, ['opacity-0', 'scale-0'], 'remove', 500,
                        () => this.animate(this.$refs.containerSplash, ['opacity-0'], 'add', 1200,
                            () => window.location.href = "/dashboard/home"
                        )
                    )
                },
                animate(element, classList, type, time, callback) {
                    setTimeout(() => {
                        if (type == 'add') {
                            element.classList.add(...classList)
                        } else {
                            element.classList.remove(...classList)
                        }

                        if (callback) {
                            callback();
                        }
                    }, time);
                }
            }
        }
    </script>
@endsection

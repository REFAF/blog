@props(['posts'])
<x-post-featured-card :post='$posts[0]' />

            @if ($posts->count() > 1)
                <div class="lg:grid lg:grid-cols-6">

                    @foreach($posts->skip(1) as $post)

                        <x-post-card 
                            :post='$post' 
                            class="{{$loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"  
                            {{-- if it is the first and second post make the span a littele larger--}} 
                        />

                    @endforeach

                </div>
            @endif
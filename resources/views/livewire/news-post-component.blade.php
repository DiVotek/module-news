<div class="wrapper">
   <div class="md:container">
      <div class="row">
         <div class="col-m-9">
            <h1
               class="text-xl sm:text-2xl text-3xl m:text-4xl font-medium uppercase text-base-content md:max-w-[80%] max-md:px-5 mb-8">
               {{$news->seo->heading ?? $news->name}}</h1>
            <div class="pt-2.5 px-2.5 max-md:px-5 pb-11 bg-base-content/10 mb-[4.5rem]">
               <div class="aspect-w-4 aspect-h-2 mb-[1.125rem]">
                  <x-image src="{{$news->image}}" width="100" height="100" alt="{{$news->name}}"
                     class="size-full object-cover" />
               </div>
               <p class="text-base sm:text-xl font-medium text-justify text-base-content">
                 {{$news->seo->summary ?? ''}}
               </p>
            </div>
            <div class="description max-md:px-5">
               {!!$news->seo->content ?? ''!!}
            </div>
         </div>
         <div class="col-m-3">
         </div>
      </div>
   </div>
</div>

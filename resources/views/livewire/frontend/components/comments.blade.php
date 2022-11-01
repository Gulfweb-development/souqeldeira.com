<div>
    <section class="reviews comments">
        @if(!empty($commentsCount))<h3 class="mb-5">{{ $commentsCount }} @lang('app.reviews')</h3>@endif
        @forelse ($comments as $comment)
            {{-- COMMENT START --}}
            <div class="row mb-5">
                <ul class="col-12 commented pl-0">
                    <li class="comm-inf">
                        <div class="col-md-2">
                            <img src="{{ $comment->user->getFile() }}" class="img-fluid" alt="{{ $comment->user->name }}"
                                >
                        </div>
                        <div class="col-md-10 comments-info">
                            <div class="conra">
                                <h5 class="mb-2">{{ $comment->user->name }}</h5>
                                <div class="rating-box">
                                    <div class="detail-list-rating mr-0">
                                        @if ($comment->stars == 1)
                                            <i class="fa fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                        @elseif ($comment->stars == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                        @elseif ($comment->stars == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                           <i class="far fa-star"></i>
                                           <i class="far fa-star"></i>
                                        @elseif ($comment->stars == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                           <i class="far fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p class="mb-4">{{ $comment->created_at->diffForHumans() }}</p>
                            <p>{{ $comment->text }}</p>

                        </div>
                    </li>
                </ul>
            </div>
            {{-- COMMENT END --}}
        @empty
        @endforelse



    </section>
    <!-- End Reviews -->
    <!-- Star Add Review -->
    <section class="single reviews leve-comments details">
        <div id="add-review" class="add-review-box">
            <!-- Add Review -->
            <h3 class="listing-desc-headline margin-bottom-20 mb-4">@lang('app.add_reveiw')</h3>
            @if (authApprovedUser())
                <span class="leave-rating-title">@lang('app.your_rating_gor_this_company')</span>
            @endif
            <!-- Rating / Upload Button -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <!-- Leave Rating -->
                    <div class="clearfix"></div>
                    @if (authApprovedUser())
                        <div class="leave-rating margin-bottom-30">
                            <input type="radio" name="rating" id="rating-5" wire:model="stars" value="5" />
                            <label for="rating-5" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="rating-4" wire:model="stars" value="4" />
                            <label for="rating-4" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="rating-3" wire:model="stars" value="3" />
                            <label for="rating-3" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="rating-2" wire:model="stars" value="2" />
                            <label for="rating-2" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="rating-1" wire:model="stars" value="1" />
                            <label for="rating-1" class="fa fa-star"></label>
                        </div>
                    @endif
                        @error('stars')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                    <div class="clearfix"></div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 data">
                    @if (authApprovedUser())
                        <form action="#">

                            <div class="col-md-12 form-group">
                                <textarea class="form-control" id="exampleTextarea" name="" rows="8"
                                    wire:model="comment"></textarea>
                                    @error('comment')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg mt-2"  wire:loading.attr="disabled" wire:click.prevent="submit">@lang('app.submit_review')</button>
                        </form>
                    @else
                        <h4>@lang('app.you_have_to') <a href="{{ route('login') }}">@lang('app.login')</a>
                            @lang('app.to_can_rate_this')</h4>

                </div>
            </div>
            @endif
        </div>
    </section>
</div>

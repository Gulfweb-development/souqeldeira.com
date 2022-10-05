


<div class="card-columns">
    
     @forelse ($lists as $list)
      <div class="card">
        <div class="card-body">
          <div class="card-title  col text-center badge-success focus">{{ $list->name_ar }}</div>
          <div class="card-text">
              <ul>
                <li>
                    Price : {{ $list->price }}
                 </li>
                <li>
                    Ads Santander : {{ $list->adv_nurmal_count }}
                 </li>
                <li>
                    Ads special : {{ $list->adv_star_count }}
                 </li>
              </ul>
          </div>
        </div>
        <div class="card-footer">
        <a href="{{ route('profile.subscripts.store',$list->id) }}" class="btn btn-primary col text-center">buy</a> 
        </div>
      </div>
  @empty
    {!! noData() !!}
@endforelse
  </div>
</div>

</div>
</div>
</div>
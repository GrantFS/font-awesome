<span class="fa-layers fa-fw fa-lg">
	<span class="fas fa-comment" data-fa-transform="grow-5"></span>
	<span class="fa-layers-text text-dark"
		data-fa-transform="{{ $item->hasTransform() ? $item->getTransform() : 'shrink-7' }}"
		style="font-weight:700;color:white">
		{{ str_limit($item->getCount() > 100 ? 999 : $item->getCount() ,2, '+')}}
	</span>
</span>

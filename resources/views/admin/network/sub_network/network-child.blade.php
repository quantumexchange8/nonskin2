<ol class="dd-list">
    @foreach ($children as $child)
        <li class="dd-item dd-collapsed" data-id="{{ $child->id }}">
            <div class="dd-content box-bg-color">
                <p style='color:#000000;'>
                    @if (count($child->downline))
                        <button class="toggle-downline btn" data-target="#downline-{{ $child->id }}">
                            <i class="mdi mdi-account-plus icon-lg"></i>
                        </button>
                    @endif
                    {{ $child->referrer_id . ' | ' . __('public.Full Name') . ': ' . $child->full_name . ' | Personal Ranking: ' . $child->rank_id }}
                </p>
                
            </div>
            <div id="downline-{{ $child->id }}" class="downline" style="display: none;">
                @if (count($child->downline))
                    @include('member.network.sub_network.network-child', ['children' => $child->downline])
                @endif
            </div>
        </li>
    @endforeach
</ol>

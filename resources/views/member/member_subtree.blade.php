<ol class="dd-list">
    @foreach ($downline as $child)
        @if (count($child->downline))
            <li class="dd-item  dd-collapsed" data-id="{{ $child->id }}">
                <div class="dd-content" onclick="test(this)">
                    <p style='color:#FFD700;'>
                        <i class='bx bx-user'></i>

                        {{ $child->referrer_id . ' | Full Name: ' . $child->full_name . ' | Personal Ranking: ' . $child->personal_ranking_display }}
                    </p>
                </div>
                {{-- @include('member.member_subtree', ['children' => $child->downline]) --}}
            </li>
        @else
            <li class="dd-item" data-id="{{ $child->id }}">
                <div class="dd-content" onclick="test(this)">
                    <p style='color:lightgreen;'>
                        <i class='bx bx-user'></i>
                        {{ $child->referrer_id . ' | Full Name: ' . $child->full_name . ' | Personal Ranking: ' . $child->personal_ranking_display }}
                    </p>
                </div>
            </li>
        @endif
    @endforeach
</ol>

<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{assert('images/wp1.png')}}" class="logo" alt="WorkPass Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

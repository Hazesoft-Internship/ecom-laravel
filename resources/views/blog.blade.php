
<h4>Lists of blogs </h4>
  @foreach ($blogs as $blog )
   <li> {{ $blog['title']}} is written by {{ $blog['author'] }}</li>

  
  @endforeach
  
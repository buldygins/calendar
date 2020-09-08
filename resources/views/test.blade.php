<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<rss version="2.0">
    <channel>
        <title>Title</title>
        <description>Description</description>
        @foreach($events as $event)
            <item>
                <title>{{$event->name}}</title>
                <description>
                   {{$event->cost}}
                  {{$event->type}}
                </description>
            </item>
        @endforeach
    </channel>
</rss>

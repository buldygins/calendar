Тайтл: {{$simp->get_title()}}
Айтемы: @foreach($simp->get_items() as $item)

            {{$loop->iteration}}

    Тайтл: {{$item->get_title()}}

    Дескрипшон: {{$item->get_description()}}

@endforeach

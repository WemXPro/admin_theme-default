@extends(AdminTheme::wrapper(), ['title' =>  'News', 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('admin.news') }}</div>

                <div class="card-body">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">{{ __('admin.create_article') }}</a>
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{!! __('admin.id') !!}</th>
                                <th>{!! __('admin.name') !!}</th>
                                <th>{!! __('admin.url', ['default' => 'URL']) !!}</th>
                                <th>{!! __('admin.status') !!}</th>
                                <th class="text-right">{!! __('admin.actions') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ route('news.article', $article->path) }}</td>
                                    <td>@if(true)
                                            <i class="fas fa-solid fa-circle text-success " style="font-size: 11px;"></i> {!! __('admin.active') !!}
                                        @else
                                            <i class="fas fa-solid fa-circle text-danger " style="font-size: 11px;"></i> {!! __('admin.inactive') !!}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('articles.translation', $article->id) }}"
                                           class="btn btn-warning">{{ __('admin.translations') }}</a>
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                            class="btn btn-primary">{!! __('admin.edit') !!}</a>

                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="deleteItem(event)" type="submit"
                                                class="btn btn-danger">{!! __('admin.delete') !!}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

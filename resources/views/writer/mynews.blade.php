@extends('admin.layouts.app')

@section('title', trans('pages.my_news'))

@section('menu')
    <li><a href="{{ route('write.createNews') }}">{{ trans('pages.write_news') }}</a></li>
    <li class="active"><a href="{{ route('write.index') }}">{{ trans('pages.my_news') }}</a></li>
@endsection

@section('content')
    <section class="p-t-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <form class="form-header" action="{{  route('write.search') }}" method="GET">
                            @csrf
                            <input class="au-input au-input--xl" type="text" name="keyWord"
                                   placeholder="{{ trans('pages.search') }}..." value="{{ $keyWord ?? '' }}"/>
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <a class="btn btn-outline-primary btn-sm"
                           href="{{ route('write.index') }}">{{ trans('pages.all') }}</a>
                        @foreach ($categories as $category)
                            @if(isset($curCategory) && $curCategory->id == $category->id)
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('write.category', $category->id) }}">{{ $category->name }}</a>
                            @else
                                <a class="btn btn-outline-primary btn-sm"
                                   href="{{ route('write.category', $category->id) }}">{{ $category->name }}</a>
                            @endif
                        @endforeach
                        <table class="table table-borderless table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('pages.title') }}</th>
                                <th>{{ trans('pages.description') }}</th>
                                <th>{{ trans('pages.category') }}</th>
                                <th>{{ trans('pages.image') }}</th>
                                <th>{{ trans('pages.created_at') }}</th>
                                <th>{{ trans('pages.updated_at') }}</th>
                                <th>{{ trans('pages.hot') }}</th>
                                <th>{{ trans('pages.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listNews as $news)
                                <tr class="tr-shadow">
                                    <td>
                                        <a href="{{ route('write.news', $news->id) }}">{{ Str::limit($news->title) }}</a>
                                    </td>
                                    <td>{{ Str::limit($news->description) }}</td>
                                    <th>{{ $news->category->name }}</th>
                                    <td>{{ $news->image }}</td>
                                    <td>{{ $news->created_at }}</td>
                                    <td>{{ $news->updated_at }}</td>
                                    <td>
                                        @if ($news->hot)
                                            <span class="badge badge-danger">{{ trans('pages.hot') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ config("news.status.$news->status") }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $listNews->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

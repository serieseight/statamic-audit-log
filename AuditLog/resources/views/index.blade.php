@extends('layout')

@section('content')

<div id="audit-log">
  <div class="flexy mb-24">
    <h1 class="fill">
      Audit Log
    </h1>
  </div>

  <div class="events-list">
    <div class="card flush">
      <table class="dossier">
        <thead>
          <tr>
            <th>Title</th>
            <th>Event</th>
            <th>User</th>
            <th>Date</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach($events as $event)
          <tr>
            <td style="max-width: 325px;">
              <a href="{{ route('auditlog.show', $event) }}">
                {{ $event->getTitle() }}
              </a>
            </td>
            <td>
              {{ $event->event }}
            </td>
            <td>
              {{ $event->user ? $event->user->username() : $event->user_id }}
            </td>
            <td>
              {{ $event->created_at->toDateTimeString() }}
              ({{ $event->created_at->tzName }})
            </td>
            <td class="text-right">
              <a class="btn btn-small" href="{{ route('auditlog.show', $event) }}">
                View
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

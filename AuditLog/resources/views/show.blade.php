@extends('layout')

@section('content')

<div id="audit-log">
  <div class="flexy mb-24">
    <h1 class="fill">
      Audit Log
    </h1>

    <a class="btn" href="{{ $audit_log_action_path }}">
      Back
    </a>
  </div>

  <div class="card">
    <p>
      <strong>Title:</strong>
      {{ $event->getTitle() }}
    </p>

    <p>
      <strong>Event:</strong>
      {{ $event->event }}
    </p>

    <p>
      <strong>User:</strong>
      @if ($event->user)
        {{ $event->user->username() }}

        @if ($event->user->username() !== $event->user->email())
          ({{ $event->user->email() }})
        @endif
      @else
        {{ $event->user_id }}
      @endif
    </p>

    <p>
      <strong>Date:</strong>
      {{ $event->created_at->toDateTimeString() }}
      ({{ $event->created_at->tzName }})
    </p>

    @if (isset($event->meta['ip']))
      <p class="mb-0">
        <strong>IP address:</strong>
        {{ $event->meta['ip'] }}
      </p>
    @endif
  </div>

  <div class="card">
    <p>
      <strong>Snapshot:</strong>
    </p>

    <pre>{{ $event->getYaml('snapshot') }}</pre>
  </div>
</div>

@endsection

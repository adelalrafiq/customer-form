@extends('layouts.app')

@section('content')
    <h2>Ingestuurde Klanten</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>E-mail</th>
                <th>Bestand</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        @if(strpos($customer->ticket_path, '.pdf') !== false)
                            <a href="{{ asset('storage/'.$customer->ticket_path) }}" target="_blank">
                                <div class="pdf-icon">
                                <i class="fas fa-file-pdf"></i>
                                </div>
                            </a>
                       
                        @else
                            <a href="#" data-toggle="modal" data-target="#modal-{{ $customer->id }}">
                                <img src="{{ asset('storage/'.$customer->ticket_path) }}" alt="Ticket thumbnail" class="img-thumbnail" style="max-width: 100px;">
                            </a>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modal-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel-{{ $customer->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{ $customer->id }}">Afbeelding</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if(strpos($customer->ticket_path, '.pdf') !== false)
                                            <p>PDF-bestand kan niet worden weergegeven. Klik <a href="{{ asset('storage/'.$customer->ticket_path) }}" target="_blank">hier</a> om te downloaden.</p>
                                        @else
                                            <img src="{{ asset('storage/'.$customer->ticket_path) }}" alt="Ticket" class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    {{-- <td><a href="{{ asset('storage/'.$customer->ticket_path) }}" target="_blank">Download</a></td> --}}
                    <td>
                        <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                            @csrf
                            <input type="text" name="name" value="{{ $customer->name }}" required>
                            <input type="email" name="email" value="{{ $customer->email }}" required>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
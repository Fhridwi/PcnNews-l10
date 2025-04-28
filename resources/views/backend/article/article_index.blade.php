@extends('backend.layouts.app')

@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">DATA ARTICLES</h4>
                    <a href="{{ route('article.create') }}" class="btn btn-primary btn-sm">ADD ARTICLE</a>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>VIEWS</th>
                                    <th>STATUS</th>
                                    <th>PUBLISHED DATE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
    $(document).ready(function() {
         $('#dataTable').DataTable({
             processing: true,
             serverSide: true,
             ajax: '{{ route('article.index') }}',  
             order: [],  // Disable ordering on all columns
             columns: [
                 { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false }, 
                 { data: 'title', name: 'title' },
                 { data: 'categories', name: 'categories' },
                 { data: 'view_count', name: 'view_count' },
                 { data: 'publish_status', name: 'publish_status' },
                 { data: 'published_at', name: 'published_at' },
                 { data: 'action', name: 'action', orderable: false, searchable: false }
             ]
         });
    });
 </script>
@endpush


@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="{{route('admin.dashboard')}}">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">
		Messages
	</li>
</ol>


<!-- Page Content -->
<div class="row">
	<div class="col-md-12">
		<!-- Tabs -->
		<div>
			<ul class="nav nav-tabs nav-tabs-persistent">
				<li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tab"
					 data-toggle="tab" href="#tab-1" id="active">Inbox</a></li>
				<li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tab"
					 data-toggle="tab" href="#tab-2" id="deleted">Deleted</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tabpanel" id="tab-1">
					<br>
					<table id="messages-dtable" class="table table-striped table-sm w-100">
						<thead>
							<tr>
								<th></th>
								<th>Date</th>
								<th>Event</th>
								<th>Type</th>
								<th>Email</th>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($messages as $msg)
							<tr id="msg-row-{{$msg->id}}" class="{{$msg->read ? '' : 'font-weight-bold'}}">
								<td>{{strtotime($msg->created_at)}}</td>
								<td>{{$msg->created_at}}</td>
								<td>{{App\Event::find($msg->event_id)->name}}</td>
								<td>{{$msg->message_type}}</td>
								<td>{{$msg->email}}</td>
								<td>{{$msg->name}}</td>
								<td>
									<div class="float-right">
										<a data-toggle="tooltip" title="View" onclick="markAsRead({{$msg->id}})" id="viewMsgBtn" class="btn btn-sm btn-primary" href="{{route('admin.messages.view', ['messageID' => $msg->id])}}"><i class="fas fa-search"></i></a>
										<form class="d-inline" method="POST" action="{{route('admin.messages.toggleReadState', ['messageId' => $msg->id])}}">
											@csrf
											@method('PATCH')
											<button id="open-btn-{{$msg->id}}" data-toggle="tooltip" title="{{$msg->read ? 'Mark as unread' : 'Mark as read'}}" type="submit" class="btn btn-sm btn-primary"><i id="open-icon-{{$msg->id}}" class="{{$msg->read ? 'fas fa-envelope-open' : 'fas fa-envelope'}}"></i></button>
										</form>
										<form class="d-inline" method="POST" action="{{route('admin.messages.delete', ['messageID' => $msg->id])}}">
											@csrf
											@method('DELETE')
											<button data-toggle="tooltip" title="Delete" type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="tab-pane {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tabpanel" id="tab-2">
					<br>
					<table id="deleted-messages-dtable" class="table table-striped table-sm w-100">
						<thead>
							<tr>
								<th></th>
								<th>Date</th>
								<th>Event</th>
								<th>Type</th>
								<th>Email</th>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($deletedMessages as $msg)
							<tr>
								<td>{{strtotime($msg->created_at)}}</td>
								<td>{{$msg->created_at}}</td>
								<td>{{App\Event::find($msg->event_id)->name}}</td>
								<td>{{$msg->message_type}}</td>
								<td>{{$msg->email}}</td>
								<td>{{$msg->name}}</td>
								<td>
									<form class="d-inline" method="POST" action="{{route('admin.messages.restore', ['messageID' => $msg->id])}}">
										@csrf
										@method('PUT')
										<button type="submit" class="btn btn-sm btn-primary">Restore</button>
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
</div>

@endsection
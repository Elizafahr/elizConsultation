@include('header')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создание новой заявки</div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('applicationsCreate') }}">
                        @csrf

                        <div class="form-group">
                            <label for="service_id">Услуга</label>
                            <select class="form-control" id="service_id" name="service_id" required>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Время</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="payment_type">Тип оплаты</label>
                            <select class="form-control" id="payment_type" name="payment_type" required>
                                <option value="cash">Наличные</option>
                                <option value="card">Картой</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Создать заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
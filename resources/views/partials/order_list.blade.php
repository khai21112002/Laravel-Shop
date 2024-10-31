@if($orders->isNotEmpty())
    @foreach ($orders as $order)
        <tr class="table-primary">
            <td>{{ $order->order_code }}</td>
            <td>{{ $order->fullname }}</td>
            <td>{{ $order->phone }}</td>
            @switch($order->status)
                @case(0)
                    <td>Đặt thành công</td>
                @break
                @case(1)
                    <td>Đang vận chuyển</td>
                @break
                @case(2)
                    <td>Đã nhận</td>
                @break
                @case(3)
                    <td>Hủy đơn</td>
                @break
                @default
                    <td>Không rõ trạng thái</td>
            @endswitch
            <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
            <td>{{ $order->received_address }}</td>
            <td>Thanh toán khi nhận hàng</td>
            <td>{{ $order->created_at }}</td>
            <td><a href="{{ route('order.detail',['orderId' =>$order->id]) }}" class="btn btn-sm btn-info">View</a></td>
        </tr>
    @endforeach
    @else
    <h6 class="order-notfound">No Product Matches This Result</h6>
@endif



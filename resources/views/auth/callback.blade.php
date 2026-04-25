<!DOCTYPE html>
<html>
<head><title>Đang xác thực...</title></head>
<body>
    <script>
        const payload = {
            token: "{{ $token ?? '' }}",
            user: {!! isset($user) ? json_encode($user) : 'null' !!},
            error: "{{ $error ?? '' }}"
        };

        window.opener.postMessage(payload, "http://localhost:5173");
        window.close();
    </script>
</body>
</html>

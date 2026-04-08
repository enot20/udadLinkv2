<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - UCADLink</title>
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a87 50%, #3d7ab5 100%);
            padding: 2rem;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        }
        .header {
            background: linear-gradient(135deg, #0066CC 0%, #0088EE 100%);
            padding: 2rem;
            text-align: center;
        }
        .header h1 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .content {
            padding: 2rem;
        }
        .content p {
            color: #374151;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #0066CC 0%, #0088EE 100%);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
        }
        .footer {
            background: #f9fafb;
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            color: #6b7280;
            font-size: 0.8rem;
        }
        .warning {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 1rem;
            margin-top: 1.5rem;
            border-radius: 4px;
        }
        .warning p {
            color: #92400e;
            font-size: 0.85rem;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 UCADLink</h1>
        </div>
        
        <div class="content">
            <p>Hola <strong>{{ $name }}</strong>,</p>
            
            <p>Hemos recibido una solicitud para recuperar la contraseña de tu cuenta en <strong>UCADLink</strong>.</p>
            
            <p>Haz clic en el siguiente botón para crear una nueva contraseña:</p>
            
            <div style="text-align: center; margin: 2rem 0;">
                <a href="{{ $url }}" class="button">Restablecer mi Contraseña</a>
            </div>
            
            <div class="warning">
                <p><strong>⚠️ Nota de seguridad:</strong> Este enlace expira en {{ $expires }} minutos. Si no solicitaste este cambio, puedes ignorar este correo.</p>
            </div>
            
            <p style="margin-top: 1.5rem; font-size: 0.85rem; color: #6b7280;">
                Si el botón no funciona, copia y pega este enlace en tu navegador:<br>
                <span style="word-break: break-all;">{{ $url }}</span>
            </p>
        </div>
        
        <div class="footer">
            <p>© 2026 Universidad Cristiana de las Asambleas de Dios - UCADLink</p>
            <p style="margin-top: 0.5rem;">Este es un correo automático, por favor no respondas a este mensaje.</p>
        </div>
    </div>
</body>
</html>
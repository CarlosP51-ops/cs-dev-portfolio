<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 24px; }
        .header { background: #3b82f6; color: white; padding: 16px 24px; border-radius: 8px 8px 0 0; }
        .body { background: #f9fafb; padding: 24px; border: 1px solid #e5e7eb; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #6b7280; font-size: 12px; text-transform: uppercase; }
        .value { margin-top: 4px; font-size: 15px; }
        .message-box { background: white; border: 1px solid #e5e7eb; border-radius: 6px; padding: 16px; margin-top: 4px; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">Nouveau message de contact</h2>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">Nom</div>
                <div class="value">{{ $name }}</div>
            </div>
            <div class="field">
                <div class="label">Email</div>
                <div class="value"><a href="mailto:{{ $email }}">{{ $email }}</a></div>
            </div>
            <div class="field">
                <div class="label">Sujet</div>
                <div class="value">{{ $subject }}</div>
            </div>
            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $message }}</div>
            </div>
        </div>
        <div class="footer">
            CS-Dev Portfolio — Message reçu via le formulaire de contact
        </div>
    </div>
</body>
</html>

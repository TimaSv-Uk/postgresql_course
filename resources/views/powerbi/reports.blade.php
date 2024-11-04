<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power BI Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.16.0/powerbi.min.js"></script>
</head>
<body>
    <div id="reportContainer" style="width: 100%; height: 600px;"></div>

    <script>
        const embedConfiguration = {
            type: 'report',
            tokenType: powerbi.models.TokenType.Embed,
            accessToken: '{{ $accessToken }}',
            embedUrl: '{{ $report['embedUrl'] }}',
            id: '{{ $report['id'] }}',
            permissions: powerbi.models.Permissions.All,
            settings: {
                filterPaneEnabled: true,
                navContentPaneEnabled: true
            }
        };

        const reportContainer = document.getElementById('reportContainer');
        const report = powerbi.embed(reportContainer, embedConfiguration);
    </script>
</body>
</html>

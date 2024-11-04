<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power BI Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.17.0/powerbi.min.js"></script>
</head>
<body>
    <div id="reportContainer" style="height: 600px;"></div>

    <script>
        var embedConfiguration = {
            type: 'report',
            tokenType: models.TokenType.Embed,
            accessToken: "{{ $accessToken }}",
            embedUrl: "https://app.powerbi.com/reportEmbed?reportId={{ $reportId }}&groupId={{ $workspaceId }}",
            id: "{{ $reportId }}",
            settings: {
                filterPaneEnabled: false,
                navContentPaneEnabled: true
            }
        };

        var $reportContainer = $('#reportContainer');
        var report = powerbi.embed($reportContainer.get(0), embedConfiguration);
    </script>
</body>
</html>

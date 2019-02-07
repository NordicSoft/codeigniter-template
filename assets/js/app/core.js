(function (window) {
    
    window.namespace = function (namespaceString) {
        var parts = namespaceString.split('.'),
            parent = window,
            currentPart = '';

        for (var i = 0, length = parts.length; i < length; i++) {
            currentPart = parts[i];
            parent[currentPart] = parent[currentPart] || {};
            parent = parent[currentPart];
        }

        return parent;
    };

    var app = namespace("app");

    app.options = {
        logEnabled: true,
        debugEnabled: true
    }

    app.log = function (message) {
        if (app.options.logEnabled && console && console.log)
            return console.log(message);
        return undefined;
    };

    app.debug = function (object) {
        if (app.options.debugEnabled && console && console.debug) {
            console.debug(object);
        }
    };

    window.app = app;
    
})(window);

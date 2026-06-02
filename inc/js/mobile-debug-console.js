// Mobile Debug Console
// Shows console messages on screen for mobile debugging

(function() {
    'use strict';
    
    // Always enable (not just mobile)
    const isMobile = true; // Force enable for debugging
    
    if (!isMobile) {
        return; // Don't show on desktop
    }
    
    let debugContainer = null;
    let logs = [];
    const maxLogs = 20;
    
    function createDebugConsole() {
        if (debugContainer) return;
        
        debugContainer = document.createElement('div');
        debugContainer.id = 'mobile-debug-console';
        debugContainer.style.cssText = `
            position: fixed;
            bottom: 80px;
            left: 10px;
            right: 10px;
            max-height: 200px;
            background: rgba(0, 0, 0, 0.9);
            color: #0f0;
            font-family: monospace;
            font-size: 11px;
            padding: 10px;
            overflow-y: auto;
            z-index: 99999;
            border-radius: 5px;
            display: block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        `;
        
        const header = document.createElement('div');
        header.style.cssText = `
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid #0f0;
        `;
        header.innerHTML = `
            <span style="color: #0f0; font-weight: bold;">📱 Mobile Debug</span>
            <button id="close-debug" style="background: #f00; color: #fff; border: none; padding: 2px 8px; border-radius: 3px; font-size: 10px;">X</button>
        `;
        
        const content = document.createElement('div');
        content.id = 'debug-content';
        
        debugContainer.appendChild(header);
        debugContainer.appendChild(content);
        document.body.appendChild(debugContainer);
        
        document.getElementById('close-debug').onclick = function() {
            if (debugContainer.style.display === 'none') {
                debugContainer.style.display = 'block';
            } else {
                debugContainer.style.display = 'none';
            }
        };
    }
    
    // Create console immediately
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', createDebugConsole);
    } else {
        createDebugConsole();
    }
    
    function addLog(message, type = 'log') {
        createDebugConsole();
        
        const colors = {
            log: '#0f0',
            error: '#f00',
            warn: '#ff0',
            info: '#0ff'
        };
        
        const time = new Date().toLocaleTimeString();
        const logEntry = `[${time}] ${message}`;
        
        logs.push({ message: logEntry, color: colors[type] || colors.log });
        
        if (logs.length > maxLogs) {
            logs.shift();
        }
        
        const content = document.getElementById('debug-content');
        if (content) {
            content.innerHTML = logs.map(log => 
                `<div style="color: ${log.color}; margin: 2px 0; word-wrap: break-word;">${log.message}</div>`
            ).join('');
            content.scrollTop = content.scrollHeight;
        }
        
        debugContainer.style.display = 'block';
    }
    
    // Override console methods
    const originalConsoleLog = console.log;
    const originalConsoleError = console.error;
    const originalConsoleWarn = console.warn;
    const originalConsoleInfo = console.info;
    
    console.log = function(...args) {
        originalConsoleLog.apply(console, args);
        const message = args.map(arg => 
            typeof arg === 'object' ? JSON.stringify(arg, null, 2) : String(arg)
        ).join(' ');
        
        // Show all Push-related logs AND button logs
        if (message.includes('[Push]') || message.includes('[Push Button]')) {
            addLog(message, 'log');
        }
    };
    
    console.error = function(...args) {
        originalConsoleError.apply(console, args);
        const message = args.map(arg => 
            typeof arg === 'object' ? JSON.stringify(arg, null, 2) : String(arg)
        ).join(' ');
        
        // Show all errors
        addLog(message, 'error');
    };
    
    console.warn = function(...args) {
        originalConsoleWarn.apply(console, args);
        const message = args.map(arg => 
            typeof arg === 'object' ? JSON.stringify(arg, null, 2) : String(arg)
        ).join(' ');
        
        if (message.includes('[Push]') || message.includes('[Push Button]')) {
            addLog(message, 'warn');
        }
    };
    
    console.info = function(...args) {
        originalConsoleInfo.apply(console, args);
        const message = args.map(arg => 
            typeof arg === 'object' ? JSON.stringify(arg, null, 2) : String(arg)
        ).join(' ');
        
        if (message.includes('[Push]') || message.includes('[Push Button]')) {
            addLog(message, 'info');
        }
    };
    
    // Catch global errors
    window.addEventListener('error', function(event) {
        addLog('ERROR: ' + event.message + ' at ' + event.filename + ':' + event.lineno, 'error');
    });
    
    window.addEventListener('unhandledrejection', function(event) {
        addLog('UNHANDLED PROMISE: ' + event.reason, 'error');
    });
    
    // Add initial message
    setTimeout(() => {
        addLog('[Push] Mobile debug console activated', 'info');
        addLog('User Agent: ' + navigator.userAgent.substring(0, 50), 'info');
        addLog('Body classes: ' + document.body.className, 'info');
        addLog('Notification support: ' + ('Notification' in window ? 'YES' : 'NO'), 'info');
        addLog('SW support: ' + ('serviceWorker' in navigator ? 'YES' : 'NO'), 'info');
    }, 100);
    
})();

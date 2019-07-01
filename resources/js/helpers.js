export function findDeep(tasks, id) {
    if (!tasks) {
        return;
    }

    for (const task of tasks) {
        // Test current object
        if (task.id === id) {
            return task;
        }

        // Test children recursively
        const child = findDeep(task.children, id);
        if (child) {
            return child;
        }
    }
}

export function removeDeep(tasks, id) {
    if (!tasks) {
        return;
    }

    for (const task of tasks) {
        // Test current object
        if (task.id === id) {
            task.show = false;
        }

        // Test children recursively
        const child = removeDeep(task.children, id);
        if (child) {
            return child;
        }
    }
}

export function route(){
    /**
     * @apiRoutes see AppController, app.blade.php, bootstrap.js
     * */ 
    let route = apiRoutes[arguments[0]];
    let i = 1;
    return route.replace(/\{([^}]*)\}/g, () => {
        return arguments[i++];
    });
}

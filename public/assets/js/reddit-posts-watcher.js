class RedditPostsWatcher
{
    init() {
        this.sseClient = new SSEClient({
            url: 'http://localhost:9091'
        });

        this.sseClient.addEventListener('PostProcessed', (e) =>
        {
            AvoidJS.Eventer.fire(AvoidJS.Events.RedditPostsWatcher.postProcessed, {
                msg: JSON.parse(JSON.parse(e.data))
            });
        });
    }

    watch() {
        this.sseClient.connect();
    }

    terminate() {
        this.sseClient.disconnect();
    }

    send(url)
    {
        AvoidJS.Ajax.Invoke(new AvoidJS.Ajax.Request('/api/submitUrl', 'POST',  {

            url: url
        }), (response) => {

            AvoidJS.Eventer.fire(AvoidJS.Events.RedditPostsWatcher.postSubmitted, {
                url: url,
            });
        }, (e) => {
            AvoidJS.Eventer.fire(AvoidJS.Events.RedditPostsWatcher.postFailedToSubmit, {
                error: e,
            });
        });
    }
}

AvoidJS.Events.RedditPostsWatcher =
{
    postSubmitted: "postSubmitted",
    postFailedToSubmit: "postFailedToSubmit",
    postProcessed: "postProcessed"
};

AvoidJS.Events.registerEvents(AvoidJS.Events.RedditPostsWatcher);

AvoidJS.Eventer.subscribe(AvoidJS.Events.AvoidJS.inited, () =>
{
    window.rdw = new RedditPostsWatcher();
    rdw.init();
    rdw.watch();
});
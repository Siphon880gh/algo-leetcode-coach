Same task as Web Crawler (collect every URL reachable from the start URL with the same hostname, using an `HtmlParser` whose `getUrls` is slow), but the crawl should use multiple threads to finish faster. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Pool of fetches, one coordinator

```python
from concurrent.futures import ThreadPoolExecutor, wait, FIRST_COMPLETED

def crawl(startUrl, htmlParser):
    host = startUrl.split("/")[2]
    seen = {startUrl}
    with ThreadPoolExecutor(max_workers=16) as pool:
        pending = {pool.submit(htmlParser.getUrls, startUrl)}
        while pending:
            done, pending = wait(pending, return_when=FIRST_COMPLETED)
            for f in done:
                for v in f.result():
                    if v.split("/")[2] == host and v not in seen:
                        seen.add(v)
                        pending.add(pool.submit(htmlParser.getUrls, v))
    return list(seen)
```

Only the coordinating loop touches `seen`, so it needs no lock; worker threads only fetch.

Do not let workers add to `seen` without a lock; two threads can both crawl the same URL. Do not wait for all pending tasks before starting new ones; that turns the crawl back into level-by-level.

Time: about (pages / threads) · fetch time  
Space: O(pages)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

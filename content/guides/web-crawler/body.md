Given a start URL and an `HtmlParser` interface whose `getUrls(url)` returns the links on a page, return all URLs reachable from the start URL that share its hostname, in any order, visiting each once. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS with a host filter

1. `host(u) = u.split("/")[2]` (the part after `http://`).
2. `seen = {start}`, `queue = [start]`.
3. Pop `u`; for each `v` in `getUrls(u)`: if `host(v) == host(start)` and `v` not in `seen`, add and push.
4. Return `seen` as a list.

Do not follow links to other hosts, even if they link back. Do not compare by prefix only; `http://news.example.org` is not `http://news.example.com`, and subdomains are different hosts.

Time: O(pages + links)  
Space: O(pages)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

There are `n` people labeled 0 to `n − 1`. Each log `[timestamp, x, y]` says `x` and `y` became friends at that time; friendship is symmetric, and people are acquainted if they are friends or connected through friends. Return the earliest timestamp at which everyone is acquainted with everyone, or −1. `logs = [[20190101,0,1],[20190104,3,4],[20190107,2,3],[20190211,1,5],[20190224,2,4],[20190301,0,3],[20190312,1,2],[20190322,4,5]]`, `n = 6` → 20190301. `logs = [[0,2,0],[1,0,1],[3,0,3],[4,1,2],[7,3,1]]`, `n = 4` → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Merge in time order

1. Sort `logs` by timestamp.
2. Union-find over `n` people, with `groups = n`.
3. For each `[t, x, y]`: if `x` and `y` have different roots, union them and `groups −= 1`; if `groups == 1`, return `t`.
4. Return −1.

Do not rebuild connectivity with a BFS after each log; that is O(L · (n + L)). Do not assume the logs are already in order; sort them first.

Time: O(L log L + L · α(n))  
Space: O(n)

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

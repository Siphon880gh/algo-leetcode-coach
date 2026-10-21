On a grid, `n` workers and `m ≥ n` bikes have distinct positions. Repeatedly choose the (worker, bike) pair with the smallest Manhattan distance among unassigned workers and bikes; break ties by smaller worker index, then smaller bike index. Assign that bike to that worker and continue. Return `ans`, where `ans[i]` is the bike index of worker `i`. `workers = [[0,0],[2,1]]`, `bikes = [[1,2],[3,3]]` → `[1,0]`. Coordinates are below 1000. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Counting sort on the pair list

1. For each worker `i` (ascending), for each bike `j` (ascending), append `(i, j)` to `bucket[dist(i, j)]`.
2. Walk distances from 0 upward and each bucket in order. If worker `i` and bike `j` are both unassigned, set `ans[i] = j` and mark both used. Stop once all `n` workers are assigned.

Appending in worker-then-bike order means each bucket already follows the tie-break rule.

Sorting all `n · m` triples `(dist, i, j)` gives the same order in O(nm log nm). Do not let each worker take its nearest bike independently; a nearer pair elsewhere may claim it first. Do not use a priority queue of only one candidate per worker without refreshing it when its bike is taken.

Time: O(n · m + D), D ≤ 2000  
Space: O(n · m)

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

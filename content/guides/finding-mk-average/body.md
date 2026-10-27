## low | mid | high

1. Until the queue has `m` values, just store them; when it reaches `m`, sort and split into `k`, `m − 2k`, `k`.
2. Add `x` after that: insert into the right bucket, then evict the oldest value from whichever bucket holds it.
3. Rebalance so `low` and `high` hold exactly `k`, moving boundary elements and updating `midSum`.
4. `calculate`: `−1` if fewer than `m`, else `midSum // (m − 2k)`.

Example → `-1`, `3`, `5`.

Sorting the window on every query is O(m log m) per call and too slow for 10^5 calls. In Python, `SortedList` gives O(log m) inserts and removals.

Time: O(log m) per add, O(1) per query  
Space: O(m)

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

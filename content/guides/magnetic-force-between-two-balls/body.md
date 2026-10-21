## Maximise the minimum

1. Sort; `lo = 1`, `hi = p[-1] − p[0]`.
2. `ok(d)`: count greedy placements; feasible if count ≥ m.
3. Upper-mid binary search for the largest feasible d.

`[1,2,3,4,7]`, m = 3 → 3. `[5,4,3,2,1,1000000000]`, m = 2 → 999999999.

Do not forget to sort. Use upper mid `(lo + hi + 1) / 2` when moving `lo = mid`, or the loop can stall.

Time: O(n log n + n log range)  
Space: O(1) extra

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

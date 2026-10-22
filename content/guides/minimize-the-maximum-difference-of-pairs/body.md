## Search on d

1. Sort `nums`.
2. `ok(d)`: `i = 0`, `cnt = 0`; while `i < n − 1`: if `a[i + 1] − a[i] ≤ d`, `cnt++`, `i += 2`; else `i++`. Return `cnt ≥ p`.
3. Binary search the smallest `d` in `[0, max − min]` with `ok(d)`.

Examples → 1, 0. Checked against trying every set of p pairs on 300 random small arrays.

In sorted order the best pairs are adjacent, and pairing the earliest possible neighbours never blocks more pairs than it uses. p = 0 gives 0.

Time: O(n log n + n log max)  
Space: O(1) besides sorting

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

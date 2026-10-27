## Piecewise cost per pair

For a pair with `x ≤ y`:
- `s < x + 1` or `s > y + limit` → 2 moves.
- `x + 1 ≤ s ≤ y + limit`, `s ≠ x + y` → 1 move.
- `s = x + y` → 0 moves.

1. `d[2] += 2`, `d[x + 1] −= 1`, `d[x + y] −= 1`, `d[x + y + 1] += 1`, `d[y + limit + 1] += 1`.
2. Prefix-sum over `s = 2 .. 2·limit`; return the minimum.

`[1,2,4,3]`, 4 → 1. `[1,2,2,1]`, 2 → 2. `[1,2,1,2]`, 2 → 0.

Do not try every target with an O(n) scan; that is O(n · limit).

Time: O(n + limit)  
Space: O(limit)

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

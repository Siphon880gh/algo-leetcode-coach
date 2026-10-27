## Split search

1. `can(str, t)`: if str is empty, return `t = 0`; else try each prefix p with value ≤ t and recurse on the rest with `t − p`.
2. Sum `i²` for every `i ≤ n` with `can(str(i²), i)`.

Examples → 182, 1478. The largest answer, n = 1000, is 10804657.

Any number of pieces is allowed: 36 needs 1 + 29 + 6. Trying only one cut into two parts misses it, and n = 37 → 182 instead of 1478. i² has at most 7 digits, so at most 2^6 splits each.

Time: O(n · 2^d) for d ≤ 7 digits  
Space: O(d)

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

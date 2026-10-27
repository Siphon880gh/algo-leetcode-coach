## Merge, then count blocks

1. Sort `ranges` by start; `end = −1`, `blocks = 0`.
2. For each `[a, b]`: if `a > end`, `blocks++`; `end = max(end, b)`.
3. Return `2^blocks mod (10^9 + 7)`.

Examples → 2, 4. Checked against a union-find over every overlapping pair on 300 random lists.

Ranges are inclusive, so touching at one integer still overlaps; that is why a new block needs `a > end`, not `a ≥ end`.

Time: O(n log n)  
Space: O(1) besides sorting

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

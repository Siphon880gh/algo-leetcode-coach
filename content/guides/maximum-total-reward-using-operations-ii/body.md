## Word-parallel DP

1. Sort the distinct values. f = 1 (bit 0).
2. For each v: f |= (f & ((1 << v) − 1)) << v.
3. Return the highest set bit of f.

Examples → 4, 11. Checked against trying every order on 300 random arrays.

A plain set of sums is about 5 · 10^4 · 10^5 = 5 · 10^9 steps; the bitset does 64 sums per word operation.

Time: O(n · M / 64), M = max value  
Space: O(M)

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

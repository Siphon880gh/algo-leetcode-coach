## Boundaries

1. `ans = 0`.
2. For each i in `1 … n − 1` with `s[i] ≠ s[i − 1]`: `ans += min(i, n − i)`.
3. Return ans.

Examples → 2, 9. Checked against Dijkstra over all strings on 300 random strings of length up to 8.

A prefix or suffix flip changes exactly one boundary, the one at its edge, so each boundary needs its own flip. The total can reach about 2.5 · 10^9 for n = 10^5, so use 64-bit.

Time: O(n)  
Space: O(1)

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

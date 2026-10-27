## All-pairs shortest paths

1. d[x][x] = 0; d[x][y] = min cost among rules x → y.
2. Floyd–Warshall over 26 letters.
3. Sum `d[source[i]][target[i]]`; if any is infinite, return −1.

Examples → 28, 12, −1.

Changes can chain: using only direct rules gives example 1 → 30 and example 2 → −1 instead of 28 and 12. Totals reach about 2.5 · 10^12; use 64-bit.

Time: O(26³ + n + m)  
Space: O(26²)

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

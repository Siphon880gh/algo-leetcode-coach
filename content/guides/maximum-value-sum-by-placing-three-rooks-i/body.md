## Filter, then brute force

1. Keep the 3 largest cells of each row.
2. Among those, keep the 3 largest of each column.
3. Keep the 11 largest remaining and try every triple with distinct rows and columns.

Examples → 4, 15, 3. Checked against every placement on 400 random boards up to 5 × 5.

Greedy largest-first: [[2, −4, 1], [8, −4, 1], [5, 6, 6]] → 10 instead of 15. Sums can be −3 · 10^9 to 3 · 10^9; use 64-bit.

Time: O(m n log n)  
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

## Close the gap greedily

1. Swap so `sum(a) ≤ sum(b)`; `d = sum(b) − sum(a)`. If `d = 0`, return 0.
2. Gains: `6 − x` for `x` in `a`, `x − 1` for `x` in `b`.
3. Take gains in descending order (a count array over 0 … 5 avoids sorting), counting operations until `d ≤ 0`.
4. Not closed → −1.

Example 1 → 3. Example 2 → −1 (7 ones can reach at least 7, but one die is at most 6). Example 3 → 3.

Overshooting is fine: any single change can be made smaller to land exactly.

Time: O(n + m)  
Space: O(1) with counts

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

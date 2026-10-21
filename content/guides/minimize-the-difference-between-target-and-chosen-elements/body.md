## Pruned subset-sum

1. `poss = {0}`.
2. For each row: new sums `s + x`; keep those ≤ target and the minimum one above target.
3. Return `min |target − s|`.

Example 1 → 0. Example 2 → 94. Example 3 → 1. Checked against all choices on small random matrices.

Without pruning, sums reach 70 · 70 = 4900 per row step; with pruning, the set stays ≤ target + 1 entries. A bitset of size ~target makes each row a few shifts.

Time: O(m · n · target)  
Space: O(target)

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

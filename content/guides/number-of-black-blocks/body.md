## Touched blocks

1. For each black (x, y), for top-left corners (x − 1 or x, y − 1 or y) inside the grid: `cnt[corner] += 1`.
2. `arr[k]` = number of corners with count k, for k ≥ 1.
3. `arr[0] = (m − 1)(n − 1) − |cnt|`.

Examples → [3, 1, 0, 0, 0], [0, 2, 2, 0, 0]. Checked against scanning every block on 300 random small grids.

There can be about 10^10 blocks, so never visit them all, and compute arr[0] in 64-bit.

Time: O(k)  
Space: O(k)

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

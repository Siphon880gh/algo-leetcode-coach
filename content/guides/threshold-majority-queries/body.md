## Blocks of size √n

1. Sort queries by (block of l, r).
2. Queries inside one block: count directly.
3. Otherwise, for each block, start the right pointer at the block end and only move it right, tracking counts and the best (highest frequency, then smallest value).
4. For each query, add nums[l … block end − 1] on top, read the best, then undo those additions.
5. Answer the best value if its frequency ≥ threshold, otherwise −1.

Examples → [1, −1, 2], [3, 2, 3, 2]. Checked against counting every query directly on 500 random cases.

Taking the smallest value that meets the threshold (not the most frequent): [1, 2, 2], query [0, 2, 1] → 1 instead of 2.

Time: O((n + q) · √n)  
Space: O(n)

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

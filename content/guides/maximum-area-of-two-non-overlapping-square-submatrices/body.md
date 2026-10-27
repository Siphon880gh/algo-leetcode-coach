## Prefix and suffix squares

1. Square DP from the bottom-right: f[i][j] = largest square with top-left (i, j). suf[i] = largest square inside rows i … m − 1.
2. Square DP from the top-left: pre[i] = largest square inside rows 0 … i − 1.
3. For each line i in 1 … m − 1: t = min(pre[i], suf[i]); answer = max(answer, t²).
4. Repeat on the transpose and return the larger result.

Examples → 4, 1, 0. Matched trying every pair of squares on 800 random grids up to 5 × 5.

Only trying horizontal lines: example 1 → 1 instead of 4.

Time: O(m · n)  
Space: O(m · n)

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

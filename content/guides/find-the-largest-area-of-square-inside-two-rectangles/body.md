## Pairwise overlap

1. For i < j: w = min(c_i, c_j) − max(a_i, a_j), h = min(d_i, d_j) − max(b_i, b_j).
2. If w > 0 and h > 0, side = min(w, h); keep the largest.
3. Return side².

Examples → 1, 4, 1, 0.

A square, not the overlap rectangle: w · h gives [2, 8, 2, 0]. The area reaches 10^14; use 64-bit. About 5 · 10^5 pairs.

Time: O(n²)  
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

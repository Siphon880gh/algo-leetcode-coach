## Bottom-right corners

1. Update `h[j]` row by row.
2. For each `j`: `mn = ∞`; for `k` from `j` down to 0: `mn = min(mn, h[k])`; stop at 0; add `mn`.
3. Optional: monotonic stack with `cnt[j] = cnt[prev] + h[j] · (j − prev)`.

`[[1,0,1],[1,1,0],[1,1,0]]` → 13. `[[0,1,1,0],[0,1,1,1],[1,1,1,0]]` → 24.

Do not enumerate all corner pairs (O(R²C²)). The O(R · C²) walk passes for 150 × 150.

Time: O(R · C²), or O(R · C) with the stack  
Space: O(C)

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

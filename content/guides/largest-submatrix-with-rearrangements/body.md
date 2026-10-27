## Histogram per row, sorted

1. `h[j] = h[j] + 1` if `matrix[r][j] == 1`, else 0.
2. `s = sorted(h, reverse=True)`; `best = max(best, s[i] · (i + 1))`.

`[[0,0,1],[1,1,1],[1,0,1]]` → 4. `[[1,0,1,0,1]]` → 3. `[[1,1,0],[1,0,1]]` → 2.

Only whole columns move, so heights stay attached to their columns. `m · n ≤ 10^5` keeps the per-row sort cheap; counting sort over heights makes it O(m · n).

Time: O(m · n log n)  
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

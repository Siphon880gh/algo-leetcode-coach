## Set of results per interval

1. `correct` = evaluate with `*` before `+`.
2. Operands at even indices. `f[i][j]` = set of results for operands `i … j`: for each operator `k` between them, combine every `a ∈ f[i][k−1]`, `b ∈ f[k+1][j]`; keep results ≤ 1000.
3. Score: 5 if `ans == correct`, else 2 if `ans ∈ f[0][n−1]`, else 0.

Examples → 7, 19, 10.

Values never decrease when combining non-negative numbers, so pruning above 1000 is safe. The correct answer is also in the set, which is why the 5-point test comes first.

Time: O(m³ · 1000²) worst case for m operands (tiny in practice)  
Space: O(m² · 1000)

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

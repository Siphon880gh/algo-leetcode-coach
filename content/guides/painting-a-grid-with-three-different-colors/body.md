## Columns as states

1. List valid columns: tuples in `{0,1,2}^m` with no equal adjacent entries.
2. Precompute compatible pairs (differ in every row).
3. `dp[c] = 1`; repeat `n − 1` times: `new[b] = Σ dp[a]` over compatible `a`.
4. Sum, mod 1e9+7.

`(1, 1)` → 3. `(1, 2)` → 6. `(5, 5)` → 580986.

Make the short side (m) the column; n up to 1000 is the long side. 48 states with at most 48 neighbours each keep every step tiny.

Time: O(n · S²), S ≤ 48  
Space: O(S²)

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

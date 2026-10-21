## Assign each bag

1. `best = Σ cookies`; `kids = [0] · k`.
2. `go(i)`: if `i = n`, `best = min(best, max(kids))`. Else for each child `j` whose total has not been tried at this level and with `kids[j] + cookies[i] < best`: add, recurse, undo.

Examples → 31, 7. Checked against all k^n assignments on 200 small cases.

n ≤ 8, so even k^n ≤ 8^8 ≈ 1.7 · 10^7 is borderline, and the two prunings cut it sharply. The bitmask DP `dp[j][mask]` = best unfairness for `mask` among `j` children is the O(k · 3^n) alternative.

Time: O(k^n) worst case  
Space: O(n + k)

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

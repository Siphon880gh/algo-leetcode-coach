## Stars and bars

1. Choose counts for a, e, i, o, u summing to n: `C(n + 4, 4)`.
2. Or DP: `dp[v]` = strings ending at vowel ≥ v; each step `dp[v] = Σ dp[w ≥ v]`.

`n = 1` → 5. `n = 2` → 15. `n = 33` → 66045.

Closed form: `(n + 1)(n + 2)(n + 3)(n + 4) / 24`. No modulo is needed for n ≤ 50.

Time: O(1)  
Space: O(1)

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

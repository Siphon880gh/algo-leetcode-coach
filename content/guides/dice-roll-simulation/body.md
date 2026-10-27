## State (last face, run length)

1. After one roll: `dp[j][1] = 1` for all six faces.
2. Each further roll: `tot[j] = Σₖ dp[j][k]`, `all = Σ tot`.
   - `new[j][1] = all − tot[j]` (switch from another face).
   - `new[j][k] = dp[j][k − 1]` for `2 ≤ k ≤ rollMax[j]`.
3. Return `Σ dp` mod `10⁹ + 7`.

`n = 2`, `rollMax = [1,1,2,2,2,3]` → 34. `n = 3`, `[1,1,1,2,2,3]` → 181.

Do not track only the last face; the limit depends on the run length. Do not let a run exceed `rollMax[j]`; drop those states. Take `all − tot[j]` mod carefully so it stays non-negative.

Time: O(n · 6 · 15)  
Space: O(6 · 15)

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

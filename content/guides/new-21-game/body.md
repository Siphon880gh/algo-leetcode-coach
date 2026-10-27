## Window of active states

`P[0] = 1`. For `x ≥ 1`: `P[x] = W / maxPts`, where `W` is the sum of `P[x − i]` for `i` in `1 … maxPts` with `x − i < k` (you only draw while below `k`).

Maintain `W` as you go:

- After computing `P[x]`: if `x < k`, add it to `W` (it can still draw).
- If `x − maxPts ≥ 0` and `x − maxPts < k`, remove `P[x − maxPts]` from `W`.

The answer is `Σ P[x]` for `x` from `k` to `n`.

Shortcuts: if `k == 0` or `n ≥ k − 1 + maxPts`, the answer is 1.

Do not simulate draws randomly; the problem needs exact probabilities. Do not recompute the window sum for each `x`; that is O(n · maxPts).

Time: O(n)  
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

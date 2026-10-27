## Weekly pattern

1. Simulation: `Σ (d // 7 + 1 + d % 7)` for `d = 0 … n − 1`.
2. Closed form: `w = n // 7`, `r = n % 7`; full weeks give `28w + 7·w(w − 1)/2`; the partial week gives `r·(w + 1) + r(r − 1)/2`.

`n = 4` → 10. `n = 10` → 37. `n = 20` → 96.

n ≤ 1000, so the loop is enough.

Time: O(1) closed form, O(n) loop  
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

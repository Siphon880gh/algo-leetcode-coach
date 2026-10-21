## 4096 subsets

1. For each `mask`: `need = Σ (aliceArrows[k] + 1)` over `k` in `mask`; skip if `need > numArrows`.
2. Score `Σ k`; keep the best mask.
3. Build Bob’s array with `aliceArrows[k] + 1` on chosen sections and the spare arrows on section 0.

Examples → scores 47 and 27; this method returns `[0,0,0,0,1,1,0,0,1,2,3,1]` and `[0,0,0,0,0,0,0,0,1,1,1,0]` (any optimal answer is accepted).

Winning with more than `aliceArrows[k] + 1` wastes arrows, and losing costs nothing, so the subset view covers every useful plan.

Time: O(2^12 · 12)  
Space: O(12)

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

## Two independent needs

1. `h = max(0, Σ energy + 1 − initialEnergy)`.
2. `x = initialExperience`. For each opponent: if `x ≤ experience[i]`, `h += experience[i] + 1 − x` and `x = experience[i] + 1`; then `x += experience[i]`.
3. Return `h`.

Examples → 8, 0. Checked against trying every split of training hours on 150 random small cases.

Energy before the last opponent is initialEnergy minus all earlier opponents’ energy, so the tightest point is the end. Training experience earlier never costs less than topping up exactly when needed.

Time: O(n)  
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

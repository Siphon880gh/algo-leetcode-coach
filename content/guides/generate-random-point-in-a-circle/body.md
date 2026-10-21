## Uniform in area, not in radius

Area inside radius `ρ` grows like `ρ²`. If you pick `ρ` uniform in `[0, r]`, half the points land within `r/2`, which is only a quarter of the area — too many points near the center. Fix it by picking `u` uniform in `[0, 1]` and setting `ρ = r · sqrt(u)`. Pick the angle `θ` uniform in `[0, 2π)`. Return `(x_c + ρ cos θ, y_c + ρ sin θ)`.

Rejection sampling also works: pick `x, y` uniform in `[−r, r]`, retry until `x² + y² <= r²`, then shift by the center. Each try succeeds with probability `π/4 ≈ 0.785`, so the expected tries are about 1.27.

Implement Rand10() Using Rand7() (470) is rejection sampling on integers. Random Point in Non-overlapping Rectangles (497) picks a rectangle by area first.

Do not use `ρ = r · u` without the square root. Do not sample `x` uniform and then `y` uniform in the remaining chord — that also skews the distribution.

Time: O(1) per call (expected O(1) with rejection)  
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

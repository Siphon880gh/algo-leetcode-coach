## Search on t

1. `ok(t)`: `Σ floor(√(t / r))` over ranks is at least `cars`.
2. Binary search `t` in `[1, min(ranks) · cars²]` for the smallest `ok(t)`.
3. Return it.

Examples → 16, 16. Checked against increasing t one at a time on 200 random small cases.

The upper bound lets the best mechanic do everything, up to 100 · 10^12 = 10^14, so use 64-bit and an integer square root. Grouping equal ranks (at most 100) makes each check cheap.

Time: O(n log(min rank · cars²))  
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

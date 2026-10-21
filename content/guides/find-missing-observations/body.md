## Feasibility then spread

1. `need = mean · (n + m) − sum(rolls)`.
2. If `need < n` or `need > 6n`, return `[]`.
3. `q, r = divmod(need, n)`; return `r` copies of `q + 1` and `n − r` copies of `q`.

Examples → `[6,6]`, a valid answer such as `[3,2,2,2]`, `[]`.

Each roll is between 1 and 6, so the sum range is exactly `[n, 6n]` and every value in it is reachable. The even spread keeps each roll within `[1, 6]`.

Time: O(n + m)  
Space: O(n)

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

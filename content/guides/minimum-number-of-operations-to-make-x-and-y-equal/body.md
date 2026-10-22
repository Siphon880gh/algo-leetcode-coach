## Memoized recursion

1. f(x) = y − x if y ≥ x.
2. Otherwise f(x) = min(x − y, x mod 5 + 1 + f(⌊x / 5⌋), 5 − x mod 5 + 1 + f(⌊x / 5⌋ + 1), and the same with 11).

Examples → 3, 4, 5. Checked against a BFS over all four operations on 400 random pairs up to 3,000.

Moving up to the next multiple matters: x = 4, y = 1 → 2 (4 → 5 → 1), but only stepping down gives 3. A BFS over values up to about 2 · 10^4 also works.

Time: O(log x) states, each O(1)  
Space: O(log x)

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

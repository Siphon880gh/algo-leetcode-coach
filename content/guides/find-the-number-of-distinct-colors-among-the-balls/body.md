## Two maps

1. If ball x has an old colour, decrement it; remove it at 0.
2. Set ball x to y; increment y.
3. Record the number of colours with a positive count.

Examples → [1, 2, 2, 3], [1, 2, 2, 3, 4].

Counting every colour ever used ignores recolouring: example 1 → [1, 2, 3, 3]. An array indexed by ball needs 10^9 + 1 slots; use a map.

Time: O(q)  
Space: O(q)

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

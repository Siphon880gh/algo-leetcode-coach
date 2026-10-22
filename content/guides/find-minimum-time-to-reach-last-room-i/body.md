## Wait, then move

1. dist[0][0] = 0; pop the smallest time.
2. For each neighbour v: max(t, moveTime[v]) + 1.
3. Answer dist at the bottom-right room.

Examples → 6, 3, 3. Checked against a search over every wait on 150 random grids.

Using max(t + 1, moveTime[v]) (treating it as an arrival time): example 1 → 5 instead of 6.

Time: O(nm log(nm))  
Space: O(nm)

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

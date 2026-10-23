## Deque

1. Group portal cells by letter; d[0][0] = 0.
2. Pop (i, j). If it holds an unused letter: mark it, give every cell with that letter distance d and push them to the front.
3. Push open neighbours with d + 1 to the back.
4. Answer d at the bottom-right, or −1.

Examples → 2, 13. Checked against Dijkstra over (cell, used letters) on 400 random grids.

Counting a teleport as one move: example 1 → 3 instead of 2.

Time: O(m · n)  
Space: O(m · n)

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

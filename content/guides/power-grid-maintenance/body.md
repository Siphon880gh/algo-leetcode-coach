## Lazy heaps

1. Union all connections; push every station into its root’s heap.
2. [2, x]: mark x offline.
3. [1, x]: if x is online, answer x. Otherwise pop offline ids from the top of x’s grid heap; answer the top, or −1 if empty.

Examples → [3, 2, 3], [1, −1]. Checked against a BFS per check on 500 random cases.

Using one heap for every station (ignoring grids): example 2 → [1, 2] instead of [1, −1].

Time: O((c + n) α(c) + q log c)  
Space: O(c)

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
